
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
$string = 'estamo apredendo Php com a Prowebsite';
echo $string.'<hr>';
echo strtolower($string).'<hr>';
echo strtoupper($string).'<hr>';
echo ucfirst($string).'<hr>';
echo ucwords($string).'<hr>';
$texto = "ola tem uma duvida \n pode me ajuda".'<hr>';;
echo nl2br($texto);
$script = "olá <?php echo 'tudo bem' ?>";
$tags = 'ola o endereço <a href="#">ola veja</a>';
echo strip_tags($tags);
?>