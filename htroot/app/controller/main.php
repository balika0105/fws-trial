<?php
    class main extends controller{
        public function index(){
            $this->view("basics/header");
            $this->view("home");
            $this->view("basics/footer");
        }
    }
?>