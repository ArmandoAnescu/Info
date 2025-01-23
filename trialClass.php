<?php
require_once 'Person.php'; // importa la classe person da person.php
$p1 = new Person('giovanni', 22, 'giovanni@gmail.com');
echo $p1->getName().'<hr>';
echo $p1->getAge().'<hr>';
echo $p1->getEmail().'<hr>';