<?php

namespace Janmas\PlatformDataDistribute;

use App\Models\LinkUsers;
use Dingo\Api\Routing\Helpers;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Janmas\PlatformDataDistribute\driver\Driver;

/**
 * @method array hasUser(OperaUserModel $userModel)
 * @method array createUser(OperaUserModel $userModel)
 * @method array updateUser(OperaUserModel $userModel)
 * @method array deleteUser(OperaUserModel $userModel)
 * @method array getUser(OperaUserModel $userModel)
 * @method array getUserList(OperaUserModel $userModel)
 * @method array getGroupList(OperaUserModel $userModel)
 * @method array getGroupUserList(OperaUserModel $userModel)
 * @method array getGroupUserCount(OperaUserModel $userModel)
 * @method array getGroupUserListByPage(OperaUserModel $userModel)
 */
class Interactives
{
    use Helpers;

    const SUCCESS_CODE = 200;
    const ERROR_CODE = 201;
    const ERRORMSG = [
        'status'  => 201,
        'message' => '算法失效, 请联系管理员'
    ];

    /**
     * 算法平台驱动
     * @var Driver
     */
    protected $driver = null;

    public function __construct(string $type = 'senselink')
    {
        $class = __NAMESPACE__ . '\\driver\\' . ucfirst($type);
        if (!class_exists($type)) {
            throw new \Exception(sprintf('平台%s不存在', $type));
        }
        $this->driver = new $class();
    }

    /**
     * 查询人员是否存在于算法平台上面
     * @param false $mobile
     * @param false $jobNumber
     * @param false $id
     * @return array
     */
    function isHavePerson(OperaUserModel $userModel)
    {
        return $this->driver->hasUser($userModel);
    }


    /**
     * 算法平台添加人员
     * @return array
     */
    function addPerson(OperaUserModel $userModel)
    {
        $res = $this->driver->createUser($userModel);
        if (200 !== $res['code']) {
            Log::channel('link_user')->info('addPerson', $res);
            $res['message'] = Lang::get('linkmsg.' . $res['message']);
        }
        return $res;
    }

    public function __call($name, $args)
    {
        if (!method_exists($name, $this)) {
            return $this->driver->$name($args);
        }
    }
}