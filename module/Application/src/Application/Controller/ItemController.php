<?php

//Khai bao namespace 

namespace Application\Controller;

//Load lớp AbstractActionController vào CONTROLLER
use Zend\Mvc\Controller\AbstractActionController;
//Load lớp ViewModel vào CONTROLLER
use Zend\View\Model\ViewModel;

class ItemController extends AbstractActionController {

    public function indexAction() {
//In ra tên của phương thức abcAction
        echo '<br />' . __METHOD__;
//Khởi tạo đối tượng ViewModel và chuyền giá vào đối tượng
        $view = new ViewModel(array('website' => 'Chào mừng các bạn đến với website www.zend.vn'));

//Truyền đối tượng ViewModel ra ngoài VIEW
        return $view;
    }

    public function abcAction() {
//In ra tên của phương thức abcAction
        echo '<br />' . __METHOD__;
//Khởi tạo đối tượng ViewModel và chuyền giá vào đối tượng
        $view = new ViewModel(array('website' => 'Chào mừng các bạn đến với website www.zend.vn'));

//Truyền đối tượng ViewModel ra ngoài VIEW
        return $view;
    }

}
