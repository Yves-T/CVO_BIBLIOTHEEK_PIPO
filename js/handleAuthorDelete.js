$(document).on("click", ".delete", function (event) {

    var answer = confirm("Wil je deze autheur echt verwijderen ?");
    if (answer == true) {
        $.ajax({
            url: "utility/deleteAuthorFromTable.php",
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
