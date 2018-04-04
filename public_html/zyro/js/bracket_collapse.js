$(function() {
    $('#collapse-bracket').on('shown.bs.collapse', function () {
        $('#bracket-down-arrow').hide();
        $('#bracket-up-arrow').show();
    })
    $('#collapse-bracket').on('hidden.bs.collapse', function () {
        $('#bracket-down-arrow').show();
        $('#bracket-up-arrow').hide();
    })
});
