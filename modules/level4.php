<?php
if (!isset($_SESSION['level'][4]['password'])) {
  $_SESSION['level'][4]['password'] = generateRamdomPassword();
}

$password = $_SESSION['level'][4]['password'];

if (isset($_POST['password']) && $password == trim($_POST['password'])) {
  $_SESSION['currentLevel'] = 5;
  $_SESSION['level'][4]['timeDiff'] = $_SERVER['REQUEST_TIME'] - $_SESSION['level'][4]['startTime'];
  header('location: ' . $_SERVER['REQUEST_URI'] . '/success');
  exit;
}
?>
<blockquote id="message">
<p>Interesante... Tus conocimientos básicos están bien, pero llegarás hasta aquí, porque solo los maestros de lógica pasarán.</p>
</blockquote>
<form id="levelQuest" method="post">
<p>Contraseña:</p>
<p><input type="password" name="password" class="input" id="password"> <input type="submit" class="button" value="Ingresar"></p>
</form>
<p id="errorMessage">¡Contraseña incorrecta!</p>
<script>
/**
 * Pseudo md5 hash function
 * @param {string} string
 * @param {string} method The function method, can be 'ENCRYPT' or 'DECRYPT'
 * @return {string}
 */
function pseudoHash(string, method) {
  // Default method is encryption
  if (!('ENCRYPT' == method || 'DECRYPT' == method)) {
    method = 'ENCRYPT';
  }

  // Run algorithm with the right method
  if ('ENCRYPT' == method) {
    // Variable for output string
    var output = '';

    // Algorithm to encrypt
    for (var x = 0, y = string.length, charCode, hexCode; x < y; ++x) {
      charCode = string.charCodeAt(x);

      if (128 > charCode) {
        charCode += 128;
      } else if (127 < charCode) {
        charCode -= 128;
      }

      charCode = 255 - charCode;

      hexCode = charCode.toString(16);

      if (2 > hexCode.length) {
        hexCode = '0' + hexCode;
      }
      
      output += hexCode;
    }

    // Return output
    return output;
  } else if ('DECRYPT' == method) {
    // DECODE MISS
    // Return ASCII value of character
    return string;
  }
}

document.getElementById('password').value = pseudoHash('<?php
$output = '';
for ($x = 0, $y = strlen($password), $charCode; $x < $y; ++$x) {
  $charCode = ord($password[$x]);
  if (128 > $charCode) {
    $charCode += 128;
  } elseif (127 < $charCode) {
    $charCode -= 128;
  }
  
  $charCode = 255 - $charCode;

  $output .= sprintf("%02x", $charCode);
}

echo $output;
?>', 'DECRYPT');
</script>
<p id="tip">Es importante saber la ingeniería reversa para muchos trabajos.</p>