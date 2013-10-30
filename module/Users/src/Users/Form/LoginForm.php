<?php

namespace Users\Form;

use Zend\Form\Form;
use Zend\Validator\EmailAddress;

class LoginForm extends Form
{
    function __construct($name = null)
    {
        parent::__construct('Login');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');

        $this->add(
            array(
                "name" => "email",
                "attributes" => array(
                    "type" => "email",
                    "required" => "required"
                ),
                "options" => array(
                    "label" => "E-Mail"
                )
            )
        );

        $this->add(
            array(
                "name" => "password",
                "attributes" => array(
                    "type" => "password",
                    "required" => "required"
                ),
                "options" => array(
                    "label" => "Password"
                ),
            )
        );

        $this->add(
            array(
                "name" => "submit",
                "attributes" => array(
                    "type" => "submit",
                    "value" => "Login",
                    "class" => "btn btn-info",
                ),
                "options" => array(
                    "label" => "Login"
                ),
            )
        );

    }
}