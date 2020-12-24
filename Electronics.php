<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Electronics extends CI_Controller {  
  public function __construct(){
    parent::_construct();
    $this->load->model(array('Electronic_model'));

    $this->load->helper(array('form', 'url','html'));
        
  } 

  public function index(){
    $this->load->view('electronic/index');

  }

  
  
  public function create(){
    $this->load->view('electronics/create');
  }

  public function new_data(){
    $this->load->library('form_validation');      
        //setting rules for each individual input fields
    $this->form_validation->set_rules('name','Name','required|alpha_numeric_spaces');    
    
    
    if($this->form_validation->run() == FALSE){
      $this->load->view('index');
      $this->load->view('create');
      echo "<h3 style='color:red;text-align:center'>Please Enter valid information !!</h3>";
    }else{
      //check name already exists
      //$allData=
      $this->load->model('Electronic_model');
      $this->Electronic_model->read_data();
      //var_dump($allData);
      if($this->Electronic_model->distinct_data($allData)){
        $this->Electronic_model->insert_data();
      }else{
        echo "<h3 style='color:red;text-align:center'>already exists !!</h3>";
        $this->create();
      }
    }
  } 

  public function read(){
    //$this->load->view('index');
    $data['read'] = $this->Electronic_model->read_data();
    //var_dump($data);
    $this->load->view('read',$data);
  }

    //for displaying the archive (SELECT * )
  public function archive(){
    $this->load->view('index');
    $data['read'] = $this->Electronic_model->read_data();
    $this->load->view('archive',$data);
  }

  //method for UPDATE
  public function update(){
    $id=$_REQUEST['id'];
    //checking if input data is valid
  if($this->form_validation->run() == FALSE){       
    echo "<br><h3 style='color:red;text-align:center'>Please Enter valid information !!</h3>";
    $this->edit();
  }
  else{
    if($this->Electronic_model->update_data($id)){
      echo "<h3 style='text-align:center'>Successfully updated !! </h3>";
    }else{
      echo "<h3 style='text-align:center'> Update Failed !! </h3>?>";
    }
    $this->read();
    } 
  }


  public function delete(){
    $id=$_REQUEST['id'];
    if($this->Electronic_model->delete_data($id)){
      echo "<h3 style='text-align:center'>Entry Successfully deleted !!</h3>";
    }else{
      echo "<h3 style='text-align:center'>Failed to delete entry !! Try Again</h3>";
    }
    $this->archive();
  }


  //for SEARCH of data (all)
  public function search(){
    $text=$this->input->post('search');           //get the text to search 
    $result=$this->Electronic_model->search_id($text);            //get all data from db

    if(count($result)==0){
      echo "<br><h3 style='color:red;text-align:center'>No result found!!</h3>";
      $this->load->view('index');

      //$this->archive();
    }else{
      $this->read_specific($result);
    }

  }

  public function read_specific($result){
    $data['read']=$this->Electronic_model->read_specific_data($result);
   $this->load->view('index');
    $this->load->view('search_result',$data);

  }


  public function search_filter(){
    $text=$this->input->post('search_text');            //get the text to search 
    $filter=$this->input->post('filter');

    $result=$this->Electronic_model->search_filterId($text,$filter);
    //if no data found show error
    if(count($result)==0){
      echo "<br><h3 style='color:red;text-align:center'>No result found!!</h3>";
      $this->load->view('index'); 
    }else{
      $this->read_specific_filter($result);
    }
  }

  public function read_specific_filter($result){
    $data['read']=$this->Electronic_model->read_specific_data($result);
    $this->load->view('index');
    $this->load->view('search_result_filter',$data);
  }
  
}

?>
