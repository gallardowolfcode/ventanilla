window.addEventListener("load", function(){
    $('#onload').fadeOut();
    $('body').removeClass('hidden');
});

$("#logo-top").on("click", function(e){
    location.reload();
});

$("#constancia").on("click", function(e){
    location.href ="index.php";
});

$("#horario").on("click", function(e){
    location.href ="index.php";
});

$("#seguimiento").on("click", function(e){
    location.href ="index.php";
});
