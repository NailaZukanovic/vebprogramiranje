<?php require "database.php" ?>
<?php 
    // if (!$_SESSION['user']) {
    //     header("Location: login.php");
    // }

    // if ($_SESSION['type'] != 'admin') {
    //     header("Location: index.php");
    // }
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create News</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>
</head>
<body> -->
    <?php include 'header.php' ;?>
    <?php require 'nav.php' ?>

    <?php
        if(isset($_POST['title']) && isset($_POST['description'])) {
            $newsImageTitle = strtolower(str_replace(' ', '', $_POST['title']));

            $newsImageName = $_FILES['newsImage']['name'];
            $newsImageTempName = $_FILES['newsImage']['tmp_name'];
            $newsImageSize = $_FILES['newsImage']['size'];
            $newsImageError = $_FILES['newsImage']['error'];
            $newsImageType = $_FILES['newsImage']['type'];

            $fileExtension = explode('.', $newsImageName);
            $fileLowerCase = strtolower(end($fileExtension));

            $allowed = array('jpg', 'jpeg', 'png', 'webp');

            if (in_array($fileLowerCase, $allowed)) {
                if ($newsImageError == 0) {
                    if ($newsImageSize < 10000000) {
                        $fileName = "{$_SESSION['user']['username']}.{$newsImageTitle}.{$fileLowerCase}";
                        $fileDestination = "news/${fileName}";

                        if (!file_exists('news')) {
                            mkdir('news', 0777, true);
                        }

                        move_uploaded_file($newsImageTempName, $fileDestination);

                        $date = date('Y/m/d');
                        $isGeneral = $_POST['newsType'] == "sports" ? 1 : 0;

                        $Create_News_Query = "
                            INSERT INTO `News` (
                                `title`,
                                `description`,
                                `dateCreated`,
                                `image`,
                                `isGeneral`
                            ) VALUES (
                                '{$_POST['title']}',
                                '{$_POST['description']}',
                                '{$date}',
                                '{$fileDestination}',
                                {$isGeneral}
                            )
                        ";

                        $result = mysqli_query($CONNECTION, $Create_News_Query);

                        if ($result) {
                            echo "
                                <div class='alert bg-success'>
                                    <h2>Vest postavljena!</h2>

                                    <p class='mt-1'>Uspesno ste postavili vest.</p>
                                </div>
                            ";
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
                                    onClick='location.href = `adminPage.php`'
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
                                onClick='location.href = `adminPage.php`'
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
                            onClick='location.href = `adminPage.php`'
                        >
                        Nazad
                        </button>
                    </div>
                ";
            }
        }
    ?>

    <div class="container container-lg">
        <form method="POST" action="createNews.php" enctype="multipart/form-data">
            <div class='mt-1'>
                <label for="title"> Naslov: </label>
                <input type="text" name="title" id="title" class="form-input size-lg" />
                <p hidden id="titleError" class="text-danger"> Naslov nije ispravan </p>

                <label class="mt-1" for="description"> Opis: </label>
                <textarea name="description" id="description" class="form-input size-lg"
                    onKeyPress="handleCurrentTextareaChars()"
                ></textarea>
                <p style="text-align: right" id="currentTextareaChars"> 0 / 512</p>
                <p hidden id="descriptionError" class="text-danger"> Opis nije ispravan </p>
                
                <div>
                    <label class="mt-1" for="newsImage"> Slika: </label>
                    <input type="file" accept="image/*" name="newsImage" id="newsImage" class="size-lg" />
                    <p hidden id="newsImageError" class="text-danger"> Izaberite sliku </p>
                </div>

                <label class="mt-1" for="newsType"> Vest je: </label>
                <select 
                    name="newsType"
                    id="newsType"
                >
                    <option value="general">Uopstena</option>
                    <option value="sports">Sportska</option>
                </select>

                <div>
                    <button type="submit" onClick="handleSubmit(event)" class="mt-1 size-lg"> Postavi vest! </button>
                </div>
            </div>
        </form>

        <div>
            <div class="header mt-2">
                <h3>
                    Vesti
                </h3>
            </div>
            
            <div class="mt-1" style="text-align: center">
                <h3> Sve vesti </h3>
            </div>

            <div class="mt-1">
                <?php 
                    $Get_News_Query = "
                        SELECT * FROM News ORDER BY dateCreated DESC
                    ";

                    $result = mysqli_query($CONNECTION, $Get_News_Query);

                    if($result) {
                        while($row = mysqli_fetch_array($result)) {
                            echo "
                                <form class='info mb-1' method='POST' action='adminPage.php'>
                                    <div class='info'>
                                        <div class='flex-row'>
                                            <h3 style='padding: 0.4em'> {$row['title']} </h3>
                                            <p> {$row['dateCreated']} </p>
                                        </div>
                                        <div style='display: flex; flex-direction: column'>
                                        <img class='img-resolution' src='{$row['image']}'/>
                                        <p style='padding: 1em;'> {$row['description']} </p>
                                        </div>
                                    </div>

                                    <button type='submit' style='width: 100%;' class='size-lg'> Izbrisi </button>
                                    
                                    <input hidden name='newsId' value='{$row['id']}' />
                                </form>
                            ";
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <script src="JS/createNewsValidation.js?newversion"></script>
</body>
</html>
