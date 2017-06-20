<?php
/**
* @Author: Ronyan Alves
* @Date: 2017-31-05 11:20
* @Projet: Scriptcase
*
**/

sc_lookup(ds,"SHOW COLUMNS FROM Accounts");
$dom = new DOMDocument("1.0", "ISO-8859-1");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$root = $dom->createElement("Contas");
$contato = $dom->createElement("Informacao");
foreach({ds} as $values){
	sc_lookup(rs,"SELECT ". $values[0]. " FROM Accounts");
	$contato->appendChild($dom->createElement($values[0], {rs[0][0]}));
}
$root->appendChild($contato);
$dom->appendChild($root);
$dom->save("contatos.xml");
header("Content-Type: text/xml");
print $dom->saveXML();
