<?php
/**
* @Author: Ronyan Alves
* @Date: 02/02/2017 06:17
* @Project: Scriptcase
*
**/

$sql = "CALL get_empresa('ABCD',@ret)";
sc_lookup(ds,$sql);
var_dump({ds});
if( !empty( {ds} ) ){
    echo "La emrpesa es: ".{ds[0][0]};;
}
