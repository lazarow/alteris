<?php
namespace Task\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Task\Model\UnitEntity;
use Task\Form\UnitForm;

class UnitController extends AbstractActionController
{
    public function indexAction()
    {
		var_dump(UnitEntity::getRepository($this)->findBy([], ['name' => 'ASC']));
		return 1;
    }
	
	public function addAction()
    {
		$form = new UnitForm();
		$form->get('submit')->setValue('Dodaj');
		$request = $this->getRequest();
		if ($request->isPost()) {
			$unit = new UnitEntity();
			$unit->setServiceLocator($this->getServiceLocator());
			$form->setInputFilter($unit->getInputFilter());
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$unit->exchangeArray($form->getData());
				$unit->getEntityManager()->persist($unit);
				$unit->getEntityManager()->flush();
				return $this->redirect()->toRoute('task/default', ['controller' => 'unit']);
			}
         }
         return ['form' => $form];
    }
	
	public function updateAction()
    {
    }
	
	public function removeAction()
    {
    }
}
