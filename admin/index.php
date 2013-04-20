<?php
ob_start();
session_start();
require('../dts/dbaSis.php');
require('../dts/outSis.php');
if(!empty($_SESSION['autUsers'])){

header('Location: index2.php');	
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

<meta name="author" content="Marcelo Melo" />   
<meta name="url" content="http://www.prowebsite.com.br" />
   
<meta name="language" content="pt-br" /> 
<meta name="robots" content="NOINDEX,NOFOLLOW" /> 

<link rel="icon" type="image/png" href="ico/chave.png" />
<link rel="stylesheet" type="text/css" href="css/login.css" />
<link rel="stylesheet" type="text/css" href="css/geral.css" />

</head>

<body>

<div id="login">

	<img src="images/login-logo.png" alt="Pro Notícias - Área administrativa | Login" title="Pro Notícias - Área administrativa | Login" />
    <?php
	if(isset($_POST['sendLogin'])){
		$f['email']		= mysql_real_escape_string($_POST['email']);
		$f['senha']		= mysql_real_escape_string($_POST['senha']);
		$f['salva']		= mysql_real_escape_string($_POST['remember']);
		if(!$f['email'] || !valMail($f['email'])){
			echo '<span class="ms al">O campo E-mail esta vazio ou não tem formato válido!</span>';
		}elseif(strlen($f['senha']) < 5 || strlen($f['senha']) > 12){
			echo '<span class="ms al">Senha deve ter entre 5 a 12 caracteres!</span>';
			
			}else{
			$autEmail = $f['email'];	
			$autSenha = md5($f['senha']);
			$sql_senha = read('up_users',"WHERE email = '$autEmail'");
			if($sql_senha){
				foreach($sql_senha as $int);
				if($autEmail == $int['email'] && $autSenha == $int['senha']){
					if($int['nivel'] == 1 || $int['nivel'] == 2 ){
					if($f['salva']){
						$autUsers = base64_encode($autEmail).'&'.base64_encode($f['senha']);
					 setcookie('autUsers',$autUsers,time()+60*60*24*30,'/');	
					}else{
					 setcookie('autUsers','',time()+3600,'/');	
					}
					 $_SESSION['autUsers'] = $int;
					 header('Location: '.$_SERVER['PHP_SELF']);
					}else{
					  echo '<span class="ms in">Seu niel não permite acesso a esta area. Vamos redirecionar ao  login de usuários</span>';	
						header('Refresh: 5;url='.BASE.'/pagina/login');
					}
				}else{
					echo '<span class="ms no">Senha não confere</span>';
				}
			}else{
			echo '<span class="ms no">E-mail não existe e nosso banco de dados</span>';	
			}
			}
		
	}elseif(!empty($_COOKIE['autUsers'])){
		$cookie = $_COOKIE['autUsers'];
		$cookie = explode('&',$cookie);
		$f['email'] = base64_decode($cookie[0]);
		$f['senha'] = base64_decode($cookie[1]);
		$f['salva'] = 1;
		}

	
	?>
       <div style="display:none">
		<span class="ms ok">Login efetuado com sucesso!</span>
        <span class="ms no">Erro</span>
        <span class="ms al">Alerta</span>
        <span class="ms in">Informação</span>
    </div>
    <?php if(!$_GET['remember']){  ?>
    	<form name="login" action="" method="post">
        	<label>
            	<span>E-mail:</span>
                <input type="text" class="radius" name="email" value="<?php if($f['email']) echo $f['email'];  ?>" />
            </label>
            <label>
            	<span>Senha:</span>
                <input type="password" class="radius" name="senha" value="<?php if($f['senha']) echo $f['senha'];  ?>" />
            </label>
            <input type="submit" value="Logar-se" name="sendLogin" class="btn" />
            
            <div class="remember">
            	<input type="checkbox" name="remember" value="1" <?php if($f['salva']) echo 'checked="checked"';  ?> /> Lembrar meus dados de acesso!
            </div>
            <a href="index.php?remember=true" class="link" title="Esqueci minha senha!">Esqueci minha senha!</a>
        </form>
       <?php
	}else{
		if(isset($_POST['sendRecover'])){
		 $revove = mysql_real_escape_string($_POST['email']);
		 $rec = read('up_users',"WHERE email = '$revove'");
		 if(!$rec){
			echo '<span class="ms no">Email nao confere</span>'; 
		 }else{
			foreach($rec as $recD);
			if($recD['nivel'] == 1 || $recD['nivel'] == 2){
				$msg =  '<h3 style="font:16 \'Trebuchet MS\', Arial, Helvetica, sans-serif; color:#099;">Prezado '.$recD['nome'].', Recupre seu acesso</h3><p style="font:bold 12px Arial, Helvetica, sans-serif; color:#069;">E-mail '.$recD['email'].'<br>Senha: '.$recD['code'].'</p><hr><p style="font:bold 12px Arial, Helvetica, sans-serif; color:#666;">Recomendamos que você Altere seu Dados em seu Perfil Após efetua seu login</p><hr>
<p style="font:bold 12px Arial, Helvetica, sans-serif; color:#666;">Atenciosamente Administração - '.date('d/m/Y - H:i:s').'<a style="color:#900;" href="http://www.prowebsite.com.br" title="tecnologia">tecnologia Prowebsite</a>';
				sendMail('Recupere seu Dados',$msg,MAILUSER,'Prowebsite',$recD['email'],'isso e teste');
			}else{
					  echo '<span class="ms in">Seu niel não permite acesso a esta area. Vamos redirecionar ao  login de usuários</span>';	
						header('Refresh: 5;url='.BASE.'/pagina/login');				
			}
		 }
		}
		?>
	    
        <form name="recover" action="" method="post">
        	<span class="ms in">Informe seu e-mail para que possamos enviar seus dados de acesso!</span>
        	<label>
            	<span>E-mail:</span>
                <input type="text" class="radius" name="email" />
                
            </label>
            <input type="submit" value="Recuperar dados" name="sendRecover" class="btn" />
             <a href="index.php" class="link" title="Voltar">Voltar!</a>
            
            
        </form>
    <?php
	}
	?>
</div><!-- //login -->

</body>
<?php
ob_end_flush();
?>
</html>