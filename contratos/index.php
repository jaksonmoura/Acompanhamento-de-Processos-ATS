  <?php
    include_once '../config/session.php';
    include '../partials/header.php';
    $contratos = $link->query("SELECT c.*, m.nome as modalidade from contratos as c INNER JOIN modalidades AS m where c.modalidades_id = m.id;");
    $total = $link->query("SELECT count(*) as total from contratos;");
    $status_r = $link->query("SELECT * from tipos_status;");
    $t = mysqli_fetch_assoc($total);

  ?>
    <div class="overall">
      <h1>Lista de contratos</h1>
      <div class="total_contratos">
        <div class="qte"><?php echo $t['total'] ?></div>
        <div class="qte_label">cadastrados</div>
      </div>
    </div>
    <table>
      <thead>
        <tr>
          <th class="tnum_contrato">Nº. Contrato</th>
          <th class="tprocesso">Proc.</th>
          <!-- <th class="tcontratado">Contratado</th>
          <th class="tobjeto">Objeto</th> -->
          <th class="tmodalidades_id">Modalidade</th>
          <th class="tvigencia">Vigência</th>
          <th class="tvalor_contrato">Valor do contrato</th>
          <th class="tvalor_previsto">Valor previsto (Mensal)</th>
          <th class="tpublicado">Publicado?</th>
          <th class="tnum_doe">Nº. DOE</th>
          <th class="tnum_portaria">Port. Número</th>
          <th class="tpublica_portaria">Port. Pública</th>
          <th class="tstatus">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while ($c = mysqli_fetch_assoc($contratos)){
            $two_m = strtotime("+60 days");
            $four_m = strtotime("+120 days");
            $vigencia = strtotime($c['vigencia']);
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
            echo "<td>".strftime('%d/%m/%Y', strtotime($c['vigencia']))."</td>";
            echo "<td><a href='show.php?id=".$c['id']."'>".number_format($c['valor_contrato'], 2, ',', '.')."</a></td>";
            echo "<td><a href='show.php?id=".$c['id']."'>".number_format($c['valor_previsto'], 2, ',', '.')."</a></td>";
            if ($c['publicado'] == true) {
              echo "<td><a href='show.php?id=".$c['id']."'>Sim</a></td>";
            } else {
              echo "<td><a href='show.php?id=".$c['id']."'>Não</a></td>";
            }
            echo "<td><a href='show.php?id=".$c['id']."'>".$c['num_doe']."</a></td>";
            echo "<td><a href='show.php?id=".$c['id']."'>".$c['num_portaria']."</a></td>";
            echo "<td><a href='show.php?id=".$c['id']."'>".$c['publica_portaria']."</a></td>";
            echo "<td class='status_btns'>";
            $status = explode(',', $c['status']);
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
            // echo '<td>';
            // if (LOGGED) {
            //   $url = $_SERVER['REQUEST_URI'];
            //   echo '
            //         <a href="edit.php?id='.$c['id'].'&file='.$c['name'].'&redirects_to='.$url.'"><img src="../assets/img/edit.png" alt="Editar" title="Editar"></a>
            //         <form class="fremove" action="remove.php" method="post">
            //           <input class="iremove" type="submit" value="Remover" title="Remover">
            //           <input type="hidden" name="file" value='.$c['id'].'>
            //           <input type="hidden" name="name" value='.$c['name'].'>
            //           <input type="hidden" name="redirects_to" value='.$url.'>
            //         </form>';
            //   echo "<a href='/licitacao/file/new.php?did=".$c['id']."&l=".$c['name']."'><img src='../assets/img/upload2.png'></a>";
            // }
            // echo '</td>';
            echo '</tr>';
          }
        ?>
      </tbody>
    </table>
<?php include '../partials/footer.php'; ?>