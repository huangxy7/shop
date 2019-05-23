<?php
namespace app\portal\controller;

use app\portal\model\PortalTagModel;
use cmf\controller\AdminBaseController;
use think\Db;

/**
 * Class AdminTagController 标签管理控制器
 * @package app\portal\controller
 */
class AdminTagController extends AdminBaseController
{
    /**
     * 审核用户退货
     */
    public function index()
    {
        $content = hook_one('portal_admin_page_index_view');

        if (!empty($content)) {
            return $content;
        }

        $data = Db::name('order')
            ->where('status', 2)
            ->paginate(10);

        $this->assign('pages', $data);
        $this->assign('page', $data->render());

        return $this->fetch();
    }

    /**
     * 确定退货
     */
    public function add()
    {
        $content = hook_one('portal_admin_page_add_view');

        if (!empty($content)) {
            return $content;
        }

        $id = $this->request->param('id', 0, 'intval');

        Db::name('order')->where('id', $id)->where('status', 2)->update(['status'=>3]);
        $this->success('操作成功!');
    }
}
