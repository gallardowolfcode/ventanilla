
window.addEventListener("load", function(){
    $('#onload').fadeOut();
    $('body').removeClass('hidden');
});

$("#logo-top").on("click", function(e){
    location.reload();
});