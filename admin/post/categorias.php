 <?php
 if(function_exists(getUsers)){
 if(!getUsers($_SESSION['autUsers']['id'],1)){
	 echo '<span class="ms al">Voce nao tem permissao</span>';
 }else{
 
 
 ?>          
            <div class="bloco cat" style="display:block">
            	<div class="titulo">Categorias:</div>   
                 <?php
				 $pag = (empty($_GET['pag']) ? '1' : $_GET['pag']);
				 $maximo = 1;
				 $inicio = ($pag * $maximo) - $maximo;
				 $readcat = read('up_cat',"WHERE id_pai IS null LIMIT $inicio,$maximo");
				 if(!$readcat){
					 echo '<span class="ms in">naõ existe registro de categorias ainda !</span>';
				 }else{
				 ?>                            
                <table width="560" border="0" class="tbdados" style="float:left;" cellspacing="0" cellpadding="0">
                  <tr class="ses">
                    <td>categoria:</td>
                    <td>resumo:</td>
                    <td align="center">tags:</td>
                    <td align="center">criada:</td>
                    <td align="center" colspan="3">ações:</td>
                  </tr>
                  <?php 
				  foreach($readcat as $cat);
					echo '<tr>'; 
					echo '<td>'.$cat['nome'].'</td>'; 
					echo '<td>'.lmWord($cat['content'],35).'</td>'; 
					echo '<td align="center"><img src="ico/ok.png" alt="3 Tags" title="3 Tags" /></td>'; 
					echo '<td align="center">'.date('d/m/Y H:i', strtotime($cat['data'])).'</td>'; 
					echo ' <td align="center" colspan="2"><a href="index2.php?exe=post/categorias&edit='.$cat['id'].'" title="editar categoria '.$cat['nome'].'"><img src="ico/edit.png" alt="editar categoria '.$cat['nome'].'" title=" editar categoria '.$cat['nome'].'" /></a></td>'; 
					echo '</tr>'; 
					
					$readSubcat = read('up_cat',"WHERE id_pai = '".$cat['id']."'"); 
				  	if($readSubcat){
						foreach($readSubcat as $sub):
						
						echo ' <tr>';
						echo '<td>&raquo;&raquo;notícias</td>';
						echo '<td>'.$sub['nome'].'</td>';
						echo '<td align="center"><img src="ico/ok.png" alt="3 Tags" title="3 Tags" /></td>';
						echo '<td align="center">'.date('d/m/Y H:i',strtotime($sub['data'])).'</td>';
						echo '<td align="center"><a href="#" title="editar"><img src="ico/edit.png" alt="editar" title="editar" /></a></td>';
						echo '<td align="center"><a href="#" title="editar"><img src="ico/no.png" alt="editar" title="excluir" /></a></td>';
						echo ' </tr>';	
						endforeach;
					}
				  
				  ?>

                  <?php ?>
                </table>
                <?php
				 }
				 $link = 'index2.php?exe=post/categorias&pag=';
				 readPaginator('up_cat',"WHERE id_pai IS null", $maximo, $link, $pag);
				?>

            </div><!-- /bloco cat -->
            
           
<?php
 }
 }else{
	echo '<h1>Desculpe acesso negado</h1>'; 
 }
?>