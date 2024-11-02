<?php

/*
USAGE: define the $title vaiable before including this
*/

if (!isset($title)) {
    $title = "PLACEHOLDER";
}

echo '
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'. $title .'</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
'

?>