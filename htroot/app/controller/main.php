<?php
    class main extends controller{
        public function index(){
            $this->view("basics/header");
            $this->view("home");
            $this->view("basics/footer");
        }

        public function processor(){
            switch($_POST["action"]){
                case "csvupload":
                    $this->model("csvnxml");
                    $model = new csvnxml();
                    $model->csvupload();
                    break;
            }
        }
    }
?>