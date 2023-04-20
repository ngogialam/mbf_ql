function deleteUser(id_device_room) {
    var confirmation = confirm("Are you sure?");
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('device_room_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manager_room_device.php?action=delete&id_device_room=" + id_device_room, true);
        xhttp.send();
    }
}


function editDeciveRoom(id_device_room) {
    console.log("55555555");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('device_room_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manager_room_device.php?action=edit&id_device_room=" + id_device_room, true);
    xhttp.send();
}

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

function refresh() {
    console.log('5');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('device_room_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manager_room_device.php?action=refresh", true);
    xhttp.send();
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
function updateDeviceRoom(id_device_room) {

    var id_room = document.getElementById("id_room");
    var name_room_tran = document.getElementById("name_room_tran");
    var name_device = document.getElementById("name_device");
    var code_device = document.getElementById("code_device");
    var status = document.getElementById("status");
    var created_at = document.getElementById("created_at");
    if (!notNull(name_device.value, 'name_device_err'))
        name_device.focus();
    else if (!notNull(code_device.value, 'code_device_err'))
        code_device.focus();
    else if (!notNull(created_at.value, "created_at_err"))
        created_at.focus();
    else {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('device_room_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manager_room_device.php?action=update&id_device_room=" + id_device_room + "&id_room=" + id_room.value + "&name_room_tran=" + name_room_tran.value + "&name_device=" + name_device.value + "&code_device=" + code_device.value + "&status=" + status.value + "&created_at=" + created_at.value, true);
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
            document.getElementById('device_room_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manager_room_device.php?action=cancel", true);
    xhttp.send();
}

function searchDeviceRoom(text) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('device_room_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manager_room_device.php?action=search&text=" + text, true);
    xhttp.send();
}

function searchStatus(number1) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('device_room_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manager_room_device.php?action=search1&number1=" + number1, true);
    xhttp.send();

}

function searchRoom(number2) {
    console.log("55555555");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('device_room_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manager_room_device.php?action=search2&number2=" + number2, true);
    xhttp.send();

}