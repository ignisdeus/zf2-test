<?php

namespace Users\Form;

use Zend\InputFilter\InputFilter;

class RegisterFilter extends InputFilter
{

    function __construct()
    {
        $this->add(
            array(
                "name" => "name",
                "required" => true,
                "filters" => array(
                    array(
                        "name" => 'StripTags',
                    ),
                ),
                "validators" => array(
                    array(
                        "name" => 'StringLength',
                        "options" => array(
                            "encoding" => 'UTF-8',
                            'min' => 2,
                            'max' => 20,
                        ),
                    ),
                ),
            )
        );

        $this->add(
            array(
                "name" => "email",
                "required" => "required",
                "validators" => array(
                    array(
                        "name" => 'EmailAddress',
                        "options" => array(
                            "domain" => true,
                        ),
                    ),
                ),
            )
        );

        $this->add(
            array(
                "name" => "password",
                "required" => true,
                "options" => array(
                    "encoding" => 'UTF-8',
                    'min' => 5,
                ),
            )
        );

        $this->add(
            array(
                "name" => "confirm_password",
                "required" => true,
                "options" => array(
                    "encoding" => 'UTF-8',
                    'min' => 5,
                ),
                "validators" => array(
                    array(
                        "name" => 'identical',
                        'options' => array(
                            'token' => 'password',
                            'message' => "The passwords must match."
                        )
                    ),
                )
            )
        );

    }
}