<?php
class BookController extends Controller {
    public function index() {
        $bookModel = $this->model('Book');
        $data['books'] = $bookModel->getAllBooks();
        $this->view('books/index', $data);
    }

    public function add() {
        $this->view('books/form');
    }

    public function store() {
        $bookModel = $this->model('Book');
        $bookModel->insert($_POST);
        header("Location: /Book/index");
    }

    public function edit($id) {
        $bookModel = $this->model('Book');
        $data['book'] = $bookModel->getBookById($id);
        $this->view('books/form', $data);
    }

    public function update($id) {
        $bookModel = $this->model('Book');
        $bookModel->update($id, $_POST);
        header("Location: /Book/index");
    }

    public function delete($id) {
        $bookModel = $this->model('Book');
        $bookModel->delete($id);
        header("Location: /Book/index");
    }
}
