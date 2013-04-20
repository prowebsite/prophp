<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$text_um = 'ola mundo, essa primeira string';
$textdois = 'ola mundo essa segunda string';
$string = similar_text($text_um,$textdois);
echo $cpf = "00022255542".'<hr>';
$cpf = substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,6,3).'-'.substr($cpf,9,2);
echo $cpf.'<hr />';
$cpf = '000.222.555-42';
$cpf = str_replace('.','',$cpf);
$cpf = str_replace('-','',$cpf);
echo $cpf;
?>