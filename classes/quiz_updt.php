<?php
require_once('../VYS_assets/DAO.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$id = $_POST['id'];
$ques = $_POST['q_title'];
$op1 = $_POST['option_1'];
$op2 = $_POST['option_2'];
$op3 = $_POST['option_3'];
$op4 = $_POST['option_4'];
$oper = $_POST['oper'];
$categ = $_POST['category'];
$dao = DAOFactory::getDAO();
if ($oper == 'add') {
    $dao->addQuestion($ques, $op1, $op2, $op3, $op4, $categ);
} else if ($oper == 'edit') {
    $dao->updateQuestion($id, $ques, $op1, $op2, $op3, $op4, $categ);
} else if ($oper == 'del') {
    $dao->deleteQuestion($id);
}

class Questionnnaire {

    private $dao = NULL;

    public function __construct() {
        if ($dao == NULL) {
            $dao = DAOFactory::getDAO();
        }
    }

    public function addQuestion($question_type) {
        $success = false;
        switch ($question_type) {
            case 1://This is a text question text options
                $result = $this->dao->addQuestion();
                break;
            case 2://This is an image question text options
                break;
            case 3://This is a text question image options
                break;
            default :
                return "errorMessage";
        }
        if (!$success) {
            return "errorMessage";
        }
    }

}
?>

