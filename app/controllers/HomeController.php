<?php
class HomeController extends Controller {
    public function index() {
        $data['title'] = "Trang chủ thư viện";
        $this->view('home', $data);
    }
}
