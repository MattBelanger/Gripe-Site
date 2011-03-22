<?php
class SearchController extends AppController {

	var $name = 'Search';
	var $components = array('Auth');
  var $uses = 'Post';

	function index() {

	}

  function results() {
    if (!$this->data['term']) {
      $this->Session->setFlash('Please enter a search term','flash_error');
      $this->redirect(array('action' => 'index'));
      exit;
    }

    $terms = split(' ',$this->data['term']);
    $searchTerms = array();
    foreach ($terms as $t) {
      $term = trim($t);
      $searchTerms[] = array('Post.title LIKE ' => '%'.$term.'%');
      $searchTerms[] = array('Post.body LIKE ' => '%'.$term.'%');
    }

    $results = $this->paginate('Post',array('OR' => $searchTerms,
                                            'Post.status' => 1));
    $this->set('posts',$results);
    $this->render('/posts/index');
  }

}
?>