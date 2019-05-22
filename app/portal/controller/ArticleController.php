<?php
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class ArticleController extends HomeBaseController
{
    /**
     * 商品详情
     */
    public function index()
    {
        $id = $this->request->param('id', 0, 'intval'); // 商品id

        $goods = Db::name('product')->where('id', $id)->find();

        $this->assign('goods', $goods);

        return $this->fetch("/article");
    }


}
