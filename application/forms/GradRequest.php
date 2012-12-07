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
       //$studentSection = new Zend_Form_SubForm();
       //$studentSection->setElementsBelongTo('studentSection');
       
       
       $name = $this->getCommonTbox('studentName', 'Name:');
       $bannerId = $this->getCommonTbox('bannerId', 'Banner ID:');
       $major = $this->getCommonTbox('major', 'Major:');
       $address = $this->getCommonTbox('address', 'Address:');
       $address->setAttrib('size', '79');
       $phone = $this->getCommonTbox('phone', 'Phone:');
       $email = $this->getEmailTbox('email', 'E-mail:');

       $semStatus = new Zend_Form_Element_MultiCheckbox('semStatus');
       $semStatus->setMultiOptions( array('1' => 'Was a New/Returning',
                                     '2' => 'Changed major',
                                     '3' => 'Changed Home Institution to HonCC'))
                 ->setSeparator("");

       $requestedRequirements = $this->getCommonTbox('requestedRequirements', '');
       $reasonForRequest = $this->getCommonTbox('reasonForRequest', '');
       $reasonForRequest->setAttrib('size', '100');

       $studentAgreement = new Zend_Form_Element_MultiCheckbox('studentAgreement');
       $studentAgreement->setMultiOptions( array('agree' => 'I agree to the terms listed in the agreement.'));


       $submit = new Zend_Form_Element_Submit('submit');
       $submit->setLabel('Submit');

       //$studentSection->addElements( array($name, $bannerId, $major, $address, $phone, $email, 
       //    $semStatus, $requestedRequirements, $reasonForRequest, $studentAgreement, $submit) );
       
       //$studentSection->setElementDecorators(array('ViewHelper',
       //                                  'Errors'
       //                           ));
       
       //$this->addSubform($studentSection, 'studentSection');
       

       $this->addElements( array($name, $bannerId, $major, $address, $phone, $email, 
           $semStatus, $requestedRequirements, $reasonForRequest, $studentAgreement, $submit) );

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

