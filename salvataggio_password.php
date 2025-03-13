<?php
$userPass='mia_password';//$_POST[]
$hashPassword=password_hash($userPass,PASSWORD_DEFAULT);
echo $hashPassword;
echo '<br>';
if(password_verify('mia_password',$hashPassword)){
    echo 'password ok';
}