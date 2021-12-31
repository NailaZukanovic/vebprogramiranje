<?php require 'database.php' ?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikacija</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>
</head>
<body> -->
<?php include 'header.php';?>
<?php require 'nav.php' ?>

<?php
        // echo "
        //     <nav>
        //         <ul>
        //             <li>
        //                 <a href='index.php'>
        //                     <img src=\"Assets//Boxing_Logo.png\" style='width: 4em; height: 3em;'/>
        //                 </a>
        //             </li>
        //         </ul>
        //     </nav>
        // ";
        $Check_Verification = "
            SELECT * FROM Verification WHERE
            id='{$_GET['for']}'
        ";

        $result = mysqli_query($CONNECTION, $Check_Verification);

        if($result && mysqli_num_rows($result) == 1) {
            $Verify_User = "
                UPDATE {$_GET['type']} SET verified=1 WHERE id='{$_GET['id']}';
            ";

            $verificationResult = mysqli_query($CONNECTION, $Verify_User);

            if($verificationResult) {
                echo "
                <div style='text-align: center'>
                    <div class='alert bg-success'>
                        <h2>Uspesno ste verifikovali profil!</h2>

                        <p class='mt-1'> Uspesno ste verifikovali profil, mozete se prijaviti.</p>
                    </div>

                    <button
                        class='size-lg mt-1 bg-success'
                        onClick='location.href = `login.php`'
                    >
                        Prijavite se
                    </button>
                </div>
                ";
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
        }
    ?>
</body>
</html>