function adminVerification(){

    var email = document.getElementById("ae");
    
    var form = new FormData();

    form.append("ae",email.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.status == 200 & request.readyState == 4){
            var response = request.responseText;
            if(response == "Success"){
                alert("The verification code has been sent successfully. Please check your email.");
                var adminVerificationModal = document.getElementById("verificationModal");
                var emailModal = document.getElementById("emailModal");

                adminVerificationModal.classList.toggle("d-none");
                emailModal.classList.toggle("d-none")

            }else{
                alert(response);
            }
        }
    }

    request.open("POST","adminVerificationProcess.php",true);
    request.send(form);

}

function adminSignin(){

    var code = document.getElementById("avcode");

    var form = new FormData();
    form.append("avcode",code.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.status == 200 & request.readyState == 4){
            var response = request.responseText;
            if(response == "success"){
                window.location = "home.php";
            }else{
                alert(response);
            }
             
        }
    }

    request.open("POST","AdminSigninProcess.php",true);
    request.send(form); 
}


function addDetails(){

    var ncategory = document.getElementById("ncategory");
    var nbrand = document.getElementById("nbrand");
    var nclr = document.getElementById("nclr");

    var form = new FormData();

    form.append("nca", ncategory.value);
    form.append("nb", nbrand.value);
    form.append("ncol", nclr.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "Saved") {
                alert("Details Saved Successfully.");
                window.location.reload();
            }else {
                alert(response);
            }
        }
    }

    request.open("POST", "addDetailsProcess.php", true);
    request.send(form);

}

function addProduct() {
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var clr = document.getElementById("color");
    var model = document.getElementById("model");
    var qty = document.getElementById("qty");

    var title = document.getElementById("title");
    var cost = document.getElementById("cost");
    var dcost = document.getElementById("dcost");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var form = new FormData();
    form.append("ca", category.value);
    form.append("b", brand.value);
    form.append("col", clr.value);
    form.append("m", model.value);
    form.append("q", qty.value);

    form.append("t", title.value);
    form.append("co", cost.value);
    form.append("dcost", dcost.value);
    form.append("de", desc.value);
    

    var file_count = image.files.length;

    for (var x = 0; x < file_count; x++) {
        form.append("image" + x, image.files[x]);
    }

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                alert("Product Saved Successfully.");
                window.location.reload();
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "addProductProcess.php", true);
    request.send(form);
}

function changeProductImage() {

    var image = document.getElementById("imageuploader");

    image.onchange = function () {
        var file_count = image.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {

                var file = this.files[x];
                var url = window.URL.createObjectURL(file);

                document.getElementById("i" + x).src = url;
            }

        } else {
            alert(file_count + " files. You are proceed to upload only 3 or less than 3 files.");
        }
    }

}

function blockProduct(id){
    var request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.status == 200 & request.readyState == 4){
            var response = request.responseText;
            alert (response);
            window.location.reload();
        }
    }

    request.open("GET","productBlockProcess.php?id="+id,true);
    request.send();
    
}

function blockUser(email){

    var request = new XMLHttpRequest();

    request.onreadystatechange = function (){
        if(request.status == 200 & request.readyState == 4){
            var response = request.responseText;
            alert (response);
            window.location.reload();
        }
    }

    request.open("GET","userBlockProcess.php?email="+email,true);
    request.send();

}