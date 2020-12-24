
<?php
class Category_model extends CI_Model{
  public function get_categories(){
    $query = $this->db->get('categories');
    return $query;
  }
  public function insert_category_to_table($data){
     $data=array('name' => $this->input->post('name'));
    
    return $this->db->insert('categories', $data);
  
}


  /*public function getById($id){
    $query = $this->db->get_where('categories',array('id'=>$id));
    return $query->row_array();
  }*/

  public function find_category($id){
    return $this->db->get_where('categories', array('id' => $id))->row();
  }  

  /*public function update_info($data,$id){
    $this->db->where('categories.id',$id);
    return $this->db->update('categories', $data);
  }*/

  public function update_category($id){
    $data=array('name' => $this->input->post('name'));
    if($id==0){
      return $this->db->insert('categories',$data);
    }else{
      $this->db->where('id',$id);
      return $this->db->update('categories',$data);
  }        
  }



  public function delete_category($id){
    $this->db->where('id', $id);
    $this->db->delete('categories');
  }

}
?>