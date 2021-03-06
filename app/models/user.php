<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'username';

  var $validate = array('username' => array('isUnique',
                                            'message' => 'Username already in use'),
                        'email' => 'email');
                        

  function createNewUser($email, $password, $hashedPw) {
    $emailParts = preg_split('/[+@]/i',$email);
    $username = $emailParts[0];
    $origName = $username;

    $ctr = 1;
    while (!$this->checkUsername($username)) {
      $username = $origName.$ctr;
      $ctr++;
    }

    $newUser = array('User' =>
                     array('username' => $username,
                           'password' => $hashedPw,
                           'usertype' => 1,
                           'email' => $email));

    $emailBody = "Thank you for making an account at ".SITE_NAME.".

Your username is $username, and your password is $password.

You can login in here: ".SITE_URL."/users/login 

After logging in, we suggest you change your password, and you may update your username if desired.

Note: If you submitted a story, you do not need to log in for it to be posted.  We have created this account as a convenience for you.

Thank you,
The ".SITE_NAME." Team";

    $this->log("New Account.  User Name: $username, Password: $password");

    if ($this->save($newUser)) {
      mail($email,'Your Account at '.SITE_NAME,$emailBody, "From: noreply@".SITE_URL);
      $newUser['User']['id'] = $this->getLastInsertID();
      return $newUser;
    } else {
      return false;
    }
  }

  function checkUsername($username) {
    $existing = $this->find('first',array('conditions' => array('User.username' => $username)));
    return (!$existing);
  }

  function isAdmin($user) {
    return $user['User']['usertype'] == 2;
  }
}
?>