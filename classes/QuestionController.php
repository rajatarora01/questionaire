<?php

require_once 'DAOFactory.php';

class QuestionController {

    private $dao = NULL;

    function __construct() {
        if ($this->dao == NULL) {
            $this->dao = DAOFactory::getDAO();
        }
    }

    function processDataAdd($data) {
        try {
            $this->dao->addQuestion_new($data);
        } catch (Exception $e) {
            exit;
        }
    }
    function processDataEdit($data) {
        try {
            $this->dao->editQuestion($data);
        } catch (Exception $e) {
            exit;
        }
    }
    function processDataDelete($data){
        try {
            $this->dao->deleteQuestion($data);
            echo $data;
            exit;
        } catch (Exception $e) {
            exit;
        }
    }

}
?>

