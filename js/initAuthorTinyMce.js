(function () {

    if (tinymce) {
        tinymce.init({
            selector: 'textarea',
            plugins: 'image',
            menubar: 'edit insert format table tools',
            setup: function (editor) {
                editor.on('change', function (e) {
                    var authorEditorContent = tinyMCE.get('authorBiographyEditor').getContent();
                    validateEditor(authorEditorContent, "authorBiographyEditor", "#editor-error-message-bio");

                    function validateEditor(editorContent, editorName, editorErrorId) {
                        if (editorContent == '' || editorContent == null) {

                            // Add error message if not already present
                            if (!$(editorErrorId).length && !$(editorErrorId).text().length > 0) {
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
                });
            }
        });
    }

})();
