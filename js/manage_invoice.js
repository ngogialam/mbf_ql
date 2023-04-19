function deleteInvoice(id_sys) {
    var confirmation = confirm("Are you sure?");
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('invoices_div').innerHTML = xhttp.responseText;
        };
        xhttp.open("GET", "php/manage_invoice.php?action=delete&id_sys=" + id_sys, true);
        xhttp.send();
    }
}

function viewItem(id_sys) {
    window.location.href = 'detail_sys_ql.php?id_sys=' + id_sys;
}

function viewEdit(id_sys) {
    window.location.href = 'edit_sys_ql.php?id_sys=' + id_sys;
}

function goBack() {
    window.location.href = 'manage_invoice.php';
}

function refresh() {
    console.log('5');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('invoices_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_invoice.php?action=refresh", true);
    xhttp.send();
}

function searchInvoice(text, tag) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('invoices_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_invoice.php?action=search&text=" + text + "&tag=" + tag, true);
    xhttp.send();
}

function printInvoice(invoice_number) {
    var print_content;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            print_content = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_invoice.php?action=print_invoice&invoice_number=" + invoice_number, false);
    xhttp.send();
    var print_window = window.open('', '', 'width=1000,height=600');
    var is_chrome = Boolean(print_window.chrome);
    print_window.document.write(print_content);

    if (is_chrome) {
        setTimeout(function() {
            print_window.document.close();
            print_window.focus();
            print_window.print();
            print_window.close();
        }, 250);
    } else {
        print_window.document.close();
        print_window.focus();
        print_window.print();
        print_window.close();
    }
    return true;
}

function edit(action) {
    document.getElementById('name_team_sys').disabled = action;
    document.getElementById('first_number').disabled = action;
    document.getElementById('name_unit_manager').disabled = action;
    document.getElementById('name_user_manager').disabled = action;
    document.getElementById('describe_sys').disabled = action;
    document.getElementById('document_sys').disabled = action;
    document.getElementById('server_sys').disabled = action;
    document.getElementById('ip_sys').disabled = action;
    document.getElementById('config_sys').disabled = action;


    if (action) {
        document.getElementById('edit').style.display = "block";
        document.getElementById('update_cancel').style.display = "none";
        document.getElementById('file_des_div').style.display = "none";
    } else {
        document.getElementById('edit').style.display = "none";
        document.getElementById('update_cancel').style.display = "block";
        document.getElementById('file_des_div').style.display = "block";
    }

    document.getElementById('id_sys_error').style.display = "none";
    document.getElementById('name_team_sys_error').style.display = "none";
    document.getElementById('first_number_error').style.display = "none";
    document.getElementById('name_unit_manager_error').style.display = "none";
    document.getElementById('name_user_manager_error').style.display = "none";
    document.getElementById('describe_sys_error').style.display = "none";
    document.getElementById('document_sys_error').style.display = "none";
    document.getElementById('server_sys_error').style.display = "none";
    document.getElementById('ip_sys_error').style.display = "none";
    document.getElementById('config_sys_error').style.display = "none";

    if (!action)
        document.getElementById('admin_acknowledgement').innerHTML = "";
}

function update() {
    var id_sys = document.getElementById('id_sys').value;
    var name_sys = document.getElementById("name_sys").value;
    var type_sys = document.getElementById("type_sys").value;
    var team_sys_manager = document.getElementById("team_sys_manager").value;
    var first_number = document.getElementById("first_number").value;
    var unit_sys = document.getElementById("unit_sys").value;
    var manager_user = document.getElementById("manager_user").value;
    var describe_sys = document.getElementById("describe_sys").value;
    var create_by = document.getElementById("create_by").value;
    var list_unit_user = document.getElementById("list_unit_user_edit").value;
    var list_block_infor = document.querySelector("#list_block_infor_edit").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState = 4 && xhttp.status == 200)
            document.getElementById('sys_div').innerHTML = xhttp.responseText;
    };

    xhttp.open('POST', 'php/manage_invoice.php');

    var formData = new FormData();
    formData.append("id_sys", id_sys);
    formData.append("name_sys", name_sys);
    formData.append("type_sys", type_sys);
    formData.append("team_sys_manager", team_sys_manager);
    formData.append("first_number", first_number);
    formData.append("unit_sys", unit_sys);
    formData.append("manager_user", manager_user);
    formData.append("describe_sys", describe_sys);

    formData.append("create_by", create_by);
    formData.append("list_unit_user", list_unit_user);
    formData.append("list_block_infor", list_block_infor);
    xhttp.send(formData);
}

function create() {
    var name_sys = document.getElementById("name_sys").value;
    if(name_sys === ""){
        alert("Vui lòng điền tên hệ thống!")
    }else{
        var team_sys_manager = document.getElementById("team_sys_manager").value;
    
        var first_number = document.getElementById("first_number").value;
        var unit_sys = document.getElementById("unit_sys").value;
        var type_sys = document.getElementById("type_sys").value;
        var manager_user = document.getElementById("manager_user").value;
        var describe_sys = document.getElementById("describe_sys").value;
        var create_by = document.getElementById("create_by").value;
        var list_unit_user = document.getElementById("list_unit_user").value;
        var list_block_infor = document.querySelector("#list_block_infor").value;
        console.log(list_block_infor);
    
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState = 4 && xhttp.status == 200)
                document.getElementById('sys_div').innerHTML = xhttp.responseText;
        };
    
        xhttp.open('POST', 'php/add_new_invoice.php');
    
        var formData = new FormData();
        formData.append("team_sys_manager", team_sys_manager);
        formData.append("type_sys", type_sys);
        formData.append("name_sys", name_sys);
        formData.append("first_number", first_number);
        formData.append("unit_sys", unit_sys);
        formData.append("manager_user", manager_user);
        formData.append('describe_sys', describe_sys);
        formData.append('create_by', create_by);
        formData.append('list_block_infor', list_block_infor);
        formData.append("list_unit_user", list_unit_user);
    
        xhttp.send(formData);
    }

}

function addUnitInSYS(cookie){
    var list_unit_user = document.getElementById(cookie);
    var unit_user = document.getElementById("unit_user").value;

    // check unit exist
    var list_unit_user_value = getCookie(cookie);
    list_unit_user_value = list_unit_user_value.split('/');

    if(list_unit_user_value.includes(unit_user)){
        alert("Đơn vị đã được thêm trước đó!")
    }
    else{
        console.log(list_unit_user.value)
        list_unit_user.value += String(unit_user) + '/';
        console.log(list_unit_user.value)
        $(document).ready(function () {
            createCookie(cookie, list_unit_user.value, "0.1");
          });
        
        $("#unit_div").load(location.href + " #unit_div");
    }
}

function deleteUnitInSYS(idx, cookie){
    var list_unit_user_value = getCookie(cookie);
    list_unit_user_value = list_unit_user_value.split('/');
    list_unit_user_value.splice(idx, 1);
    var list_unit_user = document.getElementById(cookie);
    list_unit_user.value = list_unit_user_value.join('/');

    $(document).ready(function () {
        createCookie(cookie, list_unit_user.value, "0.1");
      });
      
    $("#unit_div").load(location.href + " #unit_div");

}

function createCookie(name, value, days) {
    var expires;
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toGMTString();
    }
    else {
      expires = "";
    }
    document.cookie = String(name) + "=" + String(value) + expires + "; path=/";
  }
    

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(encodeURIComponent(document.cookie));
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}

function addBlockInfor(cookie){
    var list_block_infor = document.getElementById(cookie);
    var server_sys = document.querySelector("#server_sys");
    var ip_sys = document.getElementById("ip_sys");
    var config_sys = document.getElementById("config_sys");
    var file_des = document.querySelector('#file_des').files[0];

    // var list_block_infor_value = getCookie('list_block_infor');
    if(server_sys.value === "" && ip_sys.value === "" && config_sys.value === ""){
        alert("Vui lòng điền thống tin trước khi thêm!");
    }else{
        if(!file_des){
            file_name = '';
            console.log(list_block_infor.value);
            // list_block_infor.value = list_block_infor.value;
            list_block_infor.value += String(server_sys.value) + "|" + String(ip_sys.value) + "|" +String(config_sys.value) + "|" +String(file_name) + "|" +'/';
            console.log(list_block_infor.value);
            $(document).ready(function () {
                createCookie(cookie, list_block_infor.value, "0.1");
                });
            
            $("#block_info_div").load(location.href + " #block_info_div");
        }
        else{
            file_name = file_des.name;
            var xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                if (xhttp.readyState = 4 && xhttp.status == 200){
                    
                    console.log(xhttp.responseText);
                    if(xhttp.responseText != "ERORR"){
                        // list_block_infor.value = list_block_infor_value
                        list_block_infor.value += String(server_sys.value) + "|" + String(ip_sys.value) + "|" +String(config_sys.value) + "|" +String(file_name) + "|" +'/';
                
                        $(document).ready(function () {
                            createCookie(cookie, list_block_infor.value, "0.1");
                            });
                        
                        $("#block_info_div").load(location.href + " #block_info_div");
                    }
                    else{
                        document.getElementById('file_des_error').style.display = "block";
                        document.getElementById('file_des_error').innerHTML = "File đã tồn tại";
                    }
                }
            };
            xhttp.open('POST', 'php/uploadFileTemp.php');
            var formData = new FormData();
            formData.append("file_des", file_des);
    
            xhttp.send(formData);
        }
    }
    
}


function deleteBlockInfor(idx, cookie){
    var list_block_infor_value = getCookie(cookie);
    list_block_infor_value = list_block_infor_value.split('/');
    list_block_infor_value.splice(idx, 1);
    var list_block_infor = document.getElementById(cookie);
    list_block_infor.value = list_block_infor_value.join('/');

    $(document).ready(function () {
        createCookie(cookie, list_block_infor.value, "0.1");
        });
    
    $("#block_info_div").load(location.href + " #block_info_div");

}

function deleteCookie(cookie, block_div){

    var list_value = getCookie(block_div);
    console.log(list_value);
    list_value = list_value.split('/');
    for(let i=0; i<list_value.length; i++)
        list_value.splice(i, 1);

    var list_infor = document.getElementById(cookie);
    list_infor.value = list_value.join('/');

    $(document).ready(function () {
        createCookie(cookie, list_infor.value, "0.1");
        });
    var temp = "#"+block_div;

    $(temp).load(location.href + " " + temp);

}

function editUnitInSys(cookie,idx){
    var cookie_value = getCookie(cookie);
    cookie_value = cookie_value.split('/');
    infor_block = String(cookie_value[idx]).split("|");

    document.getElementById('updateBlockInforButton'+String(idx)).style.display = "block";

    document.getElementById("server_sys").value = String(infor_block[0]);

    document.getElementById("ip_sys").value = String(infor_block[1]);

    document.getElementById("config_sys").value = String(infor_block[2]);

    document.getElementById('editBlockInforButton'+String(idx)).style.display = "none";
    document.getElementById('abutton').style.display = "none";
    document.getElementById('dbutton').style.display = "none";
}

function updateBlockinfor(cookie, idx){

    var list_block_infor = document.getElementById(cookie);
    console.log(list_block_infor.value);
    var server_sys = document.querySelector("#server_sys");
    var ip_sys = document.getElementById("ip_sys");
    var config_sys = document.getElementById("config_sys");
    var file_des = document.querySelector('#file_des').files[0];

    // var list_block_infor_value = getCookie('list_block_infor');
    if(server_sys.value === "" && ip_sys.value === "" && config_sys.value === ""){
        alert("Vui lòng điền thống tin trước khi thêm!");
    }else{
        if(!file_des){
            file_name = '';
            // list_block_infor.value = list_block_infor.value;
            var value_tmp = list_block_infor.value.split('/');
            var value = "";
            for(let i =0; i<value_tmp.length -1 ;i++){
                if(i === idx){
                    value += String(server_sys.value) + "|" + String(ip_sys.value) + "|" +String(config_sys.value) + "|" +String(file_name) + "|" +'/';
                }
                else {
                    value+=value_tmp[i] + "/";
                }    
            }

            $(document).ready(function () {
                createCookie(cookie, value, "0.1");
                });

            document.getElementById('updateBlockInforButton'+String(idx)).style.display = "none";
            document.getElementById('editBlockInforButton'+String(idx)).style.display = "block";
            document.getElementById('abutton').style.display = "block";
            document.getElementById('dbutton').style.display = "block";
            $("#block_info_div").load(location.href + " #block_info_div");
        }
        else{
            file_name = file_des.name;
            var xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                if (xhttp.readyState = 4 && xhttp.status == 200){
                    
                    console.log(xhttp.responseText);
                    if(xhttp.responseText != "ERORR"){

                        var value_tmp = list_block_infor.value.split('/');
                        var value = "";
                        for(let i =0; i<value_tmp.length - 1;i++){
                            if(i === idx){
                                value += String(server_sys.value) + "|" + String(ip_sys.value) + "|" +String(config_sys.value) + "|" +String(file_name) + "|" +'/';
                            }
                            else {
                                value+=value_tmp[i] + "/";
                            }    
                        }
                        
                        $(document).ready(function () {
                            createCookie(cookie, value, "0.1");
                            });


                        document.getElementById('updateBlockInforButton'+String(idx)).style.display = "none";
                        document.getElementById('editBlockInforButton'+String(idx)).style.display = "block";
                        document.getElementById('abutton').style.display = "block";
                        document.getElementById('dbutton').style.display = "block";
                        $("#block_info_div").load(location.href + " #block_info_div");
                        // list_block_infor.value = list_block_infor_value
                    }
                    else{
                        document.getElementById('file_des_error').style.display = "block";
                        document.getElementById('file_des_error').innerHTML = "File đã tồn tại";
                    }
                }
            };
            xhttp.open('POST', 'php/uploadFileTemp.php');
            var formData = new FormData();
            formData.append("file_des", file_des);
    
            xhttp.send(formData);
        }
    }

}