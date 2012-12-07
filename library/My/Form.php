<?php
require_once('../inc/constants.php');

class Form
{
    protected $status;

    // User this form belongs to.
    protected $user;

    // File path that holds the data.
    //protected $storage = STORAGEDIR . '/form-data.json';

    // Root of the users form data.
    protected $data;


    public function __construct($user)
    {
        $this->user = $user;

        $formData = file_get_contents($this->storage);

        $formData = json_decode($formData);

        if (isset($formData->$user)) {
            $this->data = $formData->$user;
        } else {
            $this->data = null;
        }
    }

    /*
     * Return all form data.
     *
     */
    public function getData()
    {
        return $this->data;
    }

    /*
     * The contents of the specific user's previously submitted 
     * form, if any.
     *
     */
    public function getContents()
    {
        return $this->data->contents;
    }


    /*
     * Checks if a form for a specific user has been previously
     * submitted.
     *
     */
    public function hasData()
    {
        if (is_null($this->data)) {
            return false;
        }
        return true;
    }



}
?>
