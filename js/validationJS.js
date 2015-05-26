/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var inputFields = document.newUserForm.getElementsByTagName("input");
// this is addon for modernizer script
var validationInfo = {
    "myName" : {
        "pattern" : "this is where the regex pattern would go",
        "placeholder" : "Last Name, First"},
    "myTelephone" : {
        "pattern" : "the regex pattern",
        "placeholder" : "xxx-xxx-xxxx"}  
    }
    

 
for(key in inputFields){
    var myField = document.newUserForm.inputFields[key];
    var myError = document.getElementById('formError');

    myField.onchange = function(){
        if(Modernizr.input.pattern){
            ////modenizer creates an object called Modernizer that has information about the each type that you are trying to check for. In this case if the input field has a patteren attribute
            //do this when browser has pattern support
            var myPattern = this.pattern;//use only when pattern attribute is available to the browser (orginal b4 modernizer)
            var myPlaceholder = this.placeholder;//use only when placeholder attribute is available to the browser (orginal b4 modernizer)
        }else{
            //use only when pattern/placeholder attribute is not available to the browser.  Uses Object defined above
            var myPattern = validationInfo[this.name].pattern;
            var myPlaceholder = validationInfo[this.name].placeholder;
        }
        var isValid = this.value.search(myPattern) >= 0;

        if(!isValid){//pattern not avlid
            myError.innerHTML = "Input does not match expected pattern. " + myPlaceholder;
        }else{//pattern is valid
            myError.innerHTML = "";
        }
    }

}

/******
 * patterns (http://html5pattern.com/)
 * 
 *  Credit Card #: (\d{4}[ \-]?\d{4}[ \-]?\d{4}[ \-]?(\d{1}|\d{4}))
 *  Dollar Amount:  \$?\d*\.?\d*
 *  Password (UpperCase, LowerCase and Number):  ^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$
 *  US Phone#: \d{3}[\-]\d{3}[\-]\d{4}
 */

//jquery

$(document).ready(function(){
    $('#myForm').submit(function(){//capture the form submit.  return false; would abort the form submit.
        var abort = false;
        $("div.error").remove();
        $(":input[required]").each(function(){
            if($(this).val()===''){
                $(this).after('<div class="error">This is a required field!</div>');
                abort = true;
            }
        });
        if(abort){return false;} else {return true;}
    })
});