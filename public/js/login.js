


function onRegister(){
    let login_container = document.querySelector("#form_container_login");
    let register_container = document.querySelector("#form_container_register");

    login_container.setAttribute("style", "display:none");
    register_container.setAttribute("style", "display:flex");
}

function goToLoginPage(){
    let login_container = document.querySelector("#form_container_login");
    let register_container = document.querySelector("#form_container_register");
    login_container.setAttribute("style", "display:flex");
    register_container.setAttribute("style", "display:none");



}

function onJSONlogin(json){
    
    let alertText = document.querySelector("#alertLog");

    if(json.success != ''){
        //success
        window.open("home","_self"); redirrect
        //console.log(json);
        
    }

    if(json.invalid_credential_error != ''){
        //error
        alertText.innerHTML = json.invalid_credential_error;
    }

}

function onJSONregister(json){
    
    
    let alertText = document.querySelector("#alertReg");
    if(json.success != ''){
        //success
        goToLoginPage();
    }

    if(json.error != ''){
        //error
        alertText.innerHTML = json.error;
    }
    

}

function onResponse(response){
    
    return response.json();
    
}

function validateFormLogin(){
    const form = document.forms["login"];

    let alertText = document.querySelector("#alertLog");


    if(form.Username.value.length == 0 || form.Password.value.length == 0){
        alertText.innerHTML = "Please fill all the required fields";
    }else{
        alertText.innerHTML = "";

        let form_data  = new FormData();

        
        fetch("/login/"+encodeURIComponent(form.Username.value)+"/"+encodeURIComponent(form.Password.value)).then(onResponse).then(onJSONlogin);


    }


   


}

function validateFormRegister(){

    const form = document.forms["register"];
    let alertText = document.querySelector("#alertReg");

    
    if(form.Username.value.length == 0 || form.Password.value.length == 0 || form.PasswordConfirm.value.length == 0){

        alertText.innerHTML = "Please fill all the required fields";

    }else{
       

        if(passwordValidation(form.Password.value) == false){
            alertText.innerHTML = "Password must contain at least 6 characters, including uppercase characters and numbers";
        }else{

            if(form.Password.value == form.PasswordConfirm.value){
                alertText.innerHTML = "";
                registerNewUser(form);
            }else{
                alertText.innerHTML = "Passwords are not the same";
            }
            
        }

    }

}

function registerNewUser(form){

    
        let form_data  = new FormData();

    
        fetch("/login/register/"+encodeURIComponent(form.Username.value)+"/"+encodeURIComponent(form.Password.value)).then(onResponse).then(onJSONregister);
    

        form.reset();
  
}

function passwordValidation(pass){

    let containsUpperCase = false;
    let containsNumber = false;
    let character = '';
    
    if(pass.length < 6) return false;

    for(let i = 0; i<pass.length; i++){

        character =  pass.charAt(i);

        if(character == character.toUpperCase()){
            containsUpperCase = true;
        }

        if(character >= '0' && character <= '9'){
            containsNumber = true;
        }

    }

    if(containsNumber == true && containsUpperCase == true){
        return true;
    }else{
        return false;
    }

}

