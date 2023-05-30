<?php

include 'vendor/autoload.php';

$type = 'senselink';
$validate = [];//用laravel的验证规则
$userModal = new \Janmas\PlatformDataDistribute\OperaUserModel();
$userModal->setAttrs([
    'id' => 1,
]);
$userModal->validator($validate);
$in = new \Janmas\PlatformDataDistribute\Interactives($type);
$in->hasUser($userModal);