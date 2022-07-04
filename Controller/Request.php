<?php
namespace Controller;

use Core\AbstractController;
use Helper\FormHelper;
use Model\Message;
use Model\Subject;

class Request extends AbstractController
{
    public function index(): void
    {
        $this->data['messages'] = Message::getAllRequests();
        $this->render('request/all');
    }

    public function add()
    {
        $form = new FormHelper('request/create', 'POST');
        $form->input([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Name'
        ]);
        $form->input([
            'name' => 'lastname',
            'type' => 'text',
            'placeholder' => 'Last name'
        ]);
        $form->input([
            'name' => 'email',
            'type' => 'text',
            'placeholder' => 'Email'
        ]);
        $form->input([
            'name' => 'phone',
            'type' => 'text',
            'placeholder' => 'Phone'
        ]);
        $subjects = Subject::getAll();
        $options = [];
        foreach ($subjects as $subject) {
            $id = $subject->getId();
            $options[$id] = $subject->getName();
        }
        $form->select(['name' => 'subject_id', 'options' => $options]);
        $form->textArea('message', 'Message');
        $form->input([
            'name' => 'submit',
            'type' => 'submit',
            'value' => 'Submit'
        ]);
        $this->data['form'] = $form->getForm();
        $this->render('request/add');
    }

    public function create()
    {
        $request = new Message();
        $request->setName($_POST['name']);
        $request->setLastName($_POST['lastname']);
        $request->setEmail($_POST['email']);
        $request->setPhone($_POST['phone']);
        $request->setSubjectId($_POST['subject_id']);
        $request->setMessage($_POST['message']);
        $request->setStatus(0);
        $request->save();
    }

    public function show($id)
    {
        $message = new Message();
        $this->data['message'] = $message->load($id);
    }

    public function delete($id)
    {
        $message = new Message();
        $message->delete($id);
    }
}