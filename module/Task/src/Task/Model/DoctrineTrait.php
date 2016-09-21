<?php
namespace Task\Model;

trait DoctrineTrait
{
	/**
	 * @var \Doctrine\ORM\EntityManager 
	 */
	protected $entityManager = null;
	/**
	 * @var \Zend\ServiceManager\ServiceLocatorInterface
	 */
	protected $serviceLocator = null;
	
	/**
	 * @return \Doctrine\ORM\EntityManager
	 */	
	public function getEntityManager()
    {
		if (is_null($this->serviceLocator)) {
			throw new \Exception('The service locator is not set');
		}
        if (is_null($this->entityManager)) {
            $this->entityManager = $this->serviceLocator->get('doctrine.entitymanager.orm_default');
        }
        return $this->entityManager;
    }
	
	public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
	{
		$this->serviceLocator = $serviceLocator;
	}
}
