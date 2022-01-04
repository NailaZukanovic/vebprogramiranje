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

    <title>Register</title>
</head>
<body style="min-height: 100vh; display: grid; place-items: center; background-color: #ccffff"> -->
<?php include 'header.php';?>
    <div class="container container-sm">
        <!-- <img src="Assets//Hospital_logo.png" class='mt-2' style='width: 100%'/> -->
            
        <form method="POST" action="createUser.php" class="mb-2 mt-1" enctype="multipart/form-data">
            <div id="basicInfo">
                <label for="name"> Ime: </label>
                <input type="text" name="name" id="name" class="form-input size-lg" />
                <p hidden id="nameError" class="text-danger"> Ime nije ispravno </p>

                <label class="mt-1" for="lastname"> Prezime: </label>
                <input type="text" name="lastname" id="lastname" class="form-input size-lg" />
                <p hidden id="lastnameError" class="text-danger"> Prezime nije ispravno </p>

                <p class="mt-1">Pol: </p>
                <div>
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male"> M </label><br>

                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female"> Z </label><br>
                </div>
                <p hidden id="genderError" class="text-danger"> Morate izabrati pol </p>

                <label class="mt-1"> Datum rodjenja: </label>
                <input type="date" id="birthDate" name="birthDate" min="1900-01-01"/>
                <p hidden id="birthDateError" class="text-danger"> Datum nije ispravan! </p>

                <div>
                    <label class="mt-1" for="birthPlace"> Mesto rodjenja: </label>
                    <input type="text" name="birthPlace" id="birthPlace" class="form-input size-lg" />
                    <p hidden id="birthPlaceError" class="text-danger"> Mesto rodjenja nije ispravno </p>
                </div>

                <label class="mt-1" for="birthCountry"> Drzava rodjenja: </label>
                <input type="text" name="birthCountry" id="birthCountry" class="form-input size-lg" />
                <p hidden id="birthCountryError" class="text-danger"> Drzava rodjenja nije ispravna </p>

                <label class="mt-1" for="JMBG"> JMBG: </label>
                <input type="text" name="jmbg" id="jmbg" class="form-input size-lg" />
                <p> Minimalno 13 karaktera </p>
                <p hidden id="jmbgError" class="text-danger"> JMBG nije ispravan </p>
                
                <div>
                    <label class="mt-1" for="profilePicture"> Profilna: </label>
                    <input type="file" accept="image/*" name="profilePicture" id="profilePicture" class="size-lg" />
                    <p hidden id="profilePictureError" class="text-danger"> Izaberite profilnu sliku! </p>
                </div>

                <label for="email"> Email: </label>
                <input type="email" name="email" id="email" class="form-input size-lg" />
                <p hidden id="emailError" class="text-danger"> Email nije ispravan </p>

                <label class="mt-1" for="username"> Korisnicko ime: </label>
                <input type="text" name="username" id="username" class="form-input size-lg" />
                <p hidden id="usernameError" class="text-danger"> Korisnicko ime nije ispravno </p>

                <label class="mt-1" for="password"> Lozinka: </label>
                <input type="password" name="password" id="password" class="form-input size-lg" />
                <p hidden id="passwordError" class="text-danger"> Loznika nije ispravna </p>
                <p> Minimalno 8 karaktera </p>

                <label class="mt-1" for="confirmPassword"> Potvride lozinku: </label>
                <input type="password" name="confirmPassword" id="confirmPassword" class="form-input size-lg" />
                <p hidden id="confirmPasswordError" class="text-danger"> Lozinke nisu iste </p>
                <p> Mora biti isti kao lozinka </p>
            </div>

            <label class="mt-1" for="accountType"> Prijavljujem se kao: </label>
            <select 
                name="accountType"
                id="accountType"
                onChange="handleChangeAccountType()"
            >
                <option value="boxer">Pacijent</option>
                <option value="trainer">Lekar</option>
                <option value="admin">Admin</option>
            </select>


            <div 
                class="mt-1"
                id="accountTypeBoxer"
            >
                <label for="weight"> Zapocnite svoj karton: </label>
                <input class="form-input" id="weight" name="weight" />
            </div>

            <button type="submit" onClick="handleSubmit(event)" class="mt-1 size-lg"> Registruj me! </button>

            <div class="mt-1" style="display: flex; flex-direction: row; margin-bottom: 1em;">
                <p>Vec ste registrovani?</p>
                <a href="login.php">Prijavi se!</a>
            </div>
        </form>
    </div>

    <script src="JS/registerValidation.js?newversion"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <?php include 'footer.php';?>

</body>
</html>