<?php
require('../VYS_assets/session.class.php');
include '../classes/DAO.php';
$session=new session();
$session->start_session('s_', false);
//echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
$uid=$_SESSION['uid'];
if(empty($uid)){
header("Location: http://chalkuchkartehai.in/?v=0&err=1");
exit();
}
?>