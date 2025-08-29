<?php

class UsersController extends AppController{
    public $helpers = array('Html', 'Form', 'Flash', 'Session');

    public function beforeFilter() { // called before every action in the controller
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
    }

    
    public function isAuthorized($user){
        if (in_array($this->action, array('edit', 'delete'))){
            $userId = (int)$this->request->params['pass'][0];
            if ($userId === $user['id']) return true;
        }
        return parent::isAuthorized($user);
    }

    public function login(){
        if ($this->request->is('post')){
            if ($this->Auth->login()){
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid credentials, try again'));
        }
    }
    public function logout(){
        return $this->redirect($this->Auth->logout());
    }

    public function index(){
        $this->User->recursive = 0; //selects only users from the table not related tables
        $this->set('users', $this->paginate());
    }
    public function view($id = null){
        $this->User->id = $id;
        if (!$this->User->exists()){
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function add(){
        if($this->request->is('post')){
            $this->User->create();
            if ($this->User->save($this->request->data)){
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action'=>'index'));
            }
            $this->Flash->error(__('The user couldn\'t be saved, please try again.'));
        }
    }

    public function edit($id = null){
        $this->User->id = $id;
        if (!$this->User->exists()){
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')){
           if ($this->User->save($this->request->data)){
            $this->Flash->success(__('The user has been saved'));
            return $this->redirect(array('action' => 'index'));
           }
           $this->Flash->error(__('The user couldn\'t be saved. Please, try again.')
        );
        }
        else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }

    }

    public function delete($id = null){
        $this->request->allowMethod('post');
        $this->User->id = $id;
        if (!$this->User->exists()){
            throw new NotFoundException(__("Invalid user"));
        }
        $loggedUser = $this->Auth->user('id');

        if ($this->User->delete($id)){
            $this->Flash->success(__("User succesfully deleted"));
            if ($loggedUser == $id) {
                return $this->redirect($this->Auth->logout());
            }
            return $this->redirect(array('action'=>'index'));
        }
        $this->Flash->error(__('Couldn\'t delete user, please try again later.'));
        $this->redirect(array('action'=>'index'));
    }
}