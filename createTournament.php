<?php require 'database.php' ?>
<?php 
    if (!$_SESSION['user']) {
        header("Location: login.php");
    }

    if ($_SESSION['type'] != 'admin') {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tournament</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>
</head>
<body>
    <?php require 'nav.php' ?>

    <?php
        if (isset($_POST['title']) && isset($_POST['description'])) {
            $imageTitle = strtolower(str_replace(' ', '', $_POST['title']));

            $imageName = $_FILES['image']['name'];
            $imageTempName = $_FILES['image']['tmp_name'];
            $imageSize = $_FILES['image']['size'];
            $imageError = $_FILES['image']['error'];
            $imageType = $_FILES['image']['type'];

            $fileExtension = explode('.', $imageName);
            $fileLowerCase = strtolower(end($fileExtension));

            $allowed = array('jpg', 'jpeg', 'png', 'webp');

            if (in_array($fileLowerCase, $allowed)) {
                if ($imageError == 0) {
                    if ($imageSize < 10000000) {
                        $date = date('Y/m/d');
                        $fileName = "{$_SESSION['user']['username']}_{$imageTitle}.{$fileLowerCase}";
                        $fileDestination = "tournaments/${fileName}";

                        if (!file_exists('tournaments')) {
                            mkdir('tournaments', 0777, true);
                        }

                        move_uploaded_file($imageTempName, $fileDestination);

                        $date = date('Y/m/d');

                        $tournamentId = uniqid('tournament_');

                        $Create_Tournament_Query = "
                            INSERT INTO `Tournament` (
                                `id`,
                                `title`,
                                `description`,
                                `dateCreated`,
                                `image`,
                                `category`,
                                `gender`
                            ) VALUES (
                                '$tournamentId',
                                '{$_POST['title']}',
                                '{$_POST['description']}',
                                '{$date}',
                                '{$fileDestination}',
                                '{$_POST['category']}',
                                '{$_POST['gender']}'
                            )
                        ";

                        $result = mysqli_query($CONNECTION, $Create_Tournament_Query);

                        if ($result) {
                            if ($_POST['category'] == 'lightWelter') {
                                $minWeight = 57;
                                $maxWeight = 60;
                            } else if ($_POST['category'] == 'welter') {
                                $minWeight = 61;
                                $maxWeight = 66;
                            } else if ($_POST['category'] == 'middle') {
                                $minWeight = 67;
                                $maxWeight = 71;
                            } else if ($_POST['category'] == 'lightHeavy') {
                                $minWeight = 72;
                                $maxWeight = 79;
                            } else {
                                $minWeight = 80;
                                $maxWeight = 140;
                            }

                            $Invite_Boxers_Query = "SELECT * FROM Boxers where weight >= {$minWeight} AND weight <= {$maxWeight} AND gender = {$_POST['gender']}";

                            $boxersResult = mysqli_query($CONNECTION, $Invite_Boxers_Query);
                            
                            if($boxersResult) {
                                $insert_query = "INSERT INTO Invitations (`createdBy`, `createdFor`, `description`) VALUES";
                                $values_query = "";

                                while($row = mysqli_fetch_array($boxersResult)) {
                                    $values_query .= "('$tournamentId', '{$row['id']}', '{$_POST['title']}'), ";
                                }
                            
                                $insert_query .= substr($values_query, 0, -2);

                                $insertResult = mysqli_query($CONNECTION, $insert_query);

                                if($insertResult) {
                                    echo "
                                        <div class='alert bg-success'>
                                            <h2>Turnir postavljen!</h2>
        
                                            <p class='mt-1'>Uspesno ste objavili turnir.</p>
                                        </div>
                                    ";
                                } else {
                                    echo "
                                        <div class='alert bg-danger'>
                                            <h2>Doslo je do greske!</h2>
                                        </div>
                                    ";
                                }
                            }
                        } else {
                            echo "
                                <div class='alert bg-danger'>
                                    <h2>Doslo je do greske!</h2>
                                </div>
                            ";
                        }
                    } else {
                        echo "
                            <div class='alert bg-danger'>
                                <h2>Slika je prevelika!</h2>
                            </div>

                            <div style='text-align: center'>
                                <button 
                                    class='size-lg mt-1 bg-danger'
                                    onClick='location.href = `createTournament.php`'
                                >
                                Nazad
                                </button>
                            </div>
                        ";
                    }
                } else {
                    echo "
                        <div class='alert bg-danger'>
                            <h2>Doslo je do greske!</h2>
                        </div>

                        <div style='text-align: center'>
                            <button 
                                class='size-lg mt-1 bg-danger'
                                onClick='location.href = `createTournament.php`'
                            >
                            Nazad
                            </button>
                        </div>
                    ";
                }
            } else {
                echo "
                    <div class='alert bg-danger'>
                        <h2>Samo slike!</h2>
                    </div>

                    <div style='text-align: center'>
                        <button 
                            class='size-lg mt-1 bg-danger'
                            onClick='location.href = `createTournament.php`'
                        >
                        Nazad
                        </button>
                    </div>
                ";
            }
        }
    ?>

    <div class='container container-lg mt-1'>
        <h2> Napravite turnir </h2>

        <form method='POST' action='createTournament.php' enctype="multipart/form-data" class='mt-1'>
            <label for='title'> Naslov: </label>
            <input type='text' id='title' name='title' class="form-input size-lg" />
            <p hidden id="titleError" class="text-danger"> Neispravan naslov! </p>

            <label for='description'> Opis: </label>
            <textarea id='description' name='description' class="form-input size-lg"></textarea>
            <p hidden id="descriptionError" class="text-danger"> Neispravan opis! </p>

            <div>
                <label class="mt-1" for="image"> Profilna: </label>
                <input type="file" accept="image/*" name="image" id="image" class="size-lg" />
                <p hidden id="imageError" class="text-danger"> Izaberite sliku! </p>
            </div>

            <label for='category'> Kategorija: </label>
            <select name='category' id='category'>
                <option value='heavy'> Teska </option>
                <option value='lightHeavy'> Polu-Teska </option>
                <option value='middle'> Srednja </option>
                <option value='welter'> Velter </option>
                <option value='lightWelter'> Polu-Velter </option>
            </select>

            </br>

            <label class='mt-1' for='gender'> Pol: </label>
            <select name='gender' id='gender'>
                <option value='0'> M </option>
                <option value='1'> Z </option>
            </select>

            <div>
                <button type="submit" onClick="handleSubmit(event)" class="mt-1 size-lg"> Postavi </button>
            </div>
        </form>

        <h2 class='mt-1'> Turniri </h2>

        <div class='mt-1'>
            <?php 
                $Get_Tournaments_Query = "
                    SELECT * FROM Tournament
                    ORDER BY dateCreated DESC
                ";

                $result = mysqli_query($CONNECTION, $Get_Tournaments_Query);

                if($result) {
                    while($row = mysqli_fetch_array($result)) {
                        $active = "
                            <button type='submit' class='size-lg'>
                                Pregledaj 
                            </button>
                        ";
                        if ($row['winner']) {
                            $active = "
                                <button class='size-lg'
                                    onClick='location.href = \"tournament.php?id={$row['id']}\"'
                                >
                                    Pregledaj
                                </button>
                            ";
                        }
                        echo "
                            <form method='GET' action='tournament.php' class='mb-1'>
                                <div class='info mt-2'>
                                    <div class='flex-row'>
                                        <h3 style='padding: 0.4em'> {$row['title']} </h3>
                                        <p> {$row['dateCreated']} </p>
                                    </div>
                                    <div style='display: flex; flex-direction: column'>
                                        <img class='img-resolution' src='{$row['image']}'/>
                                        <p style='padding: 1em;'> {$row['description']} </p>
                                        {$active}
                                    </div>
                                </div>
                                <input hidden name='id' value='{$row['id']}' />
                            </form>
                        ";
                    }
                }
            ?>
        </div>
    </div>

    <script src='JS/createTournament.js'></script>
</body>
</html>
