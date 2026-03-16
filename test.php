<?php
require __DIR__ . '/models/User.php';
$u = new User();
var_dump($u->createUser(['name'=>'TesteScript','email'=>'teste-script@example.com','password'=>'123456']));
