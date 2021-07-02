<?php
//require("class.filetotext.php"); 
require __DIR__ . '/vendor/filetotext/class.filetotext.php';

$docObj = new Filetotext(__DIR__."/uploads/pdf/9f86a-recomm.docx");  
//$docObj = new Filetotext("test.pdf"); 
$return = $docObj->convertToText(); 
echo 'a';
var_dump( $return ) ; 
?>


