<?php
    session_start();

    if (isset($_SESSION['user'])) {
        header("Location: index.php");
    }
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>

    <title>Login</title>
</head>
<body style="display: grid; place-items: center; background-color: #ccffff"> -->
<?php include 'header.php';?>

    <div class="container container-sm">

        <!-- <img src="Assets//Hospital_logo.png" class='mt-2' style='width: 100%'/> -->

        <form method="POST" action="loginUser.php" class='mt-1'>
            <label for="username"> Korisnicko ime: </label>
            <input type="text" name="username" id="username" class="form-input size-lg" />
            <p hidden id="usernameError" class="text-danger"> Korisnicko ime nije ispravno </p>

            <label class="mt-1" for="password"> Lozinka: </label>
            <input type="password" name="password" id="password" class="form-input size-lg" />
            <p hidden id="passwordError" class="text-danger"> Loznika nije ispravna </p>

            <button onClick="handleSubmit(event)" class="mt-1 size-lg"> Prijavi me! </button>
            <button onClick="handleGuestLogin(event)" class="mt-1 size-lg"> Gost </button>

            <div class="mt-1" style="display: flex; flex-direction: row;">
                <p>Nemate nalog?</p>
                <a href="register.php">Registrujte se!</a>
            </div>
        </form>
    </div>

    <script src="JS/loginValidation.js?newversion">
    </script>
    <?php include 'footer.php';?>
</body>


</html>