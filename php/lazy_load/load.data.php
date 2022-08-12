<?php
if($_GET['last_id'] != "undefined"){
  if($_GET['last_id'] != 0){
    $sql_where = " WHERE some_id_column < '".$_GET['last_id']."' ";
  }else{
    $sql_where = "";
  }
  $output = "";
  $sql = "SELECT some_id_column FROM table ".$sql_where." ORDER BY some_date_column DESC LIMIT 10";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_row($result))
    {
      $output .= "<input type="hidden" class="data-id" id="'.$row[0].'">";
    }
  }
  $loc_status = 200;
  $arr_response = array("status" => $loc_status, "content" => $output);
  echo json_encode($arr_response,JSON_UNESCAPED_SLASHES);
}
?>
