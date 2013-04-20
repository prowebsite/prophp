<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$stringAll = '
<strong>Ainda não é aluno?</strong>
Crie sua conta para realizar compras e começar a <a href="http://www.prowebsite.com.br">estudar em </a>nossa plataforma online!
Conte com toda tecnologia e atendimento de nosso campus e com a didática que <em>você já conhece de nosso portal</em>!
Campus UP, Feito para você aprender!
<a href="#">Matricule-se</a> ';

function lmWord($string, $words = 100){
	$string = strip_tags($string);
	$count = strlen($string);
	if($count <= $words){
		return $string;
	}else{
		$strpos = strrpos(substr($string,0,$words),' ');
		 return substr($string,0,$strpos);
	}
	
	
	}
echo lmWord($stringAll,200);
?>