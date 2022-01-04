<?php require "database.php" ?>
<?php 
    if (!$_SESSION['user']) {
        header("Location: login.php");
    }

    if ($_SESSION['type'] != 'admin') {
        header("Location: index.php");
    }
?>
<!-- <body>  -->
    <?php require 'header.php' ?>
    <?php require 'nav.php' ?>
    
    <?php
        if (isset($_POST['newsId'])) {
            $Delete_News_Query = "
                DELETE FROM News where id = {$_POST['newsId']}
            ";

            $result = mysqli_query($CONNECTION, $Delete_News_Query);
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
                <h4 style="padding: 1em; border-bottom: 2px solid black">Pacijenti</h4>
                <?php
                    $Pending_Boxers_Query = "
                        SELECT * FROM `boxers` WHERE approved=0
                    ";

                    $boxersResult = mysqli_query($CONNECTION, $Pending_Boxers_Query);

                    
                    if(mysqli_num_rows($boxersResult) > 0) {
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

    <?php
        if(isset($_POST['allow'])) {
            if($_POST['type'] == 'boxer') {
                $Approve_Boxer_Query = "
                    UPDATE boxers SET approved=1 WHERE id='{$_POST['id']}'
                ";

                $result = mysqli_query($CONNECTION, $Approve_Boxer_Query);
            } else {
                $Approve_Trainer_Query = "
                    UPDATE trainers SET approved='1' WHERE id='{$_POST['id']}'
                ";

                $result = mysqli_query($CONNECTION, $Approve_Trainer_Query);
            }
        } else if(isset($_POST['deny'])) {
            if($_POST['type'] == 'boxer') {
                $Delete_Boxer_Query = "
                    DELETE FROM boxers WHERE id='{$_POST['id']}'
                ";

                $result = mysqli_query($CONNECTION, $Delete_Boxer_Query);}
            } else {
                $Delete_Trainer_Query = "
                    DELETE FROM trainers WHERE id='{$_POST['id']}'
                ";

                $result = mysqli_query($CONNECTION, $Delete_Trainer_Query); }
    ?>



            <div class="info mt-2">
                <h4 style="padding: 1em; border-bottom: 2px solid black">Lekari</h4>
                <?php
                    $Pending_Trainers_Query = "
                        SELECT * FROM `trainers` WHERE approved=0
                    ";

                    $trainersResult = mysqli_query($CONNECTION, $Pending_Trainers_Query);

                    if(mysqli_num_rows($trainersResult) > 0) {
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
                ";       
                

            ?>


        </div>
    </div>


<?php include 'footer.php' ?>