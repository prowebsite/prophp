<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require_once("iniSis.php");
$conn = mysql_connect(LOCALHOST,USER,PASS) or die ('Erro de conexao . '.mysql_error());
$bd = mysql_select_db(DBSA,$conn) or die ('banco de dados nao existe '.mysql_error());


function create($tabela, array $data){
	$cfield = implode(', ',array_keys($data));
	$values = "'".implode("', '",array_values($data))."'";
	echo $sqlCreate = "INSERT INTO {$tabela} ($cfield) VALUES ($values)";
	$qrCreate = mysql_query($sqlCreate) or die ('Erro ao cadastra '.$tabela.' '.mysql_error());
	if($qrCreate){
	return true;
	}
}
 ;
function read($tabela, $where = NULL){
	$sqlRead = "SELECT * FROM {$tabela} {$where}";
	$query	 = mysql_query($sqlRead) or die ('Erro ao ler tabelas '.$tabela.' '.mysql_error());
	$field = mysql_num_fields($query);
	for($y = 0; $y < $field; $y++){
		 $names[$y] = mysql_field_name($query,$y);
		 
		}
		
		for($x = 0; $res = mysql_fetch_assoc($query); $x++){
			for($i = 0; $i < $field; $i++){
				$resultado[$x][$names[$i]] = $res[$names[$i]];
				}
			}
	 return $resultado;
	} 
function update($tabela, array $data, $where){
	foreach($data as $felds => $values){
		$campo[] = "$felds = '$values'";
		}
	$campo = implode(", ",$campo);
	$sql = "UPDATE {$tabela} SET $campo WHERE {$where}";
	$qr =  mysql_query($sql) or die ('Erro ao atualizar tabelas '.$tabela.' '.mysql_error());
	if($qr){
	return true;	
	}else{
	return false;	
	}
	}
function delete($tabela, $where){
	$sqlDel = "DELETE FROM {$tabela} WHERE {$where}";
    $qrDel = mysql_query($sqlDel) or die ('Erro ao deletar '.$tabela.' '.mysql_error());
	}
?>