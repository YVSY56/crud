<?php
  namespace Post\Model;

  /**
   * 
   */
  use Zend\Db\TableGatewayInterface;
  class PostTable {
  	protected $tableGateway;
  	
  	function __construct(TableGatewayInterface $tableGateway){
        $this->tableGateway = $tableGateway;
  	}

  	public fuction fetchAll(){
        return $this->tableGateway->select();
  	}
  	

  }

?>