<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$string = '
<strong>Ainda não é aluno?</strong>
Crie sua conta para realizar compras e começar a <a href="http://www.prowebsite.com.br">estudar em </a>nossa plataforma online!
Conte com toda tecnologia e atendimento de nosso campus e com a didática que <em>você já conhece de nosso portal</em>!
Campus UP, Feito para você aprender!
<a href="#">Matricule-se</a> ';
//eliminar html

$string = strip_tags($string);
echo $string;
$count = strlen($string);
echo $count.'<hr />';
$legent = 150;
$corte = substr($string,0,$legent);
$pos = strrpos($corte,' ');
$final = substr($string,0,$pos);
echo $final;
?>