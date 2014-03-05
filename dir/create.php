<?php
include_once '../partials/header.php';
include_once '../config/session.php';
 ?>
<div class="box tcenter">
<?php
        $name = $_POST['name'];
        $category_id = $_POST['category'];
        $date = $_POST['date'];
        $link->query("INSERT INTO directories (name, category_id, created_at) VALUES ('$name', '$category_id', '$date')");
        $dirs = $link->query("SELECT * from directories WHERE name = '$name'");
        $d = mysqli_fetch_assoc($dirs);
        $_SESSION['message'] = 'Diretório criado com sucesso!';
        header('location: ../file/new.php?did='.$d['id']);
?>
</div>