<?php
function getHome(){
	$url = $_GET['url'];
	$url = explode('/',$url);
	$url[0] = ($url[0] == NULL ? 'index' : $url[0]);
	
	if(file_exists('tpl/'.$url[0].'.php')){
		require_once('tpl/'.$url[0].'.php');
	}elseif(file_exists('tpl/'.$url[0].'/'.$url[1].'.php')){
		require_once('tpl/'.$url[0].'/'.$url[1].'.php');
	}else{
	require_once("tpl/404.php");	
	}
   
	}
/* Função de Categoria*/
function getCat($catId, $campo = NULL){
	
	$categoria = mysql_real_escape_string($catId);
	$sqlCat = read('up_cat',"WHERE id = $categoria");
	if($sqlCat){
		foreach($sqlCat as $int){
		echo	$int[$campo];
		}
		}else{
			echo 'erro ao cat';
		}
	}

function getAuto($autoId, $campo = NULL){
	require_once("dbaSis.php");
	$autor = mysql_real_escape_string($autoId);
	$sqlAuto = read('up_users',"WHERE id = $autor");

	//$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
	if($sqlAuto){
		foreach($sqlAuto as $linha);
			if(!$linha['foto']):
			$gravatar = 'http://www.gravatar.com/avatar/';
			$gravatar .= md5(strtolower(trim($linha['email'])));
			$gravatar .= "?d=mm&s=180";
			$linha['foto'] = $gravatar;
		endif;
		if(!$campo){
		return $linha;
		}else{
		return $linha[$campo];
		}
		}else{
			echo 'erro ao ler autor';
		}
	
	}
	
function getUsers($users, $nivel = NULL){
	if($nivel != NULL){
		$readUsers = read('up_users',"WHERE id = '$users'");
		if($readUsers){
			foreach($readUsers as $bol);
			if($bol['nivel'] <= $nivel && $bol['nivel'] != 0 && $bol['nivel'] <= 4){
				return true;
				}else{
				return false;	
				}
			}else{
				return false;
			}
		}else{
			 return true;
		}
	
	
	
	}	
?>