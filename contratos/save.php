<?php
include_once '../partials/header.php';
include_once '../config/session.php';
 ?>
<div class="box tcenter">
<?php

if($_POST){

    $id = intval($_POST['id']);
    $type = intval($_POST['type']);
    $num_contrato = intval($_POST['num_contrato']);
    $processo = $_POST['processo'];
    $contratado = $_POST['contratado'];
    $objeto = $_POST['objeto'];
    $modalidades_id = $_POST['modalidades_id'];
    $vigencia = $_POST['vigencia'];
    $valor_contrato = $_POST['valor_contrato'];
    $valor_previsto = $_POST['valor_previsto'];
    $publicado = (isset($_POST['publicado']) == true) ? 1 : 0;
    echo $publicado;
    $num_doe = intval($_POST['num_doe']);
    $num_portaria = intval($_POST['num_portaria']);
    $publica_portaria = intval($_POST['publica_portaria']);
    $status = $_POST['status'];

    if ($type = 0) {
        $link->query("INSERT INTO contratos (num_contrato, processo, contratado, objeto, modalidades_id, vigencia, valor_contrato, valor_previsto, publicado, num_doe, num_portaria, publica_portaria, status) VALUES ('$num_contrato', '$processo', '$contratado', '$objeto', '$modalidades_id', '$vigencia', '$valor_contrato', '$valor_previsto', '$publicado', '$num_doe', '$num_portaria', '$publica_portaria', '$status')");
        $_SESSION['message'] = 'Contrato salvo com sucesso!';
        // echo $link->mysql_error();
        header("location: /ac/contratos/index.php");
    } else {
        $link->query("UPDATE contratos SET
            num_contrato = '$num_contrato',
            processo = '$processo',
            contratado = '$contratado',
            objeto = '$objeto',
            modalidades_id = '$modalidades_id',
            vigencia = '$vigencia',
            valor_contrato = '$valor_contrato',
            valor_previsto = '$valor_previsto',
            publicado = '$publicado',
            num_doe = '$num_doe',
            num_portaria = '$num_portaria',
            publica_portaria = '$publica_portaria',
            status = '$status'
            WHERE id = $id");
        $_SESSION['message'] = 'Contrato atualizado com sucesso!';
        // echo $link->mysql_error();
        header("location: /ac/contratos/show.php?id=$id");
    }
}
?>
</div>