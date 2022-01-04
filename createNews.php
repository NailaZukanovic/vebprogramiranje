<?php require "database.php" ?>
<?php 
    if (!$_SESSION['user']) {
        header("Location: login.php");
    }

    if ($_SESSION['type'] != 'admin') {
        header("Location: index.php");
    }
?>
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
                        $isGeneral = 0;

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
                                <div class='containers'>
                                <div class='card'>
                                  <div class='card__header'>
                                    <img src='{$row['image']}' alt='card__image' class='card__image' width='600'>
                                  </div>
                                  <div class='card__body'>
                                    <span class='tag tag-blue'>{$row['dateCreated']}</span>
                                    <h4>{$row['title']}</h4>
                                    <p>{$row['description']}</p>
                                  </div>
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
<?php require 'footer.php' ?>