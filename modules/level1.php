<?php
if (!isset($_SESSION['level'][1]['password'])) {
  $_SESSION['level'][1]['password'] = generateRamdomPassword();
}

$password = $_SESSION['level'][1]['password'];
?>
<blockquote id="message">
<p>Intenta hackear la contraseña e ingresar al siguiente nivel.</p>
</blockquote>
<form id="levelQuest" method="post">
<!--
  Eliminar este comentario antes de ponerlo online
  Contraseña de prueba: <?php echo $password; ?>

-->
<p>Contraseña:</p>
<p><input type="password" name="password" class="input" id="password"> <input type="submit" class="button" value="Ingresar"></p>
</form>
<p id="errorMessage"><?php
if (isset($_POST['password'])) {
  if ($_SESSION['level'][1]['password'] == trim($_POST['password'])) {
    $_SESSION['currentLevel'] = 2;
    $_SESSION['level'][1]['timeDiff'] = $_SERVER['REQUEST_TIME'] - $_SESSION['level'][1]['startTime'];
    header('location: ' . $_SERVER['REQUEST_URI'] . '/success');
    exit;
  } else {
    echo '¡Contraseña incorrecta!';
  }
}
?></p>
<p id="tip">Recuerda eliminar los comentarios innecesarios del HTML antes de poner tus proyectos en línea.</p>