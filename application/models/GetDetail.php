<?php
class GetDetail extends CI_Model {


    public function get_users_by_level($level) {
        $this->db->select('login_id, username');
        $this->db->from('login');
        $this->db->where('level', $level);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    public function getAllRegions() {
        $query = $this->db->get('region'); // Assuming your region table is named 'region'
        return $query->result_array();

        
    }
}  

    
