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

        return $this->fetch("/$tplName");
    }


}
