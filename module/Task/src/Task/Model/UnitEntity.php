<?php
namespace Task\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Task\Entity\Unit;

class UnitEntity extends Unit implements InputFilterAwareInterface
{
	use EntityTrait, DoctrineTrait;
	
	/**
	 * @var Zend\InputFilter\InputFilter 
	 */
	protected $inputFilter = null;
	/**
	 * @var \Doctrine\ORM\EntityRepository 
	 */
	protected $repository = null;
	
	/**
	 * @return \Doctrine\ORM\EntityRepository
	 */
	public function getRepository()
	{
		if (is_null($this->repository)) {
			$this->repository = $this->getEntityManager()->getRepository('Task\Entity\Unit');
		}
		return $this->repository;
	}
	
	public function exchangeArray($data)
	{
		$this->setName(array_key_exists('name', $data) ? $data['name'] : null);
		$this->setAbbreviation(array_key_exists('abbreviation', $data) ? $data['abbreviation'] : null);
		if ($this->getId() === null) {
			$this->setCreatedat(time());
		}
		$this->setModifiedat(time());
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
}
