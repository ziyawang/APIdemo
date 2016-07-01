<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //测试用户数据，项目中，数据需要根据传来的用户名从数据库中取出
    protected $users = [
        'test'=>'test',
        'ziya'=>'ziya',
    ];

    /**
     * 用户登录接口
     *
     * @param Request $req
     * @return mixed
     */
    public function login(Request $req){
        //默认返回数据为$data
        //至少包含'errcode','errmsg'两个参数，如果需要大量数据返回，增加一个data多位数组存放
        //'errcode'具体错误代码信息统一制定标准
        $data = [
            'errcode'=>5011,
            'errmsg'=>'用户名或密码错误！',
        ];

        //接受到的参数必须进行安全处理
        $postName = $this->testInput($req->name);
        $postPwd = $this->testInput($req->pwd);

        //进行业务逻辑处理
        if ( (isset($this->users["$postName"])) && ($this->users["$postName"] == $postPwd) ) {
            $data['errcode'] = 0;
            $data['errmsg'] = '登陆成功，欢迎您，' . $req->name;
        }

        //返回json数据
        return json_encode($data);
    }

    protected function testInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
