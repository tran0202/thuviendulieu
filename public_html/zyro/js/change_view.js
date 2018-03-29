$(function() {
    $(".link-change-view").click(function(){
        for (var x = 0; x < 5; x++) {
            var view_target = Number($(this).attr("data-target"));
            if (x === view_target) {
                $("#view-" + x).show();
            }
            else {
                $("#view-" + x).hide();
            }
        }
    })
});
