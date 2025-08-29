<h1>Edit Users info page</h1>
<?php 
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->input('id', array('type'=>'hidden'));
echo $this->Form->end('Save');
?>