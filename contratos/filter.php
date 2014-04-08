<?php
include_once '../config/session.php';
include_once '../partials/before_actions.php';
include_once '../partials/header.php';
if ($_GET['param']) {
  $param = $_GET['param'];
  // $contratos = $link->query("SELECT * from contratos where status like '%$param%';");
  $contratos = $link->query("SELECT c.*, m.nome as modalidade from contratos as c INNER JOIN modalidades AS m where c.status like '%$param%' group by c.id;");
}
$status_r = $link->query("SELECT * from tipos_status;");
?>

<div class="main_content">
  <div class="filter">
    <h2>Filtrar:</h2>
    <form action="filter.php" method="get">
      <div class="field">
        <label for="param">Por status:</label>
        <select name="param" id="status">
          <option value="">Escolha:</option>
        <?php while ($s = mysqli_fetch_assoc($status_r)) { ?>
          <option value="<?php echo $s['id'] ?>"><?php echo $s['nome'] ?></option>
        <?php } ?>
        </select>
      </div>
      <div class="actions">
        <input type="submit" value="Filtrar »">
      </div>
    </form>
  </div>
</div>

<?php if ($contratos): ?>
  <table id="tb_content">
      <thead>
        <tr>
          <th class="tnum_contrato">Nº.</th>
          <th class="tprocesso">Proc.</th>
          <!-- <th class="tcontratado">Contratado</th> -->
          <th class="tmodalidades_id">Modalidade</th>
          <th class="tvigencia">Vigência</th>
          <th class="tvalor_contrato">Valor contrato</th>
          <th class="tvalor_previsto">Valor previsto</th>
          <th class="tobjeto">Objeto</th>
          <th class="tmais">Mais informações</th>
          <th class="tstatus">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while ($c = mysqli_fetch_assoc($contratos)){
            $two_m = strtotime("+60 days");
            $four_m = strtotime("+120 days");
            $vigencia = strtotime($c['fim_vigencia']);
            if ($two_m > $vigencia) {
              echo '<tr class="warning">';
            } elseif ($four_m > $vigencia and $two_m < $vigencia) {
              echo '<tr class="alert">';
            } else {
              echo '<tr>';
            }
            echo "<td><a href='show.php?id=".$c['id']."'>".$c['num_contrato']."</a></td>";
            echo "<td><a href='show.php?id=".$c['id']."'>".$c['processo']."</a></td>";
            // echo "<td><a href='show.php?id=".$c['id']."'>".$c['contratado']."</a></td>";
            // echo "<td><a href='show.php?id=".$c['id']."'>".$c['objeto']."</a></td>";
            echo "<td><a href='show.php?id=".$c['id']."'>".$c['modalidade']."</a></td>";
            echo "<td class='tvigencia'>".strftime('%d/%m/%y', strtotime($c['inicio_vigencia']))." ".strftime('%d/%m/%y', strtotime($c['fim_vigencia']))."</td>";
            echo "<td class='tvalor_contrato'><a href='show.php?id=".$c['id']."'>".number_format($c['valor_contrato'], 2, ',', '.')."</a></td>";
            echo "<td class='tvalor_previsto'><a href='show.php?id=".$c['id']."'>".number_format($c['valor_previsto'], 2, ',', '.')."</a></td>";
            echo "<td class='tobjeto'><a href='show.php?id=".$c['id']."'>".substr($c['objeto'], 0, 100)."...</a></td>";
            echo "<td class='more_info'>";
              if ($c['publicado'] == true) {
                echo "<a class='tpublicado' href='show.php?id=".$c['id']."'><span>Publicado: </span>Sim</a>";
              } else {
                echo "<a class='tpublicado' href='show.php?id=".$c['id']."'><span>Publicado: </span>Não</a>";
              }
              echo "<a class='tnum_doe' href='show.php?id=".$c['id']."'><span>Nº DOE: </span>".$c['num_doe']."</a>";
              echo "<a class='tnum_portaria' href='show.php?id=".$c['id']."'><span>Nº port.: </span>".$c['num_portaria']."</a>";
              echo "<a class='tpublica_portaria' href='show.php?id=".$c['id']."'><span>Port. pública: </span>".$c['publica_portaria']."</a>";
            echo "</td>";
            echo "<td class='status_btns'>";
            $status = explode(',', $c['status']);
              mysqli_data_seek($status_r,0);
              while($st = mysqli_fetch_assoc($status_r)) {
                if (in_array($st['id'], $status, true)) {
                  switch ($st['id']) {
                    case 1:
                      echo "<abbr title='Ag. Assinatura do Contrato' class='ass_c'>ASC</abbr>";
                      break;
                    case 2:
                      echo "<abbr title='Ag. Assinatura da Portaria' class='ass_p'>ASP</abbr>";
                      break;
                    case 3:
                      echo "<abbr title='Ag. Publicação' class='ag_pub'>AGP</abbr>";
                      break;
                    case 4:
                      echo "<abbr title='Ativo' class='ativo'>ATV</abbr>";
                      break;
                  }
                }
              }
            echo "</td>";
            echo '</tr>';
          }
        ?>
      </tbody>
    </table>
<?php endif ?>


<?php include_once '../partials/footer.php'; ?>