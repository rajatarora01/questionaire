<?php
require_once '../classes/QuestionController.php';
//require('../VYS_assets/session.class.php');
//require 'VYS_assets/DAO.php';
//$session=new session();
//$session->start_session('s_', false);
////echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
//$uid=$_SESSION['s_k'];
//$fn=$_SESSION['fn'];
//$ln=$_SESSION['ln'];
//if(empty($uid)){
//header("Location: http://chalkuchkartehai.in/?v=0&err=1");
//exit();
//}
$message = "";
if (isset($_POST['Next'])) {
//validate question    
//save question 
    $ques_type = test_input($_POST['sc-1-1']);
    $err_msg = NULL;
    $q_title = "";
    $op1 = "";
    $op2 = "";
    $op3 = "";
    $op4 = "";
    $txt_lmt_q_title = 1000;
    $txt_lmt_options = 1000;
    $img_typ_alwd_fr_qstn = ["png", "jpg", "jpeg", "gif"];
    $img_size_alwd_fr_qstn_kb = 1024;
    $mc = $_POST['ms_v'];
    $c_op = $_POST['correct_option'];
    $correct_opt = "";
    if ($mc == 1) {
        if (is_array($_POST['correct_option'])) {
            foreach ($_POST['correct_option'] as $value) {
                $correct_opt = $correct_opt . $value . ",";
            }
            $correct_opt = substr($correct_opt, 0, strlen($correct_opt) - 1);
        }
    } else {
        $correct_opt = $_POST['correct_option_r'];
    }
    if ($ques_type == 1) {
        //text question
        //validate inputs
        $q_title = test_input($_POST["q_title"]);
        $op1 = test_input($_POST["op1"]);
        $op2 = test_input($_POST["op2"]);
        $op3 = test_input($_POST["op3"]);
        $op4 = test_input($_POST["op4"]);
        $categ = test_input($_POST["category"]);
        $wt = test_input($_POST["weightage"]);
        //$correct_opt = test_input($_POST['correct_option']);
        $data = array();
        if (empty($correct_opt) || empty($q_title) || empty($op1) || empty($op2) || empty($op3) || empty($op4) || empty($categ) || empty($wt) || $categ == "0" || $wt == "0") {
            //send error message
            $message = "Please fill the required information correctly";
        } else {
            //all mandatory inputs captured
            $data = array(
                'question' => $q_title,
                'op1' => $op1,
                'op2' => $op2,
                'op3' => $op3,
                'op4' => $op4,
                'category' => $categ,
                'q_type' => $ques_type,
                'weightage' => $wt,
                'correct_option' => $correct_opt,
                'multiselect' => $mc
            );
            $qc = new QuestionController();
            $qc->processDataAdd($data);
            //$message = "Question created";
        }
    } else if ($ques_type == 2) {
        //Question title as image 
        //validate inputs
        $q_title = test_input($_POST["q_title"]);
        $op1_img = $_FILES['files1'];
        $op1_img_metaData = NULL;
        if ($op1_img['name'] != NULL) {
            $op1_img_metaData = Utility::isFileOkToUpload($op1_img);
        }
        if ($op1_img_metaData != NULL) {
            $content = $op1_img_metaData["content"];
            $name = $op1_img_metaData["filename"];
            $type = $op1_img_metaData["filetype"];
            $size = $op1_img_metaData["filesize"];
            $op1 = test_input($_POST["op1"]);
            $op2 = test_input($_POST["op2"]);
            $op3 = test_input($_POST["op3"]);
            $op4 = test_input($_POST["op4"]);
            $categ = test_input($_POST["category"]);
            $wt = test_input($_POST["weightage"]);
            $data = array();
            if (empty($correct_opt) || empty($op1) || empty($op2) || empty($op3) || empty($op4) || empty($categ) || empty($wt) || $categ == "0" || $wt == "0") {
                //send error message
                $message = "Please fill the required information correctly";
            } else {
                $data = array(
                    'question' => $q_title,
                    'img_content' => $content,
                    'op1' => $op1,
                    'op2' => $op2,
                    'op3' => $op3,
                    'op4' => $op4,
                    'category' => $categ,
                    'q_type' => $ques_type,
                    'weightage' => $wt,
                    'img_filename' => $name,
                    'img_filetype' => $type,
                    'img_filesize' => $size,
                    'correct_option' => $correct_opt,
                    'multiselect' => $mc
                );
                $qc = new QuestionController();
                $qc->processDataAdd($data);
                //$message = "Question created";
            }
        } else {
            //send error message
            $message = "Title image for the choice opted can't be blank";
        }
    } else if ($ques_type == 3) {
        //Question options as image
        //validate inputs

        $q_title = test_input($_POST["q_title"]);
        $op2_img = $_FILES['files2'];
        $op2_img_metaData = NULL;
        $op3_img = $_FILES['files3'];
        $op3_img_metaData = NULL;
        $op4_img = $_FILES['files4'];
        $op4_img_metaData = NULL;
        $op5_img = $_FILES['files5'];
        $op5_img_metaData = NULL;
        if ($op2_img['name'] != NULL && $op3_img['name'] != NULL && $op4_img['name'] != NULL && $op5_img['name'] != NULL) {
            $op5_img_metaData = Utility::isFileOkToUpload($op5_img);
            $op4_img_metaData = Utility::isFileOkToUpload($op4_img);
            $op3_img_metaData = Utility::isFileOkToUpload($op3_img);
            $op2_img_metaData = Utility::isFileOkToUpload($op2_img);
        }
        if ($op2_img_metaData != NULL && $op3_img_metaData != NULL && $op4_img_metaData != NULL && $op5_img_metaData != NULL) {
            $op2_content = $op2_img_metaData["content"];
            $op2_name = $op2_img_metaData["filename"];
            $op2_type = $op2_img_metaData["filetype"];
            $op2_size = $op2_img_metaData["filesize"];
            $op3_content = $op3_img_metaData["content"];
            $op3_name = $op3_img_metaData["filename"];
            $op3_type = $op3_img_metaData["filetype"];
            $op3_size = $op3_img_metaData["filesize"];
            $op4_content = $op4_img_metaData["content"];
            $op4_name = $op4_img_metaData["filename"];
            $op4_type = $op4_img_metaData["filetype"];
            $op4_size = $op4_img_metaData["filesize"];
            $op5_content = $op5_img_metaData["content"];
            $op5_name = $op5_img_metaData["filename"];
            $op5_type = $op5_img_metaData["filetype"];
            $op5_size = $op5_img_metaData["filesize"];
            $categ = test_input($_POST["category"]);
            $wt = test_input($_POST["weightage"]);
            $data = array();
            if (empty($correct_opt) || empty($categ) || empty($wt) || $categ == "0" || $wt == "0") {
                //send error message
                $message = "Please fill the required information correctly";
            } else {
                $data = array(
                    'question' => $q_title,
                    'category' => $categ,
                    'q_type' => $ques_type,
                    'weightage' => $wt,
                    'op2_img_content' => $op2_content,
                    'op2_img_filename' => $op2_name,
                    'op2_img_filetype' => $op2_type,
                    'op2_img_filesize' => $op2_size,
                    'op3_img_content' => $op3_content,
                    'op3_img_filename' => $op3_name,
                    'op3_img_filetype' => $op3_type,
                    'op3_img_filesize' => $op3_size,
                    'op4_img_content' => $op4_content,
                    'op4_img_filename' => $op4_name,
                    'op4_img_filetype' => $op4_type,
                    'op4_img_filesize' => $op4_size,
                    'op5_img_content' => $op5_content,
                    'op5_img_filename' => $op5_name,
                    'op5_img_filetype' => $op5_type,
                    'op5_img_filesize' => $op5_size,
                    'correct_option' => $correct_opt,
                    'multiselect' => $mc
                );
                $qc = new QuestionController();
                $qc->processDataAdd($data);
                $message = "Question created";
            }
        } else {
            $message = "Option image for the choice opted can't be null";
        }
    }
    $_POST['Next'] = NULL;
} else if (isset($_POST['Previous'])) {
    //fetch previous question
    $message = "";
} else if (isset($_POST['saveEdit'])) {
    $ques_type = test_input($_POST['sc-1-1']);
    $q_number = test_input($_POST['qnoID']);
    $err_msg = NULL;
    $q_title = "";
    $op1 = "";
    $op2 = "";
    $op3 = "";
    $op4 = "";
    $txt_lmt_q_title = 1000;
    $txt_lmt_options = 1000;
    $img_typ_alwd_fr_qstn = ["png", "jpg", "jpeg", "gif"];
    $img_size_alwd_fr_qstn_kb = 1024;
    $mc = $_POST['ms_v'];
    $c_op = $_POST['correct_option'];
    $correct_opt = "";
    if ($mc == 1) {
        if (is_array($_POST['correct_option'])) {
            foreach ($_POST['correct_option'] as $value) {
                $correct_opt = $correct_opt . $value . ",";
            }
            $correct_opt = substr($correct_opt, 0, strlen($correct_opt) - 1);
        }
    } else {
        $correct_opt = $_POST['correct_option_r'];
    }
    if ($ques_type == 1) {
        //text question
        //validate inputs
        $q_title = test_input($_POST["q_title"]);
        $op1 = test_input($_POST["op1"]);
        $op2 = test_input($_POST["op2"]);
        $op3 = test_input($_POST["op3"]);
        $op4 = test_input($_POST["op4"]);
        $categ = test_input($_POST["category"]);
        $wt = test_input($_POST["weightage"]);
        //$correct_opt = test_input($_POST['correct_option']);
        $data = array();
        if (empty($correct_opt) || empty($q_title) || empty($op1) || empty($op2) || empty($op3) || empty($op4) || empty($categ) || empty($wt) || $categ == "0" || $wt == "0") {
            //send error message
            $message = "Please fill the required information correctly";
        } else {
            //all mandatory inputs captured
            $data = array(
                'question' => $q_title,
                'op1' => $op1,
                'op2' => $op2,
                'op3' => $op3,
                'op4' => $op4,
                'category' => $categ,
                'q_type' => $ques_type,
                'weightage' => $wt,
                'correct_option' => $correct_opt,
                'multiselect' => $mc,
                'qno' => $q_number
            );
            $qc = new QuestionController();
            $qc->processDataEdit($data);
            //$message = "Question created";
        }
    } else if ($ques_type == 2) {
        //Question title as image 
        //validate inputs
        $q_title = test_input($_POST["q_title"]);
        $files1_ok = $_POST['files1_ok'];
        $op1_img = $_FILES['files1'];
        $op1_img_metaData = "a";
        $op1 = test_input($_POST["op1"]);
        $op2 = test_input($_POST["op2"]);
        $op3 = test_input($_POST["op3"]);
        $op4 = test_input($_POST["op4"]);
        $categ = test_input($_POST["category"]);
        $wt = test_input($_POST["weightage"]);
        $content = NULL;
        $name = NULL;
        $type = NULL;
        $size = NULL;
        $data = array();
        if ($files1_ok == 1 && $op1_img['name'] != NULL) {
            $op1_img_metaData = Utility::isFileOkToUpload($op1_img);
            $content = $op1_img_metaData["content"];
            $name = $op1_img_metaData["filename"];
            $type = $op1_img_metaData["filetype"];
            $size = $op1_img_metaData["filesize"];
        }
        if ($op1_img_metaData != NULL) {
            if (empty($correct_opt) || empty($op1) || empty($op2) || empty($op3) || empty($op4) || empty($categ) || empty($wt) || $categ == "0" || $wt == "0") {
                //send error message
                $message = "Please fill the required information correctly";
            } else {
                $data = array(
                    'question' => $q_title,
                    'img_content' => $content,
                    'op1' => $op1,
                    'op2' => $op2,
                    'op3' => $op3,
                    'op4' => $op4,
                    'category' => $categ,
                    'q_type' => $ques_type,
                    'weightage' => $wt,
                    'img_filename' => $name,
                    'img_filetype' => $type,
                    'img_filesize' => $size,
                    'correct_option' => $correct_opt,
                    'multiselect' => $mc,
                    'qno' => $q_number
                );
                $qc = new QuestionController();
                $qc->processDataEdit($data);
                //$message = "Question created";
            }
        } else {
            //send error message
            $message = "Title image for the choice opted can't be blank";
        }
    } else if ($ques_type == 3) {
        //Question options as image
        //validate inputs

        $q_title = test_input($_POST["q_title"]);
        $op2_img = $_FILES['files2'];
        $op2_img_metaData = "NULL";
        $op3_img = $_FILES['files3'];
        $op3_img_metaData = "NULL";
        $op4_img = $_FILES['files4'];
        $op4_img_metaData = "NULL";
        $op5_img = $_FILES['files5'];
        $op5_img_metaData = "NULL";
        $files2_ok = $_POST['files2_ok'];
        $files3_ok = $_POST['files3_ok'];
        $files4_ok = $_POST['files4_ok'];
        $files5_ok = $_POST['files5_ok'];
        $op2_content = NULL;
        $op2_name = NULL;
        $op2_type = NULL;
        $op2_size = NULL;
        $op3_content = NULL;
        $op3_name = NULL;
        $op3_type = NULL;
        $op3_size = NULL;
        $op4_content = NULL;
        $op4_name = NULL;
        $op4_type = NULL;
        $op4_size = NULL;
        $op5_content = NULL;
        $op5_name = NULL;
        $op5_type = NULL;
        $op5_size = NULL;
        $data = array();
        if (($files2_ok == 1 && $op2_img['name'] != NULL)) {
            $op2_img_metaData = Utility::isFileOkToUpload($op2_img);
            $op2_content = $op2_img_metaData["content"];
            $op2_name = $op2_img_metaData["filename"];
            $op2_type = $op2_img_metaData["filetype"];
            $op2_size = $op2_img_metaData["filesize"];
        } if ($files3_ok == 1 && $op3_img['name'] != NULL) {
            $op3_img_metaData = Utility::isFileOkToUpload($op3_img);
            $op3_content = $op3_img_metaData["content"];
            $op3_name = $op3_img_metaData["filename"];
            $op3_type = $op3_img_metaData["filetype"];
            $op3_size = $op3_img_metaData["filesize"];
        }
        if ($files4_ok == 1 && $op4_img['name'] != NULL) {
            $op4_img_metaData = Utility::isFileOkToUpload($op4_img);
            $op4_content = $op4_img_metaData["content"];
            $op4_name = $op4_img_metaData["filename"];
            $op4_type = $op4_img_metaData["filetype"];
            $op4_size = $op4_img_metaData["filesize"];
        } if (($files5_ok == 1 && $op5_img['name'] != NULL)) {
            $op5_img_metaData = Utility::isFileOkToUpload($op5_img);
            $op5_content = $op5_img_metaData["content"];
            $op5_name = $op5_img_metaData["filename"];
            $op5_type = $op5_img_metaData["filetype"];
            $op5_size = $op5_img_metaData["filesize"];
        }
        if ($op2_img_metaData != NULL && $op3_img_metaData != NULL && $op4_img_metaData != NULL && $op5_img_metaData != NULL) {
            $categ = test_input($_POST["category"]);
            $wt = test_input($_POST["weightage"]);
            if (empty($correct_opt) || empty($categ) || empty($wt) || $categ == "0" || $wt == "0") {
                //send error message
                $message = "Please fill the required information correctly";
            } else {
                $data = array(
                    'question' => $q_title,
                    'category' => $categ,
                    'q_type' => $ques_type,
                    'weightage' => $wt,
                    'op2_img_content' => $op2_content,
                    'op2_img_filename' => $op2_name,
                    'op2_img_filetype' => $op2_type,
                    'op2_img_filesize' => $op2_size,
                    'op3_img_content' => $op3_content,
                    'op3_img_filename' => $op3_name,
                    'op3_img_filetype' => $op3_type,
                    'op3_img_filesize' => $op3_size,
                    'op4_img_content' => $op4_content,
                    'op4_img_filename' => $op4_name,
                    'op4_img_filetype' => $op4_type,
                    'op4_img_filesize' => $op4_size,
                    'op5_img_content' => $op5_content,
                    'op5_img_filename' => $op5_name,
                    'op5_img_filetype' => $op5_type,
                    'op5_img_filesize' => $op5_size,
                    'correct_option' => $correct_opt,
                    'multiselect' => $mc,
                    'qno' => $q_number
                );
                $qc = new QuestionController();
                $qc->processDataEdit($data);
                $message = "Question created";
            }
        } else {
            $message = "Option image for the choice opted can't be null";
        }
    }
    $_POST['Next'] = NULL;
    $_POST['saveEdit'] = NULL;
} else {
    
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Portfolio Item - Start Bootstrap Template</title>

        <!-- Bootstrap Core CSS -->
        <link href="../vinyasa/css/bootstrap.min.css" rel="stylesheet">
        <link href="../vinyasa/css/ios/switcheryios.css" rel="stylesheet">
        <link href="../assets/bootgrid/css/jquery.bootgrid.css" rel="stylesheet">
        <!-- Custom CSS -->
        <!--link href="vinyasa/css/portfolio-item.css" rel="stylesheet"-->
        <!-- Plugin CSS -->
        <link rel="stylesheet" href="../vinyasa/css/animate.min.css" type="text/css">
        <link rel="stylesheet" href="../vinyasa/css/segmented-controls.css" type="text/css">
        <link rel="stylesheet" href="../vinyasa/font-awesome/css/font-awesome.min.css" type="text/css">
        <!--<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>-->

        <!-- Custom CSS -->
        <link rel="stylesheet" href="../vinyasa/css/creative.css" type="text/css">

        <!-- jQuery -->
        <!-- Bootstrap Core JavaScript -->
        <script src="../vinyasa/js/jqgrid/jquery-1.11.0.min.js"></script>
        <script src="../vinyasa/js/bootstrap.min.js"></script>
        <script src="../vinyasa/js/creative.js"></script>
        <!-- Plugin JavaScript -->
        <script src="../vinyasa/js/jquery.easing.min.js"></script>
        <script src="../vinyasa/js/jquery.fittext.js"></script>
        <script src="../vinyasa/js/wow.min.js"></script>
        <!--BootGrid JS-->
        <script src="../assets/bootgrid/js/jquery.bootgrid.js"></script>
        <script src="../assets/bootgrid/js/jquery.bootgrid.fa.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#multi_choice").attr("value", "0");
                $('.weight_container option[value=\"0\"]').attr('selected', 'selected');
                if ($("#multi_select").is(":checked")) {
                    $('#multi_select').trigger('click');
                }
                $("#correct_option1").trigger('click');
                $("#1").trigger('click');
                displayMessage();
                loadCategories();
                $('label.options').click(function (e) {
                    var id = $(this).attr('id');
                    if (id == "r1o1" || id == "r1o2" || id == "r2o1" || id == "r2o2")
                        release();
                    var elem = document.getElementById(id);
                    $(this).removeClass("btn-danger");
                    $(this).addClass("btn-success");
                    return id;
                });
                $("input[name='sc-1-1']").click(function () {
                    var id = $(this).attr('id');
                    if (id == 2) {
                        $(".imgOpt").hide(1000);
                        $("#q_title").css("line-height", "150%");
                        //$("#questiontxt").addClass("col-lg-8");
                        $(".imgQues").show(1000);
                        $(".optxtara").show(1000);
                    } else if (id == 1) {
                        $(".imgOpt").hide(1000);
                        $(".imgQues").hide(1000, function () {
                            $("#questiontxt").removeClass("col-lg-8");
                            $("#questiontxt").addClass("col-lg-12");
                        });
                        $(".optxtara").show(1000);

                    } else if (id == 3) {
                        $(".imgQues").hide(1000, function () {
                            $("#questiontxt").removeClass("col-lg-8");
                            $("#questiontxt").addClass("col-lg-12");
                        });
                        $(".optxtara").hide(1000);
                        $(".imgOpt").show(1000);
                    }

                });
                $(".next").click(function () {
                    $(".question").hide({direction: "left"}, 1000);
                    $(".loading").show({direction: "up"}, 5000);
                    $(".loading").hide({direction: "down"}, 5000);
                    $(".question").show({direction: "right"}, 1000);
                });
                $("#multi_select").click(function () {
                    if ($("#multi_select").is(":checked")) {
                        $("#ms_v").attr("value", "1");
                        $(".correct_option_single").hide(1000);
                        $(".correct_option_multiple").show(1000);
                    } else {
                        $(".correct_option_multiple").hide(1000);
                        $(".correct_option_single").show(1000);
                        $("#ms_v").attr("value", "0");
                    }
                });
                $('#editGrid').click(function () {
                    $(".command-delete").hide();
                    $('#questionsGrid').show(1000);
                    $('#editGrid').hide();
                    $('#createGrid').show();
                    $(".select-box").hide();
                    $("#next").hide();
                    $("#previous").hide();
                    $("#saveEdit").show();

                });
                $('#cancelEdit').click(function () {
                    $('.weight_container option[value=\"0\"]').attr('selected', 'selected');
                    $("#questionForm").reset();
                    location.reload();
                });
                $("#delGrid").click(function () {
                    if ($("#delGrid").html() == 'Delete Questions') {
                        $('#editGrid').trigger('click');
                        $(".select-box").show();
                        $(".command-delete").show();
                        $(".command-edit").hide();
                        $("#delGrid").html("Edit Questions");
                    } else {
                        $("#delGrid").html("Delete Questions");
                        $(".select-box").hide();
                        $(".command-delete").hide();
                        $(".command-edit").show();
                        $("#multiDel").hide();
                    }
                });
                $('#createGrid').click(function () {
                    $('.weight_container option[value=\"0\"]').attr('selected', 'selected');
                    //$("#questionForm").reset();
                    location.reload();
                });
                var grid = $("#category_grid").bootgrid({
                    ajax: true,
                    selection: true,
                    multiSelect: true,
                    multiplesearch: true,
                    post: function ()
                    {
                        return {
                            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
                        };
                    },
                    //url: "/api/data/basic",
                    formatters: {
                        "commands": function (column, row)
                        {
                            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-id=\"" + row.qnumber + "\"   data-weight=\"" + row.weight + "\" data-categ=\"" + row.categ + "\"data-ques=\"" + row.question + "\" data-op1=\"" + row.option1 + "\" data-op2=\"" + row.option2 + "\" data-op3=\"" + row.option3 + "\" data-op4=\"" + row.option4 + "\" data-ismulti=\"" + row.isMulti + "\"  data-qtyp=\"" + row.q_type + "\"  data-img1=\"" + row.q_image + "\"  data-typ=\"" + row.q_image_tp + "\"  data-op1img=\"" + row.op1Image + "\"  data-op2img=\"" + row.op2Image + "\"  data-op3img=\"" + row.op3Image + "\"  data-op4img=\"" + row.op4Image + "\"  data-op1imgtp=\"" + row.op1Image_tp + "\"  data-op2imgtp=\"" + row.op2Image_tp + "\"  data-op3imgtp=\"" + row.op3Image_tp + "\"  data-op4imgtp=\"" + row.op4Image_tp + "\"  data-copt=\"" + row.copt + "\"  ><span class=\"fa fa-pencil\"></span></button> " +
                                    "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-id=\"" + row.qnumber + "\" data-op1=\"" + row.option1 + "\" data-op2=\"" + row.option2 + "\" data-op3=\"" + row.option3 + "\" data-op4=\"" + row.option4 + "\"   data-qtyp=\"" + row.q_type + "\"  data-img1=\"" + row.q_image + "\" ><span class=\"fa fa-trash-o\"></span></button>";
                        }
                    }
                }).on("loaded.rs.jquery.bootgrid", function ()
                {
                    /* Executes after data is loaded and rendered */
                    grid.find(".command-edit").on("click", function (e)
                    {
                        $("#q_title").text($(this).data("ques"));
                        $("#r1o1").text($(this).data("op1"));
                        $("#r1o2").text($(this).data("op2"));
                        $("#r2o1").text($(this).data("op3"));
                        $("#r2o2").text($(this).data("op4"));
                        $("#qnoIDx").html('You are editing Qno:' + $(this).data("id"));
                        $("#qnoID").attr("value", $(this).data("id"));
                        $("#cancelEdit").show();
                        $('.categ_container option[value=' + $(this).data("categ") + ']').attr('selected', 'selected');
                        $('.weight_container option[value=' + $(this).data("weight") + ']').attr('selected', 'selected');
                        if ($(this).data("ismulti") == 1) {
                            if (!$("#multi_select").is(":checked")) {
                                $('#multi_select').trigger('click');
                                var val = $(this).data("copt");
                                var copt = val.split(',');
                                for (i = 0; i < copt.length; i++) {
                                    if (copt[i] == 1 && (!$("#correct_option_m1").is(":checked"))) {
                                        $("#correct_option_m1").trigger("click");
                                    } else if (copt[i] == 2 && (!$("#correct_option_m2").is(":checked"))) {
                                        $("#correct_option_m2").trigger("click");
                                    } else if (copt[i] == 3 && (!$("#correct_option_m3").is(":checked"))) {
                                        $("#correct_option_m3").trigger("click");
                                    } else if (copt[i] == 4 && (!$("#correct_option_m4").is(":checked"))) {
                                        $("#correct_option_m4").trigger("click");
                                    }
                                }
                            }
                        } else {
                            if ($("#multi_select").is(":checked")) {
                                $('#multi_select').trigger('click');
                            }
                            if ((!$("#correct_option_m1").is(":checked"))) {
                                $("#correct_option_m1").trigger("click");
                            }
                            if ((!$("#correct_option_m2").is(":checked"))) {
                                $("#correct_option_m2").trigger("click");
                            }
                            if ((!$("#correct_option_m3").is(":checked"))) {
                                $("#correct_option_m3").trigger("click");
                            }
                            if ((!$("#correct_option_m4").is(":checked"))) {
                                $("#correct_option_m4").trigger("click");
                            }
                        }
                        if ($(this).data("qtyp") == 1) {
                            $('#1').trigger('click');
                            $("#1").attr('checked', 'checked');
                            $("#2").removeAttr("checked");
                            $("#3").removeAttr("checked");
                        } else if ($(this).data("qtyp") == 2) {
                            $('#2').trigger('click');
                            $("#2").attr('checked', 'checked');
                            $("#1").removeAttr("checked");
                            $("#3").removeAttr("checked");
                            $('#image1').attr('src', 'data:image/' + $(this).data("typ") + ';base64,' + $(this).data("img1"));
                        } else if ($(this).data("qtyp") == 3) {
                            $('#3').trigger('click');
                            $("#3").attr('checked', 'checked');
                            $("#2").removeAttr("checked");
                            $("#1").removeAttr("checked");
                            $('#image2').attr('src', 'data:image/' + $(this).data("op1imgtp") + ';base64,' + $(this).data("op1img"));
                            $('#image3').attr('src', 'data:image/' + $(this).data("op2imgtp") + ';base64,' + $(this).data("op2img"));
                            $('#image4').attr('src', 'data:image/' + $(this).data("op3imgtp") + ';base64,' + $(this).data("op3img"));
                            $('#image5').attr('src', 'data:image/' + $(this).data("op4imgtp") + ';base64,' + $(this).data("op4img"));
                        }
                        $('#questionsGrid').hide(1000);
                        $('#editGrid').html("Edit Questions");
//                        $('#multi_select').val('value', 1);
                        //alert("You pressed edit on row: " + $(this).data("row-id"));
                    }).end().find(".command-delete").on("click", function (e)
                    {
                        var postData =
                                {
                                    id: $(this).data("id"), qtype: $(this).data("qtyp")
                                }
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "../classes/delete_ques.php",
                            data: {myData: JSON.stringify({id:'1',qtype:'2'})},
                            contentType: "application/json",
                            success: function (data) {
                                alert('Question Deleted');
                            },
                            error: function (e) {
                                console.log(e.message);
                            }
                        });
                        alert("You pressed delete on row: " + $(this).data("id"));
                    });
                });
                var rowIds = [];
                grid.on("selected.rs.jquery.bootgrid", function (e, row)
                {

                    for (var i = 0; i < row.length; i++)
                    {
                        rowIds.push(row[i].qnumber);
                    }
                    if (rowIds.length >= 1) {
                        $("#multiDel").show();
                        $(".command-delete").hide();
                    }

                }).on("deselected.rs.jquery.bootgrid", function (e, rows)
                {

                    for (var i = 0; i < rows.length; i++)
                    {
                        rowIds.pop(rows[i].qnumber);
                    }
                    if (rowIds.length == 0) {
                        $("#multiDel").hide();
                        $(".command-delete").show();
                    }
                });
                $('#files1').bind('change', function () {
                    $("#files1_ok").attr("value", "1");
                });
                $("#files2").bind('change', function () {
                    $("#files2_ok").attr("value", "1");
                });
                $("#files3").bind('change', function () {
                    $("#files3_ok").attr("value", "1");
                });
                $("#files4").bind('change', function () {
                    $("#files4_ok").attr("value", "1");
                });
            });
            function release() {
                $(".options").addClass("btn-danger");
            }
            function loadCategories() {
                $.getJSON('../classes/Categories.php', {customerId: 'n'}, function (data) {
                    var cat = $('#category');
                    cat.append(new Option("Select Category", "0"));
                    for (var x = 0; x < data.length; x++) {
                        cat.append(new Option(data[x].categ, data[x].id));
                    }
                });
            }
            function displayMessage() {
                //var message = $("#message").val();
                //if (message != "") {
                $("#messageContent").html("message");
                $("#messageDiv").show(1000);
                // $("#messageDiv").hide(3000);
                //}
            }
            $(document).on('click', 'form button[type=submit]', function (e) {
                if (checkMultiChoiceOptionSelection()) {
                    e.preventDefault(); //prevent the default action
                    return false;
                }
            });
            function checkMultiChoiceOptionSelection() {
                var selection = $('[name="correct_option[]"]:checked').length
                if (selection == 0) {
                    $('#outPopUpContainer2').show();
                    $('#outPopUp').html('<div class="alert alert-warning shake alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Aaahh!</strong> Please check atlest one correct option.</div>')
                    $("#outPopUpContainer").show();
                    $(".alert").alert(function () {
                        $("#outPopUpContainer").hide();
                    });
                    return true;
                }
                return false;
            }
//            $("#category_grid").bootgrid(
//                    {
//                        caseSensitive: false /* make search case insensitive */
//                    });


        </script>
        <script>
            $(document).ready(function () {
                document.getElementById("files1").onchange = function () {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('image1').src = e.target.result;
                    };
                    reader.readAsDataURL(this.files[0]);
                };
                document.getElementById("files2").onchange = function () {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        // get loaded data and render thumbnail.
                        document.getElementById("image2").src = e.target.result;
                    };

                    // read the image file as a data URL.
                    reader.readAsDataURL(this.files[0]);
                };
                document.getElementById("files3").onchange = function () {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        // get loaded data and render thumbnail.
                        document.getElementById("image3").src = e.target.result;
                    };

                    // read the image file as a data URL.
                    reader.readAsDataURL(this.files[0]);
                };
                document.getElementById("files4").onchange = function () {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        // get loaded data and render thumbnail.
                        document.getElementById("image4").src = e.target.result;
                    };

                    // read the image file as a data URL.
                    reader.readAsDataURL(this.files[0]);
                };
                document.getElementById("files5").onchange = function () {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        // get loaded data and render thumbnail.
                        document.getElementById("image5").src = e.target.result;
                    };

                    // read the image file as a data URL.
                    reader.readAsDataURL(this.files[0]);
                };
            });

        </script>
        <style>

            .outPopUp {
                position: absolute;
                width: 300px;
                height: 200px;
                z-index: 15;
                top: 50%;
                left: 50%;
                margin: -100px 0 0 -150px;
            }
            .col-md-4{display: none;}
            .col-md-4.active{display: block;}
            table input[type="checkbox"]{
                position: relative;
                opacity: 1;
            }
            div[id="category_grid-header"] input[type="checkbox"]{
                position: relative !important;
                opacity: 1 !important;
            }
        </style>
    </head>

    <body>
        <div class="row" id="outPopUpContainer2" style="padding-top: 1%;display:none;" id="messageDiv2">
            <div class="col-lg-12 outPopUp" class="outPopUp" id="outPopUp2">
                <?php
                if (!empty($message)) {
                    echo "<div class=\"alert alert-warning shake alert-dismissable\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><strong>Aaahh!</strong> $message</div>";
                }
                ?>
            </div>
        </div>
        <input type="hidden" id="message" name="message" value="<?php echo "$message"; ?>"/>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#questart">Start Bootstrap</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#qstart">Create Question</a>
                        </li>
                        <li>
                            <a href="#">Services</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <!-- Page Content -->
        <div class="container">
            <form id="questionForm" class="form-horizontal" method="post" action="create_ques" enctype="multipart/form-data">
                <!-- Portfolio Item Heading -->
                <div class="row">
                    <input type="hidden" id="files1_ok" name="files1_ok" value="0"/>
                    <input type="hidden" id="files2_ok" name="files2_ok" value="0"/>
                    <input type="hidden" id="files3_ok" name="files3_ok" value="0"/>
                    <input type="hidden" id="files4_ok" name="files4_ok" value="0"/>
                    <input type="hidden" id="files5_ok" name="files5_ok" value="0"/>
                </div>
                <div class="row">
                    <div class="form-horizontal">
                        <fieldset>
                            <div class="col-lg-8">
                                <h1 class="page-header " style="padding-top: 5%;">Test Name

                                </h1>
                            </div>
                            <div class="col-lg-4" style="padding-top: 5%;">
                                <div style="float: left;">
                                    <button id="delGrid" name="delGrid" type="button" class="btn btn-xs" style="background-color: #5FBAAC;color:#FFFFFF;margin-top: 10%;height:150%">Delete Questions</button>
                                </div>
                                <div style="float: left;">
                                    <button id="editGrid" name="editGrid" type="button" class="btn btn-xs" style="background-color: #5FBAAC;color:#FFFFFF;margin-top: 10%;height:150%">Edit Questions</button>
                                </div>
                                <div style="float: left;">
                                    <button id="createGrid" name="createGrid" type="button" class="btn btn-xs" style="background-color: #5FBAAC;color:#FFFFFF;margin-top: 10%;height:150%;display: none;">Create Questions</button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row" id="questionsGrid" style="display:none;">
                    <button id="multiDel" class="btn btn-xs btn-primary" style="display:none;">Delete Multiple Questions</button>
                    <div class="form-horizontal">
                        <fieldset>
                            <div class="col-lg-10">
                                <!--Editing Table-->
                                <table id="category_grid" class="table table-condensed table-hover table-striped" width="100%" cellspacing="0" data-toggle="bootgrid" data-ajax="true" data-url="../classes/GetQuestions.php">
                                    <thead>
                                        <tr>
                                            <th data-column-id="qnumber" data-type="numeric" data-order="desc" data-identifier="true">ID</th>
                                            <th data-column-id="question" data-sortable="true">Question</th>
                                            <th data-column-id="q_type">Type</th>
                                            <th data-column-id="option2">Option2</th>
                                            <th data-column-id="option3">Option3</th>
                                            <th data-column-id="option4">Option4</th>
                                            <th data-column-id="categ">Category</th>
                                            <th data-column-id="weight">Weightage</th>
                                            <th data-column-id="commands" data-formatter="commands" data-sortable="false">commands</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row" id="qstart">
                    <div class=" col-lg-12 segmented-control" style="width: 100%; color: #5FBAAC">
                        <input type="radio" name="sc-1-1" id="1" value="1" checked>
                        <input type="radio" name="sc-1-1" id="2" value="2">
                        <input type="radio" name="sc-1-1" id="3" value="3">
                        <label for="1" data-value="Text Question">Text Question</label>
                        <label for="2" data-value="Question Title as Image">Question Title as Image</label>
                        <label for="3" data-value="Question Option as Image">Question Option as Image</label>
                    </div>
                </div>
                <div class="row" style="padding-top: 3%;">
                    <div class=" col-lg-6">
                        <div class="form-inline" style="color: #5FBAAC">
                            <label for="category" style="width: 100%; ">Category</label>
                        </div>
                    </div>
                    <div class=" col-lg-6">
                        <div class="form-inline" style="color: #5FBAAC">
                            <label for="weightage" style="width: 100%; ">Weightage</label>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 0%;">
                    <div class=" col-lg-6" >
                        <div style="color: #5FBAAC" class="categ_container">
                            <select id="category" name="category" class="form-control btn-info" style="width: 100%;background-color: #5FBAAC" data-max-options="3" data-live-search="true">
                            </select>
                        </div>
                    </div>
                    <div class=" col-lg-6">
                        <div  style="color: #5FBAAC" class="weight_container">
                            <select id="weightage" name="weightage" class="form-control btn-info" style="width: 100%; background-color: #5FBAAC" data-max-options="3" data-live-search="true">
                                <option value="0">Select Weightage</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="outPopUpContainer" style="padding-top: 1%;display: none;" id="messageDiv">
                    <div class="col-lg-12 outPopUp" id="outPopUp">

                    </div>
                </div>
                <div class="row loading" style="display:none;">
                    <div class="col-lg-12" style="width: 100%;">
                        <label style="width:100%;margin-left: 40%;margin-top: 20%;"><i class="fa fa-spinner fa-spin fa-5x fa-align-center wow bounceIn" data-wow-delay=".3s"></i></label>
                    </div>
                </div>
                <div class="question">
                    <!-- /.row -->

                    <!-- Portfolio Item Row -->
                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="hidden" name="qnoID" id="qnoID" value=""/>
                                <h1><small style="align-self: center;" id="qnoIDx" qno="">New Question: <span id="qno"></span></small><button id="cancelEdit" class="btn btn-primary btn-xs" style="display:none;" type="button">Cancel Editing</button></h1>

                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                    <!-- /.row -->
                    <div class="row">
                        <div class="form-horizontal">
                            <fieldset>
                                <div class="form-group">
                                    <div id="questiontxt" class="col-lg-12">
                                        <textarea id="q_title" type="submit" class="btn btn-danger" style="width:100%;height:150%;line-height:250%" placeholder="Type your question here" name="q_title"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="imgQues" style="display:none;align-content: center;" >
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-9" style="padding-left: 8%;">
                                <label class="btn btn-default btn-file">
                                    <img id="image1"  src="../assets/img/pick.png" width="300px" height="300px"><input class="hidden" id="files1" name="files1" type="file"/>
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-horizontal">
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-lg-6 option">
                                        <textarea id="r1o1" type="submit" class="optxtara btn btn-danger options" style="width:100%;height:150%" placeholder="Type option 1" name="op1"></textarea>
                                        <div class="imgOpt" style="display:none; padding-left: 50%;">
                                            <div class="col-lg-12">

                                                <label class="btn btn-default btn-file">
                                                    <img id="image2"  src="../assets/img/pick.png" width="200px" height="200px"><input class="hidden" id="files2" name="files2" type="file">
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 option">
                                        <textarea id="r1o2" type="submit" class="optxtara btn btn-danger options" style="width:100%;height:150%" placeholder="Type option 2" name="op2"></textarea>
                                        <div class="imgOpt" style="display:none;">
                                            <div class="col-lg-12">

                                                <label class="btn btn-default btn-file">
                                                    <img id="image3"  src="../assets/img/pick.png" width="200px" height="200px"><input class="hidden" id="files3" name="files3" type="file">
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-horizontal">
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-lg-6 option">
                                        <textarea id="r2o1" type="submit" class="optxtara btn btn-danger options" style="width:100%;height:150%" placeholder="Type option 3" name="op3"></textarea>
                                        <div class="imgOpt" style="display:none; padding-left: 50%;">
                                            <div class="col-lg-12">

                                                <label class="btn btn-default btn-file">
                                                    <img id="image4"  src="../assets/img/pick.png" width="200px" height="200px"><input class="hidden" id="files4" name="files4" type="file">
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 option">
                                        <textarea id="r2o2" type="submit" class="optxtara btn btn-danger options" style="width:100%;height:150%" placeholder="Type option 4" name="op4"></textarea>
                                        <div class="imgOpt" style="display:none;">
                                            <div class="col-lg-12">
                                                <label class="btn btn-default btn-file">
                                                    <img id="image5"  src="../assets/img/pick.png" width="200px" height="200px"><input class="hidden" id="files5" name="files5" type="file">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-horizontal">
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="ms_v" id="ms_v" value="0"/>
                                        <label><input type="checkbox" name="multi_select" value="0" id="multi_select" class="ios-switch green  bigswitch"/><div><div></div></div></label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-horizontal">
                            <fieldset>
                                <div class="form-group">
                                    <div class="col-lg-2">
                                        <label>Select the correct option</label>  
                                    </div>
                                    <div class=" col-lg-10 segmented-control correct_option_single" style="width: 100%; color: #5FBAAC">
                                        <input type="radio" name="correct_option_r" id="correct_option1" value="1" checked>
                                        <input type="radio" name="correct_option_r" id="correct_option2" value="2">
                                        <input type="radio" name="correct_option_r" id="correct_option3" value="3">
                                        <input type="radio" name="correct_option_r" id="correct_option4" value="4">
                                        <label for="correct_option1" data-value="Option-1 is Correct">1</label>
                                        <label for="correct_option2" data-value="Option-2 is Correct">2</label>
                                        <label for="correct_option3" data-value="Option-3 is Correct">3</label>
                                        <label for="correct_option4" data-value="Option-4 is Correct">4</label>
                                    </div>
                                    <div class=" col-lg-10 correct_option_multiple" style="width: 100%; color: #5FBAAC;display: none;">
                                        <label>Option 1<input type="checkbox" name="correct_option[]" id="correct_option_m1" value="1" class="ios-switch green  bigswitch" checked /><div><div></div></div></label>
                                        <label>Option 2<input type="checkbox" name="correct_option[]" id="correct_option_m2" value="2"class="ios-switch green  bigswitch"  /><div><div></div></div></label>
                                        <label>Option 3<input type="checkbox" name="correct_option[]" id="correct_option_m3" value="3"class="ios-switch green  bigswitch"  /><div><div></div></div></label>
                                        <label>Option 4<input type="checkbox" name="correct_option[]" id="correct_option_m4" value="4"class="ios-switch green  bigswitch"  /><div><div></div></div></label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <button id="saveEdit" name="saveEdit" type="submit" class="btn btn-info btn-xs prev" style="display:none;margin-top: 10%;margin-left: 40%;height:150%">
                                    SAVE<i class="fa fa-arrow-left fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                                </button>
                                <div class="col-lg-6">
                                    <button id="previous" name="Previous" type="submit" class="btn btn-info btn-xs prev" style="margin-top: 10%;margin-left: 40%;height:150%">
                                        <i class="fa fa-arrow-left fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                                    </button>
                                </div>
                                <div class="col-lg-6">
                                    <button id="next" name="Next" type="submit" class="btn btn-xs next" style="background-color: #c0deed;margin-top: 10%;margin-left:40%;height:150%">
                                        <i class="fa fa-arrow-right fa-3x wow bounceIn" data-wow-delay=".3s"></i>
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <!-- Footer -->
                <footer>
                    <div class="row">
                        <div class="col-lg-12">

                            <p>Copyright © Vinyasa Yoga School , Rishikesh 2015</p>
                        </div>
                    </div>
                    <!-- /.row -->

                </footer>
            </form>

        </div>
        <!-- /.container -->
    </body>
</html>