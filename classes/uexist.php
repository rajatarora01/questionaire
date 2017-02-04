<?php
namespace Vin\classes;
use Vin\classes\DBConfig;
//include '../chalkuch/db_config.php';
$usr_email=$_REQUEST['frm_txtEmail'];
$sql = "SELECT id FROM vin_sec_users where user_name='$usr_email'";

if($result = $db->query($sql)){
$row_cnt = $result->num_rows;
if($row_cnt>0){
header('Content-type: application/json');
echo json_encode(false);
}else{
header('Content-type: application/json');
echo json_encode(true);
}
  $result->close();
  }
?>