//registration page
function previewFile() {
    const preview = document.querySelector('.imgselection');
    const file = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();
    reader.addEventListener("load", function () {
        // convert image file to base64 string
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}

function confirmDialog() {
    var r = confirm("Proceed Registration?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}

function isMatch() {
    var password = document.getElementById("Mypassword").value;
    var repass = document.getElementById("repassword").value;
    if (password != repass) {
        alert("Password not match!");
        return false;
    } else {
        return true;
    }
}

function disableButton() {
    const button = document.getElementById("register")
    if(!isMatch()) {
        button.disabled = true;
    }else{
        button.disabled = false;
    }
  }

//index page
function w3_open() {
    document.getElementById("mySidebar").style.width = "100%";
    document.getElementById("mySidebar").style.display = "block";
}

function w3_close(){
        document.getElementById("mySidebar").style.display = "none";
}

function pageFunc(){
    document.getElementById("page").body.style.color = "pink";
    return false;    
}

