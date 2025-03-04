<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
        if ($this->session->userdata('user_id') !== NULL) {
            

			$this->load->model('ChildModel'); 
			$level = $this->session->userdata('level');
			$user_id = $this->session->userdata('user_id'); // Get the user ID from session
			// Get total number of children registered by the user
			$children_data = $this->ChildModel->get_children_by_user($user_id);
    
    // Pass children and total count to the view
	        $this->load->model('ChildModel');
          $data['children'] = $children_data['children'];
          $data['total_children'] = $children_data['total_children'];

		  $total_data = $this->ChildModel->get_all_children_user();
		  $children_data = $this->ChildModel->get_children_by_user($user_id);

		//   print_r($data['children']);
        //     die();

          $data['level'] = $level;
		  $data['username'] = $this->session->userdata('username');
		//   $data['total_users'] =$total_data['total_users'];
		  $data['total_children'] = $total_data['total_children']; 
		//   print_r($data['total_children']); //outpot = 2
		//   die();
		//     //   $data['total_children'] = $children_data['total_children'];
			  
			  $data['total_children_by_user'] = $children_data['total_children'];
            //checking  of the data 
            // print_r($data['level']); //outpot = 2
            // die();
            $this->load->model('UserModel');
                $this->UserModel->all_user();
                $data['total_users'] = $this->UserModel->all_user()['total_users'];
                $data['total_admin'] = $this->UserModel->all_user()['total_admin'];
            $this->load->view('dashboard', $data);
			// $this->load->view('includes/footer'); 

        } else {
            
            redirect('login'); 
        }
       
	}
       
	public function child_information() {
        if ($this->session->userdata('user_id') !== NULL) {
            $this->load->model('ChildModel');
            $user_id = $this->session->userdata('user_id'); // Get the user ID from session
            
            // Get total number of children registered by the user
            $children_data = $this->ChildModel->get_children_by_user($user_id);

            // Pass children and total count to the view
            $data['children'] = $children_data['children'];
            $data['total_children'] = $children_data['total_children'];
               
			  
	   	    // print_r($data['total_children']);
            // die("hi");

            $data['level'] = $this->session->userdata('level');
			$data['username'] = $this->session->userdata('username');
			
			
	   	    // print_r($data['username']);
            // exit(); // or die();
            // Load the child information view			
			$this->load->view('includes/sliderbar', $data); 
            $this->load->view('registration', $data);
        } 
		  
		else {
            redirect('login');
        }
    }

	
	public function employee_information() {
        if ($this->session->userdata('user_id') !== NULL) {
            // $this->load->model('ChildModel');
            // $user_id = $this->session->userdata('user_id'); // Get the user ID from session
            
            // Get total number of children registered by the user
            // $children_data = $this->ChildModel->get_children_by_user($user_id);
                 $this->load->model('UserModel');
                 $userData = $this->UserModel->get_user();
                 $data['users'] = $userData['users'];
            // Pass children and total count to the view
            // $data['children'] = $children_data['children'];
            // $data['total_children'] = $children_data['total_children'];
               
			  
	   	    // print_r($data['total_children']);
            // die("hi");

            $data['level'] = $this->session->userdata('level');
			$data['username'] = $this->session->userdata('username');
			
			
	   	    // print_r($data['username']);
            // exit(); // or die();
            // Load the child information view			
			$this->load->view('includes/sliderbar', $data); 
            $this->load->view('registration', $data);
        } 
		  
		else {
            redirect('login');
        }
    }
    public function toggle_status($login_id) {
        // Load the UserModel
        $this->load->model('UserModel');
    
        // Get the new status from the POST request
        $new_status = $this->input->post('status');
    
        // Update the user's status in the database
        $this->UserModel->update_status($login_id, $new_status);
    
        // Set a flash message for feedback
        $this->session->set_flashdata('success', 'User status updated successfully.');
    
        // Redirect back to the relevant page
        redirect('employee_info'); // Adjust this route as needed
    }
    public function get_users_by_role() {
        // Clean up any previous output
        ob_clean();
        
        // Load the required model
        $this->load->model('GetDetail');
        
        // Get the selected level from the frontend (POST request)
        $selectedLevel = $this->input->post('selected_level');  
        
        // Determine the target level based on the selected level
        $targetLevel = null;
        if ($selectedLevel == 3) {  
            $targetLevel = 2;  // Fetch Central Admins if "Doctor" is selected
        } elseif ($selectedLevel == 4) {  
            $targetLevel = 3;  // Fetch Doctors if "Health Worker" is selected
        } elseif ($selectedLevel == 5) {  
            $targetLevel = 4;  // Fetch Health Workers if "User" is selected
        }
    
        // Fetch the users based on the target level
        if ($targetLevel !== null) {
            $users = $this->GetDetail->get_users_by_level($targetLevel);
    
            // Log the fetched users for debugging
            log_message('debug', 'Fetched users: ' . print_r($users, true));
    
            // Send valid JSON response
            header('Content-Type: application/json');
            echo json_encode($users);
        } else {
            // Send an empty array if the target level is not found
            echo json_encode([]);
        }
    
        // Exit to prevent further output
        exit();
    }
    
    
    
    
    
    
    
}
