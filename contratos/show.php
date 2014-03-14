<?php
include_once '../config/session.php';
include_once '../partials/before_actions.php';
include_once '../partials/header.php';
$id = $_GET['id'];
$contrato = $link->query("SELECT c.*, m.nome as modalidade from contratos as c INNER JOIN modalidades AS m where c.id = '$id' and c.modalidades_id = m.id;");
$status_r = $link->query("SELECT * from tipos_status;");
$c = mysqli_fetch_assoc($contrato);
?>
<body>
  <div class="box_contrato">
    <h2 class="hx_left_alg"><?php echo "Contrato nº ".$c['num_contrato']; ?></h2>
    <div class="actions_right">
      <a href="/ac/contratos/edit.php?id=<?php echo $id; ?>">Editar contrato</a>
      <?php if ($_SESSION['admin'] == true): ?>
        <a class="delete" href="/ac/contratos/delete.php?id=<?php echo $id; ?>">Remover contrato</a>
      <?php endif ?>
    </div>
    <div class="contrato">

      <div class="left_box">
        <div class="field">
          <label>Num. Contrato</label>
          <p id="num_contrato"><?php echo $c['num_contrato'] ?></p>
        </div>
        <div class="field">
          <label>Processo</label>
          <p id="processo"><?php echo $c['processo'] ?></p>
        </div>
        <div class="field">
          <label>Contratado</label>
          <p id="contratado"><?php echo $c['contratado'] ?></p>
        </div>
        <div class="field">
          <label>Objeto</label>
          <p id="objeto"><?php echo $c['objeto'] ?></p>
        </div>
        <div class="field">
          <label>Modalidade</label>
          <p id="objeto"><?php echo $c['modalidade'] ?></p>
        </div>
        <div class="field">
          <label>Período de vigência</label>
          <p id="vigencia"><?php echo strftime('%d/%m/%y', strtotime($c['inicio_vigencia']))." - ".strftime('%d/%m/%y', strtotime($c['fim_vigencia'])) ?></p>
        </div>
      </div>

      <div class="right_box">
        <div class="field">
          <label>Valor do Contrato</label>
          <p id="valor_contrato"><?php echo $c['valor_contrato'] ?></p>
        </div>
        <div class="field">
          <label>Valor previsto (Mensal)</label>
          <p id="valor_previsto"><?php echo $c['valor_previsto'] ?></p>
        </div>
        <div class="field">
          <label>Publicado?</label>
          <p id="publicado"><?php echo $c['publicado'] == 0 ? 'Não' : 'Sim' ?></p>
        </div>
        <div class="field">
          <label>Num. DOE</label>
          <p id="num_doe"><?php echo $c['num_doe'] ?></p>
        </div>
        <div class="field">
          <label>Num. Portaria</label>
          <p id="num_portaria"><?php echo $c['num_portaria'] ?></p>
        </div>
        <div class="field">
          <label>Pública</label>
          <p id="publica_portaria"><?php echo $c['publica_portaria'] ?></p>
        </div>
        <div class="field">
          <label>Status do contrato</label>
          <?php
            $status = explode(',', $c['status']);
              while($st = mysqli_fetch_assoc($status_r)) {
                if (in_array($st['id'], $status, true)) { ?>
                  <p id="status_done"><?php echo $st['nome']; ?></p>
                <?php
                } else { ?>
                  <p id="status"><?php echo $st['nome']; ?></p>
                <?php }
            }
          ?>
        </div>
      </div>

    </div>
  </div>
<?php include_once '../partials/footer.php'; ?>