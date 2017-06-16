<?php
/**
* @Author: Ronyan Alves
* @Date: 05/12/2016 14:12
* @Projet: Scriptcase
*
**/

// ( Change the field "{logo_empresa}" to the global variabel ).

// Searching the Logo
// The field "{clientes_img}" is the image of a customer.

$sql_LogoCliente  = "SELECT clientes_img FROM clientes WHERE clientes_id = {clientes_id}";
sc_lookup(data_LogoCliente ,$sql_LogoCliente );
if (isset({data_LogoCliente[0][0]}))     // Image found...
{

        // Save the image on a memory variable 
   $varImg=base64_encode({data_imgMenu[0][0]});
       
        {logo_da_empresa} = "<img border=0 height='63px' src='data:image/png;base64,$varImg'>";  // 63 is the size in pixels from the image.

}

else     // Image not found.

{

    {logo_da_empresa} = 'Logo not configured.';

}
