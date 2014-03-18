	<?php
    include '../config/session.php';
    include '../partials/header.php';
    if (isset($_POST['c_id'])){
      $c = $_POST['c_id'];
  	  $link->query("DELETE FROM contratos.contratos WHERE id = ".$c);
      if ($link->affected_rows>0) {
        $_SESSION['message'] = "Removido com sucesso";
      } else {
        $_SESSION['message'] = "Não foi possível remover, tente novamente";
      }
    } else {
      $_SESSION['message'] = "Não foi possível remover, tente novamente";
    }
    header("location: /ac/contratos/index.php");
    ?>
<?php
include '../partials/footer.php';
 ?>