<?php
class ContactController extends BaseController
{
    public function index()
    {
        $this->view(
            'app',
            [
                'page' => 'contact/index',
                'title' => 'Contact',
            ]
        );
    }
}
