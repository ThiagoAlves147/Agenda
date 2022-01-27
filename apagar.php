<?php
    require_once "config.php";
    $data = filter_input(INPUT_GET, 'data');
    if($data){
        $sql = $pdo -> prepare('DELETE FROM info WHERE data=:data');
        $sql -> bindValue(":data", $data);
        $sql -> execute();
    }

    header("Location: index.php");
    exit; 