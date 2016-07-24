$(document).ready(function(){
    
    $('#loginSubmit').click(function(){
       var email = $('#email').val(),
           password = $('#password').val(),
           testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        
        if (email == "" || password == ""){
            $('#ack').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria label="Close"><span aria-hidden="true">&times;</span></button>Please enter both email address and password.</div>');
        } else if (!(testEmail.test(email))){
            $('#ack').html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria label="Close"><span aria-hidden="true">&times;</span></button>Please enter a valid email address.</div>');
        } else {
            $.post("php/login.php", $('#login :input').serializeArray(), function(response){
               if (response == "1"){
                   window.location.replace("admin");
               } else if (response == "2"){
                   alert("internal");
               } else if (response == "3"){
                   alert("external");
               } else if (response == "100"){
                   alert("user not found");
               } else if (response == "101"){
                   alert("wrong pw");
               } else if (response == "102"){
                   alert("account locked");
               }
            });
        }
        
    });
    
    
});