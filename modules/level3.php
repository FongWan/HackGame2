<?php
if (!isset($_SESSION['level'][3]['password'])) {
  $_SESSION['level'][3]['password'] = generateRamdomPassword();
}

$password = $_SESSION['level'][3]['password'];

if (!isset($_SESSION['level'][3]['splittedPassword'])) {
  $splittedPassword = array();
  $splittedPassword[0] = substr($password, 0, mt_rand(1, (int) (strlen($password) / 2) - 1));
  $splittedPassword[1] = substr($password, strlen($splittedPassword[0]), mt_rand(1, (int) (strlen($password) / 2) - 1));
  $splittedPassword[2] = substr($password, strlen($splittedPassword[0] . $splittedPassword[1]));

  function escape($string) {
    $output = array();
    for ($i = 0, $length = strlen($string); $i < $length; ++$i) {
      $output[] = '%' . dechex(ord($string{$i}));
    }

    return implode('', $output);
  }

  $_SESSION['level'][3]['splittedPassword'] = $splittedPassword = array_map('escape', $splittedPassword);
} else {
  $splittedPassword = $_SESSION['level'][3]['splittedPassword'];
}
?>
<blockquote id="message">
<p>Ok, al parecer sabes algo de javascript... ¿y ahora?</p>
</blockquote>
<form id="levelQuest" method="post">
<p>Contraseña:</p>
<p><input type="password" name="password" class="input" id="password"> <input type="submit" class="button" value="Ingresar"></p>
</form>
<p id="errorMessage"><?php
if (isset($_POST['password'])) {
  if ($password == trim($_POST['password'])) {
    $_SESSION['currentLevel'] = 4;
    $_SESSION['level'][3]['timeDiff'] = $_SERVER['REQUEST_TIME'] - $_SESSION['level'][3]['startTime'];
    header('location: ' . $_SERVER['REQUEST_URI'] . '/success');
    exit;
  } else {
    echo '¡Contraseña incorrecta!';
  }
}
?></p>
<script>
var p1 = '%66%75%6e%63%74%69%6f%6e%20%63%68%65%63%6b%53%75%62%6d%69%74%28%29%7b%76%61%72%20%61%3d%64%6f%63%75%6d%65%6e%74%2e%67%65%74%45%6c%65%6d%65%6e%74%42%79%49%64%28%22%70%61%73%73%77%6f%72%64%22%29%3b%69%66%28%22%75%6e%64%65%66%69%6e%65%64%22%21%3d%74%79%70%65%6f%66%20%61%29%7b%69%66%28%22<?php echo $splittedPassword[0]; ?>';
var p2 = '<?php echo $splittedPassword[2]; ?>%22%3d%3d%61%2e%76%61%6c%75%65%29%72%65%74%75%72%6e%21%30%3b%61%6c%65%72%74%28%22%45%72%72%6f%72%3a%20%43%6f%6e%74%72%61%73%65%f1%61%20%69%6e%63%6f%72%72%65%63%74%61%2e%22%29%3b%61%2e%66%6f%63%75%73%28%29%3b%72%65%74%75%72%6e%21%31%7d%7d%64%6f%63%75%6d%65%6e%74%2e%67%65%74%45%6c%65%6d%65%6e%74%42%79%49%64%28%22%6c%65%76%65%6c%51%75%65%73%74%22%29%2e%6f%6e%73%75%62%6d%69%74%3d%63%68%65%63%6b%53%75%62%6d%69%74%3b';
eval(unescape(p1) + unescape('<?php echo $splittedPassword[1]; ?>' + p2));
</script>
<p id="tip">Este es un método clásico para ocultar el contenido de los códigos javascript.</p>