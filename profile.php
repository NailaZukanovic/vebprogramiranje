<?php require 'database.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>
</head>
<body>
    <?php
        $Get_Admin_Profile_Query = "
            SELECT * FROM Admins
            WHERE username = '{$_GET['username']}'
        ";

        $Get_Boxer_Profile_Query = "
            SELECT * FROM Boxers
            WHERE username = '{$_GET['username']}'
        ";

        $Get_Trainer_Profile_Query = "
            SELECT * FROM Trainers
            WHERE username = '{$_GET['username']}'
        ";

        $adminResult = mysqli_query($CONNECTION, $Get_Admin_Profile_Query);
        $boxerResult = mysqli_query($CONNECTION, $Get_Boxer_Profile_Query);
        $trainerResult = mysqli_query($CONNECTION, $Get_Trainer_Profile_Query);

        if($boxerResult && mysqli_num_rows($boxerResult) > 0) {
            $result = mysqli_fetch_array($boxerResult);
        } else if ($trainerResult && mysqli_num_rows($trainerResult) > 0) {
            $result = mysqli_fetch_array($trainerResult);
        } else if ($adminResult && mysqli_num_rows($adminResult) > 0) {
            $result = mysqli_fetch_array($adminResult);
        } else {
            echo "
            <div style='text-align: center'>
                <div class='alert bg-danger'>
                    <h2>Profil ne postoji!</h2>

                    <p class='mt-1'>Proverite informacije o profilu.</p>
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
    ?>
    <?php require 'nav.php' ?>
    
    <div class='container container-lg mt-2'>
        <div class='info'>
            <?php
                $gender = $result['gender'] == 0 ? 'M' : 'Z';

                echo "
                    <h1 style='text-align: center; padding: 0.4em'> {$result['username']} </h1>
                    <img class='img-resolution' src='{$result['profilePicture']}' />
                    <div class='flex-row'>
                        <div>
                            <h3> Ime: {$result['name']} </h3>
                            <h3> Prezime: {$result['lastname']} </h3>".(isset($result['weight']) ? `<h3> Tezina: {$result['weight']} </h3>` : '')."
                            <h3> email: {$result['email']} </h3>
                        </div>
                        <div>
                            <h3> Pol: {$gender} </h3>
                            <h3> Mesto rodjenja: {$result['birthPlace']} </h3>
                            <h3> Drzava rodjenja: {$result['birthCountry']} </h3>
                            <h3> Datum rodjenja: {$result['birthDate']} </h3>
                        </div>
                    </div>
                    ".(isset($result['technique']) ? `
                        <div class='flex-row'>
                            <h2> Tezina </h2>
                            <h2> Brzina </h2>
                            <h2> Snaga </h2>
                            <h2> Odbrana </h2>
                            <h2> Vilica </h2>
                        </div>

                        <div class='flex-row'>
                            <h2> {$result['technique']} </h2>
                            <h2> {$result['speed']} </h2>
                            <h2> {$result['power']} </h2>
                            <h2> {$result['defense']} </h2>
                            <h2> {$result['chin']} </h2>
                        </div>
                    ` : '')."
                    "
            ?>
        </div>
    </div>
</body>
</html>