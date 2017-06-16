<?php
/**
* @Author: Ronyan Alves
* @Date: 2016-03-15 17:47
* @Project: PHP
*
**/

ini_set('max_execution_time', 300);
$zip = new ZipArchive;
if ($zip->open('filename.zip') === TRUE) {
    $zip->extractTo('/home/user/public_html/');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}
?>
