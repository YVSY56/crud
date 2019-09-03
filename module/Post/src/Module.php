<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Post;


use Zend\Db\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet;

class Module{
    
    public function getConfig(){
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiveConfig(){
        return[ 
        	'factories' => [ 
        		Model\PostTable::class=> function ($container){

        $tableGateway = $container->get(Model\PostTableGateway::class);
                   return new Model\PostTable($tableGateway);

        		},
        		Model\PostTableGateway::class => function ($container){
        			$adapter =$container->get(AdapterInterface::class);
        			$resultSetPrototype= new ResultSet();
        			$resultSetPrototype-> setArrayObjectPrototype(new Model\Post);
        			return new tableGateway('post',$adapter,null, $resultSetPrototype);
               },
            ],
        ];
    }

    public function getControllerConfig (){
    	return [
    	   'factories' => [ 
    	    controller\IndexController::class=> function($container){
    	    	return new Controller\IndexController($container->get(Model\PostTable::class));
            }
    	   ]	
        ];
    }
}
