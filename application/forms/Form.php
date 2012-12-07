<?php

class Application_Form_Form extends Zend_Form
{
    protected $status;

    // User this form belongs to.
    protected $user;

    // Stored form data for ALL users.
    protected $formData;

    // Path to json file.
    protected $storage;

    protected $elemRequired = false;




    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    }

/********************************* FORM ELEMENT METHODS *******************************/

   public function getCommonTbox($name,$label)
   {
      $elem = new Zend_Form_Element_Text($name);
      $elem->setRequired($this->elemRequired)
           ->setLabel($label)
           ->addFilter('StripTags')
           ->addFilter('StringTrim');
      return $elem;
   }
   
   public function getEmailTbox($name,$label)
   {
      $elem = new Zend_Form_Element_Text($name);
      $elem->setLabel($label)
           ->addFilter('StripTags')
           ->addFilter('StringTrim')
           ->setRequired($this->requiredVal)
           ->addValidator(new Zend_Validate_EmailAddress());
      return $elem;
   }

/***************************** END FORM ELEMENT METHODS *******************************/


/********************************** FORM DATA METHODS ***********************************/
   

    /*
     * The contents of the specific user's previously submitted 
     * form, if any.
     *
     */
    public function getContent()
    {
        $user = $this->user;
        return $this->formData->$user->content;
    }


    /*
     * Checks if a form for a specific user has been previously
     * submitted.
     *
     */
    public function hasData()
    {
        $user = $this->user;
        if (isset($this->formData->$user)) {
            return true;
        }
        return false;
    }
    
    
    
    public function setUser($user)
    {
       $this->user = $user;
    }
    
    
/****************************** END FORM DATA METHODS ***********************************/

}

