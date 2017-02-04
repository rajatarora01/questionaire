<?php

require_once 'QuestionController.php';
$data = "";
if (isset($_POST['myData'])) {
    $data = json_decode($_POST['myData']);
    echo 'helo';
    
}

$qc = new QuestionController();
$qc->processDataDelete($data);
?>

