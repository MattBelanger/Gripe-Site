<?php
class CommentsController extends AppController {

	var $name = 'Comments';

	function index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid comment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('comment', $this->Comment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Comment->create();
      $this->data['Comment']['ip'] = $this->RequestHandler->getClientIp();
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__('The comment has been saved', true),'flash_success');
				$this->redirect($this->data['Comment']['return_to']);
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.', true),'flash_error');
			}
		}
		$posts = $this->Comment->Post->find('list');
		$users = $this->Comment->User->find('list');
		$this->set(compact('posts', 'users'));
	}

	function admin_index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Comment->create();
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__('The comment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.', true));
			}
		}
		$posts = $this->Comment->Post->find('list');
		$users = $this->Comment->User->find('list');
		$this->set(compact('posts', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid comment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__('The comment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comment->findById($id);
		}
		$posts = $this->Comment->Post->find('list');
		$users = $this->Comment->User->find('list');
		$this->set(compact('posts', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for comment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Comment->delete($id)) {
			$this->Session->setFlash(__('Comment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Comment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>