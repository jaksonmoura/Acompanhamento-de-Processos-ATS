<!--
  Desenvolvedores: Jakson Rochelly
-->
<!doctype html>
 <html>
   <head>
    <?php
    include_once 'before_actions.php';
    header('Content-Type: text/html; charset=utf8'); ?>
    <?php if (isset($title)): ?>
     <title><?php echo $title; ?> - Acomp. de Contratos - ATS</title>
    <?php else: ?>
     <title>Acomp. de Contratos - ATS</title>
    <?php endif ?>
     <script src="../assets/js/jquery.js"></script>
     <script src="../assets/js/jquery-ui-1.10.4.custom.min.js"></script>
     <script src="../assets/js/jquery.maskMoney.js"></script>
     <script src="../assets/js/jquery.freezeheader.js"></script>
     <link rel="stylesheet" href="../assets/css/style.css"/>
     <link rel="stylesheet" href="../assets/css/jquery-ui-1.10.4.custom.min.css"/>
     <script>
        $(document).ready(function() {
            $("#tb_content").freezeHeader();
        });
       $(function() {
         $( document ).tooltip({
            track: true
          });
       });
       </script>
   </head>
   <body>
      <?php
      if (isset($_SESSION['message']) and strlen($_SESSION['message']) > 0) : ?>
          <div class="notice">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
             ?>
          </div>
      <?php endif ?>
      <script type="text/javascript">$('.notice').hide().slideDown().delay(5000).slideUp();</script>
    <header>
      <div class="logo"><a href="/ac/dir/list.php"><img src="../assets/img/icon.png" alt="ATS" title='Acomp. de Contratos - ATS'/>Contratos</a></div>
      <nav class="s_links">
        <ul>
          <li><a href="/ac/contratos/index.php">Início</a></li>
          <li><a href="/ac/contratos/new.php">Novo contrato</a></li>
          <li><a href="/ac/contratos/filter.php">Filtro</a>
            <ul>
              <li><a href="/ac/contratos/expires.php">Vencimentos</a></li>
            </ul>
          </li>
        </ul>
      </nav>
      <nav class="user_session">
        <ul>
          <?php if (LOGGED): ?>
          <li><a href="/ac/session/logout.php">Sair</a></li>
          <?php else: ?>
          <li><a href="/ac/session/login.php">Entrar</a></li>
          <?php endif ?>
        </ul>
      </nav>
    </header>
    <div class="wrapper">
      <div class="main_content">
      <div class="container">