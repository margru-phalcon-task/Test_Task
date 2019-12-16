<?php

use Phalcon\Mvc\Controller;

class IndexController extends ControllerBase{

    public function initialize()
    {
        $this->tag->setTitle('Manage your Customers');

        parent::initialize();
    }

    // ToDo: Pagination
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

     // Edits a customer based on its id
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $customer = Customers::findFirstById($id);

            if (!$customer) {
                $this->flash->error("Customer was not found");

                return $this->dispatcher->forward(
                    [
                        "controller" => "index",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new CustomerForm(
                $customer,
                [
                    'edit' => true,
                ]
            );

        }
    }

    // DB - Insert a new customer
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

    // DB - Saves a new customer
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");

        $customer = Customers::findFirstById($id);

        if (!$customer) {
            $this->flash->error("Customer does not exist");

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

        $form = new CustomerForm();

        $this->view->form = $form;

        $data = $this->request->getPost();

        if (!$form->isValid($data, $customer)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        if ($customer->save() == false) {
            foreach ($customer->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        $form->clear();

        $this->flash->success("Customer was updated successfully");

        return $this->dispatcher->forward(
            [
                "controller" => "index",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a product
     *
     * @param string $id
     *
     * ToDo: Ask if sure
     *
     */
    public function deleteAction( $id ) {
        $customers = Customers::findFirstById($id);

        if (!$customers) {
            $this->flash->error("Customer was not found");

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

        if (!$customers->delete()) {
            foreach ($customers->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

        $this->flash->success("Customer was deleted");

        return $this->dispatcher->forward(
            [
                "controller" => "index",
                "action"     => "index",
            ]
        );
    }

}