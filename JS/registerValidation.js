const name = document.getElementById('name');
const nameError = document.getElementById('nameError');

const lastname = document.getElementById('lastname');
const lastnameError = document.getElementById('lastnameError');

const male = document.getElementById('male');
const female = document.getElementById('female');

const genderError = document.getElementById('genderError');

const birthDate = document.getElementById('birthDate');
const birthDateError = document.getElementById('birthDateError');

const birthPlace = document.getElementById('birthPlace');
const birthPlaceError = document.getElementById('birthPlaceError');

const birthCountry = document.getElementById('birthCountry');
const birthCountryError = document.getElementById('birthCountryError');

const profilePicture = document.getElementById('profilePicture');
const profilePictureError = document.getElementById('profilePictureError');

const jmbg = document.getElementById('jmbg');
const jmbgError = document.getElementById('jmbgError');

const username = document.getElementById('username');
const usernameError = document.getElementById('usernameError');

const email = document.getElementById('email');
const emailError = document.getElementById('emailError');

const password = document.getElementById('password');
const passwordError = document.getElementById('passwordError');

const confirmPassword = document.getElementById('confirmPassword');
const confirmPasswordError = document.getElementById('confirmPasswordError');

const accountType = document.getElementById('accountType');

// Basic info div
const basicInfo = document.getElementById('basicInfo');

// Boxer info div
const accountTypeBoxer = document.getElementById('accountTypeBoxer');

// Boxer info
const weight = document.getElementById('weight');

const weightError = document.getElementById('weightError');

if(accountType.value === 'boxer') {
    accountTypeBoxer.hidden = false;
} else {
    accountTypeBoxer.hidden = true;
}

const handleChangeAccountType = _ => {
    if(accountType.value === 'boxer') {
        accountTypeBoxer.hidden = false;
    } else {
        accountTypeBoxer.hidden = true;
    }
}

// Validation
const namePattern = /^[a-zA-Z]{3,16}$/;
const lastnamePattern = /^[a-zA-Z]{3,24}$/;
const datePattern = /^[0-9]{2}-[0-9]{2}-[0-9]{4}$/;
const jmbgPattern = /^[0-9]{13}$/;
const usernamePattern = /^(?=[a-zA-Z0-9._]{3,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/;
const emailPattern = /^(\d{1,5}|[^\W]{1,3}|[a-zA-Z]+)([a-z]){1,}([!#$%^&*()<>_?:"}{\[\]a-z]){1,}@([a-zA-Z.]){1,}\.([a-z]){1,}$/

const handleSubmit = e => {
    let valid = true;

    if(birthDate.value) {
        if (moment().diff(birthDate.value, 'years') >= 18) {
            birthDateError.hidden = true;
        } else {
            birthDateError.hidden = false;
            birthDateError.innerHTML = 'Morate biti stariji od 18 godina.';
            valid = false;
        }
    } else {
        birthDateError.hidden = false;
        valid = false;
    }

    if(namePattern.test(name.value)) {
        nameError.hidden = true;        
    } else {
        nameError.hidden = false;
        valid = false;
    }

    if(lastnamePattern.test(lastname.value)) {
        lastnameError.hidden = true;
    } else {
        lastnameError.hidden = false;
        valid = false;
    }

    if(male.checked === true || female.checked === true) {
        genderError.hidden = true;
    } else {
        genderError.hidden = false;
        valid = false;
    }

    if(jmbgPattern.test(jmbg.value)) {
        jmbgError.hidden = true;
    } else {
        jmbgError.hidden = false;
        valid = false;
    }

    if (profilePicture.files.length > 0) {
        profilePictureError.hidden = true
    } else {
        profilePictureError.hidden = false;
        valid = false;
    }

    if(usernamePattern.test(username.value)) {
        usernameError.hidden = true;
    } else {
        usernameError.hidden = false;
        valid = false;
    }

    if(emailPattern.test(email.value)) {
        emailError.hidden = true;
    } else {
        emailError.hidden = false;
        valid = false;
    }

    if(password.value.length >= 8) {
        passwordError.hidden = true;
    } else {
        passwordError.hidden = false;
        valid = false;
    }

    if((password.value === confirmPassword.value) && (password.value !== "")) {
        confirmPasswordError.hidden = true;
    } else {
        confirmPasswordError.hidden = false;
        valid = false;
    }

    if(accountType.value === 'boxer') {
        if (weight.value >= 63 && technique.value <= 185) {
            weightError.hidden = true;
        } else {
            weightError.hidden = false;
            valid = false;
        }

    }

    if(!valid) {
        e.preventDefault();
    }
}
