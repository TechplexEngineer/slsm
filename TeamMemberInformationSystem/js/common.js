//$(document).ready(function(){
//    $('#pass2').keyup(function(){
//        //get value of other pass field
//        console.log($('#pass').val());
//        //compare it to the value of this pass field
//        //show check or x
//    });
//
//});
var firstname = "";
var lastname = "";
$(document).ready(function(){
    function makeUsrName()
    {
        var username =firstname + "." + lastname;
        $('#uname').val(username);
    }
    $('#fname').keyup(function(){
        firstname = $('#fname').val();
        makeUsrName()
    });
    $('#lname').keyup(function(){
        lastname=$('#lname').val();
        makeUsrName()
    });

});

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

function makeUname(form)
{
    console.log("make uname");
    //document.getElementById("fname").attr
    var firstname = form.fname.value;
    var lastname = form.lname.value;
    var username =firstname + "." + lastname;
    form.uname.value=username;
}

/**
 * passhelp()
 */
function passHelp() {
    alert("Your username is: Firstname.Lastname" + "\n\nYour password is the one you registered with." + "\n\nIf you can't remember your password send mail to:\n   Blake (at) Team2648 (dot) com");
}

function ajaxStats(fullname)
{
    //console.log("sjaxStats");
    $.ajax({
        url: "lib/widgets/dashboard.stats.php?name="+fullname,
        cache: false,
        success: function(html){
            //            console.log(html);
            document.getElementById("stats").innerHTML = html;
        //            var pieces = html.split("|");
        //            var fhours = pieces[0].substr(3, pieces[0].length);
        //            var fdollars = pieces[1].substr(3, pieces[0].length);
        //            var cchours = pieces[2].substr(3, pieces[0].length);
        //            var bhours = pieces[3].substr(3, pieces[0].length);



        }
    });
// make php file with these as get params, then return its outpt,
// inner html replace

}

function login()
{
    console.log("logintoggle");
    $.ajax({
        url: "lib/io.php?name=cblogin&val="+document.controlsForm.loginbox.checked,
        cache: false,
        success: function(html){
            console.log(html);
        }
    });

}
//document.controlsForm.loginbox
//document.controlsForm.regbox
function reg()
{
    console.log("regtoggle");
    $.ajax({
        url: "lib/io.php?name=cbreg&val="+document.controlsForm.regbox.checked,
        cache: false,
        success: function(html){
            console.log(html);
        }
    });

}
