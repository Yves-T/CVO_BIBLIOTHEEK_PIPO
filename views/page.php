<?php
return "<!doctype html>
<html lang=\"nl\">
<head>
    <meta charset=\"UTF-8\">
    <title>$pageData->title</title>
    <link rel='stylesheet' href=''>
    $pageData->css
    $pageData->embeddedStyle
</head>
<body>
<div id=\"wrapper\">
$pageData->scriptElements
$pageData->content
</div>
</body>
</html>";
?>
