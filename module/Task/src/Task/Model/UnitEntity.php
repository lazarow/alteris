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
	
	public function getInputFilter()
	{
		if (is_null($this->inputFilter)) {
			$dbAdapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
			$inputFilter = new InputFilter();
			$inputFilter->add([
				'name'     => 'name',
				'required' => true,
				'filters'  => [['name' => 'StringTrim']],
				'validators' => [
					[
						'name'    =>'NotEmpty', 
                        'options' => [
							'messages' => [
								\Zend\Validator\NotEmpty::IS_EMPTY => 'Nazwa jednostki miary musi być uzupełniona.' 
							]
						]
					],
					[
						'name'    => 'StringLength',
						'options' => [
							'encoding' => 'UTF-8',
							'max'      => 64,
							'messages' => [
								\Zend\Validator\StringLength::INVALID => 'Wpisana wartość jest nieprawidłowa.',
								\Zend\Validator\StringLength::TOO_LONG => 
									'Wpisana wartość jest za długa (maksymalnie 64 znaki).'
							]
						]
					],
					[
						'name'    => '\Zend\Validator\Db\NoRecordExists',
                        'options' => [
							'table' => 'unit',
                            'field' => 'name',
                            'adapter' => $dbAdapter,
                            'messages' => [
								\Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => 
									'Jednostka miary o takiej nazwie już istnieje.'
							]
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
						'name'    =>'NotEmpty', 
                        'options' => [
							'messages' => [
								\Zend\Validator\NotEmpty::IS_EMPTY => 'Skrócona nazwa jednostki musi być uzupełniona.' 
							]
						]
					],
					[
						'name'    => 'StringLength',
						'options' => [
							'encoding' => 'UTF-8',
							'max'      => 16,
							'messages' => [
								\Zend\Validator\StringLength::INVALID => 'Wpisana wartość jest nieprawidłowa.',
								\Zend\Validator\StringLength::TOO_LONG => 
									'Wpisana wartość jest za długa (maksymalnie 64 znaki).'
							]
						]
					],
					[
						'name'    => '\Zend\Validator\Db\NoRecordExists',
                        'options' => [
							'table' => 'unit',
                            'field' => 'abbreviation',
                            'adapter' => $dbAdapter,
                            'messages' => [
								\Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => 
									'Jednostka miary o takim skrócie już istnieje.'
							]
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
