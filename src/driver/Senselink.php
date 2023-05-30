<?php

namespace Janmas\PlatformDataDistribute\driver;

use Janmas\PlatformDataDistribute\OperaUserModel;

class Senselink extends Driver
{

    public function createUser(OperaUserModel $userModel): array
    {

        $res = $this->client->get('asdasda');//向平台发起请求
        $res = [
            'error_code' => 100001,
            'msg'        => '',
            'content'    => []
        ];
        //假设平台返回的是这个类型的 我们依旧需要转换成我们需要的格式
        return [
            'code'    => $res['error_code'],
            'message' => $res['msg'],
            'data'    => $res['content'],
        ];
    }

    public function updateUser(OperaUserModel $userModel): array
    {
        return [];
    }

    public function deleteUser(OperaUserModel $userModel): array
    {
        return [];
    }

    public function getUser(OperaUserModel $userModel): array
    {
        return [];
    }

    public function getList(OperaUserModel $userModel): array
    {
        return [];
    }

    public function hasUser(OperaUserModel $userModel): array
    {
        return [];

    }
}