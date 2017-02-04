<?php

require_once('../VYS_assets/session.class.php');
require_once 'DAOFactory.php';
class Utility {

    public static function encryptString($inputString) {
        $usr_encry_pswd = NULL;
        $inputString = trim($inputString);
        $options = ['cost' => 9, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)];
        if (!empty($inputString)) {
            $usr_encry_pswd = password_hash($inputString, PASSWORD_BCRYPT, $options);
        }
        return $usr_encry_pswd;
    }

    public static function encryptMD5($inputString) {
        if (!empty($inputString)) {
            return md5($inputString);
        } else {
            return NULL;
        }
    }

    public static function isFileOkToUpload($fileObject) {
        $response = NULL;
        $file = $fileObject;
        $file_temp_name = $file['tmp_name'];
        $file_name = $file['name'];
        $file_size = $file['size'];
        $check = getimagesize($file_temp_name);
        $target_dir = "/Applications/MAMP/htdocs/VYS/";
        $target_file = $target_dir . basename($file_name);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
        $check = getimagesize($file_temp_name);
//echo $check["size"];
        if ($check !== false) {
            if (!file_exists($target_file) && !($file_size > 500000) && !($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )) {
                //echo "File is an image - " . $check["mime"] . ".";
                // move_uploaded_file($_FILES['q_title_img_h']['tmp_name'], $target_file);
                $fp = fopen($file_temp_name, 'r');
                $content = fread($fp, filesize($file_temp_name));
                $content = addslashes($content);
                fclose($fp);
                if (!get_magic_quotes_gpc()) {
                    $file_name = addslashes($file_name);
                }
                $response["filename"] = $file_name;
                $response["filesize"] = $file_size;
                $response["filetype"] = $imageFileType;
                $response["content"] = $content;
                return $response;
            } else {
                return $response; // = 0;
            }
        } else {
            return $response;
        }
    }

    public static function validateSession() {
        $session = new session();
        $session->start_session('s_', false);
        $uid = $_SESSION['s_k'];
        $fn = $_SESSION['fn'];
        $ln = $_SESSION['ln'];
        if (empty($uid)) {
            header("Location: ../index?v=0&err=1");
            exit();
        } else {
            return TRUE;
        }
    }

}

?>