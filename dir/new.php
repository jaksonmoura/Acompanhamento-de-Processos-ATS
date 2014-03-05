<?php
include_once '../config/session.php';
include_once '../partials/before_actions.php';
include_once '../partials/header.php';
?>
</head>
<body>
  <div class="box">
    <h3>Criar diretório:</h3>
    <form action="create.php" id="uploader" enctype="multipart/form-data" method="post" >
      <div class="field">
        <label>Nome do diretório</label>
        <input type="text" name="name" id="name" required/>
      </div>
      <div class="field">
        <label>Ano de referência</label>
        <input type="text" name="date" id="datepicker">
      </div>
      <div class="field">
        <label>Categoria</label>
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
      <div class="actions"><input type="submit" value='Enviar'></div>
    </form>
  </div>
<?php include_once '../partials/footer.php'; ?>