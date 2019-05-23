<?php
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class PreferController extends HomeBaseController
{
    /**
     * 用户收藏商品列表
     */
    public function index()
    {
        $user_id = cmf_get_current_user_id();
        $list = Db::name('prefer')
            ->field('p.id, name, price, image')
            ->alias('pf')
            ->join('product p', 'p.id=pf.pro_id')
            ->where('user_id', $user_id)
            ->select();

        $this->assign('page', $list);
        return $this->fetch("/prefer");
    }

    /**
     * 添加收藏
     * 传: 商品id
     */
    public function add()
    {
        $id = $this->request->param('id', 0, 'intval'); // 商品id
        $user_id = cmf_get_current_user_id();
        $data = [
            'user_id'    => $user_id,
            'pro_id' => $id,
        ];

        $result = Db::name('prefer')->insert($data);

        $this->success('添加成功!');
    }

    /**
     * 删除收藏
     * 传: index返回的收藏条目id
     */
    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval'); // 收藏id
        $user_id = cmf_get_current_user_id();

        $result = Db::name('prefer')->where('pro_id', $id)->where('user_id', $user_id)->delete();

        $this->success('删除成功!');
    }

}
