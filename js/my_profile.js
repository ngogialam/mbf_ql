function edit(action) {
    document.getElementById('USERNAME_USER').disabled = action;
    document.getElementById('CONTACT_NUMBER').disabled = action;
    document.getElementById('EMAIL').disabled = action;
    document.getElementById('created_at').disabled = action;

    if (action) {
        document.getElementById('edit').style.display = "block";
        document.getElementById('update_cancel').style.display = "none";
    } else {
        document.getElementById('edit').style.display = "none";
        document.getElementById('update_cancel').style.display = "block";
    }

    document.getElementById('USERNAME_USER_error').style.display = "none";
    document.getElementById('CONTACT_NUMBER_error').style.display = "none";
    document.getElementById('EMAIL_error').style.display = "none";
    document.getElementById('created_at_error').style.display = "none";

    if (!action)
        document.getElementById('admin_acknowledgement').innerHTML = "";
}

function updateAdminDetails(ID) {
    console.log("fdhjfhsdfvasfbcash");
    var USERNAME_USER = document.getElementById("USERNAME_USER");
    var CONTACT_NUMBER = document.getElementById("CONTACT_NUMBER");
    var EMAIL = document.getElementById("EMAIL");
    var created_at = document.getElementById("created_at");

    if (!notNull(USERNAME_USER.value, "USERNAME_USER_error"))
        USERNAME_USER.focus();
    else if (!notNull(CONTACT_NUMBER.value, "CONTACT_NUMBER_error"))
        CONTACT_NUMBER.focus();
    else if (!notNull(EMAIL.value, "EMAIL_error"))
        EMAIL.focus();
    else if (!notNull(created_at.value, "created_at_error"))
        created_at.focus();
    else {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('admin_acknowledgement').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/validateCredentials.php?action=update_admin_info&ID=" + ID + "&USERNAME_USER=" + USERNAME_USER.value + "&CONTACT_NUMBER=" + CONTACT_NUMBER.value + "&EMAIL=" + EMAIL.value + "&created_at=" + created_at.value, true);
        xhttp.send();
    }
}

function validatePassword(password) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            xhttp.responseText;
    };
    xhttp.open("GET", "php/validateCredentials.php?action=validate_password&password=" + password, false);
    xhttp.send();
    if (xhttp.responseText == "true")
        return true;
    return false;
}

function checkAdminPassword(password, error) {
    document.getElementById(error).style.display = "block";
    if (validatePassword(password)) {
        document.getElementById(error).style.display = "none";
        return true;
    } else
        document.getElementById(error).innerHTML = "Wrong Password!!!";
    return false;
}

function changePassword() {
    var old_password = document.getElementById('old_password');
    var password = document.getElementById('password');
    var confirm_password = document.getElementById('confirm_password');

    if (!checkAdminPassword(old_password.value, 'old_password_error'))
        old_password.focus();
    else if (password.value.indexOf(' ') >= 0) {
        document.getElementById('password_error').style.display = "block";
        document.getElementById('password_error').innerHTML = "mustn't contain spaces!";
        password.focus();
    } else if (password.value.length < 6) {
        document.getElementById('password_error').style.display = "block";
        document.getElementById('password_error').innerHTML = "must be of length 6 or more characterss!";
        password.focus();
    } else if (password.value != confirm_password.value) {
        document.getElementById('password_error').style.display = "none";
        document.getElementById('confirm_password_error').style.display = "block";
        document.getElementById('confirm_password_error').innerHTML = "password mismatch!";
        confirm_password.focus();
    } else {
        document.getElementById('confirm_password_error').style.display = "none";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                alert(xhttp.responseText);
        };
        xhttp.open("GET", "php/validateCredentials.php?action=change_password&password=" + password.value, false);
        xhttp.send();
        return true;
    }
    return false;
}