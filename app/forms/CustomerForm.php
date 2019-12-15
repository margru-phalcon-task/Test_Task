<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class CustomerForm extends Form
{
    public function initialize( $entity = null, $options = null ){

        $first_name = new Text('first_name');
        $first_name->setLabel('Vorname');
        $first_name->addValidator(
            new PresenceOf(
                [
                    'message' => 'The firstname is required',
                ]
            )
        );
        $this->add($first_name);

        $last_name = new Text('last_name');
        $last_name->setLabel('Nachname');
        $last_name->addValidator(
            new PresenceOf(
                [
                    'message' => 'The lastname is required',
                ]
            )
        );
        $this->add($last_name);

        $email = new Text('email');
        $email->setLabel('Email');
        $email->addValidator(
            new PresenceOf(
                [
                    'message' => 'The email is required',
                ]
            )
        );
        $email->addValidator(
            new Email(
                [
                    'message' => 'The email is not valid',
                ]
            )
        );
        $this->add($email);

    }
}