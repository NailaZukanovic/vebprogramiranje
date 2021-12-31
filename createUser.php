<?php require "database.php"; ?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>
</head>
<body> -->
    <div class="block-center">
    <?php
        $accountType = $_POST['accountType'];
        $username = strtolower($_POST['username']); 
     //Check if username already exists

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

        if(mysqli_num_rows($adminUsernames) > 0 || 
        mysqli_num_rows($trainerUsernames) > 0 || 
        mysqli_num_rows($boxerUsernames) > 0) {
            echo "
                <div class='alert bg-danger'>
                    <h2>Doslo je do greske!</h2>

                    <p class='mt-1'>Korisnicko ime vec zauzeto.</p>
                </div>

                <div style='text-align: center'>
                    <button 
                        class='size-lg mt-1 bg-danger'
                        onClick='location.href = `register.php`'
                    >
                    Nazad
                    </button>
                </div>
            ";
            die();
        }

        //korisnicko ime je novo

        $gender = $_POST['gender'] == "1" ? 1 : 0;

        $profilePictureName = $_FILES['profilePicture']['name'];
        $profilePictureTempName = $_FILES['profilePicture']['tmp_name'];
        $profilePictureSize = $_FILES['profilePicture']['size'];
        $profilePictureError = $_FILES['profilePicture']['error'];
        $profilePictureType = $_FILES['profilePicture']['type'];

        $fileExtension = explode('.', $profilePictureName);
        $fileLowerCase = strtolower(end($fileExtension));

        $allowed = array('jpg', 'jpeg', 'png', 'webp');


        if (in_array($fileLowerCase, $allowed)) {
            if ($profilePictureError === 0) {
                if ($profilePictureSize < 10000000) {
                    $fileName = "{$username}.{$fileLowerCase}";
                    $fileDestination = "profilePictures/${fileName}";

                    if (!file_exists('profilePictures')) {
                        mkdir('profilePictures', 0777, true);
                    }
                    move_uploaded_file($profilePictureTempName, $fileDestination);

                    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    $id = uniqid('boxer_'); //create uniqueID

                    if ($accountType == 'boxer') {
                        $CREATE_BOXER = "
                        INSERT INTO `Boxers` (
                            `id`,
                            `name`,
                            `lastname`,
                            `gender`,
                            `birthDate`,
                            `birthPlace`,
                            `birthCountry`,
                            `JMBG`,
                            `profilePicture`,
                            `email`,
                            `verified`,
                            `approved`,
                            `username`,
                            `password`,
                            `weight`
                        ) VALUES (
                            '{$id}',
                            '{$_POST['name']}',
                            '{$_POST['lastname']}',
                            '{$gender}',
                            '{$_POST['birthDate']}',
                            '{$_POST['birthPlace']}',
                            '{$_POST['birthCountry']}',
                            '{$_POST['jmbg']}',
                            '{$fileDestination}',
                            '{$_POST['email']}',
                            0,
                            0,
                            '{$_POST['username']}',
                            '{$hashedPassword}',
                            '{$_POST['weight']}'
                        );
                    ";

                    if (mysqli_query($CONNECTION, $CREATE_BOXER)) {
                        echo "
                            <div class='alert bg-success'>
                                <h2>Nalog admina uspesno kreiran!</h2>

                                <p class='mt-1'>Uspesno ste kreirali nalog pacijenta.</p>
                            </div>


                            <div style='text-align: center'>
                                <button 
                                    class='size-lg mt-1 bg-success'
                                    onClick='location.href = `login.php`'
                                >
                                Prijavite se
                                </button>
                            </div>
                        ";
                    } else {
                        echo "
                            <div class='alert bg-danger'>
                                <h2>Doslo je do greske!</h2>

                                <p class='mt-1'>Proverite informacije i probajte ponovo.</p>
                            </div>

                            <div style='text-align: center'>
                                <button 
                                    class='size-lg mt-1 bg-danger'
                                    onClick='location.href = `register.php`'
                                >
                                Nazad
                                </button>
                            </div>
                        ";
                    }

                        //     $generatedId = uniqid(); 

                        //     $Create_Verification_Query = "
                        //         INSERT INTO `Verification` (
                        //             `id`,
                        //             `for`
                        //         ) VALUES (
                        //             '{$generatedId}',
                        //             '$id'
                        //         );
                        //     ";

                        //     $verificationResult = mysqli_query($CONNECTION, $Create_Verification_Query);

                        //     if($verificationResult) {
                        //         $_SESSION['created'] = array('name' => $_POST['name'],
                        //         'lastname' => $_POST['lastname'],
                        //         'email' => $_POST['email'],
                        //         'type' => 'Boxers',
                        //         'id' => "{$id}",
                        //         'for' => "{$generatedId}"
                        //         );
    
                        //         header("Location: sendVerifyEmail.php");
                        //     }
                        // } else {
                        //     echo "
                        //         <div class='alert bg-danger'>
                        //             <h2>Doslo je do greske!</h2>

                        //             <p class='mt-1'>Proverite informacije i probajte ponovo.</p>
                        //         </div>

                        //         <div style='text-align: center'>
                        //             <button 
                        //                 class='size-lg mt-1 bg-danger'
                        //                 onClick='location.href = `register.php`'
                        //             >
                        //             Nazad
                        //             </button>
                        //         </div>
                        //     ";
                        // }
                    } else if ($accountType == 'trainer') {
                        $id = uniqid('trainer_');

                        $CREATE_TRAINER = "
                        INSERT INTO `Trainers` (
                            `id`,
                            `name`,
                            `lastname`,
                            `gender`,
                            `birthDate`,
                            `birthPlace`,
                            `birthCountry`,
                            `JMBG`,
                            `profilePicture`,
                            `email`,
                            `verified`,
                            `approved`,
                            `username`,
                            `password`
                        ) VALUES (
                            '{$id}',
                            '{$_POST['name']}',
                            '{$_POST['lastname']}',
                            '{$gender}',
                            '{$_POST['birthDate']}',
                            '{$_POST['birthPlace']}',
                            '{$_POST['birthCountry']}',
                            '{$_POST['jmbg']}',
                            '{$fileDestination}',
                            '{$_POST['email']}',
                            0,
                            0,
                            '{$_POST['username']}',
                            '{$hashedPassword}'
                        );
                    ";

                    if (mysqli_query($CONNECTION, $CREATE_TRAINER)) {
                        echo "
                            <div class='alert bg-success'>
                                <h2>Nalog admina uspesno kreiran!</h2>

                                <p class='mt-1'>Uspesno ste kreirali nalog lekara.</p>
                            </div>


                            <div style='text-align: center'>
                                <button 
                                    class='size-lg mt-1 bg-success'
                                    onClick='location.href = `login.php`'
                                >
                                Prijavite se
                                </button>
                            </div>
                        ";
                    } else {
                        echo "
                            <div class='alert bg-danger'>
                                <h2>Doslo je do greske!</h2>

                                <p class='mt-1'>Proverite informacije i probajte ponovo.</p>
                            </div>

                            <div style='text-align: center'>
                                <button 
                                    class='size-lg mt-1 bg-danger'
                                    onClick='location.href = `register.php`'
                                >
                                Nazad
                                </button>
                            </div>
                        ";
                    }

                        //     $generatedId = uniqid();

                        //     $Create_Verification_Query = "
                        //         INSERT INTO `Verification` (
                        //             `id`,
                        //             `for`
                        //         ) VALUES (
                        //             '{$generatedId}',
                        //             '$id'
                        //         );
                        //     ";

                        //     $verificationResult = mysqli_query($CONNECTION, $Create_Verification_Query);

                        //     if($verificationResult) {
                        //         $_SESSION['created'] = array('name' => $_POST['name'],
                        //         'lastname' => $_POST['lastname'],
                        //         'email' => $_POST['email'],
                        //         'type' => 'Trainers',
                        //         'id' => "{$id}",
                        //         'for' => "{$generatedId}"
                        //         );
                        //         header("Location: sendVerifyEmail.php");
                        //     }
                        // } else {
                        //     echo "
                        //         <div class='alert bg-danger'>
                        //             <h2>Doslo je do greske!</h2>

                        //             <p class='mt-1'>Proverite informacije i probajte ponovo.</p>
                        //         </div>

                        //         <div style='text-align: center'>
                        //             <button 
                        //                 class='size-lg mt-1 bg-danger'
                        //                 onClick='location.href = `register.php`'
                        //             >
                        //             Nazad
                        //             </button>
                        //         </div>
                        //     ";
                        // }
                    } else {
                        $id = uniqid('admin_');

                        $CREATE_ADMIN = "
                        INSERT INTO `Admins` (
                            `id`,
                            `name`,
                            `lastname`,
                            `gender`,
                            `birthDate`,
                            `birthPlace`,
                            `birthCountry`,
                            `JMBG`,
                            `profilePicture`,
                            `email`,
                            `username`,
                            `password`
                        ) VALUES (
                            '{$id}',
                            '{$_POST['name']}',
                            '{$_POST['lastname']}',
                            '{$gender}',
                            '{$_POST['birthDate']}',
                            '{$_POST['birthPlace']}',
                            '{$_POST['birthCountry']}',
                            '{$_POST['jmbg']}',
                            '{$fileDestination}',
                            '{$_POST['email']}',
                            '{$_POST['username']}',
                            '{$hashedPassword}'
                        );
                    ";
                        if (mysqli_query($CONNECTION, $CREATE_ADMIN)) {
                            echo "
                                <div class='alert bg-success'>
                                    <h2>Nalog admina uspesno kreiran!</h2>

                                    <p class='mt-1'>Uspesno ste kreirali admina nalog.</p>
                                </div>


                                <div style='text-align: center'>
                                    <button 
                                        class='size-lg mt-1 bg-success'
                                        onClick='location.href = `login.php`'
                                    >
                                    Prijavite se
                                    </button>
                                </div>
                            ";
                        } else {
                            echo "
                                <div class='alert bg-danger'>
                                    <h2>Doslo je do greske!</h2>

                                    <p class='mt-1'>Proverite informacije i probajte ponovo.</p>
                                </div>

                                <div style='text-align: center'>
                                    <button 
                                        class='size-lg mt-1 bg-danger'
                                        onClick='location.href = `register.php`'
                                    >
                                    Nazad
                                    </button>
                                </div>
                            ";
                        }
                        
                    }
                } else {
                    echo "
                        <div class='alert bg-danger'>
                            <h2>Slika je prevelika!</h2>
                        </div>

                        <div style='text-align: center'>
                            <button 
                                class='size-lg mt-1 bg-danger'
                                onClick='location.href = `register.php`'
                            >
                            Nazad
                            </button>
                        </div>
                    ";
                }
            } else {
                echo "
                    <div class='alert bg-danger'>
                        <h2>Doslo je do greske!</h2>
                    </div>

                    <div style='text-align: center'>
                        <button 
                            class='size-lg mt-1 bg-danger'
                            onClick='location.href = `register.php`'
                        >
                        Nazad
                        </button>
                    </div>
                ";
            }
        } else {
            echo "
                <div class='alert bg-danger'>
                    <h2>Samo slike!</h2>

                    <p class='mt-1'>Samo slike smeju biti postavljene!</p>
                </div>

                <div style='text-align: center'>
                    <button 
                        class='size-lg mt-1 bg-danger'
                        onClick='location.href = `register.php`'
                    >
                    Nazad
                    </button>
                </div>
            ";
        }
    ?>
    </div>
</body>
</html>