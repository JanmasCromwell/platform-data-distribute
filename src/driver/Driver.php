<?php

namespace Janmas\PlatformDataDistribute\driver;

use Janmas\PlatformDataDistribute\OperaUserModel;
use Guzzle\Http\Client;

abstract class Driver
{
    protected $config = [];

    protected $client = null;

    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);
        $this->initClient();
    }

    protected function intClient()
    {
        /**
         * 在各个子类里初始化client
         */
        $this->client = new Client();
    }

    abstract public function createUser(OperaUserModel $userModel): array;

    abstract public function updateUser(OperaUserModel $userModel): array;

    abstract public function deleteUser(OperaUserModel $userModel): array;

    abstract public function hasUser(OperaUserModel $userModel): array;

    abstract public function getUser(OperaUserModel $userModel): array;

    abstract public function getList(OperaUserModel $userModel): array;
}