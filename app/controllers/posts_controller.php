<?php
class PostsController extends AppController {

	var $name = 'Posts';
	var $uses = array('User','Post');
	var $paginate = array('order' => 'Post.time_posted DESC');

	function index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate('Post', array('Post.status' => 1)));
	}

	function view($slug = null) {
		$post = $this->Post->find('first',array('conditions' => array('Post.slug' => $slug), 'recursive' => 2));
    $this->set('title_for_layout', $post['Post']['title']);
		$this->set('post', $post);
		if (!($slug || $post)) {
			$this->Session->setFlash('Invalid post');
			$this->redirect(array('action' => 'index'));
		}
	}

	function submit() {
    $this->set('title_for_layout', 'Share Your Story');
		$authUser = $this->Auth->user();
		$this->set('user',$authUser);
	}

	function search() {
		if ($this->data) {
			$cond = array('OR' =>
			array('Post.title LIKE ' => '%'.$this->data['search'].'%',
  		    'Post.body' => '%'.$this->data['search'].'%'
  		    ));
		}
			
	}

	function save() {
		if ($this->data) {
			$user = $this->User->find('first',array('conditions' => array('User.email' => $this->data['Post']['email'])));
			$authUser = $this->Auth->user();
			if ($user && !$authUser) {
				$this->Session->write('post', $this->data['Post']);
				$this->Session->setFlash('Please log in to your account to post.','flash_error');
				$this->redirect('/users/login');
				exit;
			} else if (!$user) {
				$password = '';
				for ($i=0;$i<12;$i++) {
					$password .= chr(rand(65,90));
				}
				$hashedPw = $this->Auth->hashPasswords(array('User' => array('username' => $this->data['Post']['email'],'password' => $password)));
				$user = $this->User->createNewUser($this->data['Post']['email'],$password,$hashedPw['User']['password']);
				if (!$user) {
					$notOK = true;
					$this->Session->setFlash('Please enter all fields, and a valid email address, to continue','flash_error');
				}
				$this->set('post',$this->data);
			} else if ($user && $authUser && ($user['User']['id'] != $authUser['User']['id'])) {
				$this->Session->write('post', $this->data['Post']);
				$this->Session->setFlash('Please log in to your account to post.','flash_error');
				$this->redirect('/users/login');
			}

			if (strlen($this->data['Post']['body']) < 512) {
				$teaser = $this->data['Post']['body'];
			} else {
				$tArray = split("\n",$this->data['Post']['body']);
				$teaser = $tArray[0];
			}

			$post = array('Post' =>
			array('title' => $this->data['Post']['title'],
                          'body' => $this->data['Post']['body'],
                          'teaser' => $teaser,
                          'status' => 2,
                          'user_id' => $user['User']['id']));
			$this->Post->save($post);

			if (!$notOK) {
				$this->Session->setFlash('Thank you for your contribution to '.SITE_NAME.'.<br>We will review your submission shortly.','flash_success');
				$this->redirect('/');
				exit;
			}
		}
		$this->redirect('/posts/submit');
		exit;
	}

	function admin_edit($id = null) {
		if (!empty($this->data)) {
      if ($this->data['Post']['id']) $id = $this->data['Post']['id'];
			if ($id) {
				$post = $this->Post->findById($id);
				if (!$post) {
					$this->Session->setFlash(__('Invalid post', 'flash_error'));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$this->data['Post']['user_id'] = $this->Session->read('Auth.User.id');
			}

      $oldStatus = $post['Post']['status'];
			foreach ($this->data['Post'] as $index => $d) {
        if ($index == 'status' && $d == 1 && $oldStatus != 1) {
          $post['Post']['time_posted'] = date('Y-m-d H:i:s');
        }
				$post['Post'][$index] = $d;
			}

			if ($this->Post->save($post)) {
				$this->Session->setFlash(__('The post has been saved', 'flash_success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.', 'flash_error'));
			}
		}

		if (empty($this->data) && $id) {
			$post = $this->Post->findById($id);
			$this->set('post',$post);
		}

		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
		$this->render('edit');
	}

  function admin_modqueue() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate('Post',array('Post.status' => 2)));
  }

	function admin_index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate('Post'));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid post', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Post->create();
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The post has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for post', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash(__('Post deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Post was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>