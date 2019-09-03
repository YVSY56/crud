<?php
 namespace Post\Model;
 /**
  * 
  */
 class Post{
 	
 	protected $id;
 	protected $nombre;
 	protected $precio;
    
    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->nombre = !empty($data['nombre']) ? $data['nombre'] : null;
        $this->precio = !empty($data['precio ']) ? $data['precio'] : null;
    }   
  }    
 

?>