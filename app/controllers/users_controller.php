<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $components = array('Auth');

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

  function profile($id) {
    $this->User->bindModel(array('hasMany' => array('Post')));
    $user = $this->User->findById($id);
    if (!$user) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
    }

    $this->set('title_for_layout', $user['User']['username']);

    $this->set('user',$user);
    $loggedInUser = $this->Auth->user();
    if ($loggedInUser['User']['id'] == $id || $this->User->isAdmin($loggedInUser)) {
      $this->render('edit');
    } else {
      $this->render('view');
    }
  }

  function save() {
    $id = $this->data['User']['id'];
    $loggedInUser = $this->Auth->user();
    if ($loggedInUser['User']['id'] == $id || $this->User->isAdmin($loggedInUser)) {
      if (!empty($this->data)) {
        if ($this->User->save($this->data)) {
          $this->Session->setFlash('The user has been saved', 'flash_success');
        } else {
          $this->Session->setFlash('The user could not be saved. Please, try again.', 'flash_error');
        }
      }
    } else {
      $this->Session->setFlash('The user could not be saved. Please, log in and try again.', 'flash_error');
    }
    $this->redirect('/users/profile/'.$id);
  }

	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}



	function admin_add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

  function login() {
  }

  function logout() {
    $this->redirect($this->Auth->logout());
  }
}
?>