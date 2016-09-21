<?php
namespace Task\Form;

use Zend\Form\Form;

class UnitForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('unit');
		$this->add([
			'name' => 'name',
			'type' => 'Text',
			'options' => [
				'label' => 'Nazwa'
			]
		]);
		$this->add([
			'name' => 'abbreviation',
			'type' => 'Text',
			'options' => [
				'label' => 'Skrócona nazwa'
			]
		]);
		$this->add([
			'name' => 'submit',
			'type' => 'Submit',
			'attributes' => [
				'value' => 'Zatwierdź'
			]
		]);
	}
}
