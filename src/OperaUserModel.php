<?php

namespace Janmas\PlatformDataDistribute;

use Illuminate\Support\Facades\Validator;

/**
 * @property string name 姓名
 * @property string avatarFile 头像
 * @property string groups 分组
 * @property string icNumber IC卡号
 * @property string jobNumber   工号
 * @property string mobile  手机号
 * @property string remark  备注
 * @property string gender  性别
 * @property string idNumber    身份证号
 * @property array condition    条件
 * @property int page    页码
 * @property int limit   每页条数
 * @property string order 排序
 */
class OperaUserModel
{

    /**
     * 接受用户信息
     * @param array $data
     * @return void
     */
    public function setAttrs(array $data = []): void
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @param $validate
     * @return true
     * @throws \Exception
     */
    public function validator($validate): bool|\Exception
    {

        $validator = Validator::make($this->toArray(), $validate);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return true;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name ?? '';
    }
}