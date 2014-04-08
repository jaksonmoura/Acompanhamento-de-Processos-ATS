<?php
include_once '../partials/header.php';
include_once '../config/session.php';
 ?>
<div class="box tcenter">
<?php

if($_POST){

    $id = intval($_POST['id']);
    $type = intval($_POST['type']);
    $num_contrato = $_POST['num_contrato'];
    $processo = $_POST['processo'];
    $contratado = $_POST['contratado'];
    $objeto = $_POST['objeto'];
    $modalidades_id = !empty($_POST['modalidades_id']) ? $_POST['modalidades_id'] : "NULL";
    $iv = explode("/",$_POST['inicio_vigencia']);
    $fv = explode("/",$_POST['fim_vigencia']);
    $inicio_vigencia = !empty($_POST['inicio_vigencia']) ? "$iv[2]-$iv[1]-$iv[0]": "NULL";
    $fim_vigencia = !empty($_POST['fim_vigencia']) ? "$fv[2]-$fv[1]-$fv[0]" : "NULL";
    $vc = floatval(str_replace(',', '.', str_replace('.', '', $_POST['valor_contrato'])));
    $vp = floatval(str_replace(',', '.', str_replace('.', '', $_POST['valor_previsto'])));
    $valor_contrato = !empty($vc) ? $vc : "NULL";
    $valor_previsto = !empty($vp) ? $vp : "NULL";
    $publicado = (isset($_POST['publicado']) == true) ? 1 : 0;
    $num_doe = !empty($_POST['num_doe']) ? intval($_POST['num_doe']) : "NULL";
    $num_portaria = $_POST['num_portaria'];
    $publica_portaria = $_POST['publica_portaria'];
    $status = $_POST['status'];

    if ($type == 0) {
        $link->query("INSERT INTO contratos (num_contrato, processo, contratado, objeto, modalidades_id, inicio_vigencia, fim_vigencia, valor_contrato, valor_previsto, publicado, num_doe, num_portaria, publica_portaria, status) VALUES ('$num_contrato', '$processo', '$contratado', '$objeto', $modalidades_id, '$inicio_vigencia', '$fim_vigencia', '$valor_contrato', '$valor_previsto', $publicado, $num_doe, '$num_portaria', '$publica_portaria', '$status')");
        $_SESSION['message'] = 'Contrato salvo com sucesso!';
        // echo $link->mysql_error();
        header("location: /ac/contratos/index.php");
    } else {
        $link->query("UPDATE contratos SET
            num_contrato = '$num_contrato',
            processo = '$processo',
            contratado = '$contratado',
            objeto = '$objeto',
            modalidades_id = $modalidades_id,
            inicio_vigencia = '$inicio_vigencia',
            fim_vigencia = '$fim_vigencia',
            valor_contrato = '$valor_contrato',
            valor_previsto = '$valor_previsto',
            publicado = $publicado,
            num_doe = $num_doe,
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