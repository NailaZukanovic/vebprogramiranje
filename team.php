<?php require 'database.php' ?>

<?php
    if (!$_SESSION['user']) {
        header("Location: login.php");
    }

    if ($_SESSION['type'] != 'trainer') {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>
</head>
<body>
    <?php require 'nav.php' ?>

    <?php
        if(isset($_POST['boxerId'])) {
            $Remove_From_In_Training = "
                DELETE FROM In_Training
                WHERE boxer = '{$_POST['boxerId']}'  
            ";

            $removeInTraining = mysqli_query($CONNECTION, $Remove_From_In_Training);

            if($removeInTraining) {
                echo "
                    <div class='alert bg-success'>
                        <h2> Bokser izbrisan iz tima !</h2>

                        <p class='mt-1'> Bokser izbrisan iz tima. </p>
                    </div>
                ";
            } else {
                echo "
                    <div class='alert bg-danger'>
                        <h2> Greska! </h2>

                        <p class='mt-1'> Doslo je do greske. </p>
                    </div>
                ";
            }
        }
    ?>

    <div class='container container-lg'>
        <div class='flex-col mt-2'>
            <?php
                $Get_Boxers_In_Training = "
                    SELECT * FROM In_Training
                    RIGHT JOIN
                    Boxers ON Boxers.id = In_Training.boxer
                    WHERE
                    In_Training.trainer = '{$_SESSION['user']['id']}'
                ";

                $boxerResult = mysqli_query($CONNECTION, $Get_Boxers_In_Training);

                if($boxerResult) {
                    if(mysqli_num_rows($boxerResult) == 0) {
                        echo "<h1>Nemate nikog u timu!</h1>";
                    } else {
                        while($row = mysqli_fetch_array($boxerResult)) {
                            $gender = $row['gender'] = 1 ? 'M' : 'Z';
                            echo "
                                <form method='POST' action='team.php'>
                                    <div class='mt-1' style='min-width: 460px; background-color: white; padding: 0.4em'>
                                        <h2 style='text-align: center; border-bottom: 2px solid black;'> {$row['username']} </h2>
                                        <div class='flex-row' style='justify-content: center'>
                                            <h3> {$row['name']} </h3>
                                            <h3 style='margin-left: 0.5em'> {$row['lastname']} </h3>
                                            <h3 style='margin-left: 0.5em'> {$row['weight']} </h3>
                                            <h3 style='margin-left: 0.5em'> {$gender} </h3>
                                        </div>
                                        
                                        <div class='flex-col'>
                                            <img class='img-resolution' src='{$row['profilePicture']}' />
                                        </div>
    
                                        <div class='flex-row'>
                                            <h4> Tehnika </h4>
                                            <h4> Brzina </h4>
                                            <h4> Snaga </h4>
                                            <h4> Odbrana </h4>
                                            <h4> Vilica </h4>
                                        </div>
                                        <div class='flex-row'>
                                            <h4> {$row['technique']} </h4>
                                            <h4> {$row['speed']} </h4>
                                            <h4> {$row['power']} </h4>
                                            <h4> {$row['defense']} </h4>
                                            <h4> {$row['chin']} </h4>
                                        </div>
    
                                        <div style='display: flex; justify-content: center;'>
                                            <button type='submit' class='bg-danger'>
                                                Otupusti
                                            </button>
                                        </div>
    
                                        <input hidden name='boxerId' value='{$row['id']}'/>
                                    </div>
                                </form>
                            ";
                        }
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>
