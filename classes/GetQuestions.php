<?php

require_once 'DAOFactory.php';
;
$dao = DAOFactory::getDAO();
$pageNumber = $_POST['current'];
$rowsToBeFetched = $_POST['rowCount'];
$sortOrdArr = $_POST['sort'];
$sortCol = "";
$sortOrd = "";
foreach ($sortOrdArr as $key => $value) {
    $sortCol=$key;
    $sortOrd=$value;
}
$searchPhrase = $_POST['searchPhrase'];
$dao->getAllQuestions($pageNumber, $rowsToBeFetched, $sortCol,$sortOrd, $searchPhrase);
?>

