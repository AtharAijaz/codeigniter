<?php
class Products extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('Product_model'); 
  }



  public function index(){
    $data['product_list'] = $this->Product_model->get_products();
    $this->load->view('products/show_products', $data);
  }

  


  public function add_form(){
    $data['categories'] = $this->Product_model->get_all_category();
    $data['subcategories'] = $this->Product_model->get_all_subcategory();
    $this->load->view('products/insert', $data);
  }

  public function insert_products(){
    $this->form_validation->set_rules('name', 'Name', 'required|is_unique[products.name]',
      array(
        'required' => 'field required',
        'is_unique' => ' product exists'));
    $this->form_validation->set_rules('category_id','category_id','required');
    $this->form_validation->set_rules('subcategory_id','subcategory_id','required');
    if ($this->form_validation->run() == FALSE) {
      $this->form_validation->set_message('insert_products', 'Record already exists');
      $this->load->view('products/insert');
    }else{
      $data['name'] = $this->input->post('name');
      $data['category_id'] = $this->input->post('category_id');
      $data['subcategory_id'] = $this->input->post('subcategory_id');
      $res = $this->Product_model->insert_product_to_table($data);
      redirect(base_url('products'));
    }
  }

  public function edit($id){
    $product = $this->Product_model->find_category($id);
    $this->load->view('products/edit',array('product' => $product));
 }

 public function update($id){
    $this->form_validation->set_rules('name', 'Name', 'required|is_unique[products.name]',
       array('is_unique[products.name]' => 'Error Message category exists'));
    $this->form_validation->set_rules('category_id','category_id','required');
    $this->form_validation->set_rules('subcategory_id','subcategory_id','required');
    if ($this->form_validation->run() == FALSE) {
      redirect(base_url('products'));
    }

    $this->Product_model->update_product($id);
    redirect(base_url('products'));
 }

 public function delete($id){
    $this->Product_model->delete_category($id);
    $this->index();
  }
}