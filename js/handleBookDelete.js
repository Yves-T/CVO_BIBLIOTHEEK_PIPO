// find input elements that have a name aatribute equal to 1
// these elements must be disabled because they represent lend books
// and we don't want to delete them
var inputElements = $('input');
inputElements.each(function () {
    if ($(this).attr('name') == 1) {
        $(this).prop('disabled', true);
    }
});

$(document).on("click", ".delete", function (event) {

    var answer = confirm("Wil je dit boek echt verwijderen ?");
    if (answer == true) {
        $.ajax({
            url: "utility/deleteBookFromTable.php",
            type: "POST",
            data: {"id": this.id},
            success: function (sResult) {
                // remove row closest to delete button being pressed
                console.log(sResult);

                if (sResult.localeCompare('OK')) {
                    $(event.target).closest("tr").remove();
                }
            },
            statusCode: {
                404: function () {
                    alert("page not found");
                }
            }
        });
    }
});
