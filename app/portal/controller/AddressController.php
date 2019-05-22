<?php
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class AddressController extends HomeBaseController
{
    /**
     * 用户地址列表
     */
    public function index()
    {
        $user_id = cmf_get_current_user_id();
        $list = Db::name('address')->where('user_id', $user_id)->select();

        $this->assign('page', $list);
        return $this->fetch("/address");
    }

    /**
     * 用户地址添加
     * 传: username收件人, province省份, city城市, details详细地址, phone手机号
     */
    public function add()
    {
        $data = $this->request->param(); // 商品id
        $user_id = cmf_get_current_user_id();
        $data['user_id'] = $user_id;

        $result = Db::name('address')->insert($data);

        $this->success('添加成功!');
    }

    /**
     * 用户地址删除
     * 传: 地址id
     */
    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval'); // 地址id
        $user_id = cmf_get_current_user_id();

        $result = Db::name('address')->where('id', $id)->where('user_id', $user_id)->delete();
        $user_id = cmf_get_current_user_id();
        $list = Db::name('address')->where('user_id', $user_id)->select();

        $this->assign('page', $list);
        return $this->fetch("/address");

    }

}
