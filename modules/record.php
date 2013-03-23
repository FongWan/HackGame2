<?php
header('Cache-Control: max-age=86400, must-revalidate', true);
$recordId = (int) $_GET['id'];

$PDO = new PDO(PDO_DSN, PDO_USER, PDO_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8, time_zone = \'' . TIMEZONE . '\''));

$dataQuery = $PDO->query('SELECT `name`, `version`, `spend` FROM `record` WHERE `id` = ' . $recordId);
$dataResult = $dataQuery->fetch(PDO::FETCH_ASSOC);

if ($dataResult) {
  $totalTime = $dataResult['spend'];

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
<p class="snippetText" itemprop="description">¡Yo <?php echo $dataResult['name']; ?> logré hackear todos los niveles de HackGame v<?php echo $dataResult['version']; ?> en <?php echo $displayText; ?>! #HackGame</p>
<script>location.replace('/hackgame/');</script>
<?php
} else {
  header('location: /hackgame/', true, 302);
  exit;
}