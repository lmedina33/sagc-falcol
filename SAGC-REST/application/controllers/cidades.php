<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use models\negocio\EstadoBLL;
use models\negocio\CidadeBLL;

class Cidades extends MY_Controller{
    
    public function buscarPorEstadoJson($estadoId){
        $estadoBLL = new EstadoBLL();
        $estado = $estadoBLL->buscarPorId($estadoId);
        $cidades = $estado->getCidades();
        
        $cidadesArray = array();
        foreach($cidades as $cidade){
            $cidadesArray[] = array('id' => $cidade->getId(), 'nome' => $cidade->getNome(), 'estado_id' => $estado->getId());
        }
        
        print json_encode($cidadesArray);
    }
}

?>
