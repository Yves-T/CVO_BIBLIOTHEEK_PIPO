$(function () {

    $("#memberZip").autocomplete({
        source: 'utility/zipServer.php'
    });

    $("#membeCity").autocomplete({
        source: 'utility/zipNameServer.php'
    });
});
