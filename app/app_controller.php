<?php
class AppController extends Controller {

  var $components = array('Auth','Session','RequestHandler');

  function beforeFilter() {
    $this->Auth->allow('*');
    $this->Auth->loginAction = array('admin' => false, 'controller' => 'users', 'action' => 'login');
    $this->Auth->flashElement = 'flash_error';
    $user = $this->Auth->user();
    $this->set('activeUser',$user);
    $this->User = ClassRegistry::init('User');
    $isAdmin = $this->User->isAdmin($user);
    $this->set('isAdmin',$isAdmin);
    if (substr($this->action,0,5) == 'admin') {
      if ($isAdmin) {
        $this->Auth->deny($this->action);
      } else {
        $this->layout = 'admin';
      }
    }
  }
}
