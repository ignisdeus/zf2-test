<?php

namespace Users\Form;

use Zend\Form\Form;
use Zend\Validator\EmailAddress;

class RegisterForm extends Form
{
    function __construct($name = null)
    {
        parent::__construct('Register');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');

        $this->add(
          array(
              "name" => "name",
              "attributes" => array(
                "type" => "text",
              ),
              "options" => array(
                "label" => "Full Name"
              ),
          )
        );

        $this->add(
            array(
                "name" => "email",
                "attributes" => array(
                    "type" => "email",
                    "required" => "required"
                ),
                "options" => array(
                    "label" => "E-Mail"
                ),
                "validators" => array(
                    array(
                      "name" => 'EmailAddress',
                      "options" => array(
                        "messages" => array(EmailAddress::INVALID_FORMAT => 'Email address format is invalid')
                      ),
                    ),
                ),
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
                "name" => "confirm_password",
                "attributes" => array(
                    "type" => "password",
                    "required" => "required"
                ),
                "options" => array(
                    "label" => "Confirm Password"
                ),
            )
        );

        $this->add(
            array(
                "name" => "submit",
                "attributes" => array(
                    "type" => "submit",
                    "value" => "Register",
                ),
                "options" => array(
                    "label" => "Register"
                ),
            )
        );

    }
}