<?php
namespace app\portal\controller;

use app\admin\model\RouteModel;
use cmf\controller\AdminBaseController;
use app\portal\model\PortalPostModel;
use app\portal\service\PostService;
use app\admin\model\ThemeModel;
use think\Db;

class AdminPageController extends AdminBaseController
{

    /**
     * 审核用户订单
     */
    public function index()
    {
        $content = hook_one('portal_admin_page_index_view');

        if (!empty($content)) {
            return $content;
        }

        $data = Db::name('order')
            ->where('status', 0)
            ->paginate(10);

        $this->assign('pages', $data);
        $this->assign('page', $data->render());

        return $this->fetch();
    }

    /**
     * 确定下单
     */
    public function add()
    {
        $content = hook_one('portal_admin_page_add_view');

        if (!empty($content)) {
            return $content;
        }

        $id = $this->request->param('id', 0, 'intval');

        Db::name('order')->where('id', $id)->where('status', 0)->update(['status'=>1]);
        $this->success('操作成功!');
    }

}
