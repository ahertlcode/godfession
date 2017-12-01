var file;

function loadHtmlPage(page, target) {
    var loc = page;
    $("#" + target).load(loc);
    window.scrollTo(0, 0);
}

function notify_hide() {
    $("#notifier").html("");
    $("#notifier").removeClass("notifier-show");
    $("#notifier").removeClass("w3-*");
    document.getElementById("notifier").style.display = "none";
    removepagecover();
}

function removepagecover() {
    $("#pagecover").removeClass("page-cover");
    document.getElementById("pagecover").style.display = "none";
}

function coverpage() {
    $("#pagecover").addClass("page-cover");
    document.getElementById("pagecover").style.display = "block";
}

function notify(msg, themeclass = null, itimeout = 0) {
    coverpage();
    if (themeclass === null) {
        themeclass = "w3-orange";
    }
    $("#notifier").html(msg);
    $("#notifier").addClass(themeclass);
    $("#notifier").addClass("notifier-show");
    document.getElementById("notifier").style.display = "block";
    setTimeout("notify_hide()", itimeout);
}

function showloading() {

}

function fillState(nation) {

}

function processform(fid) {
    var frmData = $("#" + fid).serialize();
    return frmData;
}

function clearbox(ob) {
    var lbox = $("#" + ob + ' option').size();
    if (lbox > 1) {
        for (i = 1; i < lbox; i++) {
            $("#" + ob).removeItem(i);
        }
    }
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";domain=;path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function local_store(arr, desc, actn) {
    var retn;
    if (typeof(Storage) !== undefined) {
        // Code for localStorage/sessionStorage.
        if (actn === "add") {
            //to create storage
            var stringifyd = JSON.stringify(arr);
            //save to localstorage
            if (localStorage.setItem(desc, stringifyd)) {
                retn = true;
            } else {
                retn = false;
            }
        } else if (actn === "get") {
            retn = localStorage.getItem(desc);
            if (retn != "{}") {
                retn = JSON.parse(retn);
            }
        } else if (actn === "remove") {
            if (localStorage.removeItem(desc)) {
                retn = true;
            } else {
                retn = false;
            }
        }
    } else {
        //Sorry! No Web Storage support..
    }
    return retn;
}

function getRandomNumber(start = 0, end = 1000) {
    var num = Math.floor(Math.random() * end);
    return num;
}

function inArrayX(target, iarray) {
    var hasValue = false;
    asize = iarray.length;
    if (typeof(asize) === undefined && (typeof(iarray) !== null || typeof(iarray) !== undefined)) {
        array = [];
        array.push(iarray);
        iarray = array;
        asize = 1;
    }
    var ArrLen = iarray.map(function(lk) {
        return Object.keys(lk).length;
    });
    if (asize === 1 && !$.isArray(ArrLen)) {
        for (var index = 0; index < ArrLen; index++) {
            var cur = iarray[asize - 1][index];
            if (cur === target) {
                hasValue = true;
            }
        }
    } else {
        i = 1;
        iarray.forEach(function(obj) {
            if (obj[i] === target) {
                hasValue = true;
            }
            i += 1;
        });
    }
    return hasValue;
}

function uploadFile() {
    notify("Attached file is being uploaded!", "w3-green", 2000);
    var url = '../php-server/uploadslip.php';
    var xhr = new XMLHttpRequest();
    var fd = new FormData();
    xhr.open("POST", url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            notify("File Successfully attached for upload", "w3-green", "3000");
        }
    };
    fd.append("upload_file", file);
    xhr.send(fd);
}

function previewImage(file, prevwin) {
    var msg;
    $(".thumbnail").remove();
    var galleryId = prevwin;
    var gallery = document.getElementById(galleryId);
    var imageType = /image.*/;
    if (!file.type.match(imageType)) {
        msg = "File Type must be an image";
        notify(msg, "w3-orange", "2000");
        throw "";
    }
    if (file.name.length > 50) {
        msg = "Please rename your file! choose a shorter filename not more that 30 character long";
        notify(msg, "w3-orange", "2000");
        throw "";
    }
    if (file.size > 102400) {
        msg = "File too large. File size should not exceed 500KB. Scale your image file and try again.";
        notify(msg, "w3-orange", "2000");
        throw "";
    }

    var thumb = document.createElement("div");
    thumb.classList.add('thumbnail'); // Add the class thumbnail to the created div
    var img = document.createElement("img");
    img.file = file;
    thumb.appendChild(img);
    gallery.appendChild(thumb);
    // Using FileReader to display the image content
    var reader = new FileReader();
    reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
    reader.readAsDataURL(file);
}

function logError(ErrObj) {
    console.log(ErrObj);
}