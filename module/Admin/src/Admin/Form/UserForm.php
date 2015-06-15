<?php

namespace Admin\Form;

use Zend\Form\Form;

class UserForm extends Form {

    public function __construct($name = null) {
        parent::__construct('appForm');
        //Khai báo phương thức sử dụng trong FORM
        $this->setAttribute('method', 'post');
        //Khai báo kiểu dữ liệu được gửi lên server 
        $this->setAttribute('enctype', 'multipart/form-data');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        //Khai báo phần tử textbox 'username'
        $this->add(array(
            'name' => 'username',
            'attributes' => array(
                'type' => 'text',
                'required' => 'required',
                'class' => 'txtInput txtMedium'
            ),
            'options' => array(
                'label' => 'Username:',
            ),
        ));

        //Khai báo phần tử textbox 'username'
        $this->add(array(
            'name' => 'picture',
            'attributes' => array(
                'type' => 'file',
                //'required' => 'required',
                'class' => 'txtInput txtMedium'
            ),
            'options' => array(
                'label' => 'Avatar:',
            ),
        ));


        //Khai báo phần tử textbox 'email'
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'text',
                'required' => 'required',
                'class' => 'txtInput txtMedium'
            ),
            'options' => array(
                'label' => 'Email:',
            ),
        ));

        //Khai báo phần tử textbox 'password'
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
                'required' => 'required',
                'class' => 'txtInput txtMedium'
            ),
            'options' => array(
                'label' => 'Password:',
            ),
        ));

        //Khai báo phần tử selectbox 'group'
        $this->add(array(
            'name' => 'group',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'class' => 'txtInput txtMedium',
            ),
            'options' => array(
                'label' => 'Group name:',
                'value_options' => array(
                    'admin' => 'Admin group',
                    'member' => 'Member group',
                ),
            ),
        ));

        //submit
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Send data'
            ),
        ));
    }

    public function upload($files = array(), $file_path = '') {

        $fileName = '';

        if (count($files) != 0 && $file_path != '') {
            $fileName = $files['picture']['name'];

            $uploadObj = new \Zend\File\Transfer\Adapter\Http();
            $uploadObj->setDestination($file_path);
            $uploadObj->receive($fileName);
        }

        return $fileName;
    }

}
