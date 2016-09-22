<?php
namespace Task\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Task\Model\Entities;

class ConsoleController extends AbstractActionController
{
    public function fixEntitiesAction()
    {
		Entities::fix(__DIR__ . '/../Entity');
		return 0;
    }
}
