<?php
    session_start();
    require_once "config.php";
    $dia = filter_input(INPUT_POST, 'dia');
    $hora = filter_input(INPUT_POST, 'hora');
    $texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sql = $pdo -> query("SELECT * FROM info WHERE data='$dia'");
    if($sql -> rowCount() > 0){
        $_SESSION['aviso'] = "Este dia está indisponível";
        header("Location: index.php");
        exit;
    }

    if($dia && $hora && $texto){
        $texto = ucfirst(strtolower($texto));
        $sql = $pdo -> prepare("INSERT INTO info(data, hora, texto) VALUES(:dia, :hora, :texto)");
        $sql -> bindValue(':dia', $dia);
        $sql -> bindValue(':hora', $hora);
        $sql -> bindValue(':texto', $texto);
        $sql -> execute();
    }else{
        $_SESSION['aviso'] = "Preencha os campos corretamente!";
    }
    header("Location: index.php");
    exit;
    