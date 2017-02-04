<?php
namespace Vin\classes;
use Vin\classes\DAOFactory;
//require 'VYS_assets/DAO.php';

$id=$_GET['x'];
$vc=$_GET['vc'];
if(empty($id) || empty($vc)){
    header("Location: index?v=0&err=1"); /* Redirect browser */
    exit();
}
$dao = DAOFactory::getDAO();
$userVerification = $dao->verifyUserViaEmailLink($vc, $id);
    if($userVerification!=NULL){
    $dao->updateUserVerificationStatus($id);
    	header("Location: index?v=1&x=$id&se=$userVerification"); /* Redirect browser */
	exit();
    }else{
    	header("Location: index?v=0&err=1"); /* Redirect browser */
	exit();
    }
?>