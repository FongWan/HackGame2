<?php
if (!isset($_SESSION['level'][2]['password'])) {
  $_SESSION['level'][2]['password'] = $_SESSION['level'][1]['password'];
}

$password = $_SESSION['level'][2]['password'];
?>
<blockquote id="message">
<p>¿Fácil? En este nivel ya no es simplemente mirar el código fuente.</p>
<p>Te facilito un poquito, usa la misma contraseña del nivel 1.</p>
</blockquote>
<form id="levelQuest" method="post">
<p>Contraseña:</p>
<p><input type="password" name="password" class="input" id="password"> <input type="submit" class="button" value="Ingresar"></p>
</form>
<p id="errorMessage"><?php
if (isset($_POST['password'])) {
  if ($password == trim($_POST['password'])) {
    $_SESSION['currentLevel'] = 3;
    $_SESSION['level'][2]['timeDiff'] = $_SERVER['REQUEST_TIME'] - $_SESSION['level'][2]['startTime'];
    header('location: ' . $_SERVER['REQUEST_URI'] . '/success');
    exit;
  } else {
    echo '¡Contraseña incorrecta!';
  }
}
?></p>
<script>
function checkSubmit() {
  var password = document.getElementById('password');
  if ('undefined' != typeof password) {
    if ('' == password.value) {
      alert('Error: La contraseña no puede ser vacío.');
      password.focus();
      return false;
    } else if ('' != password.value) {
      alert('Error: La contraseña debe ser vacío.');
      password.focus();
      return false;
    }
  }
}

document.getElementById('levelQuest').onsubmit = checkSubmit;
</script>
<p id="tip">Nunca hay que confiar las validaciones de campos por parte del cliente, también deben revisar por parte del servidor.</p>