<?php
namespace Task\Model;

use Zend\InputFilter\InputFilterInterface;

trait EntityTrait
{
	public function getArrayCopy() 
	{
		return get_object_vars($this);
	}
	
	public function setInputFilter(InputFilterInterface $inputFilter)
    {
		throw new \Exception('The method ' . __METHOD__ . ' cannot be used');
    }
	
	public function exchangeArray($data = array()) 
    {
		throw new \Exception('The method ' . __METHOD__ . ' is not implemented');
    }
	
	public function getInputFilter() 
    {
		throw new \Exception('The method ' . __METHOD__ . ' is not implemented');
    }
}