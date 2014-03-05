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
     <title><?php echo $title; ?> - Licitações - ATS</title>
    <?php else: ?>
     <title>Licitações - ATS</title>
    <?php endif ?>
     <script src="../assets/js/jquery.js"></script>
     <script src="../assets/js/jquery-ui-1.10.4.custom.min.js"></script>
     <link rel="stylesheet" href="../assets/css/style.css"/>
     <link rel="stylesheet" href="../assets/css/jquery-ui-1.10.4.custom.min.css"/>
     <script>

       $(function() {
         $( document ).tooltip({
            track: true
          });
         $( "#datepicker" ).datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy-mm-dd',
            onClose: function(dateText, inst) {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, month, 1));
            }
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
      <div class="logo"><a href="/ac/dir/list.php"><img src="../assets/img/icon.png" alt="ATS" title='Licitação - ATS'/>Contratos</a></div>
      <nav class="s_links">
        <ul>
          <li><a href="/ac/contratos/index.php">Início</a></li>
          <li><a href="/ac/contratos/new.php">Novo contrato</a></li>
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