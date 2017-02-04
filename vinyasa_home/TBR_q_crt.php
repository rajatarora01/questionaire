<?php

require('../VYS_assets/DAO.php');
$ques = $_POST['q_title'];
$op1 = $_POST['option_1'];
$op2 = $_POST['option_2'];
$op3 = $_POST['option_3'];
$op4 = $_POST['option_4'];
$wt = $_POST['weightage'];
$cat = $_POST['category'];
$q_title_img = $_FILES['q_title_img_h'];
$abc = Utility::isFileOkToUpload($q_title_img);
if($abc!=NULL){
    $content= $abc["content"];
    $name= $abc["filename"];
    $type= $abc["filetype"];
    $size= $abc["filesize"];
    $dao = DAOFactory::getDAO();
    $dao->addQuestion($ques, $op1, $op2, $op3, $op4,$cat,$wt,$content,$name,$type,$size);
}
//}

//header("Location: quiz");
exit();
?>

