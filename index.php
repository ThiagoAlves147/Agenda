<!DOCTYPE html>
<html lang="pt-br">

<?php
    session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-escale=1, shrink-to-fit=no"/>
    <script src="https://kit.fontawesome.com/f5c5b70e3a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="estilo.css"/>
    <link rel="stylesheet" href="estiloB.css"/>
    <title>Agenda</title>
</head>
<body>

    <?php
        require_once "config.php";
        $sql = $pdo -> query('SELECT * FROM info');
        $listar = [];
        if($sql -> rowCount() > 0){
            $listar = $sql -> fetchAll(PDO::FETCH_ASSOC);
        }
    ?>  

    <h1 style="text-align: center; color: rgb(0, 0, 133);">
        Agenda Semanal<br/>
    </h1>

    <h2 style="text-align: center; color: rgb(0, 0, 133);">
        <?php 
            date_default_timezone_set('UTC');
             echo "Hoje: ".date("d/m/Y"); 
        ?>
    </h2>

    <div class="flex">
    <table class="table table-bordered border-primary">
        <thead>
            <tr>
            <th scope="col"><img src="imagens/imagem2S.png" width="80px"/><br></th>
            <th scope="col">Day<br><?php echo date('d', time() + 86400 * 1); ?></th>
            <th scope="col">Day<br><?php echo date('d', time() + 86400 * 2); ?></th>
            <th scope="col">Day<br><?php echo date('d', time() + 86400 * 3); ?></th>
            <th scope="col">Day<br><?php echo date('d', time() + 86400 * 4); ?></th>
            <th scope="col">Day<br><?php echo date('d', time() + 86400 * 5); ?></th>
            <th scope="col">Day<br><?php echo date('d', time() + 86400 * 6); ?></th>
            <th scope="col">Day<br><?php echo date('d', time() + 86400 * 7); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Horario</th>
                <?php $cont = 1; for($i = 0; $i <= 6; $i++): ?>
                    <td>
                        <?php 
                             $data = date('Y-m-d', time() + 86400 * $cont);
                             if(isset($listar)){
                                 foreach($listar as $value){
                                    
                                    if($value['data'] == $data){
                                        echo $value['hora'];
                                    }
                                    
                                 }
                             }else{
                                 echo "-/-";
                             }

                             $cont++;
                        ?>
                    </td>
                <?php endfor?>
            </tr>
            <tr>
                <th class="compromisso" scope="row">Compromisso</th>
                <?php $cont = 1; for($i = 0; $i <= 6; $i++): ?>
                        <td>
                            <?php 
                                $data = date('Y-m-d', time() + 86400 * $cont);
                                if(isset($listar)){
                                    foreach($listar as $value){
                                        
                                        if($value['data'] == $data){
                                            echo $value['texto'];
                                        }
                                        
                                    }
                                }else{
                                    echo "-/-";
                                }

                                $cont++;
                            ?>
                        </td>
                    <?php endfor?>
            </tr>
            <tr>
                <th scope="row">Ações</th>
                <td>
                    <a href="apagar.php?data=<?php echo date('Y/m/d', time() + 86400) ;?>" onclick="return confirm('Certeza que deseja confirmar a ação?')"><i class="far fa-trash-alt"></i></a>
                </td>
                <td>
                    <a href="apagar.php?data=<?php echo date('Y/m/d', time() + 86400 * 2) ;?>" onclick="return confirm('Certeza que deseja confirmar a ação?')"><i class="far fa-trash-alt"></i></a>
                </td>
                <td>
                    <a href="apagar.php?data=<?php echo date('Y/m/d', time() + 86400 * 3) ;?>" onclick="return confirm('Certeza que deseja confirmar a ação?')"><i class="far fa-trash-alt"></i></a>
                </td>
                <td>
                    <a href="apagar.php?data=<?php echo date('Y/m/d', time() + 86400 * 4) ;?>" onclick="return confirm('Certeza que deseja confirmar a ação?')"><i class="far fa-trash-alt"></i></a>
                </td>
                <td>
                    <a href="apagar.php?data=<?php echo date('Y/m/d', time() + 86400 * 5) ;?>" onclick="return confirm('Certeza que deseja confirmar a ação?')"><i class="far fa-trash-alt"></i></a>
                </td>
                <td>
                    <a href="apagar.php?data=<?php echo date('Y/m/d', time() + 86400 * 6) ;?>" onclick="return confirm('Certeza que deseja confirmar a ação?')"><i class="far fa-trash-alt"></i></a>
                </td>
                <td>
                    <a href="apagar.php?data=<?php echo date('Y/m/d', time() + 86400 * 7) ;?>" onclick="return confirm('Certeza que deseja confirmar a ação?')"><i class="far fa-trash-alt color-success"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
    </div>  
    
    <p>
        <?php
            if(isset($_SESSION['aviso'])){
                echo  $_SESSION['aviso'];
                $_SESSION['aviso'] = " ";
            }
        ?>
    </p>

    <div class="container">

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#janela">Agendar</button>

        <div class="modal fade" id="janela">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="font-weight: bold;">Agendar</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="post" action="verificarInserir.php">
                        <div class="modal-body">
                            <?php
                                $min = date('d', time() + 86400);
                                $max = date('d', time() + 604800);
                                $monthMin = date('m');
                                $monthMax = date('m', time() + 604800);
                                $year = date('Y');
                            ?>
                                <label>
                                    Data:
                                    <input type="date" name="dia" min="<?php echo $year."-".$monthMin."-".$min ?>" max="<?php echo $year."-".$monthMax."-".$max ?>">
                                </label>
                                <label>
                                    Hora:
                                    <input type="time" name="hora" min="00:00" max="23:59"/>
                                </label>
                                <br/><br/>
                                <label>
                                    Descrição do Compromisso<br/>
                                    <textarea name="texto"></textarea>
                                </label>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    

    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="bootstrap.js"></script>
</body>
</html>