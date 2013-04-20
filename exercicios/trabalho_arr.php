<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$curso = array('nosso','curso','de','PHP');
print_r($curso);
echo '<hr />';
$join = join(" ",$curso);
echo $join.'<hr />';
$string = 'nosso curso de PHP';
echo explode(" ",$string).'<hr />';
print_r($string);
?>