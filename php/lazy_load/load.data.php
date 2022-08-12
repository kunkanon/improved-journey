<?php
if($_GET['last_id'] != "undefined"){
  if($_GET['last_id'] != 0){
    $sql_where = " WHERE some_id_column < '".$_GET['last_id']."' ";
  }else{
    $sql_where = "";
  }
  $output = "";
  $sql = "SELECT field FROM table ".$sql_where;
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_row($result))
    {
      $output .= "<div class='row'>$row[0]</div>";
    }
  }
  $loc_status = 200;
  $arr_response = array("status" => $loc_status, "content" => $output);
  echo json_encode($arr_response,JSON_UNESCAPED_SLASHES);
}
?>
