function login_check(){

    function check_email(){
        var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        var stevens_email = /^\w+@(stevens.edu)$/;
        var email = document.getElementById("email").value;
        var r = stevens_email.test(email);
        if (r == false)
            document.getElementById("email_error").innerHTML = "Please use Stevens edu email.";
        console.log(r);
        return r;
    };
    function check_password(){

        var password1 = document.getElementById("password").value;
        console.log("Checking.");
        if(password1.length<6){
            document.getElementById("password_error").innerHTML = "Password error";
            return false;
        }
        return true;
    };
    $('#login_form').bind("submit",function(e){
        
        if(check_email()&&check_password()){
            $(this).unbind("submit");
            $('#login_form').submit();
        }else{
             e.preventDefault();
        }
        
    });
}

function registration_check(){

    function check_email(){
        var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        var stevens_email = /^\w+@(stevens.edu)$/;
        var email = document.getElementById("email").value;
        var r = stevens_email.test(email);
        document.getElementById("email_error").innerHTML = "Please use Stevens edu email.";
        console.log(r);
        if (r==true){
            document.getElementById("email_error").innerHTML = "";
        }
        return r;
    };
    function check_password(){
        var password1 = document.getElementById("password").value;
        var password2 = document.getElementById("passwordConfirm").value;
        if(password1.length<6||password2.length<6){
            document.getElementById("password_error").innerHTML = "Password's length should be longer than 6.";
            return false;
        }else if(password1 != password2){
            document.getElementById("password_error").innerHTML = "Password does not match.";
            return false;
        }else{
            document.getElementById("password_error").innerHTML = "";
            return true;
        }
    };

    $('#register_form').bind("submit",function(e){
        if(check_email()&&check_password()){
            console.log("Hello");
            $(this).unbind('submit').submit();
        }else{
            e.preventDefault();
        }
    });

}
