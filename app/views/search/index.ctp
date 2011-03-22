<?php
echo $form->create(false, array('action' => 'results'));
echo $form->input('term', array('label' => 'Search For: '));
echo $form->submit();
?>