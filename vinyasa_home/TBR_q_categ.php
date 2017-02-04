<?php
require('../classes/DAO.php');
$dao = DAOFactory::getDAO();
$dao->getAllCategories();
?>

