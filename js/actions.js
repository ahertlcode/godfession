var dserver = "server/";
const btnAct = document.querySelectorAll(".backEndActions");
btnAct.forEach((ev) => {
    ev.onclick = function(ea) {
        if (ea.target.id == "dologins") {
            resolveLogin();
        }
    }
});

function resolveLogin() {
    let uid = document.getElementById("username").value;
    let pwd = document.getElementById("password").value;
    let userData = [{ name: "email", value: uid }, { name: "password", value: pwd }];
    let dataObj = [{ name: "datamethod", value: "get_users" }, { name: "datakls", value: "users" }, { name: "actualact", value: "getSingle" }];


    let ddata = arrayJoin(userData, dataObj);
    serverSideRequestHandler(ddata, "");
}

function serverSideRequestHandler(inda = {}, rqstType = "") {
    try {
        let indata = inda;
        let complUrl = "serverSideProcessor.php";
        $.ajax({
                method: "POST",
                url: dserver + complUrl,
                data: indata
            })
            .done(function(retData) {
                //console.log(retData);
                //serverResponseHandler(retData);
                local_store(retData, "user_data_log", "add");
                window.location.href = "html/dashboard.html";
            });
    } catch (ev) {
        console.log(ev);
        errorHandler(ev);
    }
}

function getData(local_acct_id, apiurl, local_id, tmpl, display) {
    try {
        let userdata = local_store({}, local_acct_id, "get").retn;
        let udata = [{ name: "ck__users_id", value: userdata.ck__users_id },
            { name: "ck__phone_no", value: userdata.ck__phone_no },
            { name: "ck__email", value: userdata.ck__email },
            { name: "ck__password", value: userdata.ck__password }
        ];
        let dataobj = [{ name: "datamethod", value: "get_users" },
            { name: "datakls", value: "users" },
            { name: "actualact", value: "getLists" }
        ];
        var mydata = arrayJoin(udata, dataobj);
        $.ajax({
            url: "../" + dserver + apiurl + ".php",
            method: "POST",
            data: mydata
        }).done(function(retUsers) {
            local_store(retUsers, local_id, "add");
            showstuff(local_id, tmpl, display);
        });
    } catch (ex) {
        console.log(ex);
        errorHandler(ex);
    }
}

/** 
function showList(local_id, tmpl_id, target_display) {
    fdata = local_store({}, local_id, "get");
    var tmpl = $.templates("#"+tmpl_id);
    var html = tmpl.render(fdata);
    $("#user").html(html);

}
*/

function showstuff(local_id, tmpl_id, target_display) {
    var udata = local_store({}, local_id, "get");
    var tmpl = $.templates("#" + tmpl_id);
    var html = tmpl.render(udata);
    $("#" + target_display).html(html);
}

function arrayJoin(oArray, cArray) {
    var it = 0;
    $.each(cArray, function(key, value) {
        var ux = {};
        $.each(value, function(key, value) {
            it += 1;
            if (it % 2 === 1) {
                ux['name'] = value;
            }
            if (it % 2 === 0) {
                ux['value'] = value;
            }
        });
        oArray.push(ux);
    });
    return oArray;
}

function view_edit_data(id_col, apiurl, target_frm, local_id, target_display) {
    try {
        $.ajax({
            url: "../" + dserver + apiurl + ".php",
            method: "POST",
            data: { "uid": id_col }
        }).done(function(retd) {
            local_store(retd, local_id, "add");
            loadHtmlPage(target_frm, target_display);
        });
    } catch (eu) {
        console.log(eu);
        errorHandler(eu);
    }
}

function delete_data(id_col, target_tb, local_acct_id, apiurl, local_id, tmpl, display) {
    try {
        $.ajax({
            url: "../" + dserver + "deleterec.php",
            method: "POST",
            data: { "t_col": id_col, "t_tb": target_tb }
        }).done(function(retm) {
            alert(retm.msg);
            getData(local_acct_id, apiurl, local_id, tmpl, display);
        });
    } catch (er) {
        console.log(er);
        errorHandler(er);
    }
}