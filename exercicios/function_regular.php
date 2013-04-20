<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
/*
? = [0,1]
* = [0,]
+ = [1,]
*/
$string = 'marsol643.lete-sal@hotmail.com';
if(preg_match('/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+.[a-z]{2,4}$/',$string)){
	echo "Validado";
	}else{
	echo "Error";	
	}
?>