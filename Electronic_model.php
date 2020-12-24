<?php  
class Electronic_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->view('electronics/index');

   // echo"0";

  }


 

  //[INSERT]
  public function insert_data(){
  echo"1";
    $name=$this->input->post('name');       //fetch data sent by form over POST using specific input name
    $insert_data = array('name'=>$name);            //array of all data to be inserted into db

    //on successful insert of data
    if($this->db->insert('electronics', $insert_data)){   //load array to database
                                  //show success message       
      echo "Congratulations ".$insert_data['name']." your data was successfully inserted !!<br><br>";
     ;                         
    }else{
      echo "Sorry ".$insert_data['name']." your data was not inserted !!<br><br>";
          }
  }
 
  //Edit data from database
  public function edit_data(){
    $id=$_REQUEST['id'];
    $query = $this->db->get_where('electronics', array('id' => $id));      //get the row specified by id from the table demo
    return $query->result_array();                    //return the query result
  }

  //UPDATE data
  public function update_data($id){
    $name=$this->input->post('name');
    $data = array('name' => $name);
    $this->db->where('id', $id);
    if($this->db->update('electronics', $data)){           //check if update was successfull
      return true;
    }else{
      return false;
    }
  }

  //DELETE data
  public function delete_data($id){
    if($this->db->delete('electronics',array('id'=>$id))){
      return true;
      }else{
        return false;
      }

    }

    //check if name is unique
  public function distinct_data($allData){
    $name=$this->input->post('name');
    foreach ($allData as $info) {
      if($info['name']==name){
        return false;
      }
    }
    return true;
  }


  //method for searching 
  public function search_id($text){
    $this->db->select('id');            //SELECT id
    $this->db->from('electronics');            //FROM demo
    $this->db->like('name',$text);      //first_name LIKE $text
    $query=$this->db->get();

    return  $query->result_array();     //return as a asscoc array of id
  }

  //raed the specific data as passed by parameter
  public function read_specific_data($result){
      //loop over nested arrays and find all data of given IDs
    foreach ($result as $key => $value) {
      foreach ($value as $key2 => $value_in) {
          //echo $value_in."<br>";
      $result_data[$key]=$this->read_all($value_in);
      }
    }
    return $result_data;
  }


  public function read_all($id){
        $query = $this->db->get_where('electronics', array('id' => $id));
        return $query->result_array();
  }













}
?>