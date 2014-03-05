<?php
include_once '../config/session.php';
include_once '../partials/before_actions.php';
include_once '../partials/header.php';
$modalidades = $link->query("SELECT * from modalidades;");
$id = $_GET['id'];
$contrato = $link->query("SELECT * from contratos where id = '$id';");
$c = mysqli_fetch_assoc($contrato);
$status_r = $link->query("SELECT * from tipos_status;");
?>
</head>
<body>
  <div class="box">
    <h2>Editar contrato nº <?php echo $c['num_contrato'];  ?></h2>
    <h3>Enviar arquivo:</h3>
    <form action="save.php" id="novo_contrato" method="post" >
      <div class="left">
        <input type="hidden" name="type" value="1">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="field num_contrato">
          <label>Num. Contrato</label>
          <input type="text" name="num_contrato" id="num_contrato" value="<?php echo $c['num_contrato'] ?>"/>
        </div>
        <div class="field processo">
          <label>Processo</label>
          <textarea name="processo" id="processo"><?php echo $c['processo'] ?></textarea>
        </div>
        <div class="field contratado">
          <label>Contratado</label>
          <textarea type="text" name="contratado" id="contratado"><?php echo $c['contratado'] ?></textarea>
        </div>
        <div class="field objeto">
          <label>Objeto</label>
          <textarea type="text" name="objeto" id="objeto"><?php echo $c['objeto'] ?></textarea>
        </div>
        <div class="field modalidades_id">
          <label>Modalidade:</label>
          <select name="modalidades_id" id="modalidades_idvalue="<?php echo $c['id'] ?>"">
            <option value="">Escolha:</option>
          <?php  while ($m = mysqli_fetch_assoc($modalidades)) {
            if ($m['id'] == $c['modalidades_id']) {
          ?>
            <option selected="true" value="<?php echo $m['id']; ?>"><?php echo $m['nome']; ?></option>
          <?php } else { ?>
            <option value="<?php echo $m['id']; ?>"><?php echo $m['nome']; ?></option>
            <?php } } ?>
          </select>
        </div>
      </div>
      <div class="right">
        <div class="field vigencia">
          <label>Período de vigência</label>
          <input type="text" name="vigencia" id="vigencia" value="<?php echo $c['vigencia'] ?>"/>
        </div>
        <div class="field valor_contrato">
          <label>Valor do Contrato</label>
          <input type="text" name="valor_contrato" id="valor_contrato" value="<?php echo $c['valor_contrato'] ?>"/>
        </div>
        <div class="field valor_previsto">
          <label>Valor previsto (Mensal)</label>
          <input type="text" name="valor_previsto" id="valor_previsto" value="<?php echo $c['valor_previsto'] ?>"/>
        </div>
        <div class="field publicado">
          <label>Contrado publicado?</label>
          <?php if ($c['publicado'] == true){ ?>
          <input type="checkbox" name="publicado" id="publicado" value="1" checked="true"/>
          <?php }else{ ?>
          <input type="checkbox" name="publicado" id="publicado" value="1"/>
          <?php } ?>
        </div>
        <div class="field num_doe">
          <label>Num. DOE</label>
          <input type="text" name="num_doe" id="num_doe" value="<?php echo $c['num_doe'] ?>"/>
        </div>
        <div class="field num_portaria">
          <label>Num. Portaria</label>
          <input type="text" name="num_portaria" id="num_portaria" value="<?php echo $c['num_portaria'] ?>"/>
        </div>
        <div class="field publica_portaria">
          <label>Pública</label>
          <input type="text" name="publica_portaria" id="publica_portaria" value="<?php echo $c['publica_portaria'] ?>"/>
        </div>
        <div class="field status">
          <label>Status do contrato</label>
          <div class="status_check">
          <?php
            $status = explode(',', $c['status']);
              while($st = mysqli_fetch_assoc($status_r)) {
                if (in_array($st['id'], $status, true)) { ?>
                  <input type="checkbox" checked="true" value="<?php echo $st['id']; ?>" id="status<?php echo $st['id']; ?>" />
                  <span><?php echo $st['nome'] ?></span><br>
                <?php
                } else { ?>
                  <input type="checkbox" value="<?php echo $st['id']; ?>" id="status<?php echo $st['id']; ?>" />
                  <span><?php echo $st['nome'] ?></span><br>
                <?php }
              } ?>
          </div>
          <input type="hidden" name="status" id="status" />
        </div>
      </div>

      <div class="actions"><input type="submit" value='Atualizar contrato'></div>
    </form>
  </div>
  <script>
    $('#novo_contrato').submit(function(){
      status = "";
      $(".status_check input").each(function() {
        if ($(this).is(':checked')) {
          status += $(this).val() + ",";
        };
      });
        st = status.substr(0, status.length - 1);
      $('#status').val(st);
    });
  </script>
<?php include_once '../partials/footer.php'; ?>