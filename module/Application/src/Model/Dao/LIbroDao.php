<?php 
class ProductoDao implements ILibroDao{
	protected $tableGateway;

	public function __contruct(TableGateway $tableGateway){
		$this->tableGateway = $tableGateway;
	}	
    public function getL($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'No existe %d',
                $id
            ));
        }

        return $row;
    }
    namespace Album\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class AlbumTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getL($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'No existe %d',
                $id
            ));
        }

        return $row;
    }

    public function guardar(Libro $libro){
    	$data =  [
    		'nombre' => $libro->getNombre(),
            'precio' => $libro->getPrecio(),
    	];
    	$id = (int) $libro->getId();

    	if ($id == 0){
           $this->tableGateway ->insert($data);      
    	}else{
    	   if ($this->getL($id)){
              $this->tableGateway ->update($data, (['id' => $id]));
    	   }else{
    	   	  throw new RuntimeException("no existe el id");
    	   	  

    	   }
        }

    }
    
    public function eliminar(Libro $libro){
    	$this->tableGateway->delete(['id' => $libro ->getId()]);

    }
}