<?php require "database.php"; ?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>

</head>
<body> -->
    <?php include 'header.php' ?>
    <?php include 'nav.php' ?>
    <div class="block-center">
    <?php
            $username = strtolower($_POST['username']); 
            $password = $_POST['password'];

            $Admin_Username_Query = "
            SELECT * FROM Admins WHERE username='{$username}'
            ";

            $Trainer_Username_Query = "
            SELECT * FROM Trainers WHERE username='{$username}'
            ";

            $Boxer_Username_Query = "
            SELECT * FROM Boxers WHERE username='{$username}'
            ";

            $adminUsernames = mysqli_query($CONNECTION, $Admin_Username_Query);
            $trainerUsernames = mysqli_query($CONNECTION, $Trainer_Username_Query);
            $boxerUsernames = mysqli_query($CONNECTION, $Boxer_Username_Query);

            if ($adminUsernames && mysqli_num_rows($adminUsernames) > 0) {
                $row = mysqli_fetch_assoc($adminUsernames);
    
                if (password_verify($_POST['password'], $row['password'])) {
                    $_SESSION['user'] = $row;
                    $_SESSION['type'] = 'admin';
                } else {
                    echo "
                        <div style='text-align: center'>
                            <div class='alert bg-danger'>
                                <h2>Doslo je do greske!</h2>

                                <p class='mt-1'>Proverite informacije koje ste uneli.</p>
                            </div>

                            <button
                                class='size-lg mt-1 bg-danger'
                                onClick='location.href = `login.php`'
                            >
                                Nazad
                            </button>
                        </div>
                    ";
                    die();
                }
            } else if ($trainerUsernames && mysqli_num_rows($trainerUsernames) > 0) {
                $row = mysqli_fetch_assoc($trainerUsernames);

                if (password_verify($_POST['password'], $row['password'])) {
                    if($row['verified'] == 1 && $row['approved'] == 1) {
                        $_SESSION['user'] = $row;
                        $_SESSION['type'] = 'trainer';
                    } else {
                        echo "
                                <div style='text-align: center'>
                                    <div class='alert bg-danger'>
                                        <h2>Niste verifikovani ili nalog nije odobren!</h2>
                    
                                        <p class='mt-1'>Niste se verifikovali ili vas nalog jos uvek nije odobren.</p>
                                    </div>
                    
                                    <button 
                                        class='size-lg mt-1 bg-danger'
                                        onClick='location.href = `login.php`'
                                    >
                                        Prijavite se
                                    </button>
                                </div>
                            ";
                        die();
                    }
                } else {
                    echo "
                        <div style='text-align: center'>
                            <div class='alert bg-danger'>
                                <h2>Doslo je do greske!</h2>

                                <p class='mt-1'>Proverite informacije koje ste uneli.</p>
                            </div>

                            <button
                                class='size-lg mt-1 bg-danger'
                                onClick='location.href = `index.php`'
                            >
                                Pocetna
                            </button>
                        </div>
                    ";
                    die();
                }
            } else if ($boxerUsernames && mysqli_num_rows($boxerUsernames) > 0) {
                $row = mysqli_fetch_assoc($boxerUsernames);
    
                if (password_verify($_POST['password'], $row['password'])) {
                    if($row['verified'] == 1 && $row['approved'] == 1) {
                        $_SESSION['user'] = $row;
                        $_SESSION['type'] = 'boxer';
                    } else {
                        echo "
                                <div style='text-align: center'>
                                    <div class='alert bg-danger'>
                                        <h2>Niste verifikovani ili nalog nije odobren!</h2>
                    
                                        <p class='mt-1'>Niste se verifikovali ili vas nalog jos uvek nije odobren.</p>
                                    </div>
                    
                                    <button 
                                        class='size-lg mt-1 bg-danger'
                                        onClick='location.href = `login.php`'
                                    >
                                        Prijavite se
                                    </button>
                                </div>
                            ";
                        die();
                    }
                } else {
                    echo "
                        <div style='text-align: center'>
                            <div class='alert bg-danger'>
                                <h2>Doslo je do greske!</h2>

                                <p class='mt-1'>Proverite informacije koje ste uneli.</p>
                            </div>

                            <button
                                class='size-lg mt-1 bg-danger'
                                onClick='location.href = `index.php`'
                            >
                                Pocetna
                            </button>
                        </div>
                    ";
                    die();
                }
            } else {
                echo "
                <div style='text-align: center'>
                    <div class='alert bg-danger'>
                        <h2>Doslo je do greske!</h2>

                        <p class='mt-1'>Proverite informacije koje ste uneli.</p>
                    </div>

                    <button
                        class='size-lg mt-1 bg-danger'
                        onClick='location.href = `index.php`'
                    >
                        Pocetna
                    </button>
                </div>
                
                ";
                die();
            }
            echo "
                <div style='text-align: center'>
                    <div class='alert'>
                        <h2>Uspesno!</h2>
    
                        <p class='mt-1'>Uspesno ste se prijavili.</p>
                    </div>
    
                    <button 
                        class='size-lg mt-1'
                        onClick='location.href = `index.php`'
                    >
                        Pocetna
                    </button>
                </div>
                ";
        ?>
    </div>
</body>
</html>
