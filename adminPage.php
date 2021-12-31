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
    <title>Admin page</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>
</head>
<body> -->
    <?php require 'header.php' ?>
    <?php require 'nav.php' ?>
    
    <?php
        if (isset($_POST['newsId'])) {
            $Delete_News_Query = "
                DELETE FROM News where id = {$_POST['newsId']}
            ";

            $result = mysqli_query($CONNECTION, $Delete_News_Query);

        //     if ($result) {
        //         echo "
        //             <div class='alert bg-success'>
        //                 <h2>Vest izbrisana!</h2>
        
        //                 <p class='mt-1'>Uspesno ste izbrisali vest.</p>
        //             </div>
        //         ";
        //     }
        }
    ?>

    <?php
        if(isset($_POST['allow'])) {
            if($_POST['type'] == 'boxer') {
                $Approve_Boxer_Query = "
                    UPDATE Boxers SET approved=1 WHERE id='{$_POST['id']}'
                ";

                $result = mysqli_query($CONNECTION, $Approve_Boxer_Query);

                // if($result) {
                //     echo "
                //         <div class='alert bg-success'>
                //             <h2>Bokser odobren!</h2>
            
                //             <p class='mt-1'>Uspesno ste odobrili boksera.</p>
                //         </div>
                //     ";
                // } else {
                //     echo "
                //         <div class='alert bg-danger'>
                //             <h2>Doslo je do greske!</h2>
            
                //             <p class='mt-1'>Doslo je do greske.</p>
                //         </div>
                //     ";
                // }             
            } else {
                $Approve_Trainer_Query = "
                    UPDATE Trainers SET approved='1' WHERE id='{$_POST['id']}'
                ";

                $result = mysqli_query($CONNECTION, $Approve_Trainer_Query);

                // if($result) {
                //     echo "
                //         <div class='alert bg-success'>
                //             <h2>Trener odobren!</h2>
            
                //             <p class='mt-1'>Uspesno ste odobrili trenera.</p>
                //         </div>
                //     ";
                // } else {
                //     echo "
                //         <div class='alert bg-danger'>
                //             <h2>Doslo je do greske!</h2>
            
                //             <p class='mt-1'>Doslo je do greske.</p>
                //         </div>
                //     ";
                // }            
            }
        } else if(isset($_POST['deny'])) {
            if($_POST['type'] == 'boxer') {
                $Delete_Boxer_Query = "
                    DELETE FROM Boxers WHERE id='{$_POST['id']}'
                ";

                $result = mysqli_query($CONNECTION, $Delete_Boxer_Query);

                // if($result) {
                //     echo "
                //         <div class='alert bg-success'>
                //             <h2>Bokser odbijen!</h2>
            
                //             <p class='mt-1'>Uspesno ste odbili boksera.</p>
                //         </div>
                //     ";
                // } else {
                //     echo "
                //         <div class='alert bg-danger'>
                //             <h2>Doslo je do greske!</h2>
            
                //             <p class='mt-1'>Doslo je do greske.</p>
                //         </div>
                //     ";
                // }     
            } else {
                $Delete_Trainer_Query = "
                    DELETE FROM Trainers WHERE id='{$_POST['id']}'
                ";

                $result = mysqli_query($CONNECTION, $Delete_Trainer_Query);

                // if($result) {
                //     echo "
                //         <div class='alert bg-success'>
                //             <h2>Trener odbijen!</h2>
            
                //             <p class='mt-1'>Uspesno ste odbili trenera.</p>
                //         </div>
                //     ";
                // } else {
                //     echo "
                //         <div class='alert bg-danger'>
                //             <h2>Doslo je do greske!</h2>
            
                //             <p class='mt-1'>Doslo je do greske.</p>
                //         </div>
                //     ";
                // }  
            }
        }
    ?>

    <div class="container container-lg mt-2 index">
        <div>
            <div class="header">
                <h3>
                    Odobri nove korisnike
                </h3>
            </div>

            <div class="info">
                <h4 style="padding: 1em; border-bottom: 2px solid black">Bokseri</h4>
                <?php
                    $Pending_Boxers_Query = "
                        SELECT * FROM `Boxers` WHERE approved=0
                    ";

                    $boxersResult = mysqli_query($CONNECTION, $Pending_Boxers_Query);

                    
                    if(mysqli_num_rows($boxersResult) == 0) {
                        echo "
                            <h1 style='padding: 0.4em; text-align: center;'> Nema novih boksera za odobravanje </h1>
                        ";
                    } else {
                        while($row = mysqli_fetch_array($boxersResult)) {
                            echo "
                                <form method='POST' action='adminPage.php'>
                                    <div class='flex-row'>
                                        <img class='avatar' src='{$row['profilePicture']}' />
                                        <h4> {$row['name']} </h4>
                                        <h4> {$row['lastname']} </h4>
                                        <h4> {$row['username']} </h4>
    
                                        <button class='bg-success'
                                            type='submit'
                                            name='allow'
                                            value='allow'
                                        >
                                            Odobri
                                        </button>
    
                                        <button class='bg-danger'
                                            type='submit'
                                            name='deny'
                                            value='deny'
                                        >
                                            Odbij
                                        </button>
                                    </div>
                                    <input hidden name='type' value='boxer'/>
                                    <input hidden name='id' value='{$row['id']}'/>
                                </form>
                            ";
                        }
                    }
                ?>
            </div>

            <div class="info mt-2">
                <h4 style="padding: 1em; border-bottom: 2px solid black">Treneri</h4>
                <?php
                    $Pending_Trainers_Query = "
                        SELECT * FROM `Trainers` WHERE approved=0
                    ";

                    $trainersResult = mysqli_query($CONNECTION, $Pending_Trainers_Query);

                    if(mysqli_num_rows($trainersResult) == 0) {
                        echo "
                            <h1 style='padding: 0.4em; text-align: center;'> Nema novih trenera za odobravanje </h1>
                        ";
                    } else {
                        while($row = mysqli_fetch_array($trainersResult)) {
                            echo "
                                <form method='POST' action='adminPage.php'>
                                    <div class='flex-row'>
                                        <img class='avatar' src='{$row['profilePicture']}' />
                                        <h4> {$row['name']} </h4>
                                        <h4> {$row['lastname']} </h4>
                                        <h4> {$row['username']} </h4>
    
                                        <button class='bg-success'
                                            type='submit'
                                            name='allow'
                                            value='allow'
                                        >
                                            Odobri
                                        </button>
    
                                        <button class='bg-danger'
                                            type='submit'
                                            name='deny'
                                            value='deny'
                                        >
                                            Odbij
                                        </button>
                                    </div>
                                    <input hidden name='type' value='trainer'/>
                                    <input hidden name='id' value='{$row['id']}'/>
                                </form>
                            ";
                        }
                    }
                ?>
            </div>
        </div>
        
        <div class="info mt-1">
                <button class="size-lg"
                    onClick="location.href = 'createNews.php'"
                >
                    <h3>
                        Nova vest
                    </h3>
                    <h2>
                        +
                    </h2>
                </button>
        </div>

        <div class="header">
            <h3>
                Sadrzaj kontakt stranice 
            </h3>
        </div>

        <div class="info">
        <?php
                echo "
                    <form method='POST' action='contact.php' class='mb-2 mt-1' enctype='multipart/form-data'>
                        <div id='basicInfo'>
                        <label for='izmena'> izmenite: </label>
                        <input type='text' name='izmena' id='izmena' class='form-input size-lg' style='width:70%'/>
                        <button type='submit'class='mt-1 size-lg' name='izmenaKontakta' id='izmenaKontakta'> :) </button>
                    </form>
                "       
                

            ?>


        </div>
    </div>
<!-- </body>
</html> -->

<?php include 'footer.php' ?>