<?php
    function new_connection() {
        $mysqli = new mysqli("localhost", "u500888395_fuckingbitch", "shittyfuck", "u500888395_neurovolk");
    
        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            die;
        }
        
        return $mysqli;
    }
?>