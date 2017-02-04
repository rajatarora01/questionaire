<?php
require_once ('../VYS_assets/session.class.php');
require_once('DAO.php');
$session = new session();
$uname = $_POST['frm_username'];
$pwd = $_POST['frm_password'];
$dao = DAOFactory::getDAO();
$userAuthenticated = $dao->authenticateUserLogin($uname, $pwd);
if ($userAuthenticated) {
    header("Location: ../vinyasa_home/home"); /* Redirect browser */
    exit;
} else {
    header("Location: index?v=0&err=1"); /* Redirect browser */
    exit;
}
?>