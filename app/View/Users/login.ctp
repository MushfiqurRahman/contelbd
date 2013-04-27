<?php 
    echo $this->Form->create('User',array('type' => 'post','action' => 'login')); 
    echo $this->Form->input('email',array('type' => 'text', 'label' => 'Email'));
    echo $this->Form->input('password',array('type' => 'password', 'lable' => 'Password'));
    echo $this->Form->end('Login');
?>