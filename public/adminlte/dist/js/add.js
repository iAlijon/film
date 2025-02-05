$(document).ready(function (){
    $('#changeImage').click(function (e){
        e.preventDefault()
       $('#imageBox').slideUp()
       $('#fileInput').slideDown()
    });

    $('#cancelChangeImage').click(function(e) {
        e.preventDefault();
        $('#imageBox').slideDown();
        $('#fileInput').slideUp();
    })
});
