<?php require 'database.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Tournament </title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>
</head>
<body>
    <?php require 'nav.php' ?>
    
    <?php
        $Get_Tournament_By_Id = "
            SELECT * FROM Tournament
            WHERE id = '{$_GET['id']}'
        ";

        $result = mysqli_query($CONNECTION, $Get_Tournament_By_Id);

        $tournament = mysqli_fetch_array($result);

        if(!$tournament) {
            echo "
            <div style='text-align: center'>
                <div class='alert bg-danger'>
                    <h2>Turnir ne postoji!</h2>

                    <p class='mt-1'>Proverite informacije o turniru.</p>
                </div>

                <button
                    class='size-lg mt-1 bg-danger'
                    onClick='location.href = `index.php`'
                >
                    Nazad
                </button>
            </div>
            ";
            die();
        }

        // Had to make this seperate query
        // Cause i didn't know how to do it in one query (Get_Tournament_By_Id) at the top
        if(!is_null($tournament['winner'])) {
            $Get_Winner_Query = "
                SELECT username FROM Boxers
                WHERE id = '{$tournament['winner']}'
            ";

            $tournamentWinnerResult = mysqli_query($CONNECTION, $Get_Winner_Query);

            $tournamentWinner = mysqli_fetch_row($tournamentWinnerResult);
        }

        if ($result) {
            $Get_Participating_Boxers = "
                SELECT * FROM Boxers, Participating
                WHERE
                Participating.tournament = '{$_GET['id']}'
                AND
                Participating.participant = Boxers.id
            ";

            $participatingBoxers = mysqli_query($CONNECTION, $Get_Participating_Boxers);
        }
    ?>

    <?php
        if(isset($_POST['finish'])) {
            $Find_Best_Boxer_Query = "
            SELECT *, MAX(((technique / 10) * ((speed / 2) + (defense / 3) + (chin / 4)) + power)) AS performance FROM Boxers
            ";

            $result = mysqli_query($CONNECTION, $Find_Best_Boxer_Query);

            $winner = mysqli_fetch_array($result);

            if($result) {
                $Update_Tournament_Winner_Query = "
                    UPDATE Tournament SET winner='{$winner['id']}' WHERE id='{$tournament['id']}'
                ";

                $updateTournamentResult = mysqli_query($CONNECTION, $Update_Tournament_Winner_Query);

                if($updateTournamentResult) {
                    echo "
                        <div class='alert'>
                            <h2>POBEDNIK JE {$winner['username']}!</h2>

                            <p class='mt-1'>Turnir se zavrsio sa najboljim bokserom {$winner['username']}.</p>
                        </div>
                    ";
                }
            }
        }
    ?>

    <div class='container container-lg mt-1'>
        <?php
            if(!$tournament['winner'] && mysqli_num_rows($participatingBoxers) > 0 && isset($_SESSION['type']) && $_SESSION['type'] == 'admin') {
                $playTournament = "
                <button 
                    class='size-lg'
                    type='submit'
                > Odigraj turnir </button>
                ";
            } else if ($tournament['winner']){
                $playTournament = "
                    <img src='./Assets/Icons/11 belt, award, champion, boxing, boxer, sport, fighting.svg' />
                    <h1 style='text-align: center; margin-bottom: 0.4em'> {$tournamentWinner[0]} </h1>
                ";
            } else {
                $playTournament = "";
            }
            echo "
                <form method='POST' action='tournament.php?id={$tournament['id']}'>
                    <div class='info mt-2'>
                        <div class='flex-row'>
                            <h3 style='padding: 0.4em'> {$tournament['title']} </h3>
                            <p> {$tournament['dateCreated']} </p>
                        </div>
                        <div style='display: flex; flex-direction: column'>
                        <img class='img-resolution' src='{$tournament['image']}'/>
                        <p style='padding: 1em;'> {$tournament['description']} </p>
                        <input hidden name='finish' value='finish' />
                        </div>
                        $playTournament
                    </div>
                </form>
            ";
        ?>
        <?php 
            if($participatingBoxers) {
                if(mysqli_num_rows($participatingBoxers) == 0) {
                    echo "<h1 class='mt-1' style='text-align: center'> Niko se nije prijavio jos uvek! </h1>";
                }
            }
        ?>
        <div class="header mt-2">
            <h3>
                Takmicari
            </h3>
        </div>
        <div class='info'>
            <?php 
                if($participatingBoxers) {
                    if(mysqli_num_rows($participatingBoxers) > 1) {
                        while($row = mysqli_fetch_array($participatingBoxers)) {
                            $performance = floor(($row['technique'] / 10) * (($row['speed']/2) + ($row['defense']/3) + ($row['chin'] / 4)) + $row['power']);

                            echo "
                                <div class='flex-row'>
                                    <img class='avatar' src='{$row['profilePicture']}' />
                                    <h4> {$row['name']} </h4>
                                    <h4> {$row['lastname']} </h4>
                                    <h4> {$row['username']} </h4>
                                    <h4> {$row['weight']} </h4>
                                    <h4> $performance </h4>
                                </div>
                            ";
                        }
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>