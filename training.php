<?php require "database.php" ?>
<?php
    if (!$_SESSION['user']) {
        header("Location: login.php");
    }

    if ($_SESSION['type'] != 'boxer') {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>
</head>
<body>
    <?php require 'nav.php' ?>

    <?php
        if(isset($_POST['trained']) && $_POST['trained'] == 'trained') {
            $Get_Trainer_Query = "
                SELECT * FROM In_Training
                RIGHT JOIN Trainers
                ON In_Training.trainer = Trainers.id
                WHERE In_Training.boxer = {$_SESSION['user']['id']}
            ";

            $hasTrainer = mysqli_query($CONNECTION, $Get_Trainer_Query);

            $success = 0;

            if ($hasTrainer) {
                if (mysqli_num_rows($hasTrainer) > 0) {
                    $success = 10;
                } else {
                    $success = 5;
                }
            }

            $trained = false;
            $chance = rand(0, 99);

            if ($chance < $success)
                $trained = true;

            if($trained) {
                $Increase_Stat_Query = "
                    UPDATE Boxers SET {$_POST['skill']} = {$_POST['skill']} + 1
                    WHERE id = '{$_SESSION['user']['id']}'
                ";

                $result = mysqli_query($CONNECTION, $Increase_Stat_Query);

                if($result) {
                    $skill = "";
                    if ($_POST['skill'] == 'technique') {
                        $skill = 'Tehnika';
                    }
                    else if ($_POST['skill'] == 'speed') {
                        $skill = 'Brzina';
                    }
                    else if ($_POST['skill'] == 'power') {
                        $skill = 'Snaga';
                    }
                    else if ($_POST['skill'] == 'defense') {
                        $skill = 'Odbrana';
                    } 
                    else if ($_POST['skill'] == 'chin') {
                        $skill = 'Vilica';
                    }

                    echo "
                    <div class='alert bg-success'>
                        <h2>{$skill}++</h2>

                        <p class='mt-1'>Uspesno ste se povecali $skill.</p>
                    </div>
                    ";
                }
            } else {
                echo "
                <div class='alert bg-danger'>
                    <h2>Trening nije uspeo!</h2>

                    <p class='mt-1'>Probajte ponovo sledeci dan.</p>
                </div>
                ";
            }
        }
    ?>

    <div class="container container-md mt-2">
        <div class="header">
            <?php
                $performance = floor(($_SESSION['user']['technique'] / 10) * (($_SESSION['user']['speed']/2) + ($_SESSION['user']['defense']/3) + ($_SESSION['user']['chin'] / 4)) + $_SESSION['user']['power']);
                echo "<h2 class='mb-1'>Performanse: $performance </h2>";
            ?>
            <h3> Izberi vestinu koju zelis da unapredis </h4>
            <p class='mt-1'> Posle biranja zeljene vestine postoji sansa da se ona poveca </p>
        </div>

        <form class="info" style="text-align: center; padding: 1em;" method="POST" action="training.php">
            <?php
                $Get_Latest_Stats_Query = "
                    SELECT * FROM Boxers where id = '{$_SESSION['user']['id']}'
                ";

                $result = mysqli_query($CONNECTION, $Get_Latest_Stats_Query);

                $row = mysqli_fetch_assoc($result);
                $_SESSION['user'] = $row;

                $technique = $_SESSION['user']['technique'] >= 100 ? 'button' : 'submit';
                $speed = $_SESSION['user']['speed'] >= 100 ? 'button' : 'submit';
                $power = $_SESSION['user']['power'] >= 100 ? 'button' : 'submit';
                $defense = $_SESSION['user']['defense'] >= 100 ? 'button' : 'submit';
                $chin = $_SESSION['user']['chin'] >= 100 ? 'button' : 'submit';

                echo "
                    <h4> Tehnika je najbitniji faktor u formuli performanse boksera </h4>
                    <button class='size-lg' style='margin: 0.5em 0 0.5em 0'
                        name='skill'
                        value='technique'
                        type='{$technique}'
                    >
                        <img src='Assets/Icons/34 punch, man, hit, boxing, boxer, sport, fighting.svg' />
                        <h2> Tehnika </h2>
                        <h3> {$_SESSION['user']['technique']} </h3> 
                        <h1> + </h1>
                    </button>

                    <h4> Brzina je mnozac snage i odbrane </h4>
                    <button class='size-lg bg-success' style='margin: 0.5em 0 0.5em 0'
                        name='skill'
                        value='speed'
                        type='{$speed}'
                    >
                        <img src='Assets/Icons/30 shoes, equipment, boxing, boxer, sport, fighting.svg' />
                        <h2> Brzina </h2> 
                        <h3> {$_SESSION['user']['speed']} </h3>
                        <h1> + </h1>
                    </button>

                    <h4> Snaga je bruto plus u formuli performanse </h4>
                    <button class='size-lg bg-danger' style='margin: 0.5em 0 0.5em 0'
                        name='skill'
                        value='power'
                        type='{$power}'
                    >
                        <img src='Assets/Icons/42 hand, hit, punch, boxing, boxer, sport, fighting.svg' />
                        <h2> Snaga </h2>
                        <h3> {$_SESSION['user']['power']} </h3> 
                        <h1> + </h1>
                    </button>
                    
                    <h4> Odbrana je kontra protivnikove brzine </h4>
                    <button class='size-lg bg-dark-blue' style='margin: 0.5em 0 0.5em 0'
                        name='skill'
                        value='defense'
                        type='{$defense}'
                    >
                        <img src='Assets/Icons/44 gloves, victory, flag, boxing, boxer, sport, fighting.svg' />
                        <h2> Odbrana </h2>
                        <h3> {$_SESSION['user']['defense']} </h3>
                        <h1> + </h1>
                    </button>

                    <h4> Vilica je bruto minus protivnika </h4>
                    <button class='size-lg bg-purple' style='margin: 0.5em 0 0.5em 0'
                        name='skill'
                        value='chin'
                        type='{$chin}'
                    >
                        <img src='Assets/Icons/1 mouth, guard, protection, boxing, boxer, sport, fighting.svg' />
                        <h2> Vilica </h2>
                        <h3> {$_SESSION['user']['chin']} </h3> 
                        <h1> + </h1>
                    </button>
                ";
            ?>
        <input hidden name='trained' value='trained'/>
        </form>
    </div>
</body>
</html>
