<?php
class ChildModel extends CI_Model {

    public function child_exists($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('child_registration');
        
        // Check if the query returns any result
        return $query->num_rows() > 0; // This returns true if any rows exist
    }

    public function insert_child_data($data) {
        // $name = $data['name'];
        // echo "Name: $name<br>";
        // die('here');

        if ($this->is_name_exists($data['name'])) {
            return false; // Name already exists
        }
        return $this->db->insert('child_registration', $data); // Inserts data including user_id
    }
    public function is_name_exists($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('child_registration');

        // Check if any rows are returned
        return $query->num_rows() > 0;
    }

    public function get_children_by_user($user_id) {
        $this->db->where('registered_by', $user_id);
        $query = $this->db->get('child_registration'); // Fetch rows with specific user_id
    
        $result = $query->result_array(); // Get the result as an array
    
        // Return both children and the total count
        return [
            'children' => $result,
            'total_children' => count($result) // Count the number of children
        ];
    }
    public function get_all_children_user() {
       
        $child_query = $this->db->get('child_registration');
        $child_result = $child_query->result_array(); //  result as an array
        
        // total children
        $total_children = $this->db->count_all_results('child_registration');
    
        // Fetch the total number of users with level = 2
        $this->db->where('level', 2); // Add condition for level = 2
        $total_users = $this->db->count_all_results('login'); // Count users in login table with level 2
        
        // Return the result as an array including both child data and user/child counts
        return [
            'children' => $child_result,
            'total_users' => $total_users,
            'total_children' => $total_children
        ];

    }
    public function getChildrenByDoctor($doctorId) {
        // Select the required child details and health worker name
        $this->db->select('child_partial_registration.child_name, child_partial_registration.dateofbirth, child_partial_registration.gender, child_partial_registration.father_name, child_partial_registration.mother_name, login.username as health_worker_name');
        
        // From child_partial_registration table
        $this->db->from('child_partial_registration');
        
        // Join the login table to get the health worker's name
        $this->db->join('login', 'login.login_id = child_partial_registration.healthworker_id');
        
        // Filter by doctorId (register_by_id corresponds to the doctor's login_id)
        $this->db->where('login.register_by_id', $doctorId);
        
        // Ensure the user is a health worker (level = 4) and their account is active (status = 1)
        $this->db->where('login.level', 4);  // Health Worker level
        $this->db->where('login.status', 1); // Active status
        
        // Execute the query
        $query = $this->db->get();
        
        // Check if any rows were returned
        if ($query->num_rows() > 0) {
            // Return the result as an array
            return $query->result_array();
        } else {
            // Return an empty array if no data is found
            return [];
        }
    }
    
    
}