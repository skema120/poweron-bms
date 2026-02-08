<?php

class MY_Model extends CI_Model {
  const DB_TABLE = "default";
  const DB_TABLE_PK = "default";


  private function insert() {
    $this->db->insert($this::DB_TABLE , $this);
    $this->{$this::DB_TABLE_PK} = $this->db->insert_id();
  }

  private function update() {
    $this->db->where($this::DB_TABLE_PK , $this->{$this::DB_TABLE_PK});
    $this->db->update($this::DB_TABLE , $this);
  }

  public function save() {
    if (isset($this->{$this::DB_TABLE_PK})) {
      $this->update();
    } else {
      $this->insert();
    }
  }

  
}