<?php
/**
* @Author: Ronyan Alves
* @Date: 2016-03-15 17:44
* @Project: PHP
*
**/

function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir"){
            rrmdir($dir."/".$object);
         }else{ 
            unlink($dir."/".$object);
         }
       }
     }
     reset($objects);
     rmdir($dir);
  }
}

rrmdir('/home/username/public_html/foldername');
