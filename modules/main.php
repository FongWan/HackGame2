<?php
if (!empty($_POST['name'])) {
  $_SESSION['name'] = trim($_POST['name']);
  header('location: ' . $_SERVER['REQUEST_URI'] . '/success');
  exit;
}
?>
<h1 id="logo" class="big">HackGame</h1>
<p>Este es un juego con record de tiempo. Prepara tu máxima concentración y cuando estés listo, ingresa tu nombre:
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<p><input type="text" name="name" class="input"> <input type="submit" class="button" value="Comenzar"></p>
</form>
<div id="socialMain">
<p class="snippetText" itemprop="description">Un juego de hacker con record de tiempo, requiriendo la máxima concentración para poder pasar con mínimo de tiempo posible.</p>
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