
<?php  
class Categories extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('Category_model');
    $this->load->library('form_validation');  
  }
  public function index(){
    $data['category_list'] = $this->Category_model->get_categories();
    $this->load->view('categories/show_categories', $data);
  }

  /*public function create(){
    $this->load->view('categories/insert');
  }*/
 public function add_form(){
    $this->load->view('categories/insert');

  }

  public function insert_categories(){
    $this->form_validation->set_rules('name', 'Name', 'required|is_unique[categories.name]',
      array(
        'required' => 'field required',
        'is_unique' => ' category exists'));
    if ($this->form_validation->run() == FALSE) {
      $this->form_validation->set_message('insert_categories', 'Record already exists');
      $this->load->view('categories/insert');

    }else{
      $data['name'] = $this->input->post('name');
      $res = $this->Category_model->insert_category_to_table($data);
      redirect(base_url('categories'));
      //redirect($this->uri->uri_string());
      //$this->index();
    }
  }

  public function edit($id){
    $category = $this->Category_model->find_category($id);
    $this->load->view('categories/edit',array('category' => $category));
 }


 public function update($id){
     $this->form_validation->set_rules('name', 'Name', 'required|is_unique[categories.name]',
       array('is_unique[categories.name]' => 'Error Message category exists'));
    if ($this->form_validation->run() == FALSE) {
      redirect(base_url('categories'));
    }

    $this->Category_model->update_category($id);
    redirect(base_url('categories'));
 }





 /* public function edit($id){
    $data['name'] = $this->Category_model->getById($id);
    $res=$this->load->view('categories/edit', $data);
  }
*/
  

 /* public function edit(){
    $data['id'] = $this->input->post('id');
    $result = $this->Category_model->getById($id);
    foreach($query->result() as $row) {
    $data['getById']= $row->getById;
}
  }*/



 /* public function update(){
    $data['name'] = $_POST['name'];
    $res=$this->Category_model->update_info($data, $_POST['id']);
  
  }*/






  public function delete($id){
    $this->Category_model->delete_category($id);
    $this->index();
  }
}
?>










