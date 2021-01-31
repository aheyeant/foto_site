function signinPageVerify() {
    let error = 0;
    error += verifyUsername("input_username", "error_username");
    error += verifyPassword("input_password", "error_password");
    return error === 0;
}

function signupPageVerify() {
    let error = 0;
    error += verifyUsername("input_username", "error_username");
    error += verifyEmail("input_email", "error_email");
    error += verifyPhone("input_phone", "error_phone");
    error += verifyPassword("input_password", "error_password");
    return error === 0;
}

function accountEditVerify() {
    let error = 0;
    error += verifyEmail("input_email", "error_email");
    error += verifyPhone("input_phone", "error_phone");
    return error === 0;
}

function accountPasswordVerify() {
    let error = 0;
    error += verifyPassword("input_old_password", "error_old_password");
    error += verifyPassword("input_new_password", "error_new_password");
    return error === 0;
}

function createOfferVerify() {
    let error = 0;
    error += verifyModel("input_model", "error_model");
    error += verifyPrice("input_price", "error_price");
    error += verifyDescription("input_description", "error_description");
    return error === 0;
}

function editOfferVerify() {
    let error = 0;
    error += verifyModel("input_model", "error_model");
    error += verifyPrice("input_price", "error_price");
    error += verifyDescription("input_description", "error_description");
    return error === 0;
}

function makeReservationVerify() {
    let error = 0;
    error += verifyEmail("input_email", "error_email");
    error += verifyPhone("input_phone", "error_phone");
    return error === 0;
}


function verifyUsername(id_input_username, id_error_username) {
    let input = document.getElementById(id_input_username).value.toLowerCase();
    let error = document.getElementById(id_error_username);
    if (!error.classList.contains("hidden")) error.classList.add("hidden");
    if (! /^[a-zA-Z0-9_]+$/.test(input) || input.length > 64) {
        error.innerText = "INCORRECT USERNAME FORMAT";
        error.classList.remove("hidden");
        return 1;
    }
    return 0;
}

function verifyPassword(id_input_password, id_error_password) {
    let input = document.getElementById(id_input_password).value;
    let error = document.getElementById(id_error_password);
    if (!error.classList.contains("hidden")) error.classList.add("hidden");
    if (input.length > 64 || input.length < 4) {
        error.innerText = "PASSWORD MUST BE AT LEAST 4 CHARACTERS";
        error.classList.remove("hidden");
        return 1;
    }
    return 0;
}

function verifyEmail(id_input_email, id_error_email) {
    let input = document.getElementById(id_input_email).value.toLowerCase();
    let error = document.getElementById(id_error_email);
    if (!error.classList.contains("hidden")) error.classList.add("hidden");
    const pattern = /^(([^<>()\[\].,;:\s@"]+(\.[^<>()\[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/i;
    if (!pattern.test(input)) {
        error.innerText = "INCORRECT EMAIL FORMAT";
        error.classList.remove("hidden");
        return 1;
    }
    return 0;
}

function verifyPhone(id_input_phone, id_error_phone) {
    let input = document.getElementById(id_input_phone).value;
    let error = document.getElementById(id_error_phone);
    if (!error.classList.contains("hidden")) error.classList.add("hidden");
    if (input.length === 0) return 0;
    if (input[0] !== "+") {
        error.innerText = "INCORRECT PHONE NUMBER FORMAT";
        error.classList.remove("hidden");
        return 1;
    }
    input = input.substr(1);
    if (! /^[0-9]+$/.test(input) || input.length > 24 || input.length < 7) {
        error.innerText = "INCORRECT PHONE NUMBER FORMAT";
        error.classList.remove("hidden");
        return 1;
    }
    return 0;
}

function verifyModel(id_input_model, id_error_model) {
    let input = document.getElementById(id_input_model).value;
    let error = document.getElementById(id_error_model);
    if (!error.classList.contains("hidden")) error.classList.add("hidden");
    input = input.replace("<", "");
    input = input.replace(">", "");
    if (input.length === 0) {
        error.innerText = "INCORRECT MODEL FORMAT";
        error.classList.remove("hidden");
        return 1;
    }
    document.getElementById(id_input_model).value = input;
    return 0;
}

function verifyPrice(id_input_price, id_error_price) {
    let input = document.getElementById(id_input_price).value;
    let error = document.getElementById(id_error_price);
    if (!error.classList.contains("hidden")) error.classList.add("hidden");
    if (input < 0 || input > 1000) {
        document.getElementById(id_input_price).value = 0;
    }
    return 0;
}

function verifyDescription(id_input_description, id_error_description) {
    let input = document.getElementById(id_input_description).innerText;
    let error = document.getElementById(id_error_description);
    if (!error.classList.contains("hidden")) error.classList.add("hidden");
    input.replace("<", "");
    input.replace(">", "");
    document.getElementById(id_input_description).innerText = input;
    return 0;
}