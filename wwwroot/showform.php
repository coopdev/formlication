<?php
// This include path is used when using Zend_Loader::loadClass(), it looks in this directory
// for the file and class. Assumes the dir '../lib' exists and has the Zend library within.
set_include_path(
	implode(PATH_SEPARATOR, array(
		get_include_path(),
		'../lib'
	)));
// Load needed Zend classes
require_once("../lib/Zend/Loader.php");

// Tries to load '../lib/Zend/View.php' file and the Zend_View class within that file.
// Uses the path set using 'set_include_path' as it's root dir to search.
Zend_Loader::loadClass('Zend_View');
Zend_Loader::loadClass('Form');

// Create a view to render the form
$view = new Zend_View();

// Create an instance of the form
$form = new Form();

if (!$_POST) {
    // Render the blank form
    echo $form->render($view);
} else if(!$form->isValid($_POST)) {
    // Renders form with error messages
    echo $form->render($view);
} else {
    // Passed validation. Do someting with the values entered.
    $values = $form->getValues();
    extract($values);
    include "thank-you.php";
}

?>
