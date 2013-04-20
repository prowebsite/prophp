<?php
ob_start(); session_start();
require_once("../dts/dbaSis.php");
require_once("../dts/getSis.php");
require_once("../dts/outSis.php");
require_once("../dts/setSis.php");

if(!$_SESSION['autUsers']){
	header('Location: index.php');
	}else{
	$autUsers = $_SESSION['autUsers']['id'];
	$readUsers = read('up_users',"WHERE id = '$autUsers'");	
	if($readUsers){
		foreach($readUsers as $seg);
		if($seg['nivel'] == 1 || $seg['nivel'] == 2){
			
			}else{
				header('Location: '.BASE.'/pagina/perfil');
			}
		}else{
			
			header('Location: index.php');
			}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Painel Administrativo - Pró Notícias</title>

<meta name="title" content="Painel Administrativo - Pró Notícias" />
<meta name="description" content="Área restrita aos administradores do site PRÓ NOTÍCIAS" />
<meta name="keywords" content="Login, Recuperar Senha, Pró Notícias" />

<meta name="author" content="AUTOR DO SITE" />   
<meta name="url" content="URL DO SITE" />
   
<meta name="language" content="pt-br" /> 
<meta name="robots" content="NOINDEX,NOFOLLOW" /> 

<link rel="icon" type="image/png" href="ico/chave.png" />
<link rel="stylesheet" type="text/css" href="css/painel.css" />
<link rel="stylesheet" type="text/css" href="css/geral.css" />
</head>
<body>

<div id="painel">
	<div id="header">
<?php 
require_once('header.php');
?>
    
    <div id="content">
    <?php require_once('menu.php') ;?>
    <div class="pg">
<?php
if(empty($_GET['exe'])){
require_once('home.php');	
}elseif(file_exists($_GET['exe'].'.php')){
	require_once($_GET['exe'].'.php');
	}else{
	echo '<span class="ms in">Desculpe página que você esta tentando acessar e invalida</span>';	
	}
?>
    
    	
    </div><!-- /content -->
    </div><!--pg-->
    
<div style="clear:both"></div> 
<div id="footer">Desenvolvido por <a href="http://studio.upinside.com.br" title="Sistema desenvolvido por Robson V. Leite">UpInside Tecnologia</a></div>   
</div><!-- //painel -->



</body>
<?php include_once('../js/jscSis.php');  ?>
<?php require_once('js/jsc.php'); ob_end_flush(); ?>

</html>