<?php

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        //echo __METHOD__;
        return $this->tableGateway->select();
    }

    public function getUser($id = 0) {
        $row = null;
        //Trong trường hợp id truyền vào khác 0 thì chúng ta sẽ lấy ra thông tin USER
        if ((int) $id != 0) {
            //Lay ra tập hợp dữ liệu theo id truyen vao
            $rowset = $this->tableGateway->select(array('id' => $id));
            //Lấy đối tượng đầu tiên trong đối tượng $rowset
            $row = $rowset->current();
        }

        //Trả về một đối tượng nếu id tồn tại trong database
        return $row;
    }

    public function saveUser(User $user) {
        $data = array(
            'username' => $user->username,
            'picture' => $user->picture,
            'email' => $user->email,
            'password' => $user->password,
            'group' => $user->group,
        );

        $id = (int) $user->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('User id does not exist');
            }
        }
    }

    public function saveData($arrParam = array(), $options = array()) {
        //Loại bỏ phần tử 'submit' trong mảng được POST qua
        unset($arrParam['submit']);

        //Nếu $options['task'] có giá trị 'add' thì thêm một record mới trong database
        if ($options['task'] == 'add') {
            $this->tableGateway->insert($arrParam);
        }
    }

    public function deleteData($arrParam = array(), $options = array()) {
        if ($options['task'] == 'one') {
            //Lấy id của USER muốn xóa trong mảng $arrParam
            $id = $arrParam['id'];

            //Lấy thông tin của USER
            $user = $this->getUser($id);

            //Lấy đường dẫn đến tập tin hình ảnh của USER
            $filePath = FILES_PATH . '/users/' . $user->picture;

            //Xóa hình ảnh của USER
            @unlink($filePath);

            //Xóa dữ liệu trong database theo id của USER truyền vào
            $this->tableGateway->delete(array('id' => $id));
        }
    }

}
