<?php

namespace models\Entity;

/** @MappedSuperclass
 * @HasLifecycleCallbacks
 */
abstract class Entidade {

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="datetime", columnDefinition="TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL", nullable=false)
     */
    protected $dataRegistro;

    /**
     * @Column (type="datetime", nullable=false) 
     */
    protected $dataModificacao;

    public function __construct() {
        \Doctrine::$ems->persist($this);
        $this->dataRegistro = new \DateTime();
        $this->dataModificacao = new \DateTime();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDataRegistro() {
        return $this->dataRegistro;
    }

    public function setDataRegistro($dataRegistro) {
        $this->dataRegistro = $dataRegistro;
    }

    public function getDataModificacao() {
        return $this->dataModificacao;
    }

    public function setDataModificacao($dataModificacao) {
        $this->dataModificacao = $dataModificacao;
    }
    
    /**
     * @PreUpdate
     */
    public function atualizarDataModificacao(){
        $this->dataModificacao = new \DateTime();
    }
    
    /**
     * @PreUpdate
     * @PreRemove
     */
    public function logEstadoAtual(){
        $db = & get_instance()->db;
        $classMetadata = \Doctrine::$ems->getClassMetadata(get_class($this));
        
        $className = $classMetadata->getName();
        $className = str_replace('models\\entidades\\', '', $className);
        $tableName = $classMetadata->getTableName();
        
        $join = array();
        
        $entityCount = 1;
        foreach(class_parents($this) as $parent){
            $parentClassMetadata = \Doctrine::$ems->getClassMetadata($parent);
            if($parentClassMetadata->isInheritanceTypeJoined()){
                $parentClassName = $parentClassMetadata->getName();
                $parentClassName = str_replace('models\\entidades\\', '', $parentClassMetadata);                
                $parentTableName = $parentClassMetadata->getTableName();  
                
                $join[] = " JOIN ".$parentTableName." AS e".$entityCount." ON e".$entityCount.".id = ".$tableName.".id ";                
            }
            $entityCount++;
        }
        
        
        
        $join_txt = implode(" ",$join);
        
        $query = $db->query("SELECT * FROM {$tableName} {$join_txt} WHERE {$tableName}.id = {$this->getId()}");
        $results = $query->result_array();
        $entidadeArray = $results[0];
        
        foreach($entidadeArray as $key => $value){
            $fieldName = $classMetadata->getFieldName($key);
            if($key != $fieldName){
                $entidadeArray[$fieldName] = $value;
                unset($entidadeArray[$key]);
            }
        }
        
        $entidadeExported = var_export($entidadeArray, true);
        
        
        $usuarioBLL = new \models\negocio\UsuarioBLL();
        $usuario = $usuarioBLL->buscarPorId(get_instance()->tank_auth->get_user_id());
        
        $db->query("INSERT INTO Log (prefeitura_id, usuario_id, ip, entidade, entidadeId, log, dataModificacao) VALUES (".$usuario->getPrefeitura()->getId().", ".$usuario->getId().", '".$_SERVER['REMOTE_ADDR']."', '".$className."', ".$this->getId().", '".addslashes($entidadeExported)."', NOW())");
    }
}

?>
