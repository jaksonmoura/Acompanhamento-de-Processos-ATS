<?php
  $title = "Buscar licitação";
  include '../partials/before_actions.php';
  include  '../partials/header.php';
?>
<div class="box bleft">
  <form action="list.php" method="get">
    <h3>Buscar licitação:</h3>
    <div class="field">
      <label for="year">*Ano:</label><br>
      <select name="year" required>
        <option value="">Selecione o ano:</option>
        <?php
          $result = $link->query('SELECT distinct year(created_at) as year from licitacao.directories;');
          while ($r = mysqli_fetch_assoc($result)) {
            $r = $r['year'];
            echo "<option value='$r'>$r</option>";
          }
        ?>
      </select>
    </div>

    <div class="field">
      <label for="month">*Mês:</label><br>
      <select name="month" required>
        <option value="">Selecione o mês:</option>
        <?php $months = Array( '01' => 'Janeiro', '02' => 'Fevereiro', '03' => 'Março', '04' => 'Abril', '05' => 'Maio', '06' => 'Junho', '07' => 'Julho', '08' => 'Agosto', '09' => 'Setembro', '10' => 'Outubro', '11' => 'Novembro', '12' => 'Dezembro');
        $i = 0;
        foreach ($months as $m) {
          $i++;
          echo "<option value='$i'>$m</option>";
        }
        ?>
      </select>
    </div>
    <div class="field">
      <label for="month">*Tipo:</label><br>
      <select name="category" required>
        <option value="">Selecione o tipo:</option>
        <?php
        $result = $link->query('SELECT * from categories;');
          while ($r = mysqli_fetch_assoc($result)) {
            $rid = $r['id'];
            $rname = $r['name'];
            echo "<option value='$rid'>$rname</option>";
          }
        ?>
      </select>
    </div>
    <span><small>* Campos obrigatórios.</small></span>
    <div class="actions"><input type="submit" value="Buscar"></div>
  </form>
</div>