<?php

class FormsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function gradRequestAction()
    {
       // the user argument should be coming from a session.
       $form = new Application_Form_GradRequest( array('user' => 'jdoe') );

       $this->view->form = $form;

       if ($this->getRequest()->isPost()) {
          $data = $_POST;

          //die(var_dump($data));
          if ($form->isValid($data)) {
             //die(var_dump($form->getValues()));
             $form->submit();

          }
       }
    }
}

