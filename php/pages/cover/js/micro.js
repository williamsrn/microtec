function setCoverContent(){
    $('.masthead-nav > li').click(function(e){
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
    });
}

function getContactUsMsg(){
    $('#btnContactUs').click(function(e){
        e.preventDefault();
//        if(document.contactUsForm){
//            document.contactUsForm.onsubmit = function(){
//                submit = validateForm();
//                console.log("submit form: " + submit); 
//                if(!submit){
//                    console.log("New User Submission Interruped!");
//                }
//                return submit;
//            };
//        }
        $.ajax({
            url : "php/pscript/processContactUsMsg.php",
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
    });    
}

