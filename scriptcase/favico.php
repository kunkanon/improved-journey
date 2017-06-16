<?php
/**
* @Author: Ronyan Alves
* @Date: 2016-08-25 14:02
* @Project: Scriptcase
*
**/

?>
<script>
document.head = document.head || document.getElementsByTagName('head')[0];

function changeFavicon(src) {
 var link = document.createElement('link'),
     oldLink = document.getElementById('dynamic-favicon');
 link.id = 'dynamic-favicon';
 link.rel = 'shortcut icon';
 link.href = src;
 if (oldLink) {
  document.head.removeChild(oldLink);
 }
 document.head.appendChild(link);
}

changeFavicon('http://www.google.com/favicon.ico');
	</script>
<?php
