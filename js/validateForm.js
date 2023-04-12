function notNull(text, error) {
    var result = document.getElementById(error);
    result.style.display = '"block"';
    if (text < 0) {
        result.innerHTML = "Invalid!";
        return false;
    } else if (text.trim() == "") {
        result.innerHTML = "Must be filled out!";
        return false;
    }
    result.style.display = "none";
    return true;
}

function validateName(name, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (name.trim() == "") {
        result.innerHTML = "Must be filled out!";
        return false;
    }
    result.innerHTML = "Must contain only letters!";
    for (var i = 0; i < name.length; i++)
        if (!((name[i] >= 'a' && name[i] <= 'z') || (name[i] >= 'A' && name[i] <= 'Z') || name[i] == ' '))
            return false;
    result.style.display = "none";
    return true;
}

function validateContactNumber(contact_number, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (contact_number.length != 10) {
        result.innerHTML = "Must contain 10 digits!";
        return false;
    } else
        result.style.display = "none";
    return true;
}

function validateAddress(address, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (address.trim().length < 10) {
        result.innerHTML = "Please enter more specific address!";
        return false;
    } else
        result.style.display = "none";
    return true;
}

function checkExpiry(date, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (date.trim() == "" || date.trim().length != 5 || date[2] != "/")
        result.innerHTML = "Please enter date in mm/yy format!";
    else if (date.slice(0, 2) < 1 || date.slice(0, 2) > 12)
        result.innerHTML = "Invalid month!";
    else if (new Date("20" + date.slice(3, 5), date.slice(0, 2)) < new Date()) {
        result.innerHTML = "Expired Medicine!";
        return -1;
    } else {
        result.style.display = "none";
        return true;
    }
    return false;
}

function checkQuantity(quantity, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (quantity < 0 || !Number.isInteger(parseFloat(quantity)))
        result.innerHTML = "Invalid quantity!";
    else {
        result.style.display = "none";
        return true;
    }
    return false;
}

function checkValue(value, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (value < 0 || value == "")
        result.innerHTML = "Invalid!";
    else {
        result.style.display = "none";
        return true;
    }
    return false;
}

function checkDate(date, error) {
    var result = document.getElementById(error);
    result.style.display = "block";
    if (date == "")
        result.innerHTML = "Mustn't be empty!!";
    else if (new Date(date) > new Date())
        result.innerHTML = "Mustn't be future date!";
    else {
        result.style.display = "none";
        return true;
    }
    return false;
}

function addCustomer() {
    document.getElementById("customer_acknowledgement").innerHTML = "";
    var name_user_manager = document.getElementById("name_user_manager");
    var sdt = document.getElementById("sdt");
    var gmail = document.getElementById("gmail");
    var room = document.getElementById("room");
    var position_manager = document.getElementById("position_manager");
    var create_by = document.getElementById("create_by");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById("customer_acknowledgement").innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/add_new_customer.php?name_user_manager=" + name_user_manager.value + "&sdt=" + sdt.value + "&gmail=" + gmail.value + "&room=" + room.value + "&position_manager=" + position_manager.value + "&create_by=" + create_by.value, true);
    xhttp.send();

    console.log(name_user_manager);
    return false;
}

function addSupplier() {
    document.getElementById("supplier_acknowledgement").innerHTML = "";
    var name_team_sys = document.getElementById("name_team_sys");
    var type_sys = document.getElementById("type_sys");
    var describe_sys = document.getElementById("describe_sys");
    var create_by = document.getElementById("create_by");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById("supplier_acknowledgement").innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/add_new_supplier.php?name_team_sys=" + name_team_sys.value + "&type_sys=" + type_sys.value + "&describe_sys=" + describe_sys.value + "&create_by=" + create_by.value, true);
    xhttp.send();
    // }
}

function addUnitManager() {
    document.getElementById("medicine_acknowledgement").innerHTML = "";
    var name = document.getElementById("name_unit_sys");
    var packing = document.getElementById("name_room");
    var generic_name = document.getElementById("create_by");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById("medicine_acknowledgement").innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/add_new_unit_manager.php?name_unit_sys=" + name.value + "&name_room=" + packing.value + "&create_by=" + generic_name.value , true);
    xhttp.send();
}

function addUnitUser() {
    document.getElementById("medicine_acknowledgement").innerHTML = "";
    var name_unit_user = document.getElementById("name_unit_user");
    var name_room_unit = document.getElementById("name_room_unit");
    var create_by = document.getElementById("create_by");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById("medicine_acknowledgement").innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/add_new_unit_user.php?name_unit_user=" + name_unit_user.value + "&name_room_unit=" + name_room_unit.value + "&create_by=" + create_by.value , true);
    xhttp.send();
}

function addManager() {
    document.getElementById("customer_acknowledgement").innerHTML = "";
    var name_user_manager = document.getElementById("name_user_manager");
    var sdt = document.getElementById("sdt");
    var gmail = document.getElementById("gmail");
    var room = document.getElementById("room");
    var team_sys_manager = document.getElementById("team_sys_manager");
    var position_manager = document.getElementById("position_manager");
    var create_by = document.getElementById("create_by");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById("customer_acknowledgement").innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/add_new_user.php?name_user_manager=" + name_user_manager.value+ "&team_sys_manager="+ team_sys_manager.value + "&sdt=" + sdt.value + "&gmail=" + gmail.value + "&room=" + room.value + "&position_manager=" + position_manager.value + "&create_by=" + create_by.value, true);
    xhttp.send();
    console.log(team_sys_manager);
    return false;
}


function checkInputFile(value, error) {
    var result = document.getElementById(error);
    result.style.display = "block";

    var extention = value.split('.').pop();
    if (extention != 'pdf' && extention != 'ppt'&& extention != 'doc'&& extention != 'xlsx'&& extention != 'xls'&& extention != 'docx' && value != "")
        result.innerHTML = "Chỉ upload được file pdf, doc, docx, ppt, xls, xlsx!";
    else {
        var file_des = document.querySelector('#file_des').files[0]
        if (file_des){
            var fileSize = file_des.size / 1024 / 1024; // in MiB
            if (fileSize > 3) {
                result.innerHTML = "File có dung lượng quá lớn (>5M)";
            } else {
                result.style.display = "none";
                return true;

            }
        }
    }
    return false;
}

