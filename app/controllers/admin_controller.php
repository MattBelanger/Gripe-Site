<?php
class AdminController extends AppController {

	var $uses = array('User','Post','Comment');

  function beforeFilter() {
    parent::beforeFilter();
    $user = $this->Auth->user();
    if ($user['User']['usertype'] < 2) {
      $this->Auth->deny($this->action);
    }
    $this->layout = 'admin';
  }

  function index() {
    $this->set('userCount',$this->User->find('count'));
    $this->set('adminCount',$this->User->find('count', array('conditions' => array('User.usertype > ' => 1))));
    $this->set('bannedCount',$this->User->find('count', array('conditions' => array('User.usertype' => 0))));
    $this->set('postCount',$this->Post->find('count'));
    $this->set('visPostCount',$this->Post->find('count', array('conditions' => array('Post.status ' => 1))));
    $this->set('queueCount',$this->Post->find('count', array('conditions' => array('Post.status ' => 2))));
    $this->set('denPostCount',$this->Post->find('count', array('conditions' => array('Post.status ' => 3))));
    $this->set('commentCount',$this->Comment->find('count'));
    $this->set('queueCommentCount',$this->Comment->find('count', array('conditions' => array('Post.status ' => 2))));


  }

}
?>