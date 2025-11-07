<?php
class UserController extends Controller {
    public function index() {
        $userModel = $this->model('User');
        $keyword = $_GET['search'] ?? '';
        $data['users'] = $userModel->getAllUsers($keyword);
        $data['keyword'] = $keyword;
        $this->view('users/index', $data);
    }

    public function add() {
        $this->view('users/form');
    }

    public function store() {
        $userModel = $this->model('User');
        $userModel->insert($_POST);
        header("Location: /User/index");
    }

    public function edit($id) {
        $userModel = $this->model('User');
        $data['user'] = $userModel->getUserById($id);
        $this->view('users/form', $data);
    }

    public function update($id) {
        $userModel = $this->model('User');
        $userModel->update($id, $_POST);
        header("Location: /User/index");
    }

    public function delete($id) {
        $userModel = $this->model('User');
        $userModel->delete($id);
        header("Location: /User/index");
    }
}
