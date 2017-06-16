<?php
/**
* @Author: Ronyan Alves
* @Date: 2017-06-16 11:54
* @Project: Scriptcase
*
**/

$path = $_SERVER['DOCUMENT_ROOT'].'sc9/file/reportpdf_pdf.pdf';
[glo_pdf_file] = $path;
sc_pdf_output([glo_pdf_file],"F");

?>
<script>
	window.opener.location.href = window.opener.location.href;
	window.close();
</script>
<?php
