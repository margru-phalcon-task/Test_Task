<?php

use Phalcon\Mvc\Controller;

class IndexController extends ControllerBase{

    public function initialize()
    {
        $this->tag->setTitle('Manage your Customers');

        parent::initialize();
    }

    public function indexAction(){

        $this->assets->addCss('css/style.css');
        $this->assets->addCss('css/index.css');

        $this->view->customers = Customers::find();

    }

    // Add new Customer
    public function newAction(){

        $this->assets->addCss('css/index.css');

        $this->view->form = new CustomerForm();

    }

    // Insert a new customer
    public function createAction(){

        // No $_POST, redirect back to addCustomer
        if( !$this->request->isPost()) {
            $this->response->redirect('/index/new');
        }

        $form = new CustomerForm();

        // Check if Input is valid, otherwise redirect
        if (!$form->isValid($_POST)) {

            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "new",
                ]
            );

        }

        $customer = new Customers();

        // Store and check for errors
        $success = $customer->save(
            $this->request->getPost(),
            [
                "first_name",
                "last_name",
                "email"
            ]
        );

        if ($success) {

            $this->flash->success( "Kunde erfolgreich angelegt" );
            return $this->dispatcher->forward(
                [
                    'action' => 'index'
                ]);

        } else {
            $messages = $customer->getMessages();

            foreach ($messages as $message) {
                $this->flash->error( $message );
            }

            return $this->dispatcher->forward(
                [
                    'action' => 'new'
                ]);
        }

    }

}