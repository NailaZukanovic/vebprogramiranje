const title = document.getElementById('title');
const titleError = document.getElementById('titleError');

const description = document.getElementById('description');
const descriptionError = document.getElementById('descriptionError');

const newsImage = document.getElementById('newsImage');
const newsImageError = document.getElementById('newsImageError');

const newsType = document.getElementById('newsType');

const currentTextareaChars = document.getElementById('currentTextareaChars');

const handleCurrentTextareaChars = _ => {
    currentTextareaChars.innerHTML = `${description.value.length + 1} / 512`;
}

const handleSubmit = e => {
    let valid = true;

    if (title.value !== "") {
        titleError.hidden = true;
    } else {
        valid = false;
        titleError.hidden = false;
    }

    if (description.value !== "" && description.value.length <= 512) {
        descriptionError.hidden = true;
    } else {
        valid = false;
        descriptionError.hidden = false;
    }

    if (newsImage.files.length > 0) {
        newsImage.hidden = true
    } else {
        newsImageError.hidden = false;
        valid = false;
    }

    if(!valid) {
        e.preventDefault();
    }
}