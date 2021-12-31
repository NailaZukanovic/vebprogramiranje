<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Styles/global.css"/>
</head>
<body class="block-center">
    <?php
        session_start();
        session_destroy();

        echo "
        <div style='text-align: center'>
            <div class='alert bg-success'>
                <h2>Odjavili ste se!</h2>

                <p class='mt-1'>Uspesno ste se odjavili.</p>
            </div>

            <button 
                class='size-lg mt-1 bg-success'
                onClick='location.href = `index.php`'
            >
                Pocetna
            </button>
        </div>
        ";
    ?>
</body>
</html>
