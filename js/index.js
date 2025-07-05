// function Login() {
//     window.location = "login.php";
//     return false;
// }

var x = document.getElementById("login");
var y = document.getElementById("Register");
var z = document.getElementById("btn");

function Register(){
    x.style.left ="-400px";
    y.style.left ="50px";
    z.style.left = "110px";
}
function login(){
    x.style.left ="50px";
    y.style.left ="450px";
    z.style.left = "0px";
}

function Logout() {
    window.location = "logout.php";
    return false;
}

function Sudalogin() {
    alert('Maaf, anda sudah login');
}

// SMOOTHSCROLL NAVBAR
$(function() {
    $('.navbar a, .home a, .footer a').on('click', function(event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
        scrollTop: $($anchor.attr('href')).offset().top - 49
    }, 1000);
    event.preventDefault();
    });
}); 

// buttonscroll
$(document).ready(function(){

    $(window).scroll(function(){
        if($(this).scrollTop() > 40){
            $('#topBtn').fadeIn();
        } else{
            $('#topBtn').fadeOut();
        }
    });

    $('#topBtn').click(function(){
        $('html, body').animate({scrollTop: 0}, 800);
    });

});
// buttonscroll


// ======================================================
        // About Modal Box
        // Get the modal
        var modal = document.getElementById("LoginModal");

        // // Get the button that opens the modal
        var btn = document.getElementById("LoginBtn");
        var btn2 = document.getElementById("LoginBtn2");

        // // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // // When the user clicks on the button, open the modal
        btn.onclick = function() {
        modal.style.display = "block";
        }

        btn2.onclick = function() {
        modal.style.display = "block";
        }

        // // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // // When the user clicks anywhere outside of the modal, close it
        // window.onclick = function(event) {
        //     if (event.target == modal) {
        //         modal.style.display = "none";
        //     }
        // }
// ==========================================================

function sendEmail(){
    Email.send({
    // SecureToken : "3de0c0ad-e059-4db3-9793-56be886d080f",
    // Username : "yanuarcygithub1@gamil.com",
    // Password : "3052FCAC9D2AA31FC8C3A999A205E9ED2B8B",
    SecureToken : "89efb415-61bc-4f9e-89b0-d06cf9bf2248 ",
    Host : "smtp.elasticemail.com",
    Username : "yanuarsecacc567@gmail.com",
    Password : "A2ABEF082AB780E439CFA29478232EA6E6D5",
    To : 'yanuarsecacc567@gmail.com',
    From : 'yanuarsecacc567@gmail.com',
    // ReplyTo : document.getElementById("email").value,
    Subject : "You got new email, Membership Form",
    Body : "Nama : " + document.getElementById("nama").value
        + "<br> Email : " + document.getElementById("email").value
        + "<br> Message : " + document.getElementById("message").value
    }).then(
    message => alert("Pesan Berhasil Di Kirim, Silahkan Tunggu Balasan. Terimakasih Sudah Mengirim Pesan")
    );
}



function submitValue() {
    var inputValue = document.getElementById("inputValue").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "addToCart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    }
    xhr.send("inputValue=" + inputValue);
}