<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{   
    protected $users = [
        'test'=>'test',
        'ziya'=>'ziya',
    ];

    public function index(){
        return 1;
    }

    /**
     * 用户登录接口
     *
     * @param Request $req
     * @return mixed
     */
    public function login(Request $req){
        $data = [
            'errcode'=>5011,
            'errmsg'=>'用户名或密码错误！',
        ];
        if ( (isset($this->users["$req->name"])) && ($this->users["$req->name"] == $req->pwd) ) {
            $data['errcode'] = 0;
            $data['errmsg'] = '登陆成功，欢迎您，' . $req->name;
        }
        return json_encode($data);
    }
}
