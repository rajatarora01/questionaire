<?php
require_once('DAOFactory.php');
$dao = NULL;
$dao = DAOFactory::getDAO();
$dao->getAllCategories_new();
$dao = NULL;
?>

