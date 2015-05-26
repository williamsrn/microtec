var submit;
function signInControl(){
    $('#sInP a').click(function(){
        $('#signInModal').on('hidden.bs.modal', function(){
            $('.form-signin input').val("");
            clearSUF();
            $('#newUserModal').modal('show');
//            $('#newUserModal').on('shown.bs.modal', function(){               
//                
//            });
        });
    });
}

function setHomeContent(){
    /*$('.masthead-nav > li').click(function(e){
        e.preventDefault();
        if($(this).hasClass('active')){
            return false;
        }else{
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
            var lnkId = $(this).data('lnk');        
            if(lnkId !== null){
                $.ajax({
                    url : "php/pages/cover/pscript/coverContent.php",
                    type: "POST",
                    dataType: "text",
                    data: {linkId: lnkId},                
                    success: function(data){
                        if(data){
                            $('#slick').fadeOut('slow', function() {
                                $(this).html(data)
                                $(this).fadeIn('slow');
                            });                                
                        }else{
                            alert('foo!! \n ' + lnkId);
                        }                    
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Error!  Code 00003e");
                    }
                });
            }else{
                alert("foo@! \n " + lnkId);
            }
        }
    });*/
}

function newUserValid(){
    
    if(document.newUserForm){
        document.newUserForm.onsubmit = function(){
            submit = validateForm();
            console.log("submit form: " + submit); 
            if(!submit){
                console.log("New User Submission Interruped!");
            }
            return submit;
        };
    }
    $('#caxBut').click(function(){
        clearSUF();
    });
    
    $('#newUserModal').on('shown.bs.modal', function(){
        var e = $('#inputEmail').val();
        var c = $('#confirmEmail').val();    

        if(e){
            verifyEmail(e);
        }
        if(c){
            confirmEmail(e, c);   
        }
    });

    $('#newUserForm input[placeholder]').blur(function(){
        if($(this).val().length > 0){               
            $(this).siblings('span').fadeOut();                
        }else{                
            if($(this).attr('required')){
                var name = $(this).attr('placeholder');                    
                var msg;
                if(name){
                    msg = name + " is required";                        
                }else{
                    msg = "Required Field";                        
                }
                $(this).siblings('span').html(msg).hide().fadeIn().fadeOut(3000);
            }
        }
    });
    
    

    $('#inputEmail').blur(function(){
        // Check to see if email exists
        var email = $('#inputEmail').val();           
         verifyEmail(email);
    });

    $('#confirmEmail').blur(function(){        
        var e = $('#inputEmail').val();
        var c = $('#confirmEmail').val();            
        confirmEmail(e, c);                 
    });

    $('#inputPassword').blur(function(){            
        var pass = $('#inputPassword').val();
        var vPass = $('#verifyPassword').val();
        var msg;
        if(pass.length >= 7){                
            if(vPass.length > 0){
                if(pass === vPass){
                    $(this).siblings('span').html("");                        
                }else{
                    msg = "Passwords Do Not Match!";
                }
            }else{
                if(validatePassword(pass)){                    
                    $(this).siblings('span').html().fadeOut();                        
                }else{
                    msg = "Password must have uppercase, lowercase and a number!";
                }
            }
        }else{
            var msg = "Password must be at least 7 characters!";
        }

        if(msg)
            $(this).siblings('span').html(msg).hide().fadeIn();

    });

    $('#verifyPassword').blur(function(){ 
        verifyPassword(this);            
    });
}

function verifyName(data){
    var fname = $('#fName').val();
    var lname = $('#lName').val();
}

function verifyPassword(data, effect){
    var pass = $('#inputPassword').val();
    var vPass = $('#verifyPassword').val();            

    if(pass.length > 0 && vPass.length > 0){
        if(pass === vPass){
            $(data).siblings('span').html("");
        }else{
            var msg = "Passwords Do Not Match!";            
            $(data).siblings('span').html(msg).hide().fadeIn();
        }
    }
}

function confirmEmail(email, cEmail){
    if(cEmail.length > 0){
        if(cEmail === email){
            $('#confirmEmail').siblings('span').html("");                    
        }else{
            var msg = "Emails Do Not Match!";
            $('#confirmEmail').siblings('span').html(msg).hide().fadeIn();                    
        }
    }
}

function verifyEmail(email){
    if(email.length > 0){
        $.ajax({
            url : "php/pscript/checkUserEmail.php",
            type: "POST",
            dataType: "text",
            data: {email: email},                
            success: function(data){                    
                console.log(data);
                if(data === 'exists'){
                    //submit = false;
                    $('#emailMsg').html('Email already exists!  <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" href="#">Sign In</button>').hide().fadeIn();
                    $('#emailMsg').children('button').click(function(){
                        var email = $('#inputEmail').val();                                                
                        $('#newUserModal').on('hidden.bs.modal', function(e) {
                            clearSUF();//clear the Sign Up form fields                            
                            if(email && email !==""){
                                $('#signInModal').modal('show');
                                $('#signInModal').on('shown.bs.modal', function(){
                                    $('#userEmail').val(email);
                                    email = "";
                                    $('#userPassword').focus();                                    
                                });
                            }
                        });                                               
                    });
                }else{
                    $('#emailMsg').html("Email is available!").hide().fadeIn().fadeOut(3000);                            
                }                    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("Error!  Code 00001");
            }
        });
    } 
}

function clearSUF(){
    //clear the Sign Up form fields  
    $('.modal-body .form-group input').val("");    
    $('.modal-body .form-group span').hide();       
}

function validatePassword(data){    
    var testStr = data;
    //var pattern = new RegExp('^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$', 'g');//string literals must have all / escaped. This will not work as is.
    var result = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/.test(testStr);
    return result;
    
}

function validateForm(){
    var inputs = $('#newUserForm input');
    submit = true;
    for(var i=0; i<inputs.length; i++){
        var name = $(inputs[i]).attr('name');
        console.log('attrName: ' + name);
        var rqd = $(inputs[i]).attr('required');
        console.log('rqd: ' + rqd);
        if(rqd && inputs[i].length <=0){
            var fieldName = $(inputs[i]).attr('placeholder');
            console.log('fieldname: ' + fieldName)
            var msg;
            if(fieldName)
                msg = fieldName + " is a required field.";
            else
                msg = "This is a required field";
            $(inputs[i]).siblings('span').html(msg).hide().fadeIn();
            submit = false;
        }
        
        var test = /input/.test(name);        
        if(rqd && test){
            var ele = $(inputs[i]).val();
            var vele = $(inputs[(i+1)]).val();
            console.log('ele: ' + ele);
            console.log('vele: ' + vele);
            if(ele !== vele){                
                var fieldName = $(inputs[i]).attr('placeholder');
                console.log('fieldname: ' + fieldName)
                var msg;
                if(fieldName)
                    msg = fieldName + " does not match.";
                else
                    msg = "Fields do not match";
                $(inputs[i]).siblings('span').html(msg).hide().fadeIn(); 
                submit = false;
            }
        }
    }
    console.log('submit' + submit);
    return submit;
}