<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
echo date('d/m/Y H:i:s').'<br />';
$dia_semana = date('w');
$dia_atual  = date('d');
$mes        = date('m');
$ano 		= date('Y');
$dia_ext = array(
	"0" => "Domingo",
	"1" => "Segunda Feira",
	"2" => "Terça Feira",
	"3" => "Quarta Feira",
	"4" => "Quinta Feira",
	"5" => "Sexta Feira",
	"6" => "Sabado"
);
$mes_anual = array(
	"01" => "Janeiro",
	"02" => "Fervereiro",
	"03" => "Março",
	"04" => "Abril",
	"05" => "Maio",
	"06" => "Junho",
	"07" => "Julho",
	"08" => "Agosto",
	"09" => "Setembro",
	"10" => "Outubro",
	"11" => "Novembro",
	"12" => "Dezembro"
);
echo 'Hoje e '.$dia_ext[$dia_semana].' dia '.$dia_atual.' de '.$ano.'<br />';
$ano_time = strtotime(date('Y-m-d')); echo $ano_time.'<br />'; 
$dia_anv = strtotime(date('Y-03-27')); echo $dia_anv;
$time_falta = $ano_time - $dia_anv;
$soma_dia = 24*60*60;
$falta_anv = $time_falta/$soma_dia;
echo $falta_anv;
?>