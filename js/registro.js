$(document).ready(function(){
    
    $('#nombre-reg').blur(function(){
        validateNombre();   
    });

    $('#email-reg').blur(function(){
        validateEmail();   
    });

    $('#usuario-reg').blur(function(){
        validateNombre();
    });

    function validateNombre(){
    
        var nameReg = /^[A-Za-z]+$/;
    
        var usuario = $('#nombre-reg').val();
        
        if(usuario == ""){
            $('.error-reg').html('<span class="error" style="color:red"><p>Introduzca su usuario valido </p></span>');
        } 
        else if(!nameReg.test(usuario)){
            $('.error-reg').html('<span class="error" style="color:red"> <p>El usuario solo puede contener letras</p></span>');
        }       
    }

    function validateEmail(){
    
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    
        var email = $('#email-reg').val();
        
        if(email == ""){
            $('.error-reg').html('<span class="error" style="color:red"><p>Introduzca un correo</p></span>');
        } 
        else if(!emailReg.test(email)){
            $('.error-reg').html('<span class="error" style="color:red"><p>El correo no parece valido</p></span>');
        }  
    }
 
           

});