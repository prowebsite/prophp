<?php
function setViews($setId){
	$setId = mysql_real_escape_string($setId);
	$readViews = read('up_post',"WHERE id = '$setId'");
	
	 foreach($readViews as $int);
	 $bios = $int['visitas'];
	 $bios = $bios+1; 
	 $dataViews = array(
	 'visitas' => $bios
	 );
	update('up_post',$dataViews,"id= '$setId'");
	
	}

function setHome(){
	echo BASE;
	
	}
	function setArq($nomeArquivo){
		if(file_exists($nomeArquivo.'.php')){
			include($nomeArquivo.'.php');
		}else{
			echo 'Erro ao incluir <strong>'.$nomeArquivo.'.php</strong>, arquivo ou caminho não conferem!';	
		}
	}
?>