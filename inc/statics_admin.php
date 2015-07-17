<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript" src="URL/biblioteca/lib/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
//        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
//        "searchreplace wordcount visualblocks visualchars code fullscreen",
//        "insertdatetime media nonbreaking save table contextmenu directionality",
//        "emoticons template paste textcolor moxiemanager"
        " autolink lists link charmap preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime nonbreaking directionality",
        "emoticons template paste textcolor moxiemanager"

    ],
    toolbar1: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
    toolbar2: "preview | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>