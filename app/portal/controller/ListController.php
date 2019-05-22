<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class ListController extends HomeBaseController
{
    /***
     * 商品列表
     */
    public function index()
    {
        $id = $this->request->param('id', 0, 'intval'); // 分类id, 1保湿, 2blabla

        // 商品信息, 分页
        $list = Db::name('product')
            ->field('id, name, price, sales,image')
            ->where('category_id', $id)
            // ->select();
            ->paginate(5); // 分页

        $this->assign('list', $list);
        $lists = '666';
        $this->assign('lists', $lists);
        return $this->fetch('/list');
    }

    /***
     * 根据id返回商品信息
     */
    public function getGoods()
    {
        $id = $this->request->param('id'); // 商品id列表
        $id = explode(',', $id);
        // $id = json_decode($id);

        // 商品信息
        $list = Db::name('product')
            ->field('id, name, price, sales')
            ->where('id', 'in', $id)
            ->select();

        return $list;
    }

}
