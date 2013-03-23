<?php
// Get the absolute path and include config data
define('ABSPATH', dirname(__FILE__) . '/');
require(ABSPATH . 'inc/config.php');

// Performance gain
ob_start('ob_gzhandler');

// Set the content type that are going to output
header('Content-Type: text/html; charset=utf-8');

// Start the session
session_set_cookie_params(0, '/hackgame/');
session_start();
?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage">
<title>HackGame - Let's Hack!</title>
<link rel="stylesheet" href="/hackgame/resources/styles/global.v1.css">
<meta itemprop="name" content="HackGame - Let's Hack">
<meta name="description" content="Un juego de hacker con record de tiempo, requiriendo la máxima concentración para poder pasar con mínimo de tiempo posible.">
<body>
<?php
if (isset($_SESSION['name'])){
  if (isset($_POST['reset']) && '1' == $_POST['reset']) {
    session_destroy();
    header('location: ' . $_SERVER['REQUEST_URI'] . '/success');
    exit;
  }

  // Check is the game started
  if (!isset($_SESSION['currentLevel'])) {
    $_SESSION['currentLevel'] = $currentLevel = 1;
  } else {
    $currentLevel = $_SESSION['currentLevel'];
  }


  $levelLabel = array(1 => 'Uno', 2 => 'Dos', 3 => 'Tres', 4 => 'Cuatro', 5 => 'Terminado');
?>
<h1 id="logo" class="small">HackGame</h1>
<div id="globalBody">
<div id="contentWrapper">
<article id="mainContent">
<h1 id="levelTitle">Nivel <span id="levelNumber"><?php echo $levelLabel[$currentLevel]; ?></span></h1>
<div id="levelContent">
<?php
  if (!isset($_SESSION['level'][$currentLevel]['startTime'])) {
    $_SESSION['level'][$currentLevel]['startTime'] = $_SERVER['REQUEST_TIME'];
  }

  function generateRamdomPassword() {
    $passwords = array(
      'password', 
      '123456', 
      '12345678', 
      'abc123', 
      'qwerty', 
      'monkey', 
      'letmein', 
      'dragon', 
      '111111', 
      'baseball', 
      'iloveyou', 
      'trustno1', 
      '1234567', 
      'sunshine', 
      'master', 
      '123123', 
      'welcome', 
      'shadow', 
      'ashley', 
      'football', 
      'jesus', 
      'michael', 
      'ninja', 
      'mustang', 
      'password1', 
      'seinfeld', 
      'winner', 
      'purple', 
      'sweeps', 
      'contest', 
      'princess', 
      'maggie', 
      '9452', 
      'peanut', 
      'ginger', 
      'buster', 
      'tigger', 
      'cookie', 
      'george', 
      'summer', 
      'taylor', 
      'bosco', 
      'bailey'
    );
    return $passwords[mt_rand(0, sizeof($passwords) - 1)];
  }

  include(ABSPATH . '/modules/level' . $currentLevel . '.php');
?>
</div>
</article>
<div id="sidebar">
<h1 id="progressTitle">Progreso</h1>
<ul id="levelList">
<li class="<?php echo 1 == $currentLevel ? 'current' : (1 < $currentLevel ? 'unlocked' : 'locked'); ?>"><strong>Nivel 1</strong> Nunca comentar contraseñas</li>
<li class="<?php echo 2 == $currentLevel ? 'current' : (2 < $currentLevel ? 'unlocked' : 'locked'); ?>"><strong>Nivel 2</strong> No confiar verificación javascript</li>
<li class="<?php echo 3 == $currentLevel ? 'current' : (3 < $currentLevel ? 'unlocked' : 'locked'); ?>"><strong>Nivel 3</strong> No sirve ocultar códigos javascript</li>
<li class="<?php echo 4 == $currentLevel ? 'current' : (4 < $currentLevel ? 'unlocked' : 'locked'); ?>"><strong>Nivel 4</strong> Ingeniería reversa</li>
<li id="honorWall">Panel de honor</li>
</ul>
<p id="startAgain">¡Empezar de nuevo!</p>
</div>
</div>
</div>
<footer id="globalFooter">
<div id="social">
<div class="g-plusone"></div>
<script type="text/javascript">
window.___gcfg = {lang: 'es-419'};

(function() {
  var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
  po.src = 'https://apis.google.com/js/plusone.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
</div>
<p>Fong-Wan &copy; <?php echo date('Y'); ?></p>
<p>Diseñado y programado por <a href="http://fong-wan.me/">Fong-Wan Chau</a>.</p>
</footer>
<script src="/hackgame/resources/scripts/global.js"></script>
<?php
} else {
  if (!empty($_GET['id'])) {
    include(ABSPATH . '/modules/record.php');
  } else {
    include(ABSPATH . '/modules/main.php');
  }
}
?>