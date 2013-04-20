<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$baseDir = 'uploads/';
$abreDir = ($_GET['dir'] != '' ? $_GET['dir'] : $baseDir);
$openDir = dir($abreDir);
$strrdir = strrpos(substr($abreDir,0,-1),'/');
$backdir = substr($abreDir,0,$strrdir+1);
if(isset($_POST['send'])){
	$novaPasta = $_POST['pasta'];
	if(!file_exists($abreDir.$novaPasta)){
	mkdir($abreDir.$novaPasta, 0755);
	}else{
		echo "Pasta Existe";
	}
}
if(isset($_POST['sendImg'])){
	$img = $_FILES['img'];
	$img['name'];
	$strrimg = strrpos($img['name'],'.');
	$arqext = substr($img['name'],$strrimg);
	$nomeext = md5(time()).$arqext;
	echo move_uploaded_file($img['tmp_name'],$abreDir.'/'.$nomeext);
}
echo '<form method="post"  name="cad" enctype="multipart/form-data">
<fieldset style="width:470px; margin-bottom:10px;">
<span>Cria Pasta</span>
<input type="text" name="pasta"   />
<input type="submit" value="Cria Pasta" name="send" />
</fieldset>

<fieldset style="width:470px;" />
<input type="file" name="img"/>
<input type="submit" value="Enviar Imagens" name="sendImg" />
</fieldset>
</form>';

$openDir = dir($abreDir);


echo '<table width="500" border="1">';
while($arq = $openDir ->read()):
if($arq != '.' && $arq != '..'){
	if(is_dir($abreDir.$arq)){
echo '<tr>';
echo '<td>'.$arq.'</td>';
echo '<td><a href="dir.php?dir='.$abreDir.$arq.'/">Abre</a></td>';
echo '</tr>';		
		
	}else{
echo '<tr>';
echo '<td>'.$arq.'</td>';
echo '<td><a href="'.$abreDir.$arq.'">ver</a></td>';
echo '</tr>';
}
}
endwhile;
echo '</table>';
if($abreDir != $baseDir){
	echo '<a href="dir.php?dir='.$backdir.'">Voltar</a>';
	}
$openDir->close();
?>

 
    
  

