<?php
//set_include_path(
//	implode(PATH_SEPARATOR, array(
//		get_include_path(),
//		'../lib'
//	)));

//require_once("../lib/Zend/Loader.php");
Zend_Loader::loadClass('Zend_Form');
Zend_Loader::loadClass('Zend_Form_Element_Text');

class Form extends Zend_Form
{
    public function init()
    {
        //$this->setDecorators(array(array('ViewScript',
        //        array('viewScript' => 'form-template.php'))));
        $this->setAction('foo');
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name:');

        $this->addElement($name);
    
        //$this->setElementDecorators(array('ViewHelper',
        //                              'Errors'
        //                       ));
    }


}

?>
