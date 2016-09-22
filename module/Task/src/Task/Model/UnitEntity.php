<?php
namespace Task\Model;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Task\Entity\Unit;

/**
 * @ORM\Table(name="unit")
 * @ORM\Entity
 */
class UnitEntity extends Unit implements InputFilterAwareInterface
{
	use EntityTrait, DoctrineTrait;
	
	/**
	 * @var \Doctrine\ORM\EntityRepository 
	 */
	protected static $repository = null;
	/**
	 * @var Zend\InputFilter\InputFilter 
	 */
	protected $inputFilter = null;
	
	public function exchangeArray($data)
	{
		$this->setName(array_key_exists('name', $data) ? $data['name'] : null);
		$this->setAbbreviation(array_key_exists('abbreviation', $data) ? $data['abbreviation'] : null);
		$now = new \DateTime('now');
		if ($this->getId() === null) {
			$this->setCreatedat($now);
		}
		$this->setModifiedat($now);
	}
	
	public function getDoctrineEntity()
	{
		$entity = new Unit();
		$entity->setName($this->getName())
			->setAbbreviation($this->getAbbreviation())
			->setCreatedat($this->getCreatedat())
			->setModifiedat($this->getModifiedat());
		return $entity;
	}
	
	public function getInputFilter()
	{
		if (is_null($this->inputFilter)) {
			$inputFilter = new InputFilter();
			$inputFilter->add([
				'name'     => 'name',
				'required' => true,
				'filters'  => [['name' => 'StringTrim']],
				'validators' => [
					[
						'name'    => 'StringLength',
						'options' => [
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 64,
						]
					]
				]
			]);
			$inputFilter->add([
				'name'     => 'abbreviation',
				'required' => true,
				'filters'  => [['name' => 'StringTrim']],
				'validators' => [
					[
						'name'    => 'StringLength',
						'options' => [
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 16,
						]
					]
				]
			]);
			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}
	
	/**
	 * @return \Doctrine\ORM\EntityRepository
	 */
	public static function getRepository($context)
	{
		if (is_null(self::$repository)) {
			$entityManager = self::getDoctrineEntityManager($context->getServiceLocator());
			self::$repository = $entityManager->getRepository('Task\Model\UnitEntity');
		}
		return self::$repository;
	}
}
