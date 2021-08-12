$(function () {


    $("#created").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    
    $('.glyphicon-calendar').click(function () {
        $("#created").focus();
    });



});

