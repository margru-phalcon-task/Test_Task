<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class Customers extends Model{

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $createdt_date;
    public $updatedt_date;

    // Validatie E-Mail Adress
    public function validation(){
        $validation = new Validation();

        $validation->add(
            'first_name',
            new PresenceOf(
                [
                    'message' => 'The firstname is required',
                ]
            )
        );

        $validation->add(
            'last_name',
            new PresenceOf(
                [
                    'message' => 'The lastname is required',
                ]
            )
        );

        $validation->add(
            'email',
            new Email(
                [
                    'message' => 'The e-mail is not valid',
                ]
            )
        );

        return $this->validate($validation);
    }

}