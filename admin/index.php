
<?php  
require_once('common/header.php');
require_once('common/left-menu.php');

$m = !empty($_GET['m']) ? $_GET['m'] : 'site';
  $a = !empty($_GET['a']) ? $_GET['a'] : 'index';

  $file = __DIR__.'/modules/'.$m.'/'.$a.'.php';

  if (file_exists($file)) {
    include $file;
  }

require_once('common/footer.php');

?>