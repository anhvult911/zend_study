<?php

//Khai bao namespace 

namespace Template\Controller;

//Load lớp AbstractActionController vào CONTROLLER
use Zend\Mvc\Controller\AbstractActionController;
//Load lớp ViewModel vào CONTROLLER
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {

        //'layout/home' => __DIR__ . '/../view/layout/index.phtml',
        //Gọi đến tập tin LAYOUT index.phtml trong thư mục layout của MODULE
        $this->layout('layout/home');
    }

    public function aboutAction() {

        //'layout/about'  => __DIR__ . '/../view/layout/about.phtml',
        //Gọi đến tập tin LAYOUT index.phtml trong thư mục layout của MODULE
        $this->layout('layout/about');
    }

    public function contactAction() {

        //'layout/contact'   => __DIR__ . '/../view/layout/contact.phtml',
        //Gọi đến tập tin LAYOUT index.phtml trong thư mục layout của MODULE
        $this->layout('layout/contact');
    }

    public function hairstyleAction() {

        //'layout/hairstyle'    => __DIR__ . '/../view/layout/hairstyle.phtml',
        //Gọi đến tập tin LAYOUT index.phtml trong thư mục layout của MODULE
        $this->layout('layout/hairstyle');
    }

    public function newsAction() {

        //'layout/news' => __DIR__ . '/../view/layout/news.phtml',
        //Gọi đến tập tin LAYOUT index.phtml trong thư mục layout của MODULE
        $this->layout('layout/news');
    }

}
