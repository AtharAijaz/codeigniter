<?php
class Abc_model extends CI_Model
{
  
  function select_data()
  {
    $query = $this->db->get('myTable');
    return $query;
  }
}
?>