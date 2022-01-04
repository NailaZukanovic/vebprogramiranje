<?php require 'database.php' ?>
<?php
    // if (!$_SESSION['user']) {
    //     header("Location: login.php");
    // }

    // if ($_SESSION['type'] != 'trainer') {
    //     header("Location: index.php");
    // }
?>
    <?php include 'header.php';?>
    <?php require 'nav.php' ?>

    <div class='container container-lg index'>
        <?php
            $Get_All_Patients_Query = "
                SELECT * FROM Boxers

                WHERE Boxers.fk_trainers = {$_SESSION['user']['id']}
            ";
            $result = mysqli_query($CONNECTION, $Get_All_Patients_Query);

            if ($result) {
                echo "
                    <div class='header mt-2' style='text-align:center'>
                         <h3>
                            Pregled pacijenata i unos podataka u karton uz mogucnost ostavljanja poruke
                        </h3>
                    </div>
                ";
                if (mysqli_num_rows($result) > 0) {
                    $boxer = mysqli_fetch_array($result);

                    echo "
                    <form method='POST' action='trainer.php' class='mb-2 mt-1' enctype='multipart/form-data'>
                        <div class='mt-1' style='min-width: 460px; padding: 0.4em'>
                            <div class='flex-row' style='justify-content: center'>
                                <h3> {$boxer['name']} </h3>
                                <h3 style='margin-left: 0.5em'> {$boxer['lastname']} </h3>
                                <h3 style='visibility:hidden' name='id'> {$boxer['id']} </h3>
                            </div>
                            
                            <div class='flex-col'>
                                <img class='img-resolution' src='{$boxer['profilePicture']}' />
                            </div>

                            <div class='mt-1'>
                                <h4> Email: {$boxer['email']} </h4>
                            </div>

                            <label for='karton'> <b>Unesi u karton: </b></label>
                            <input type='text' name='karton' id='karton' class='form-input size-lg' style='width:70%'/>
                            
                            <label for='poruka'> <b>Napisi svom pacijentu: </b></label>
                            <input type='text' name='poruka' id='poruka' class='form-input size-lg' style='width:70%'/>

                            <button type='submit' class='mt-1 size-lg' name='zaKarton' id='zaKarton'> Unesi </button>
                        </div>
                    </form>
                     ";
                }
             }
        ?>

        <div class='header mt-2' style='text-align:center'>
            <h3>
                Unesi vest
            </h3>
        </div>

        <form method='POST' action='trainer.php' class='mb-2 mt-1' enctype='multipart/form-data' style="padding-left:10px">
            <label for="title"> Naslov: </label>
            <input type="text" name="title" id="title" class="form-input size-lg"  style="width:70%"/>

            <label class="mt-1" for="description"> Opis: </label>
                <textarea name="description" id="description" class="form-input size-lg" style="width:70%">
                </textarea>


            <div>
                <label class="mt-1" for="newsImage"> Slika: </label>
                <input type="file" accept="image/*" name="newsImage" id="newsImage" class="size-lg" />
            </div>
            <div>
                <button type="submit" class="mt-1 size-lg" name="vest" id="vest"> Postavi vest! </button>
            </div>
        </form>

    </div>

    <?php
        if(isset($_POST['zaKarton']))
        {
            $karton = $_POST['karton'];

            $poruka = $_POST['poruka'];

            $boxerId = $_POST['id'];

            $Get_Weight_Query = "
                SELECT weight FROM boxers
                WHERE
                boxers.id = {$_POST['id']}
            ";
            $result = mysqli_query($CONNECTION, $Get_Weight_Query);

            $weight = mysqli_fetch_array($result) + $karton;

            $Update_Weight_Query = "
            UPDATE boxers SET weight={$weight} WHERE id = {$_POST['id']}
            ";

            $result = mysqli_query($CONNECTION, $Update_Weight_Query);

            $Create_Message_Query = "
                INSERT INTO `Invitations` (
                    `createdBy`,
                    `createdFor`,
                    `description`
                ) VALUES (
                    '{$_SESSION['user']['id']}',
                    '{$_POST['id']}',
                    '{$poruka}'
                )
            ";

            $result = mysqli_query($CONNECTION, $Create_Message_Query);

        }

    ?>


    <?php

        if(isset($_POST['vest']))
        {
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
                        $isGeneral = 1;

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
                    }
                }
            }
        }
    ?>

    <?php include 'footer.php';?>
</body>
</html>
