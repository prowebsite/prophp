<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$data = date('26/03/2014');
$data = explode('/',$data);

$dia = $data[0];
$mes = $data[1];
$ano = $data[2];

$diav = true;
$mesv = true;
$anov = true;

if($ano <= date('Y') && $ano >= 1979){
	$arrum = array('1',3,'5','7','8','10','12');
	$arrdois = array('4',6,'9','11');
	if(in_array($mes,$arrum)){
		if($dia < 1 || $dia > 31):
			
		endif;
	}elseif(in_array($mes,$arrdois)){
		if($dia < 1 || $dia > 30):
			
		endif;		
	}elseif($mes == 2){
		if(($ano%4== 0 && $ano%100!=0 || $ano%400==0 )){
			$fev = '29';
		}else{
			$fev = '28';
		}
		if($dia < 1 || $dia > $fev):
			
		endif;
		
	}else{
		$mesv =false;
	}
}else{
	
	$anov = false;
}
if(!$anov){
	echo 'Somente aceitamos ano entre 1979 a '.date('Y');
}elseif(!$mesv){
	echo 'mês informado nao existe no calendário !';
	
}elseif(!$diav){
	echo 'dia informado nao existe no calendário !';
}else{
 echo 'data Confere';	
}





?>