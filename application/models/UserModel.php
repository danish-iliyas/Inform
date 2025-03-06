<?php
class UserModel extends CI_Model {

    public function authenticate($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password); // Assuming MD5 hashing
        $this->db->where('status', 1);
        $query = $this->db->get('login'); // Adjust table name if needed

          
        // echo $this->db->last_query(); 
        // print_r($query->row());
        // die();
        if ($query->num_rows() === 1) {
            return $query->row(); // Return the user object
        } else {
            return FALSE; // Authentication failed
        }
    }
    public function insert_user($data) {
        // Insert the user data into the database
        return $this->db->insert('login', $data);
    }

    public function get_users_by_level($level) {
        $this->db->select('login_id, username');
        $this->db->from('login');
        $this->db->where('level', $level);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    public function get_user() {
        
        $query = $this->db->get('login'); // Fetch rows with specific user_id
    
        $result = $query->result_array(); // Get the result as an array
    
        // Return both children and the total count
        return [
            'users' => $result,
             // Count the number of children
        ];
    }
    public function delete_user($login_id) {
        $this->db->where('login_id', $login_id);
        return $this->db->delete('login'); // Adjust the table name as necessary
    }
    public function update_status($login_id, $status) {
        $this->db->where('login_id', $login_id);
        return $this->db->update('login', ['status' => $status]); // Adjust the table name as necessary
    }
    public function all_user() {
        $this->db->where('level', 2); // Add condition for level = 2
        $total_users = $this->db->count_all_results('login');

        $this->db->where('level', 1); // Add condition for level = 2    
        $total_admin = $this->db->count_all_results('login');
        return [
            'total_users' => $total_users,
            'total_admin' => $total_admin
        ] ;
    }  



    // model for doctor 

    public function getAllDoctorByCentralAdmin($central_admin_id) {
        $this->db->select('username');
        $this->db->select('login_id');
        $this->db->from('login');
        $this->db->where('level', 3); // Level 3 represents doctors
        $this->db->where('register_by_id', $central_admin_id); // Registered by this Central Admin
        
        $query = $this->db->get();
        
        // Debug the query
        echo $this->db->last_query(); // This will print the query being executed
        return $query->result_array(); // Return the array of doctors
    }
}
    

