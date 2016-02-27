$(document).ready(function () {

    $.validate({
        modules: '',
        decimalSeparator: ',',
        onModulesLoaded: function () {

        }
    });

    $("#submit").click(function (evemt) {
        var shortEditorContent = tinyMCE.get('shortCommentEditor').getContent();
        validateEditor(shortEditorContent, "shortCommentEditor", "#editor-error-message");

        function validateEditor(editorContent, editorName, editorErrorId) {
            if (editorContent == '' || editorContent == null) {
                event.preventDefault();
                // Add error message if not already present
                if (!$(editorErrorId).length) {
                    $('<span id="' + editorErrorId.substring(1) + '">Editor veld is leeg</span>')
                        .insertAfter($(tinyMCE.get(editorName).getContainer()));
                }
            }
            else {
                // Remove error message
                if ($(editorErrorId))
                    $(editorErrorId).remove();
            }
        }

    })

});
