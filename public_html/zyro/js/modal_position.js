$(function() {
    $(".link-modal").click(function(){
        var x = $(this).offset();
        var modal = $(this).attr("data-target");
        $(modal).css({top: window.innerHeight/3, left: 0});
    })
});
