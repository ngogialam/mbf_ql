function deleteUser(ID) {
    var confirmation = confirm("Are you sure?");
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('user_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/managerUser.php?action=delete&ID=" + ID, true);
        xhttp.send();
    }
}


function editUser(ID) {
    console.log("55555555");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('user_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/managerUser.php?action=edit&ID=" + ID, true);
    xhttp.send();
}

// function viewPopup(id) {
//     // Gán giá trị id vào popup
//     document.getElementById("popup_id").innerHTML = id;
//     $('#exampleModal').modal('show');
// }

function viewPopup(ID) {
    // Make an AJAX request to the server to fetch data using the ID value
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Parse the response as JSON
            var data = JSON.parse(this.responseText);
            // Update the popup with the fetched data
            document.getElementById("popup_id").textContent = data.ID;
            document.getElementById("popup_id_team_user").textContent = data.id_team_user;
            document.getElementById("popup_name_team_user").textContent = data.name_team_user;
            document.getElementById("popup_user_status").textContent = data.user_status;
            document.getElementById("popup_create_by").textContent = data.create_by;
            document.getElementById("popup_created_at").textContent = data.created_at;
        }
    };
    xhr.open("GET", "get_popup_data.php?ID=" + ID, true);
    xhr.send();
}
// function viewPopup(ID) {
//     $.ajax({
//         type: 'GET',
//         url: 'php/get_popup_data.php',
//         data: {
//             'ID': ID
//         },
//         dataType: 'json',
//         success: function(data) {
//             $('#popup_id').html(data.ID);
//             $('#popup_username').html(data.USERNAME_USER);
//             $('#popup_name').html(data.name_team_user);
//             if (data.user_status == 1) {
//                 $('#popup_status').html('hoạt động');
//             } else {
//                 $('#popup_status').html('không hoạt động');
//             }
//             $('#popup_create_by').html(data.create_by);
//             $('#popup_created_at').html(data.created_at);
//         }
//     });
// }

function updateUser(ID) {
    var id_team_user = document.getElementById("id_team_user");
    var USERNAME_USER = document.getElementById("USERNAME_USER");
    var CONTACT_NUMBER = document.getElementById("CONTACT_NUMBER");
    var PASSWORD_1 = document.getElementById("PASSWORD_1");
    var EMAIL = document.getElementById("EMAIL");
    var room = document.getElementById("room");
    var position_manager = document.getElementById("position_manager");
    var create_by = document.getElementById("create_by");
    var created_at = document.getElementById("created_at");

    if (!notNull(USERNAME_USER.value, "USERNAME_USER_err"))
        USERNAME_USER.focus();
    else if (!validateContactNumber(CONTACT_NUMBER.value, "CONTACT_NUMBER_err"))
        CONTACT_NUMBER.focus();
    else if (!validateAddress(EMAIL.value, "EMAIL_err"))
        EMAIL.focus();
    else if (!notNull(room.value, 'room_err'))
        room.focus();
    else if (!notNull(PASSWORD_1.value, 'PASSWORD_1_err'))
        PASSWORD_1.focus();
    else if (!notNull(position_manager.value, 'position_manager_err'))
        position_manager.focus();
    else if (!notNull(create_by.value, "create_by_error"))
        create_by.focus();
    else if (!notNull(created_at.value, "created_at_err"))
        created_at.focus();
    else {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('user_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/managerUser.php?action=update&ID=" + ID + "&USERNAME_USER=" + USERNAME_USER.value + "&id_team_user=" + id_team_user.value + "&CONTACT_NUMBER=" + CONTACT_NUMBER.value + "&PASSWORD_1=" + PASSWORD_1.value + "&EMAIL=" + EMAIL.value + "&room=" + room.value + "&position_manager=" + position_manager.value + "&create_by=" + create_by.value + "&created_at=" + created_at.value, true);
        xhttp.send();
    }
}

function printPurchase(id) {
    //Get the HTML of div
    var divElements = document.getElementById("user_div").innerHTML;

    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;

    //Reset the pages HTML with divs HTML only
    document.body.innerHTML = "<html><head><title></title></head><body>" + divElements + "</body>";

    //Print Page
    window.print();

    //Restore orignal HTML
    document.body.innerHTML = oldPage;
}

function cancel() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('user_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/managerUser.php?action=cancel", true);
    xhttp.send();
}

function searchUser(text) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('user_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/managerUser.php?action=search&text=" + text, true);
    xhttp.send();
}

function showPassword(link) {
    console.log("gggggggggggggggggggg");
    link.previousElementSibling.style.display = "inline";
    link.style.display = "none";
}