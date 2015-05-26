$(window).load(function() {
      //alert("window load occurred!");//second
});


$(document).ready(function() {
    var pId = $('#pId').val();
    
    if(pId !== null){
        switch(pId){
            case '0':
                setCoverContent();
                signInControl();
                break;
            case '1':
                setHomeContent();
                newUserValid();
                signInControl();
                break;
            default:                
                break;
        }
    }
    
    $('#toggle').click(function(){
        getSome(this);
    });

    drawStuff();
});//end ready

function resizeCanvas(canvas, context) {
        canvas.width = window.innerWidth;
        //canvas.height = window.innerHeight;

        /**
         * Your drawings need to be inside this function otherwise they will be reset when 
         * you resize the browser window and the canvas goes will be cleared.
         */
        drawStuff(context); 
}

function drawStuff(context){
//    var canvas = document.getElementById('coverCanvas'), context = canvas.getContext('2d');
//    context.fillStyle = "#FFFFFF";
//    context.fillRect(225,62.5,150,75);
//    context.strokeStyle = "blue";
//    context.strokeRect(200,37.5,200,125);
//    context.strokeRect(225,62.5,150,75);
//    context.strokeStyle = "green";
//    context.moveTo(0,0);
//    context.lineTo(600,200);
//    context.stroke();
}


function getSome(e){
    console.log($(e).prop('tagName'));
    if($(e).is('span')){
        cplay(e);
    }
}

function cplay(e){
    console.log('cplay');
    var orgVal = $(e).data('color');
    console.log('orgVal: ' + orgVal);
    $(e).fadeOut(1000);
    $(e)[0].outerHTML = '<input id="toggle" type="color" />';
    $('#toggle').blur(function(){
        alert('in here');
    });
    $('#toggle').css('width', 90);
    
    $('#toggle').click().val(orgVal).change(function(){
        var newVal = $(this).val();
        console.log('newVal: ' + newVal);        
        $(this)[0].outerHTML = '<span id="toggle" data-color="' + newVal + '">optimized</span>';        
        $('#toggle').addClass('optimize').css('color',  newVal).hide().fadeIn().bind('click', function(){
            getSome(this);
        });        
    });
}

//(function() {
//    var canvas = document.getElementById('coverCanvas'), context = canvas.getContext('2d');
//
//    // resize the canvas to fill browser window dynamically
//    window.addEventListener('resize', resizeCanvas, false);
//
//
//    resizeCanvas(canvas, context);
//
//})();

(screensize = function(){
    alert("Window:  " + window.innerWidth + " x " + window.innerHeight + "\n" +
            "Viewport:  " + document.documentElement.clientWidth + " x " + document.documentElement.clientHeight + "\n" +
            "Avl. Window: "+ window.screen.availWidth + " x " + window.screen.availHeight);    
});