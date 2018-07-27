$(function() {

    // Bracket Collapse

    $('#collapse-bracket').on('shown.bs.collapse', function () {
        $('#bracket-down-arrow').hide();
        $('#bracket-up-arrow').show();
    })
    $('#collapse-bracket').on('hidden.bs.collapse', function () {
        $('#bracket-down-arrow').show();
        $('#bracket-up-arrow').hide();
    })

    $('#collapse-summary').on('shown.bs.collapse', function () {
        $('#summary-down-arrow').hide();
        $('#summary-up-arrow').show();
    })
    $('#collapse-summary').on('hidden.bs.collapse', function () {
        $('#summary-down-arrow').show();
        $('#summary-up-arrow').hide();
    })

    // Change View

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

    // Modal Position

    $(".link-modal").click(function(){
        var x = $(this).offset();
        var modal = $(this).attr("data-target");
        $(modal).css({top: window.innerHeight/4, left: 0});
    })

    // Sticky Header

    //// When the user scrolls the page, execute myFunction
    window.onscroll = function() {myFunction()};

    //// Get the header
    var header = document.getElementById("page-header");

    //// Get the offset position of the navbar
    var sticky = header.offsetTop;

    //// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
        if (window.pageYOffset >= sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }

    // Bootstrap Popover

    $("[data-toggle=popover]").each(function(i, obj) {

        $(this).popover({
            html: true,
            content: function() {
                var id = $(this).attr('id');
                id = id.replace('popover_', '');
                return $('#popover-content-' + id).html();
            }
        });

    });

    // UNL Initial Tab

    $('#UNLLeagueTab li:first-child a').tab('show');
    $('#UNLMatchDayTab li:first-child a').tab('show');
});
