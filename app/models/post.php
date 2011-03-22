<?php
class Post extends AppModel {
	var $name = 'Post';
	var $displayField = 'title';
  var $actsAs = array('Sluggable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		)
	);

  var $hasMany = array('Comment' => array('conditions' => array('Comment.status' => 1)));
                       

  var $validate = array('title' => 'notEmpty',
                        'body' => 'notEmpty'
                        );

}
?>