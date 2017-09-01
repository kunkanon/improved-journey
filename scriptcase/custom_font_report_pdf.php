<?php
/**
* @Author: Ronyan Alves
* @Date: 09/01/2017 10:25
* @Project: Scriptcase
*
**/
/** Layout > Code > Body **/
$pdf_font = new TCPDF_FONTS();
$fontname = $pdf_font->addTTFfont('/Applications/Scriptcase/v9/wwwroot/f2-tecnocratica-ffp.ttf', 'TrueType', '', 32);
sc_pdf_add_font($fontname);
sc_pdf_set_font($fontname);
[glo_font_style] = $fontname;

/** Layout > Code > Definition **/
$this->default_font = [glo_font_style];
