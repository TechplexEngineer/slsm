//$(document).ready(function(){
//    $('#pass2').keyup(function(){
//        //get value of other pass field
//        console.log($('#pass').val());
//        //compare it to the value of this pass field
//        //show check or x
//    });
//
//});

/**
 * Comment
 */
function passMatch(form) {
    //console.log(document.getElementById('pass2'));
    var pass1 = form.pass.value;
    var pass2 = form.pass2.value;
    console.log(pass1 + pass2);
    if(pass1 == pass2)
    {
    //enable submitt button
    form.Submit.disabled=false;
    //make green checkmark, and small caption "passwords match"
    }
    else
    {
        //Disable submitt button,
        form.Submit.disabled=true;
        // make red x and caption "passwords don't match"
    }

}