const username = document.getElementById('username');
const usernameError = document.getElementById('usernameError');

const password = document.getElementById('password');
const passwordError = document.getElementById('passwordError');

const usernamePattern = /^(?=[a-zA-Z0-9._]{3,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/;

const handleGuestLogin = e => {
    e.preventDefault();

    location.href = 'index.php';
}

const handleSubmit = e => {
    let valid = true;

    if(usernamePattern.test(username.value)) {
        usernameError.hidden = true;
    } else {
        usernameError.hidden = false;
        valid = false;
    }

    if(password.value.length >= 8) {
        passwordError.hidden = true;
    } else {
        passwordError.hidden = false;
        valid = false;
    }

    if(!valid) {
        e.preventDefault();
    }
}
