<?php


class Application_Form_GradRequest extends Application_Form_Form
{

    public function init()
    {
       $this->storage = APPLICATION_PATH . '/../storage/form-data.json';
       
       $this->setDecorators(array(array('ViewScript', 
                                 array('viewScript' => '/forms/form-templates/grad-request.phtml'))));
       
       $formData = file_get_contents($this->storage);
       
       // If empty, make it an empty JSON object.
       if (empty($formData)) {
          $formData = "{}";
       }
       $this->formData = json_decode($formData);

       $this->makeFields();
       
       if ($this->hasData()) {
          $this->populate( (array)$this->getContent());
       }
       
       $this->setElementDecorators(array('ViewHelper',
                                         'Errors'
                                  ));
    }


    public function makeFields()
    {
       $name = $this->getCommonTbox('studentName', 'Name:');
       $bannerId = $this->getCommonTbox('bannerId', 'Banner ID:');


       $submit = new Zend_Form_Element_Submit('submit');
       $submit->setLabel('Submit');

       $this->addElements( array($name, $bannerId, $submit) );

    }

    public function submit()
    {
       $vals = $this->getValues();

       $user = $this->user;
       
       $this->formData->$user->content = (object) $vals;
       $formData = json_encode($this->formData);
       
       $this->writeToStorage($formData);

    }

    public function writeToStorage($jsondata)
    {
       file_put_contents($this->storage, $jsondata);
    }



}

