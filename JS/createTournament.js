const title = document.getElementById('title');
const titleError = document.getElementById('titleError');

const description = document.getElementById('description');
const descriptionError = document.getElementById('descriptionError');

const image = document.getElementById('image');
const imageError = document.getElementById('imageError');

const category = document.getElementById('category');

const handleSubmit = e => {
    let valid = true;

    if (title.value !== "") {
        titleError.hidden = true;
    } else {
        valid = false;
        titleError.hidden = false;
    }

    if (description.value !== "") {
        descriptionError.hidden = true;
    } else {
        valid = false;
        descriptionError.hidden = false;
    }

    if (image.files.length > 0) {
        imageError.hidden = true;
    } else {
        valid = false;
        imageError.hidden = false;
    }

    if(!valid) {
        e.preventDefault();
    }
}
