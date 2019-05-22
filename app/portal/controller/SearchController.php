<?php
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class SearchController extends HomeBaseController
{
    /**
     * 关键字搜索
     * @return mixed
     */
    public function index()
    {
        $keyword = $this->request->param('keyword', '', 'trim');

        if (empty($keyword)) {
            $this -> error("关键词不能为空！请重新输入！");
        }
        $where = [];
        if ($keyword) {
            $where[] = ['name', 'like', $keyword];
        }
        $list = Db::

        // 商品信息, 分页
        $list = Db::name('product')
            ->field('id, name, price, sales')
            ->where('category_id', $id)
            ->where($where)
            ->paginate(5); // 分页
       
        $this->assign('list', $list);

        return $this->fetch('/search');
    }
}
