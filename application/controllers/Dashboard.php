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
        //     die("hi");

          $data['level'] = $level;
		  $data['userid'] = $this->session->userdata('userid');
		//   $data['total_users'] =$total_data['total_users'];
		  $data['total_children'] = $total_data['total_children']; 
		//   print_r($data['total_children']); //outpot = 2
		//   die();
		//     //   $data['total_children'] = $children_data['total_children'];
			  
			  $data['total_children_by_user'] = $children_data['total_children'];
            //checking  of the data 
            // print_r($data['level']); //outpot = 2
            // die();
            if($data['level'] == 2){
                $this->getAllDoctorUnderCentralAdmin();
            }else if($data['level'] == 3){
                $this->getHealthWorkersUnderDoctor();
            }elseif($data['level'] == 4){
                $total_children = $this->ChildModel->getChildrenCountByHW($user_id);
					    // print($total_children);
						// print_r($user_id);
						$data['user_id'] = $user_id;
						$data['level'] = $this->session->userdata('level');
						$data['userid'] = $this->session->userdata('userid');
						$data['total_children'] = $total_children;
					
						$this->load->view('dashboard', $data);
            }
            else{
                   $this->load->model('UserModel');
                $this->UserModel->all_user();
                $data['total_users'] = $this->UserModel->all_user()['total_users'];
                $data['total_admin'] = $this->UserModel->all_user()['total_admin'];
            $this->load->view('dashboard', $data);
			$this->load->view('includes/footer'); 
            }
         

        } else {
            
            redirect('login'); 
        }
       
	}
    public function getAllDoctorUnderCentralAdmin() {
		
		if ($this->session->userdata('user_id') !== NULL && $this->session->userdata('level') == 2) {
			// Only allow Central Admin access (level = 2)
			
			$this->load->model('UserModel');
	
			$central_admin_id = $this->session->userdata('user_id'); // Get the current Central Admin ID
			     $data['user_id'] = $this->session->userdata('user_id');
				 $data['level'] = $this->session->userdata('level');
				 $data['userid'] = $this->session->userdata('userid');
			// Fetch doctors for this Central Admin
			$data['doctors'] = $this->UserModel->getAllDoctorByCentralAdmin($central_admin_id); 
			// print_r($data['doctors']);
			
			// Debug doctors array
			// print_r($data['doctors']);
			// die("Doctor data");

			 
			// Other data (like active user count)
			$data['doctor_count'] = count($data['doctors']); // Count of doctors
			
			// Load the dashboard view
			$this->load->view('dashboard', $data);
		} else {
			redirect('login');
		}
	}
	
	// public function child_information() {
    //     if ($this->session->userdata('user_id') !== NULL) {
    //         $this->load->model('ChildModel');
    //         $user_id = $this->session->userdata('user_id'); // Get the user ID from session
            
    //         // Get total number of children registered by the user
    //         $children_data = $this->ChildModel->get_children_by_user($user_id);

    //         // Pass children and total count to the view
    //         $data['children'] = $children_data['children'];
    //         $data['total_children'] = $children_data['total_children'];
               
			  
	//    	    // print_r($data['total_children']);
    //         // die("hi");

    //         $data['level'] = $this->session->userdata('level');
	// 		$data['userid'] = $this->session->userdata('userid');
			
			
	//    	    // print_r($data['userid']);
    //         // exit(); // or die();
    //         // Load the child information view			
	// 		$this->load->view('includes/sliderbar', $data); 
    //         $this->load->view('registration', $data);
    //     } 
		  
	// 	else {
    //         redirect('login');
    //     }
    // }

	
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
			$data['userid'] = $this->session->userdata('userid');
			
			
	   	    // print_r($data['userid']);
            // exit(); // or die();
            // Load the child information view			
			$this->load->view('includes/sliderbar', $data); 
            $this->load->view('registration', $data);
        } 
		  
		else {
            redirect('login');
        }
    }
    public function toggle_status($id) {
        // Load the UserModel
        $this->load->model('UserModel');
    
        // Get the new is_active from the POST request
        $new_status = $this->input->post('is_active');
    
        // Update the user's is_active in the database
        $this->UserModel->update_status($id, $new_status);
    
        // Set a flash message for feedback
        $this->session->set_flashdata('success', 'User is_active updated successfully.');
    
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
    public function getRegions() {
        $this->load->model('GetDetail'); // Load your region model
        $regions = $this->GetDetail->getAllRegions(); // Assuming this method fetches all regions from the DB
        echo json_encode($regions); // Send regions data as JSON
    }
    
   public function children($doctorId) {
    $this->load->model('ChildModel');
    //  print_r($doctorId,"jkddjdfhjdsfhdf");
    // Debugging: print to log and browser
    log_message('debug', 'Children function called with doctorId: ' . $doctorId);
    echo "Controller hit with doctorId: $doctorId";

    // Fetch children data by doctor ID
    $children = $this->ChildModel->getChildrenByDoctor($doctorId);
    // print_r($children,"dhsjhdjsd");
    // Clear output buffer to remove any unexpected output (e.g., whitespace)
    ob_clean();
    
    // Set the content type to JSON
    header('Content-Type: application/json');
    
    // Return the children data as a JSON response
    echo json_encode($children);
    
    // Terminate the script to avoid any further output
    exit;
}

    
    // for Specific doctor getting child information 
    // public function child_information() {
    //     $this->load->model('ChildModel');  // Replace 'YourModelName' with the actual name of your model
    //     $doctorId = $this->session->userdata('user_id');
    //     // print_r($doctorId);
    //     // echo("hi");
    //     // die();
    //     $level = $this->session->userdata('level');  
    //     // $userid = $this->session->userdata('userid');
    //     $data['userid'] = $this->session->userdata('userid');
    //     $data['level'] = $level;  // Assuming you store the doctor's login ID in session
    //     $data['children'] = $this->ChildModel->getChildrenByDoctorLevel($doctorId);  // Fetch the child information for this doctor
    //     print_r($data['children']);
    //     $this->load->view('child_information', $data);  // Pass the data to the view
    // }
    
    
    public function fetchChildInformation() {
        // Fetch the user level from the session
        $level = $this->session->userdata('level');
        $userId = $this->session->userdata('user_id');
        $userid = $this->session->userdata('userid');
        //  print_r($level);
        //  print_r($userId);
        //  print_r($userid);
        // Load the Child model
        $this->load->model('ChildModel');
    
        // Initialize an empty array for children data
        $data['children'] = [];
        $data['level'] = $level;  // Pass the user level to the view
        $data['userid'] = $userid;
    
        // Check the user's level and fetch the children data accordingly
        if ($level == 3) {  // Doctor
            $data['children'] = $this->ChildModel->getChildrenByDoctorLevel($userId);
        } elseif ($level == 4) {  // Health Worker
            $data['children'] = $this->ChildModel->getChildrenByHealthWorkerId($userId);
        }
    
        // Load the view and pass the data array, including the level
        $this->load->view('child_information', $data);
    }
    
    
    // doctor login functionality
    public function children_by_hw($healthworker_id) {
        $this->load->model('ChildModel'); // replace with your actual model
        $children = $this->ChildModel->get_children_by_healthworker($healthworker_id); // implement this method
        // echo "Controller hit with doctorId: $children";
        echo json_encode($children);
    }
    
    public function getHealthWorkersUnderDoctor() {
		if ($this->session->userdata('user_id') !== NULL && $this->session->userdata('level') == 3) {
			// Only allow Doctor access (level = 3)
	
			$this->load->model('UserModel');
	
			$doctor_id = $this->session->userdata('user_id'); // Current Doctor ID
	
			$data['user_id'] = $doctor_id;
			$data['level'] = $this->session->userdata('level');
			$data['userid'] = $this->session->userdata('userid');
	
			// Fetch health workers where 'creater_id' = current doctor
			$data['health_workers'] = $this->UserModel->getHealthWorkersByDoctor($doctor_id);
	        //  print_r($data['health_workers']);
			//  die("hi");
			$data['health_worker_count'] = count($data['health_workers']);
	
			// Load dashboard view for Doctor with HW data
			$this->load->view('dashboard', $data);
		} else {
			redirect('login');
		}
	}
    
     
}
