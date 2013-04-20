<?php
/**
 * @author    Tiarê Balbi
 * @package   PagSeguro
 * @category  osCommerce, Loja Virtual, Pagamentos
 */

class Pagseguro {
        
        /**
         * Fator para calculo de juros em parcela
         * @var array
         */
        var $fator = array(
                        '1'=>'1',
                        '2'=>'0.51495',
                        '3'=>'0.34670',
                        '4'=>'0.26255',
                        '5'=>'0.21210', 
                        '6'=>'0.17847',
                        '7'=>'0.15446',
                        '8'=>'0.13645',
                        '9'=>'0.12246',
                        '10'=>'0.11127',
                        '11'=>'0.10212',
                        '12'=>'0.09450',
                        '13'=>'0.08806',
                        '14'=>'0.08254',
                        '15'=>'0.07777',
                        '16'=>'0.07359',
                        '17'=>'0.06991',
                        '18'=>'0.06664'
        );
        
        /**
         * Bandeiras das empresas de cartão de credito e o numero maximo de parcelas 
         * @var array
         */
        var $bandeiras = array(
                        '1'=>array('nome'=>'Visa','parcelas'=>'12'),
                        '2'=>array('nome'=>'MasterCard','parcelas'=>'12'),
                        '3'=>array('nome'=>'Diners','parcelas'=>'12'),
                        '4'=>array('nome'=>'American Express','parcelas'=>'12'),
                        '5'=>array('nome'=>'Hipercard','parcelas'=>'12'),
                        '6'=>array('nome'=>'Aura','parcelas'=>'18')             
        );

        var $parcela_minima = 5.00;
        
        /**
         * Converte o valor para formato numerico valido
         * @param string $valor
         */
        public function formatNumber($valor){
                
                $preco = (!empty($valor) ? $valor : "0.00");            
                return number_format($preco, 2, ',', '');
                 
        }
        
        /**
         * Converte o valor para um valor inteiro sem casa decimal
         * @param int $valor
         */
        public function formatInteiro($valor){
                $preco = (!empty($valor) ? $valor : "0.00");
                return number_format($preco, 0, ',', '');
                
        }
        
        /**
         * Realiza o calculo e cria uma array retornando o valor da parcela, total de parcela, total pago respectiva parcela.
         * @param int $valor
         * @param int $cartao
         */
        public function parcelamento($valor,$cartao){
                
                $valor = str_replace(",", ".", $valor);
                
                $retorno = array();
                
                $retorno['cartao'] = $this->bandeiras[$cartao]['nome'];
                
                
                for($i=1;$i<=$this->bandeiras[$cartao]['parcelas'];$i++){

                        $valor_parcela = $this->formatNumber($valor*$this->fator[$i]);
                        
                        
                        if($i != 1 && $this->formatInteiro($this->parcela_minima) > $this->formatInteiro($valor_parcela)){
                                break;
                        }
                                                
                        $retorno['valores'][$i] = array(
                                        'prestacao'=>$i,
                                        'valor'=>$valor_parcela,
                                        'total_pago'=>$this->formatNumber($valor*$this->fator[$i]*$i)
                        );
                        
                }

                return $retorno;
        }

}
$pg = new Pagseguro();

//Primeiro campo é o valor que você deseja simular
//Segundo campo é a bandeira do cartão, lista de bandeiras abaixo:
/*

1: Visa
2: MasterCard
3: Diners
4: American Express
5: Hipercard
6: Aura
        
*/
$retorno = $pg->parcelamento('1000', '6');

//A função Parcelamento retornará uma array() que você pode ler ela da forma que você achar melhor abaixo segue um exemplo:
echo $retorno['cartao'] . '<br/>';

foreach($retorno['valores'] as $valor ){
        echo 'Numero de Parcelas: ' . $valor['prestacao'] . ' x ';
        echo $valor['valor'] . '<br/>';
}

?>