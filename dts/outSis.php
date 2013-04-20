<?php 
/*****************************
GERA RESUMOS
*****************************/

	function lmWord($string, $words = '100'){
		$string 	= strip_tags($string);
		$count		= strlen($string);
		
		if($count <= $words){
			return $string;	
		}else{
			$strpos = strrpos(substr($string,0,$words),' ');
			return substr($string,0,$strpos).'...';
		}
		
	}
function sendMail($assunto,$msg,$remetente,$nomeRemetente,$destino,$nomeDestino, $reply = NULL, $replyNome = NULL){
require_once('mail/class.phpmailer.php'); //Include pasta/classe do PHPMailer
$mail = new PHPMailer(); //INICIA A CLASSE
$mail->IsSMTP(); //Habilita envio SMPT
$mail->SMTPAuth = true; //Ativa email autenticado
$mail->IsHTML(true);

$mail->Host = MAILHOST; //Servidor de envio
$mail->Port = MAILPORT; //Porta de envio
$mail->Username = MAILUSER; //email para smtp autenticado
$mail->Password = MAILPASS; //seleciona a porta de envio

$mail->From = utf8_decode($remetente); //remtente
$mail->FromName = utf8_decode($nomeRemetente); //remtetene nome
if($reply != NULL){
$mail->AddReplyTo(utf8_decode($reply),utf8_decode($replyNome));	
}
$mail->Subject = utf8_decode($assunto); //assunto
$mail->Body = utf8_decode($msg); //mensagem
$mail->AddAddress(utf8_decode($destino),utf8_decode($nomeDestino)); //email e nome do destino
if(!$mail->Send()){
 echo '<span>Erro ao enviar, favor entre em contato pelo e-mail MEU EMAIL!</span>';
}else{
 echo '<span>Mensagem enviada com sucesso!</span>';
}
}

function userOnline($times = 900){
	$selMes = date('m');
	$selAno = date('Y');
	if(empty($_SESSION['star_views']['sessao'])){
		$_SESSION['star_views']['sessao'] = session_id();
		$_SESSION['star_views']['ip'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['star_views']['url'] = $_SERVER['PHP_SELF'];
		$_SESSION['star_views']['time_end'] = time()+ $times;
		 create('up_views_online',$_SESSION['star_views']);
		$readViews = read('up_views',"WHERE mes = '$selMes' AND ano = '$selAno'");
		if(!$readViews){
		 $views = array('mes' => $selMes,'ano' => $selAno,'visitas' => 1);	
		 create('up_views',$views);
		}else{
			foreach($readViews as $rs);
			if(empty($_COOKIE['star_views'])){
				$visitas = array(
				'visitas' => $rs['visitas']+1,
				'visitante' => $rs['visitante']+1				
				);
				update('up_views',$visitas,"mes = '$selMes' AND ano = '$selAno'");
				setcookie('star_views',time(),time()+60*60*24,'/');
			}else{
				$updateVisitas = array('visitas' => $rs['visitas']+1);
				update('up_views',$updateVisitas,"mes = '$selMes' AND ano = '$selAno'");
				$pagViwes = read('up_views',"WHERE mes = '$selMes' AND ano = '$selAno' ");
			foreach($pagViwes as $pr);
			$verupdate = array('pagviews' => $pr['pagviews']+1);
			update('up_views',$verupdate,"mes = '$selMes' AND ano = '$selAno'");
			}
			
		}
	}else{
		$id_sessao =$_SESSION['star_views']['sessao'];
		if($_SESSION['star_views']['time_end'] <=time ()){
			delete('up_views_online',"sessao = '$id_sessao' OR time_end <= time(NOW())"); 
			unset($_SESSION['star_views']);
		}else{
			$_SESSION['star_views']['time_end'] = time()+ $times;
			$timeEnd = array('time_end' =>$_SESSION['star_views']['time_end']);
			update('up_views_online',$timeEnd,"sessao = '$id_sessao'");
			
		}
		
	}
	

	
	}
/*****************************
Paginação de resultados
*****************************/

	function readPaginator($tabela, $cond, $maximos, $link, $pag, $width = NULL, $maxlinks = 4){
		$readPaginator = read("$tabela","$cond");
		$total = count($readPaginator);
		if($total > $maximos){
			$paginas = ceil($total/$maximos);
			if($width){
				echo '<div class="paginator" style="width:'.$width.'">';
			}else{
				echo '<div class="paginator">';
			}
			echo '<a href="'.$link.'1">Primeira Página</a>';
			for($i = $pag - $maxlinks; $i <= $pag - 1; $i++){
				if($i >= 1){
					echo '<a href="'.$link.$i.'">'.$i.'</a>';
				}
			}
			echo '<span class="atv">'.$pag.'</span>';
			for($i = $pag + 1; $i <= $pag + $maxlinks; $i++){
				if($i <= $paginas){
					echo '<a href="'.$link.$i.'">'.$i.'</a>';
				}
			}
			echo '<a href="'.$link.$paginas.'">Última Página</a>';
			echo '</div><!-- /paginator -->';
		}
	}
	
	function valMail($email){
		if(preg_match('/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/',$email)){
			return true;
		}else{
			return false;
		}
	}










?>