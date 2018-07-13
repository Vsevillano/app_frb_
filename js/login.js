$(document).ready(function(){

    $('#user-login').blur(function(){
        validateUser();   
    });

    $('#pass-login').blur(function(){
        validatePass();   
    });
    
    function validateUser(){
    
        var nameReg = /^[A-Za-z]+$/;
    
        var usuario = $('#user-login').val();
    
    
        if(usuario == ""){
            $('.error-login').html('<span class="error" style="color:red"><p>Introduzca su usuario valido </p></span>');
        } 
        else if(!nameReg.test(usuario)){
            $('.error-login').html('<span class="error" style="color:red"> <p>El usuario solo puede contener letras</p></span>');
        }       
    }   

    function validatePass(){    
        var pass = $('#pass-login').val();
    
        $('.error').hide();
    
        if(pass == ""){
            $('.error-login').html('<span class="error" style="color:red"><p>Introduzca su contraseña</p></span>');
        } 
            
    }
    
});