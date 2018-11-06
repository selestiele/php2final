<?php

//$docRoot = $_SERVER['DOCUMENT_ROOT'];
$docRoot = "http://localhost/";

//$appPath = $_SERVER['REQUEST_URI']; - need to remove the filename for this, since it gives everything after the document root, AND includes the forward slash which makes the filename get two forward slashes.

$appPath = "php2final/";

$fullPath = $docRoot . $appPath;

?>
