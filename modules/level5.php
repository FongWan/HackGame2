<?php
$totalTime = 0;
for ($i = 4; $i > 0; --$i) {
  $totalTime += $_SESSION['level'][$i]['timeDiff'];
}

if (empty($_SESSION['recordId'])) {
  $PDO = new PDO(PDO_DSN, PDO_USER, PDO_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8, time_zone = \'' . TIMEZONE . '\''));


  $PDO->exec('INSERT INTO `record` (`name`, `version`, `spend`) VALUES (' . $PDO->quote($_SESSION['name']) . ', ' . $PDO->quote('2.00') . ', ' . $totalTime . ')');
  $recordId = $PDO->lastInsertId();
  $_SESSION['recordId'] = $recordId;

  $query = array();
  for ($i = 4; $i > 0; --$i) {
    $timeDiff = $_SESSION['level'][$i]['timeDiff'];
    $query[] = '(' . $recordId . ', ' . $i . ', ' . $timeDiff . ')';
  }
  $PDO->exec('INSERT INTO `record_detail` (`recordId`, `level`, `spend`) VALUES ' . implode(',', $query));
}

$minutes = (int) ($totalTime/60);
$seconds = (int) ($totalTime%60);

if ($seconds) {
  $secondsText = 'segundo';

  if (1 < $seconds) {
    $secondsText .= 's';
  }

  if ($minutes) {
    $minutesText = 'minuto';

    if (1 < $minutes) {
      $minutesText .= 's';
    }

    $displayText = $minutes . ' ' . $minutesText . ' y ' . $seconds . ' ' . $secondsText;
  } else {
    $displayText = $seconds . ' segundos';
  }
} else {
  $minutesText = 'minuto';

  if (1 < $minutes) {
    $minutesText .= 's';
  }

  $displayText = $minutes . ' ' . $minutesText;
}
?>
<p><strong>¡Felicidades <?php echo $_SESSION['name']; ?>!</strong> Lograste pasar todos los niveles.</p>
<p><strong>Tu record actual en HackGame v2.00:</strong></p>
<div id="record"><input class="input" value="<?php echo $displayText; ?>" readonly> <div id="shareButton"><div class="g-plus" data-action="share" data-href="<?php echo $_SERVER['REQUEST_URI'] . $_SESSION['recordId']; ?>" data-annotation="none" data-height="24"></div></div></div>
<p class="snippetText" itemprop="description">¡Hackeé todos los niveles de HackGame en <?php echo $displayText; ?>!</p>
<p>¿Sabias qué, la diferencia entre un hacker y un cracker, es que los hackers construyen cosas nuevas e interesantes, mientras que los crackers destruyen las cosas?</p>
<p>Te recuerdo que:</p>
<ol>
<li>El mundo está lleno de problemas fascinantes que esperan ser resueltos.</li>
<li>Ningún problema tendría que resolverse dos veces.</li>
<li>El aburrimiento y el trabajo rutinario son perniciosos.</li>
<li>La libertad es buena.</li>
<li>La actitud no es sustituto para la competencia.</li>
</ol>
<p><strong>¡Espero que sigas dando valor a nuestra comunidad y gracias por tu participación!</strong></p>