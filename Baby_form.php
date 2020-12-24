<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Baby_form extends CI_Controller {  
      
    public function index()  
    {  
        $this->load->view("baby_form_add");  
    }  
    function savingdata()  
    {  
        //this array is used to get fetch data from the view page.  
        $data = array(  
                        'name'     => $this->input->post('name'),  
                        'meaning'  => $this->input->post('meaning'),  
                        'gender'   => $this->input->post('gender'),  
                        'religion' => $this->input->post('religion')  
                        );  
        //insert data into database table.  
        $this->db->insert('baby',$data);  
  
        redirect("baby_form/index");  
    }  
}  
?>