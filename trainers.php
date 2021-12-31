<?php require "database.php" ?>
<?php
    // if (!$_SESSION['user']) {
    //     header("Location: login.php");
    // }

    // if ($_SESSION['type'] != 'boxer') {
    //     header("Location: index.php");
    // }
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Trainers </title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>
</head>
<body> -->
    <?php include 'header.php'; ?>
    <?php require 'nav.php' ?>

    <?php 
        if(isset($_POST['accept']) && $_POST['accept'] == 'accept' && isset($_POST['tournamentId'])) {
            $Create_Participating_Query = "
                INSERT INTO `Participating` (
                    `tournament`,
                    `participant`
                ) VALUES (
                    '{$_POST['tournamentId']}',
                    '{$_SESSION['user']['id']}'
                )
            ";

            $result = mysqli_query($CONNECTION, $Create_Participating_Query);

            $Remove_Participating_Invitation_Query = "
                DELETE FROM Invitations
                WHERE id = {$_POST['invitationId']}
            ";

            $removeInvitation = mysqli_query($CONNECTION, $Remove_Participating_Invitation_Query);
            

            if($result && $removeInvitation) {
                echo "
                    <div class='alert bg-success'>
                        <h2>Uspesno!</h2>

                        <p class='mt-1'>Prihvatili ste poziv za turnir.</p>
                    </div>
                ";
            } else {
                echo "
                    <div class='alert'>
                        <h2>Greska!</h2>

                        <p class='mt-1'>Doslo je do greske.</p>
                    </div>
                ";
            }
        }
    ?>

    <?php
        if(isset($_POST['accept']) && $_POST['accept'] == 'accept' && isset($_POST['trainerId'])) {
            $Create_In_Training_Query = "
                INSERT INTO In_Training (
                    `boxer`,
                    `trainer`
                ) VALUES (
                    '{$_SESSION['user']['id']}',
                    '{$_POST['trainerId']}'
                )
            ";

            $result = mysqli_query($CONNECTION, $Create_In_Training_Query);

            if($result) {
                echo "
                    <div class='alert bg-success'>
                        <h2>Uspesno!</h2>

                        <p class='mt-1'>Prihvatili ste poziv za treniranje.</p>
                    </div>
                ";

                $Delete_Invitation_Query = "
                    DELETE FROM Invitations
                    WHERE id = {$_POST['invitationId']}
                ";

                $result = mysqli_query($CONNECTION, $Delete_Invitation_Query);
            } else {
                echo "
                    <div class='alert bg-danger'>
                        <h2>Greska!</h2>

                        <p class='mt-1'>Doslo je do greske.</p>
                    </div>
                ";
            }
        } else if (isset($_POST['deny']) && $_POST['deny'] == 'deny') {
            $Delete_Invitation_Query = "
                DELETE FROM Invitations
                WHERE id = {$_POST['invitationId']}
            ";

            $result = mysqli_query($CONNECTION, $Delete_Invitation_Query);

            if($result) {
                echo "
                    <div class='alert bg-blue'>
                        <h2>Odbili ste pozivnicu!</h2>

                        <p class='mt-1'>Uspesno ste odbili pozivnicu.</p>
                    </div>
                ";
            }
        }
    ?>

    <?php
        if (!isset($_POST['accept']) && !isset($_POST['deny']) && isset($_POST['inviteTrainerId'])) {
            $Invite_To_Train = "
                INSERT INTO `Invitations` (
                    `createdBy`,
                    `createdFor`,
                    `description`
                ) VALUES (
                    '{$_SESSION['user']['id']}',
                    '{$_POST['inviteTrainerId']}',
                    '{$_SESSION['user']['username']} zeli da vezba kod vas'
                )
            ";

            $result = mysqli_query($CONNECTION, $Invite_To_Train);

            if ($result) {
                echo "
                    <div class='alert bg-success'>
                        <h2>Pozivnica poslata!</h2>

                        <p class='mt-1'>Uspesno ste poslali pozivnicu.</p>
                    </div>
                ";
            } else {
                echo mysqli_error($result);
            }
        }
    ?>

    <div class="container container-lg mt-2">
        <div class="header mt-2">
            <h3>
                Pozivi Turnira
            </h3>
        </div>

        <div class='info'>
            <?php
                $Tournament_Invites_Query = "
                    SELECT * FROM Invitations, Tournament
                    WHERE
                    Invitations.createdBy = Tournament.id
                    AND
                    '{$_SESSION['user']['id']}' = Invitations.createdFor
                ";

                $tournamentResult = mysqli_query($CONNECTION, $Tournament_Invites_Query);

                if(mysqli_num_rows($tournamentResult) == 0) {
                    echo "
                        <h4 style='padding: 1em; text-align: center'> Nema pozivnica! </h4>
                    ";
                } else {
                    while($row = mysqli_fetch_array($tournamentResult)) {
                        echo "
                            <form method='POST' action='trainers.php'>
                                <div class='flex-col'>
                                    <h3 class='mt-1'> {$row['title']} </h3>
                                    <img class='img-resolution mb-1' src='{$row['image']}' />

                                    <div class='mb-1'>
                                        <button
                                            class='bg-success'
                                            type='submit'
                                            name='accept'
                                            value='accept'
                                        >
                                            Prihvati
                                        </button>

                                        <button
                                            class='bg-danger'
                                            type='submit'
                                            name='deny'
                                            value='deny'
                                        >
                                            Odbij
                                        </button>
                                    </div>
                                </div>
                                
                                <input hidden name='tournamentId' value='{$row['id']}' />
                                <input hidden name='invitationId' value='{$row[0]}'/>
                            </form>
                        ";
                    }
                }
            ?>
        </div>

        <div class="header mt-2">
            <h3>
                Pozivi Trenera
            </h3>
        </div>

        <div class="info">
            <?php
                $Trainer_Invites_Query = "
                    SELECT * FROM Invitations, Trainers
                    WHERE
                    Invitations.createdBy = Trainers.id
                    AND
                    '{$_SESSION['user']['id']}' = Invitations.createdFor
                ";

                $trainerResult = mysqli_query($CONNECTION, $Trainer_Invites_Query);

                if(mysqli_num_rows($trainerResult) == 0) {
                    echo "
                        <h4 style='padding: 1em; text-align: center'> Nema pozivnica! </h4>
                    ";
                } else {
                    while($row = mysqli_fetch_array($trainerResult)) {
                        echo "
                            <form method='POST' action='trainers.php'>
                                <div class='flex-row'>
                                    <img class='avatar' src='{$row['profilePicture']}' />
                                    <h4> {$row['username']} </h4>
                                </div>
                                <div class='flex-row'>
                                <p> {$row['description']} </p>
                                <button
                                    class='bg-success'
                                    type='submit'
                                    name='accept'
                                    value='accept'
                                >
                                    Prihvati
                                </button>
        
                                <button
                                    class='bg-danger'
                                    type='submit'
                                    name='deny'
                                    value='deny'
                                >
                                    Odbij
                                </button>
                                </div>
                                <input hidden name='trainerId' value='{$row['id']}' />
                                <input hidden name='invitationId' value='{$row[0]}'/>
                            </form>
                        ";
                    }
                }
            ?>
        </div>

        <div class="header mt-2">
            <h3>
                Treneri
            </h3>
        </div>

        <div class="info">
            <?php
                // Only trainers that have not been invited are shown 
                $Available_Trainers_Query = "
                    SELECT * FROM Trainers
                    WHERE Trainers.id NOT IN (SELECT createdFor FROM Invitations WHERE createdBy = '{$_SESSION['user']['id']}')
                    AND
                    Trainers.id NOT IN (SELECT createdBy FROM Invitations WHERE createdFor = '{$_SESSION['user']['id']}')
                    AND
                    Trainers.id NOT IN (SELECT trainer FROM In_Training WHERE boxer = '{$_SESSION['user']['id']}')
                ";

                $result = mysqli_query($CONNECTION, $Available_Trainers_Query);

                while($row = mysqli_fetch_array($result)) {
                    if ($row['verified'] == 1 && $row['approved'] == 1) {
                        echo "
                        <form method='POST' action='trainers.php'>
                            <div class='flex-row'>
                                <img class='avatar' src='{$row['profilePicture']}' />
                                <h4> {$row['name']} </h4>
                                <h4> {$row['lastname']} </h4>
                                <h4> {$row['username']} </h4>
    
                                <button
                                    type='submit'
                                >
                                    Pozovi
                                </button>
                            </div>
                            <input hidden name='inviteTrainerId' value='{$row['id']}'/>
                        </form>
                        ";
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>
