<?php  
class Abc extends CI_Controller{
  function index(){
    $this->load->model('Abc_model');
    $data['readSelect']=$this->Abc_model->select_data();
    $this->load->view('abc', $data);
  }
}

?>