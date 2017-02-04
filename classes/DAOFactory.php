<?php
require_once 'DAO.php';
class DAOFactory {

    public static function getDAO() {
        return new DAO();
    }

}
?>