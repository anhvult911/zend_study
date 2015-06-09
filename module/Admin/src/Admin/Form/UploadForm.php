<?php

//Khai bao namespace cho class UploadForm

namespace Admin\Form;

//Gọi đến CLASS chứa đối tượng tạo FORM
use Zend\Form\Form;

class UploadForm extends Form {

    public function __construct($name = null) {
        parent::__construct('appForm');
//Khai báo phương thức sử dụng trong FORM
        $this->setAttribute('method', 'post');
        //Khai báo kiểu dữ liệu được gửi lên server 
        $this->setAttribute('enctype', 'multipart/form-data');

        //Khai báo phần tử textbox 'username'
        $this->add(array(
            'name' => 'picture',
            'attributes' => array(
                'type' => 'file',
                'required' => 'required',
                'class' => 'txtInput txtMedium'
            ),
            'options' => array(
                'label' => 'File upload:',
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
