<?php

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class IndexController extends ControllerBase{

    public function initialize()
    {
        $this->tag->setTitle('Manage Contacts');

        parent::initialize();
    }

    // ToDo: Pagination
    public function indexAction(){

        $this->assets->addCss('css/style.css');
        $this->assets->addCss('css/index.css');

        $contacts = Contacts::find();
        $currentPage = isset($_GET['page'])? $_GET['page'] : 1 ;

        $paginator = new PaginatorModel(
            [
                'data'  => $contacts,
                'limit' => 10,
                'page'  => $currentPage,
            ]
        );

        // Get the paginated results
        $page = $paginator->getPaginate();
        $this->view->page = $page;
    }

    // Add new Contact
    public function newAction(){

        $this->assets->addCss('css/index.css');

        $this->view->form = new ContactForm();

    }

     // Edits a contact based on its id
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $contact = Contacts::findFirstById($id);

            if (!$contact) {
                $this->flash->error("Contact was not found");

                return $this->dispatcher->forward(
                    [
                        "controller" => "index",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new ContactForm(
                $contact,
                [
                    'edit' => true,
                ]
            );

        }
    }

    // DB - Insert a new contact
    public function createAction(){

        // No $_POST, redirect back to new
        if( !$this->request->isPost()) {
            $this->response->redirect('/index/new');
        }

        $form = new ContactForm();

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

        $contact = new Contacts();

        // Store and check for errors
        $success = $contact->save(
            $this->request->getPost(),
            [
                "first_name",
                "last_name",
                "email"
            ]
        );

        if ($success) {

            $this->flash->success( "Contact successfully added" );
            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]);

        } else {
            $messages = $contact->getMessages();

            foreach ($messages as $message) {
                $this->flash->error( $message );
            }

            return $this->dispatcher->forward(
                [
                    'action' => 'new'
                ]);
        }

    }

    // DB - Saves a new contact
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

        $contact = Contacts::findFirstById($id);

        if (!$contact) {
            $this->flash->error("Contact does not exist");

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

        $form = new ContactForm();

        $this->view->form = $form;

        $data = $this->request->getPost();

        if (!$form->isValid($data, $contact)) {
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

        if ($contact->save() == false) {
            foreach ($contact->getMessages() as $message) {
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

        $this->flash->success("Contact was updated successfully");

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
        $contacts = Contacts::findFirstById($id);

        if (!$contacts) {
            $this->flash->error("Contact was not found");

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

        if (!$contacts->delete()) {
            foreach ($contacts->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "index",
                    "action"     => "index",
                ]
            );
        }

        $this->flash->success("Contact was deleted");

        return $this->dispatcher->forward(
            [
                "controller" => "index",
                "action"     => "index",
            ]
        );
    }

}