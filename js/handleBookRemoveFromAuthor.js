$(document).on("click", ".delete", function (event) {
    console.log(event.target.id);
    var answer = confirm("Wil je dit boek echt loskoppelen van deze autheur ?");
    if (answer == true) {
        $.ajax({
            url: "utility/removeBookFromAuthor.php",
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
                },
                200: function () {
                    $("#bookList").hide();
                    $("#removeBookOk").css({"display": "block"});
                }
            }
        });
    }
});
