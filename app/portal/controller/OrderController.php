<?php
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class OrderController extends HomeBaseController
{
    /**
     * 用户订单列表
     */
    public function index()
    {
        $user_id = cmf_get_current_user_id();
        $list = Db::name('order')->where('user_id', $user_id)->select();
        
        $this->assign('page', $list);
        return $this->fetch("/shop");
    }

    /**
     * 用户订单详情, 貌似用不到这个
     * 传: 订单id
     */
    public function read()
    {
        $id = $this->request->param('id', 0, 'intval'); // 订单id
        $user_id = cmf_get_current_user_id();

        $info = Db::name('order')
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->find();

        // 订单的商品信息
        $info['goods'] = Db::name('order_data')
            ->field('p.name, p.price, o.amount')
            ->alias('o')
            ->join('product p', 'o.product_id = p.id')
            ->where('order_id', $id)
            ->select();
        
        $this->assign('info', $info);
        return $this->fetch("/order");
    }

    /**
     * 用户下单
     * 传: goods商品列表, address地址, username收件人名字, phone手机号
     * 商品列表格式: [商品1id=>商品1个数, ...]
     */
    public function add()
    {
        $goods = $this->request->param('goods', []); // 商品列表
        if (empty($goods)) {
            $this->error('请添加商品');
        }

        $data = $this->request->param();
        $data['goods'] = json_decode($data['goods'], true);

        $user_id = cmf_get_current_user_id();
        $order_num = time() . $user_id . rand(100,999); // 订单号
        $order_num = substr($order_num, 0, 15);

        // 计算订单总价
        $total_price = 0;
        foreach ($data['goods'] as $key => $value) {
            $price = Db::name('product')->where('id', $key)->value('price');
            $total_price = $total_price + $price * $value;
        }
        
        $data['user_id'] = $user_id;
        $data['ordertime'] = time();
        $data['order_num'] = $order_num;
        $data['status'] = 1; // 等待审核
        $data['total_price'] = $total_price; // 订单总价

        $order_id = Db::name('order')->insertGetId($data);

        $order_data = [];
        foreach ($data['goods'] as $key => $value) {
            $d = [
                'order_id' => $order_id,
                'product_id' => $key,
                'amount' => $value,
            ];
            $order_data[] = $d;
        }
        Db::name('order_data')->insertAll($order_data);
        
        $this->success('下单成功!');
    }

    /**
     * 用户退货退款
     * 传: 订单id
     */
    public function refund()
    {
        $id = $this->request->param('id', 0, 'intval'); // 订单id
        $user_id = cmf_get_current_user_id();

        $result = Db::name('order')
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->update([
                'status' => 2,
            ]);
        
        $this->success('等待退款!');
    }

    /**
     * 用户撤销退货退款
     * 传: 订单id
     */
    public function undo()
    {
        $id = $this->request->param('id', 0, 'intval'); // 订单id
        $user_id = cmf_get_current_user_id();

        $result = Db::name('order')
            ->where('id', $id)
            ->where('user_id', $user_id)
            ->update([
                'status' => 1,
            ]);
        
        $this->success('撤销申请成功!');
    }

}
