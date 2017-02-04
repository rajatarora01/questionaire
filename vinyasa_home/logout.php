<?php
include '../VYS_assets/session.class.php';
if($session=new session()){
$session->start_session('s_', false);
session_unset();
session_destroy();
}
header('location: http://chalkuchkartehai.in');
exit;
?>