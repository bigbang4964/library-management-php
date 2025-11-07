<?php
class BorrowController extends Controller {
    public function index() {
        $borrowModel = $this->model('Borrow');
        $data['records'] = $borrowModel->getAllRecords();
        $this->view('borrow/index', $data);
    }

    public function add() {
        $bookModel = $this->model('Book');
        $userModel = $this->model('User');
        $data['books'] = $bookModel->getAllBooks();
        $data['users'] = $userModel->getAllUsers();
        $this->view('borrow/form', $data);
    }

    public function store() {
        $borrowModel = $this->model('Borrow');
        $borrowModel->insert($_POST);
        header("Location: /Borrow/index");
    }

    public function returnBook($id) {
        $borrowModel = $this->model('Borrow');
        $borrowModel->markAsReturned($id);
        header("Location: /Borrow/index");
    }

    public function delete($id) {
        $borrowModel = $this->model('Borrow');
        $borrowModel->delete($id);
        header("Location: /Borrow/index");
    }
}
