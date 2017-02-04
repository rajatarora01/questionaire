<?php
namespace Vin\classes;
require('VYS_assets/DAO.php');
$pageNo = $_GET['page'];
$rowsPerPg = $_GET['rows'];
$sortCol = $_GET['sidx'];
$sortOrd = $_GET['sord'];
//echo $pageNo.$rowsPerPg.$sortCol.$sortOrd;
$dao = DAOFactory::getDAO();
//$dao->getQuestions();
$dao->getQuestionsWithPagination($rowsPerPg, $pageNo, $sortOrd, $sortCol);
//$dao->getQuestionsWithPagination(10, 0, "asc", "q_title");
?>