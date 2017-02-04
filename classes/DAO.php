<?php

require_once 'Utility.php';
require_once 'DBConfig.php';

class DAO {

//Database credentials

    private $dbConfig = NULL;

    public function __construct() {
        
    }

    public function getMysqliConnection() {
        //Connect with the database
        if ($this->dbConfig == NULL) {
            $this->dbConfig = DBConfigFactory::getDBConfig();
        }
        return $this->dbConfig->getMysqliConnection();
    }

    private function getPDOConnection() {
        if ($this->dbConfig == NULL) {
            $this->dbConfig = DBConfigFactory::getDBConfig();
        }
        return $this->dbConfig->getPDOConnection();
    }

    function createNewUser($fname, $lname, $uname, $contact, $enc_pwd, $secureKey) {
        $db = $this->getMysqliConnection();
        $stmt = $db->prepare('insert into vin_sec_users(fname,lname, user_name, contact_number,secure_key,reg_date,verify_hash) values (?,?,?,?,?,now(),?)');
        $fname = $this->escStr($db, $fname);
        $lname = $this->escStr($db, $lname);
        $uname = $this->escStr($db, $uname);
        $contact = $this->escStr($db, $contact);
        $secureKey = $this->escStr($db, $secureKey);
        $enc_pwd = $this->escStr($db, $enc_pwd);
        $stmt->bind_param('ssssss', $fname, $lname, $uname, $contact, $secureKey, $enc_pwd);
        $stmt->execute();
        $stmt->close();
        $db->close();
        return TRUE;
    }

    function getUserID($uname) {
        $db_id = NULL;
        $db = $this->getMysqliConnection();
        if ($stmt = $db->prepare('SELECT id FROM vin_sec_users where user_name=?')) {
            $stmt->bind_param('s', $uname);
            $stmt->execute();
            $stmt->bind_result($db_id);
            $stmt->fetch();
            $stmt->close();
        }
        $db->close();
        return $db_id;
    }

    function escStr($db, $string) {
        return mysqli_real_escape_string($db, $string);
        ;
    }

    function verifyUserViaEmailLink($encryStr, $uid) {
        $db_uname = NULL;
        $userVerificationStatus = NULL;
        $db = $this->getMysqliConnection();
        if ($stmt = $db->prepare('SELECT user_name FROM vin_sec_users where id=?')) {
            $stmt->bind_param('s', $uid);
            $stmt->execute();
            $stmt->bind_result($db_uname);
            $stmt->fetch();
            $stmt->close();
        }
        if ($db_uname != NULL) {
            $email_md5 = Utility::encryptMD5($db_uname);
            if (strcmp($email_md5, $encryStr) == 0) {
                $userVerificationStatus = $db_uname;
            }
        }
        $db->close();
        return $userVerificationStatus;
    }

    function updateUserVerificationStatus($uid) {
        $db = $this->getMysqliConnection();
        $stmt = $db->prepare("update vin_sec_users set user_verified=1 where id=?");
        $uid = $this->escStr($db, $uid);
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    function authenticateUserLogin($un, $pw) {
        $userAuthenticationStatus = FALSE;
        $db = $this->getMysqliConnection();
        if ($stmt = $db->prepare('SELECT verify_hash ,secure_key,fname,lname FROM vin_sec_users where user_name=?')) {
            $stmt->bind_param('s', $un);
            $stmt->execute();
            $stmt->bind_result($hash_key, $secure_key, $fname, $lname);
            $stmt->fetch();
            if (password_verify($pw, $hash_key)) {
                $session = new session();
                $session->start_session('s_', false);
                $_SESSION['s_k'] = $secure_key;
                $_SESSION['fn'] = $fname;
                $_SESSION['ln'] = $lname;
                $userAuthenticationStatus = TRUE;
            }
            $stmt->close();
        }
        $db->close();
        return $userAuthenticationStatus;
    }

    function getQuestionsWithPagination($pageSize, $pageNum, $sortOrder, $sortFieldName) {
        $db = $this->getMysqliConnection();
        $totalRecords = 0;
        if ($stmt = $db->prepare('SELECT count(*) AS totalRecords FROM quiz_questionnaire')) {
            $stmt->execute();
            $stmt->bind_result($totalRecords);
            $stmt->fetch();
            $stmt->close();
        }
        if ($totalRecords > 0) {
            $total_pages = ceil($totalRecords / $pageSize);
            //$total_pages = ceil($count/1);
        } else {
            $total_pages = 0;
        } if ($pageNum > $total_pages) {
            $pageNum = $total_pages;
        }
        $start = $pageSize * $pageNum - $pageSize;
        //$start = $pageNum * $pageSize;
        //echo $start."--".$pageSize;
        $responce = NULL;
        $i = 0;
        $id = NULL;
//        if (TRUE) {
        if ($sortOrder != "") {
            if ($sortOrder == "desc") {
                if ($stmt = $db->prepare("SELECT ques.id,ques.q_title,ques.option_1,ques.option_2,ques.option_3,ques.option_4,TO_BASE64(ques.q_title_img),cat.id category from quiz_questionnaire ques"
                        . " INNER JOIN quiz_category cat on cat.id=ques.category_id LIMIT ?,?")) {
                    $stmt->bind_param('ii', $start, $pageSize);
                    $stmt->execute();
                    $stmt->bind_result($id, $q_title, $op1, $op2, $op3, $op4, $q_title_img, $catId);
                    while ($stmt->fetch()) {
                        echo $q_title;
                        //$questions = array('Question' => $q_title, 'Option-1' => $op1, 'Opiton-2' => $op2, 'Opiton-3' => $op3, 'Opiton-4' => $op4);
                        $responce->rows[$i]['id'] = $id;
                        $responce->rows[$i]['cell'] = array($id, $q_title, $op1, $op2, $op3, $op4, $q_title_img, $catId);
                        $i++;
                    }
                    $stmt->close();
                }
            } else if ($sortOrder == "asc") {
                if ($stmt = $db->prepare("SELECT ques.id,ques.q_title,ques.option_1,ques.option_2,ques.option_3,ques.option_4,TO_BASE64(ques.q_title_img),cat.id category from quiz_questionnaire ques"
                        . " INNER JOIN quiz_category cat on cat.id=ques.category_id LIMIT ?,?")) {
                    $stmt->bind_param('ii', $start, $pageSize);
                    $stmt->execute();
                    $stmt->bind_result($id, $q_title, $op1, $op2, $op3, $op4, $q_title_img, $catId);
                    while ($stmt->fetch()) {
                        //echo $q_title;
                        //$questions = array('Question' => $q_title, 'Option-1' => $op1, 'Opiton-2' => $op2, 'Opiton-3' => $op3, 'Opiton-4' => $op4);
                        $responce->rows[$i]['id'] = $id;
                        $responce->rows[$i]['cell'] = array($id, $q_title, $op1, $op2, $op3, $op4, $q_title_img, $catId);
                        $i++;
                    }
                    $stmt->close();
                }
            }
        } else {
            $stmt = $db->prepare("SELECT SQL_CALC_FOUND_ROWS id,q_title,option_1,option_2,option_3,option_4 from quiz_questionnaire LIMIT ?,?");
            $stmt->bind_param('ii', $start, $pageSize);
            $stmt->execute();
            $stmt->bind_result($id, $q_title, $op1, $op2, $op3, $op4);
            while ($stmt->fetch()) {
                //$questions = array('Question' => $q_title, 'Option-1' => $op1, 'Opiton-2' => $op2, 'Opiton-3' => $op3, 'Opiton-4' => $op4);
                $responce->rows[$i]['id'] = $id;
                $responce->rows[$i]['cell'] = array($id, $q_title, $op1, $op2, $op3, $op4);
                $i++;
            }
            $stmt->close();
        }
//        } else {
//            $stmt = $db->prepare("SELECT SQL_CALC_FOUND_ROWS q_title,option_1,option_2,option_3,option_4 from quiz_questionnaire LIMIT ?,?");
//            $stmt->bind_param('ii', $start, $pageSize);
//            $stmt->execute();
//            $stmt->bind_result($q_title, $op1, $op2, $op3, $op4);
//            while ($stmt->fetch()) {
//                //$questions = array('Question' => $q_title, 'Option-1' => $op1, 'Opiton-2' => $op2, 'Opiton-3' => $op3, 'Opiton-4' => $op4);
//                $responce->rows[$i]['id'] = $q_title;
//                $responce->rows[$i]['cell'] = array($q_title, $op1, $op2, $op3, $op4);
//            }
//            $stmt->close();
//        }
        echo json_encode($responce);
        $db->close();
    }

    function updateQuestion($id, $ques, $op1, $op2, $op3, $op4, $categ) {
        $db = $this->getMysqliConnection();
        $stmt = $db->prepare("update quiz_questionnaire set q_title=?,option_1=?,option_2=?,option_3=?,option_4=?,category_id=? where id=?");
        $id = $this->escStr($db, $id);
        $ques = $this->escStr($db, $ques);
        $op1 = $this->escStr($db, $op1);
        $op2 = $this->escStr($db, $op2);
        $op3 = $this->escStr($db, $op3);
        $op4 = $this->escStr($db, $op4);
        $stmt->bind_param('sssssii', $ques, $op1, $op2, $op3, $op4, $categ, $id);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    function addQuestion($ques, $op1, $op2, $op3, $op4, $cat, $wt, $content, $name, $type, $size) {
        $db = $this->getMysqliConnection();
        $stmt = $db->prepare("insert into quiz_image(content,name,type,size) values(?,?,?,?)");
//        $stmt = $db->query("insert into `quiz_image`(q_title) values('$q_title_img')");
        $stmt->bind_param('ssss', $content, $name, $type, $size);
        $stmt->execute();
        echo mysqli_error($db);
        $stmt->close();
//        echo $result;
//        exit;
        $q_title_img_id = $db->insert_id;
        $stmt = $db->prepare("insert into quiz_questionnaire(q_title,option_1,option_2,option_3,option_4,category_id,weightage,q_title_img) values(?,?,?,?,?,?,?,?)");
        $ques = $this->escStr($db, $ques);
        $op1 = $this->escStr($db, $op1);
        $op2 = $this->escStr($db, $op2);
        $op3 = $this->escStr($db, $op3);
        $op4 = $this->escStr($db, $op4);
        $stmt->bind_param('sssssiii', $ques, $op1, $op2, $op3, $op4, $cat, $wt, $q_title_img_id);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    function addQuestion_new($data) {
        $db = $this->getMysqliConnection();
        $ques_type = 9999;
        if (empty($data)) {
            echo "data passed is empty [addNewQuestion::DAO]";
        } else {
            $ques = $data['question'];
            $ques_type = $data['q_type'];
            $cat = $data['category'];
            $wt = $data['weightage'];
            $correct_option = $data['correct_option'];
            $multiSelect = $data['multiselect'];
            $usr = 1; //fetch user from session
            switch ($ques_type) {
                case 1:// Question having everything as text
                    $op1 = $data['op1'];
                    $op2 = $data['op2'];
                    $op3 = $data['op3'];
                    $op4 = $data['op4'];
                    $stmt = $db->prepare("insert into quiz_questionnaire(q_title,option_1,option_2,option_3,option_4,category_id,weightage,question_type,correct_option,created_by,updated_by,is_multiple_select) values(?,?,?,?,?,?,?,?,?,?,?,?)");
                    $ques = $this->escStr($db, $ques);
                    $op1 = $this->escStr($db, $op1);
                    $op2 = $this->escStr($db, $op2);
                    $op3 = $this->escStr($db, $op3);
                    $op4 = $this->escStr($db, $op4);
                    $cat = $this->escStr($db, $cat);
                    $wt = $this->escStr($db, $wt);
                    $correct_option = $this->escStr($db, $correct_option);
                    $stmt->bind_param('sssssiiisiii', $ques, $op1, $op2, $op3, $op4, $cat, $wt, $ques_type, $correct_option, $usr, $usr, $multiSelect);
                    $stmt->execute();
                    $stmt->close();
                    break;
                case 2:// Question having q_title as image
                    $op1 = $data['op1'];
                    $op2 = $data['op2'];
                    $op3 = $data['op3'];
                    $op4 = $data['op4'];
                    $content = (($data['img_content']));
                    $name = $data['img_filename'];
                    $type = $data['img_filetype'];
                    $size = $data['img_filesize'];
                    $stmt = $db->prepare("insert into quiz_image(content,name,type,size,created_by,updated_by) values(?,?,?,?,?,?)");
                    $stmt->bind_param('ssssii', $content, $name, $type, $size, $usr, $usr);
                    $stmt->execute();
                    $q_title_img_id = $db->insert_id;
                    $stmt = $db->prepare("insert into quiz_questionnaire(q_title,q_title_img,option_1,option_2,option_3,option_4,category_id,weightage,question_type,correct_option,created_by,updated_by,is_multiple_select) values(?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $q_title_img_id = $this->escStr($db, $q_title_img_id);
                    $ques = $this->escStr($db, $ques);
                    $op1 = $this->escStr($db, $op1);
                    $op2 = $this->escStr($db, $op2);
                    $op3 = $this->escStr($db, $op3);
                    $op4 = $this->escStr($db, $op4);
                    $cat = $this->escStr($db, $cat);
                    $wt = $this->escStr($db, $wt);
                    $correct_option = $this->escStr($db, $correct_option);
                    $stmt->bind_param('sissssiiisiii', $ques, $q_title_img_id, $op1, $op2, $op3, $op4, $cat, $wt, $ques_type, $correct_option, $usr, $usr, $multiSelect);
                    $stmt->execute();
                    $stmt->close();
                    break;
                case 3:// Question having options as image
                    $contentop2 = ($data['op2_img_content']);
                    $nameop2 = $data['op2_img_filename'];
                    $typeop2 = $data['op2_img_filetype'];
                    $sizeop2 = $data['op2_img_filesize'];
                    $stmt = $db->prepare("insert into quiz_image(content,name,type,size,created_by,updated_by) values(?,?,?,?,?,?)");
                    $stmt->bind_param('ssssii', $contentop2, $nameop2, $typeop2, $sizeop2, $usr, $usr);
                    $stmt->execute();
                    $op2_img_id = $db->insert_id;
                    $contentop3 = ($data['op3_img_content']);
                    $nameop3 = $data['op3_img_filename'];
                    $typeop3 = $data['op3_img_filetype'];
                    $sizeop3 = $data['op3_img_filesize'];
                    $stmt = $db->prepare("insert into quiz_image(content,name,type,size,created_by,updated_by) values(?,?,?,?,?,?)");
                    $stmt->bind_param('ssssii', $contentop3, $nameop3, $typeop3, $sizeop3, $usr, $usr);
                    $stmt->execute();
                    $op3_img_id = $db->insert_id;
                    $contentop4 = ($data['op4_img_content']);
                    $nameop4 = $data['op4_img_filename'];
                    $typeop4 = $data['op4_img_filetype'];
                    $sizeop4 = $data['op4_img_filesize'];
                    $stmt = $db->prepare("insert into quiz_image(content,name,type,size,created_by,updated_by) values(?,?,?,?,?,?)");
                    $stmt->bind_param('ssssii', $contentop4, $nameop4, $typeop4, $sizeop4, $usr, $usr);
                    $stmt->execute();
                    $op4_img_id = $db->insert_id;
                    $contentop5 = ($data['op5_img_content']);
                    $nameop5 = $data['op5_img_filename'];
                    $typeop5 = $data['op5_img_filetype'];
                    $sizeop5 = $data['op5_img_filesize'];
                    $stmt = $db->prepare("insert into quiz_image(content,name,type,size,created_by,updated_by) values(?,?,?,?,?,?)");
                    $stmt->bind_param('ssssii', $contentop5, $nameop5, $typeop5, $sizeop5, $usr, $usr);
                    $stmt->execute();
                    $op5_img_id = $db->insert_id;
                    $stmt = $db->prepare("insert into quiz_questionnaire(q_title,category_id,weightage,question_type,correct_option,created_by,updated_by,is_multiple_select,option_1_img,option_2_img,option_3_img,option_4_img) values(?,?,?,?,?,?,?,?,?,?,?,?)");
                    $ques = $this->escStr($db, $ques);
                    $cat = $this->escStr($db, $cat);
                    $wt = $this->escStr($db, $wt);
                    $correct_option = $this->escStr($db, $correct_option);
                    $stmt->bind_param('siiisiiiiiii', $ques, $cat, $wt, $ques_type, $correct_option, $usr, $usr, $multiSelect, $op2_img_id, $op3_img_id, $op4_img_id, $op5_img_id);
                    $stmt->execute();
                    $stmt->close();
                    break;
                default :
                    return "errMessage";
            }
        }
        $db->close();
    }

    function editQuestion($data) {
        $db = $this->getMysqliConnection();
        $ques_type = 9999;
        if (empty($data)) {
            echo "data passed is empty [addNewQuestion::DAO]";
        } else {
            $ques = $data['question'];
            $ques_type = $data['q_type'];
            $cat = $data['category'];
            $wt = $data['weightage'];
            $correct_option = $data['correct_option'];
            $multiSelect = $data['multiselect'];
            $qno = $data['qno'];
            $usr = 1; //fetch user from session
            switch ($ques_type) {
                case 1:// Question having everything as text
                    $op1 = $data['op1'];
                    $op2 = $data['op2'];
                    $op3 = $data['op3'];
                    $op4 = $data['op4'];
                    $stmt = $db->prepare("update quiz_questionnaire set q_title=? ,option_1=? ,option_2=? ,option_3=? ,option_4=? ,category_id=? ,weightage=? ,question_type=? ,correct_option=? ,updated_by=? ,updated_date=current_timestamp ,is_multiple_select=? where id=?");
                    $ques = $this->escStr($db, $ques);
                    $op1 = $this->escStr($db, $op1);
                    $op2 = $this->escStr($db, $op2);
                    $op3 = $this->escStr($db, $op3);
                    $op4 = $this->escStr($db, $op4);
                    $cat = $this->escStr($db, $cat);
                    $wt = $this->escStr($db, $wt);
                    $correct_option = $this->escStr($db, $correct_option);
                    $stmt->bind_param('sssssiiisiii', $ques, $op1, $op2, $op3, $op4, $cat, $wt, $ques_type, $correct_option, $usr, $multiSelect, $qno);
                    $stmt->execute();
                    $stmt->close();
                    break;
                case 2:// Question having q_title as image
                    $op1 = $data['op1'];
                    $op2 = $data['op2'];
                    $op3 = $data['op3'];
                    $op4 = $data['op4'];
                    $content = (($data['img_content']));
                    $name = $data['img_filename'];
                    $type = $data['img_filetype'];
                    $size = $data['img_filesize'];
                    if ($content != NULL) {
                        $stmt = $db->prepare("select q_title_img from quiz_questionnaire where id=?");
                        $stmt->bind_param('i', $qno);
                        $stmt->execute();
                        $stmt->bind_result($q_title_img_id);
                        $stmt->fetch();
                        $stmt->close();
                        $stmt = $db->prepare("update quiz_image set content=? ,name=? ,type=? ,size=? ,updated_date=CURRENT_TIMESTAMP ,updated_by=? where id=?");
                        $stmt->bind_param('ssssii', $content, $name, $type, $size, $usr, $q_title_img_id);
                        $stmt->execute();
                        $stmt->close();
                        $stmt = $db->prepare("update quiz_questionnaire set q_title=? ,q_title_img=? ,option_1=? ,option_2=? ,option_3=? ,option_4=? ,category_id=? ,weightage=? ,question_type=? ,correct_option=? ,updated_by=? ,is_multiple_select=? ,updated_date=CURRENT_TIMESTAMP where id=?");
                        $q_title_img_id = $this->escStr($db, $q_title_img_id);
                        $ques = $this->escStr($db, $ques);
                        $op1 = $this->escStr($db, $op1);
                        $op2 = $this->escStr($db, $op2);
                        $op3 = $this->escStr($db, $op3);
                        $op4 = $this->escStr($db, $op4);
                        $cat = $this->escStr($db, $cat);
                        $wt = $this->escStr($db, $wt);
                        $correct_option = $this->escStr($db, $correct_option);
                        $stmt->bind_param('sissssiiisiii', $ques, $q_title_img_id, $op1, $op2, $op3, $op4, $cat, $wt, $ques_type, $correct_option, $usr, $multiSelect, $qno);
                        $stmt->execute();
                        $stmt->close();
                    } else {
                        $stmt = $db->prepare("update quiz_questionnaire set q_title=? ,option_1=? ,option_2=? ,option_3=? ,option_4=? ,category_id=? ,weightage=? ,question_type=? ,correct_option=? ,updated_by=? ,is_multiple_select=? ,updated_date=CURRENT_TIMESTAMP where id=?");
                        $ques = $this->escStr($db, $ques);
                        $op1 = $this->escStr($db, $op1);
                        $op2 = $this->escStr($db, $op2);
                        $op3 = $this->escStr($db, $op3);
                        $op4 = $this->escStr($db, $op4);
                        $cat = $this->escStr($db, $cat);
                        $wt = $this->escStr($db, $wt);
                        $correct_option = $this->escStr($db, $correct_option);
                        $stmt->bind_param('sssssiiisiii', $ques, $op1, $op2, $op3, $op4, $cat, $wt, $ques_type, $correct_option, $usr, $multiSelect, $qno);
                        $stmt->execute();
                        $stmt->close();
                    }

                    break;
                case 3:// Question having options as image
                    $contentop2 = ($data['op2_img_content']);
                    $contentop3 = ($data['op3_img_content']);
                    $contentop4 = ($data['op4_img_content']);
                    $contentop5 = ($data['op5_img_content']);
                    if ($contentop2 != NULL) {
                        $nameop2 = $data['op2_img_filename'];
                        $typeop2 = $data['op2_img_filetype'];
                        $sizeop2 = $data['op2_img_filesize'];
                        $stmt = $db->prepare("select option_1_img from  quiz_questionnaire where id=?");
                        $stmt->bind_param('i', $qno);
                        $stmt->execute();
                        $stmt->bind_result($op2_img_id);
                        $stmt->fetch();
                        $stmt->close();
                        $stmt = $db->prepare("update quiz_image set content=?,name=? ,type=? ,size=? ,updated_date=CURRENT_TIMESTAMP  ,updated_by=?  where id=?");
                        $stmt->bind_param('ssssii', $contentop2, $nameop2, $typeop2, $sizeop2, $usr, $op2_img_id);
                        $stmt->execute();
                        $stmt->close();
                    }if ($contentop3 != NULL) {
                        $nameop3 = $data['op3_img_filename'];
                        $typeop3 = $data['op3_img_filetype'];
                        $sizeop3 = $data['op3_img_filesize'];
                        $stmt = $db->prepare("select option_2_img from  quiz_questionnaire where id=?");
                        $stmt->bind_param('i', $qno);
                        $stmt->execute();
                        $stmt->bind_result($op3_img_id);
                        $stmt->fetch();
                        $stmt->close();
                        $stmt = $db->prepare("update quiz_image set content=?,name=? ,type=? ,size=? ,updated_date=CURRENT_TIMESTAMP  ,updated_by=?  where id=?");
                        $stmt->bind_param('ssssii', $contentop3, $nameop3, $typeop3, $sizeop3, $usr, $op3_img_id);
                        $stmt->execute();
                        $stmt->close();
                    }if ($contentop4 != NULL) {
                        $nameop4 = $data['op4_img_filename'];
                        $typeop4 = $data['op4_img_filetype'];
                        $sizeop4 = $data['op4_img_filesize'];
                        $stmt = $db->prepare("select option_3_img from  quiz_questionnaire where id=?");
                        $stmt->bind_param('i', $qno);
                        $stmt->execute();
                        $stmt->bind_result($op4_img_id);
                        $stmt->fetch();
                        $stmt->close();
                        $stmt = $db->prepare("update quiz_image set content=?,name=? ,type=? ,size=? ,updated_date=CURRENT_TIMESTAMP  ,updated_by=?  where id=?");
                        $stmt->bind_param('ssssii', $contentop4, $nameop4, $typeop4, $sizeop4, $usr, $op4_img_id);
                        $stmt->execute();
                        $stmt->close();
                    }if ($contentop5 != NULL) {
                        $nameop5 = $data['op5_img_filename'];
                        $typeop5 = $data['op5_img_filetype'];
                        $sizeop5 = $data['op5_img_filesize'];
                        $stmt = $db->prepare("select option_4_img from  quiz_questionnaire where id=?");
                        $stmt->bind_param('i', $qno);
                        $stmt->execute();
                        $stmt->bind_result($op4_img_id);
                        $stmt->fetch();
                        $stmt->close();
                        $stmt = $db->prepare("update quiz_image set content=?,name=? ,type=? ,size=? ,updated_date=CURRENT_TIMESTAMP  ,updated_by=?  where id=?");
                        $stmt->bind_param('ssssii', $contentop5, $nameop5, $typeop5, $sizeop5, $usr, $op5_img_id);
                        $stmt->execute();
                        $stmt->close();
                    }
                    $stmt = $db->prepare("update quiz_questionnaire set q_title=? ,category_id=? ,weightage=? ,question_type=? ,correct_option=? ,updated_by=? ,is_multiple_select=? ,updated_date=CURRENT_TIMESTAMP where id=?");
                    $ques = $this->escStr($db, $ques);
                    $cat = $this->escStr($db, $cat);
                    $wt = $this->escStr($db, $wt);
                    $correct_option = $this->escStr($db, $correct_option);
                    $stmt->bind_param('siiisiii', $ques, $cat, $wt, $ques_type, $correct_option, $usr, $multiSelect, $qno);
                    $stmt->execute();
                    $stmt->close();
                    break;
                default :
                    echo "errMessage";
            }
        }
        $db->close();
    }

    function getAllCategories() {
        $db = $this->getMysqliConnection();
        $stmt = $db->prepare("SELECT id,category_name from quiz_category");
        $stmt->execute();
        $stmt->bind_result($id, $categ_name);
        $responce = "";
//        $s="";
        while ($stmt->fetch()) {
            //$questions = array('Question' => $q_title, 'Option-1' => $op1, 'Opiton-2' => $op2, 'Opiton-3' => $op3, 'Opiton-4' => $op4);
            //$responce[$id] = $categ_name;
            $responce = $responce . "$id:$categ_name" . ";";
//            $responce->rows[$i]['cell'] = array($id, $q_title, $op1, $op2, $op3, $op4);
//            $i++;
//            echo "<option value='" . $id . "'>" . $categ_name . "</option>";
        }
        $responce = substr($responce, 0, strlen($responce) - 1);
        $stmt->close();
        $db->close();
        echo ($responce);
    }

    function getAllCategories_new() {
        $db = $this->getMysqliConnection();
        $stmt = $db->prepare("SELECT id,category_name from quiz_category");
        $stmt->execute();
        $stmt->bind_result($id, $categ_name);
//        $responce = "";
//        $s="";
        $json = array();
        while ($stmt->fetch()) {
            //$questions = array('Question' => $q_title, 'Option-1' => $op1, 'Opiton-2' => $op2, 'Opiton-3' => $op3, 'Opiton-4' => $op4);
            //$responce[$id] = $categ_name;
//            $responce = $responce . "$id:$categ_name" . ";";
            $json[] = array(
                'id' => $id,
                'categ' => $categ_name // Don't you want the name?
            );
//            $responce->rows[$i]['cell'] = array($id, $q_title, $op1, $op2, $op3, $op4);
//            $i++;
//            echo "<option value='" . $id . "'>" . $categ_name . "</option>";
        }
//        $responce = substr($responce, 0, strlen($responce) - 1);
        $stmt->close();
        $db->close();
        echo json_encode($json);
    }

    function getAllQuestions($pageNumber, $rowsToBeFetched, $sortCol, $sortOrd, $searchPhrase) {
        $db = $this->getMysqliConnection();
        $pageNumber = intval($pageNumber);
        $start = intval($pageNumber);
        $end = 0;
        $limit = "";
        if ($rowsToBeFetched != -1) {
            $rowsToBeFetched = intval($rowsToBeFetched);
            if ($start != 1) {
                $start = (($pageNumber - 1) * intval($rowsToBeFetched)) + 1;
            } else {
                $start = $start - 1;
            }
            $end = $start + intval($rowsToBeFetched) - 1;
            $limit = " LIMIT $start,$rowsToBeFetched";
        }
        $where = "q.q_title LIKE '%" . $searchPhrase . "%'";
        $stmt = $db->prepare("SELECT q.id qnumber,q.q_title question,q.option_1 option1,q.option_2 option2,q.option_3 option3,"
                . "q.option_4 option4,categ.id,q.weightage categ ,q.question_type,"
                . "q.option_1_img,q.option_2_img,q.option_3_img,q.option_4_img,q.q_title_img,q.is_multiple_select,q.correct_option "
                . "from "
                . "quiz_questionnaire q LEFT OUTER JOIN quiz_category categ ON q.category_id=categ.id "
                . " WHERE $where "
                . "order by " . $sortCol . " " . $sortOrd . $limit);
        $stmt->execute();
        $stmt->bind_result($id, $q_title, $op1, $op2, $op3, $op4, $categ_name, $weightage, $q_type, $op1Img, $op2Img, $op3Img, $op4Img, $q_img, $isMultiSel, $crr_opt);
//        $responce = "";
        $json = [];
        while ($stmt->fetch()) {
            if ($q_type == 2 || $q_type == 3) {
                $s = "";
                $q_image = "";
                $type = "";
                $op1Image = "";
                $images = array();
                $imagesTyp = array();
                $dbx = $this->getMysqliConnection();
                if ($q_type == 2) {
                    $s = "SELECT content,type from quiz_image where id=?";
                    try {
                        $st = $dbx->prepare($s);
                        $st->bind_param('i', $q_img);
                        $st->execute();
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        exit();
                    }
                    $st->bind_result($q_image, $type);
                    $st->fetch();
                    $st->close();
                } else if ($q_type == 3) {
                    $s = "id in($op1Img,$op2Img,$op3Img,$op4Img)";
                    $st = $dbx->prepare("SELECT content,type from quiz_image where $s");
                    echo "SELECT content,type from quiz_image where $s";
                    $st->execute();
                    $st->bind_result($op1Image, $type);
                    $i = 0;
                    while ($st->fetch()) {
                        $images[$i] = (($op1Image));
                        $imagesTyp[$i] = $type;
                        $i++;
                    }
                    $st->close();
                }
                $dbx->close();
            }
            if ($q_type == 1) {
                $json[] = array(
                    'qnumber' => $id,
                    'question' => $q_title,
                    'option1' => $op1,
                    'option2' => $op2,
                    'option3' => $op3,
                    'option4' => $op4,
                    'categ' => $categ_name,
                    'weight' => $weightage,
                    'q_image' => '',
                    'op1Image' => '',
                    'op2Image' => '',
                    'op3Image' => '',
                    'op4Image' => '',
                    'op1Image_tp' => '',
                    'op2Image_tp' => '',
                    'op3Image_tp' => '',
                    'op4Image_tp' => '',
                    'q_type' => $q_type,
                    'isMulti' => $isMultiSel,
                    'copt' => $crr_opt
                );
            } else if ($q_type == 2) {
                //$json['q_image'] = base64_encode($q_image);
                $json[] = array(
                    'qnumber' => $id,
                    'question' => $q_title,
                    'option1' => $op1,
                    'option2' => $op2,
                    'option3' => $op3,
                    'option4' => $op4,
                    'categ' => $categ_name,
                    'weight' => $weightage,
                    'q_image' => base64_encode((stripslashes($q_image))),
                    'q_image_tp' => $type,
                    'op1Image' => '',
                    'op2Image' => '',
                    'op3Image' => '',
                    'op4Image' => '',
                    'op1Image_tp' => '',
                    'op2Image_tp' => '',
                    'op3Image_tp' => '',
                    'op4Image_tp' => '',
                    'q_type' => $q_type,
                    'isMulti' => $isMultiSel,
                    'copt' => $crr_opt
                );
            } elseif ($q_type == 3) {
                $json[] = array(
                    'qnumber' => $id,
                    'question' => $q_title,
                    'option1' => $op1,
                    'option2' => $op2,
                    'option3' => $op3,
                    'option4' => $op4,
                    'categ' => $categ_name,
                    'weight' => $weightage,
                    'q_image' => '',
                    'op1Image' => base64_encode(stripslashes($images[0])),
                    'op2Image' => base64_encode(stripslashes($images[1])),
                    'op3Image' => base64_encode(stripslashes($images[2])),
                    'op4Image' => base64_encode(stripslashes($images[3])),
                    'op1Image_tp' => $imagesTyp[0],
                    'op2Image_tp' => $imagesTyp[1],
                    'op3Image_tp' => $imagesTyp[2],
                    'op4Image_tp' => $imagesTyp[3],
                    'q_type' => $q_type,
                    'isMulti' => $isMultiSel,
                    'copt' => $crr_opt
                );
            }
//            $responce->rows[$i]['cell'] = array($id, $q_title, $op1, $op2, $op3, $op4);
//            $i++;
//            echo "<option value='" . $id . "'>" . $categ_name . "</option>";
        }
        $stmt = $db->prepare("SELECT count(q.id) from quiz_questionnaire q LEFT OUTER JOIN quiz_category categ ON q.category_id=categ.id ");
        $stmt->execute();
        $stmt->bind_result($total);
        $stmt->fetch();
        $json = "{ \"current\": $pageNumber, \"rowCount\":$rowsToBeFetched, \"rows\": " . json_encode($json) . ", \"total\": $total }";
        $stmt->close();
        $db->close();
        echo ($json);
    }

    function deleteQuestion($data) {
        $db = $this->getMysqliConnection();
        echo $data;
        $id = $data["id"];
        $qtyp = $data["qtyp"];
        $db->begin_transaction(MYSQLI_TRANS_START_READ_WRITE, "deleteQuestion");
        if ($qtyp == 3) {
            $query = "select option_1_img,option_2_img,option_3_img,option_4_img from quiz_questionnaire where id=?";
            $query2 = "delete from quiz_image where id in(?,?,?,?)";
            $stmt = $db->prepare($query);
            $id = $this->escStr($db, $id);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($op1, $op2, $op3, $op4);
            $stmt->close();
            $stmt = $db->prepare($query2);
            $stmt->bind_param('iiii', $op1, $op2, $op3, $op4);
            $stmt->execute();
            $stmt->close();
        } else if ($qtyp == 2) {
            $query = "select q_title_img from quiz_questionnaire where id=?";
            $query2 = "delete from quiz_image where id in(?)";
            $stmt = $db->prepare($query);
            $id = $this->escStr($db, $id);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($q_title_img);
            $stmt->close();
            $stmt = $db->prepare($query2);
            $stmt->bind_param('i', $q_title_img);
            $stmt->execute();
            $stmt->close();
        }
        $query = "delete from quiz_questionnaire where id=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        $db->commit(MYSQLI_TRANS_START_READ_WRITE, "deleteQuestion");
        $db->close();
    }

}

?>