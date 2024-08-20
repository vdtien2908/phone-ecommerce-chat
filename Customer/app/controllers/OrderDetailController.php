<?php
class OrderDetailController extends BaseController
{
    private $orderDetailtModel;

    public function __construct()
    {
        $this->orderDetailtModel = $this->model('orderDetailtModel');
    }
    public function index()
    {
        $this->view(
            'app',
            [
                'page' => 'shop/index',
                'title' => 'Shop',
            ]
        );
    }
}
