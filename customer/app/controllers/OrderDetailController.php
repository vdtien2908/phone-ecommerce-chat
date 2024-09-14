<?php
class OrderDetailController extends BaseController
{
    private $orderDetailModel;

    public function __construct()
    {
        $this->orderDetailModel = $this->model('orderDetailModel');
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
