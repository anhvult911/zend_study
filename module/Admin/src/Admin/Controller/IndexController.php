<?php

namespace Admin\Controller;

use Admin\Form\UserForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Model\User;

class IndexController extends AbstractActionController {

    protected $userTable;

    public function indexAction() {
        $userTable = $this->getServiceLocator()->get('Admin\Model\UserTable');
        return new ViewModel(array('users' => $userTable->fetchAll()));
    }

    public function getUserTable() {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Album\Model\UserTable');
        }
        return $this->userTable;
    }

    public function addAction() {

        //Khởi tạo đối tượng UserForm
        $form = new UserForm();
        $form->get('submit')->setAttribute('value', 'Save');
        //Truyền đối tượng UserForm vào đối tượng ViewModel
        $viewModel = new ViewModel(array('form' => $form));

        //Lấy tất cả các giá trị được truyền qua từ FORM
        $request = $this->getRequest();

        if ($request->isPost()) {

            //Lấy mảng thông tin được gửi từ FORM lên
            $arrParam = $request->getPost()->toArray();

            //Lấy mảng thông tin của file gửi lên
            $files = $request->getFiles()->toArray();

            //Tạo một phần tử 'picture' trong mảng $arrParam
            $arrParam['picture'] = '';

            //Trong trường hợp có tập tin gửi lên 
            //thì gọi đến phương thức upload trong đối tượng UserForm            
            if (!empty($files['picture']['name'])) {
                //Lấy tên của tập tin upload đưa vào phần tử 'picture' trong mảng $arrParam
                $arrParam['picture'] = $form->upload($files, FILES_PATH . '/users');
            }

            //Gọi đối tượng UserTable đã khai báo trong đối tượng service
            $userTable = $this->getServiceLocator()->get('Admin\Model\UserTable');

            //Truyền mảng dự liệu $arrParam vào phương thức savaData 
            //của đối tượng Admin\Model\UserTable
            $userTable->saveData($arrParam, array('task' => 'add'));

            //Sau khi đưa dữ liệu vào datbase chúng trả nó về trang hiển thị dữ liệu        
            return $this->redirect()->toRoute('admin', array(
                        'controller' => 'index',
                        'action' => 'index'
            ));
        }

        //Đư đối tượng ViewModel ra ngoài VIEW
        return $viewModel;
    }

    public function deleteAction() {

        //Lay id của USER được truyền trên URL
        $id = $this->params()->fromRoute('id');
        echo '<br>' . $id;

        //Gọi đối tượng UserTable đã khai báo trong đối tượng service
        $userTable = $this->getServiceLocator()->get('Admin\Model\UserTable');

        //Gọi phương thức xóa dữ liệu trong Admin\Model\UserTable 
        $userTable->deleteData(array('id' => $id), array('task' => 'one'));

        //Sau khi xoa xong thi quay ve trang hien thi du lieu
        return $this->redirect()->toRoute('admin', array(
                    'controller' => 'index',
                    'action' => 'index'
        ));
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('admin', array(
                        'controller' => 'index',
                        'action' => 'add'
            ));
        }

        //Gọi đối tượng UserTable đã khai báo trong đối tượng service
        $userTable = $this->getServiceLocator()->get('Admin\Model\UserTable');
        $user = $userTable->getUser($id);
        if (!$user) {
            return $this->redirect()->toRoute('admin', array(
                        'controller' => 'index',
                        'action' => 'index'
            ));
        }
        $oldPicture = $user->picture;

        //Khởi tạo đối tượng UserForm
        $form = new UserForm();
        $form->bind($user);
        $form->get('submit')->setAttribute('value', 'Edit');
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                //Lấy mảng thông tin của file gửi lên
                $files = $request->getFiles()->toArray();
                //Lấy đường dẫn đến tập tin hình ảnh của USER
                $filePath = FILES_PATH . '/users/' . $oldPicture;

                //Xóa hình ảnh của USER
                @unlink($filePath);

                if (!empty($files['picture']['name'])) {
                    //Lấy tên của tập tin upload đưa vào phần tử 'picture' trong mảng $arrParam
                    $user->picture = $form->upload($files, FILES_PATH . '/users');
                }

                $userTable->saveUser($user);
                return $this->redirect()->toRoute('admin');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

}
