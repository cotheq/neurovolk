<?php
    require_once("mysql_connection.php");
    $r = array(
        "success" => false,
        "rating" => null,
    );
    
    if (isset($_POST["citata_id"])) {
        $id = $_POST["citata_id"];
        session_start();
        if (!isset($_SESSION["likes"][$id])) {
            if (isset($_POST["like"])) {
                $like = $_POST["like"];
                if ($like == "like" || $like == "dislike") {
                    $mysqli = new_connection();
                    if ($like == "like") {
                        $sign = "+";
                    } else {
                        $sign = "-";
                    }
                    $mysqli->query("update citatas set rating = rating" . $sign . "1 where id = " . $id);
                    $mysqli -> close();
                    $mysqli = new_connection();
                    $res = $mysqli->query("select rating from citatas where id = " . $id);
                    while ($row = $res->fetch_assoc()) {
                        $rating = intval($row['rating']);
                    }
                    $mysqli -> close();
                    $_SESSION["likes"][$id] = $like;
                    $r["success"] = true;
                    $r["rating"] = $rating;
                }
            }
            
        }
    }
    echo json_encode($r);
?>