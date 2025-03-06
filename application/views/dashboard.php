<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admindashboard.css'); ?>">
    <!-- Include Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard">
 
                     
               <!-- // Correctly accessing the 'level' value
                print_r($level);  //output = 0,1,2
                 exit;
       -->
        <div class="containersliderandmaincontent " style ="display: flex; width: 100%;">
      <?php $this->load->view('includes/sliderbar'); ?>

         <!-- Main Content -->

        <!--  copy for different role start -->
         <?php if ($level == 0): ?>
        <div class="main-content">
        <?php $this->load->view('includes/header'); ?>
      
            <section class="stats-section">
                <div class="stats-card">
                    <h3>Total Users</h3>
                    <p>1200</p>
                </div>
                <div class="stats-card">
                    <h3>Active Users</h3>
                    <p>850</p>
                </div>
                <div class="stats-card">
                    <h3>New Signups</h3>
                    <p>300</p>
                </div>
                <div class="stats-card">
                    <h3>Admin Tasks</h3>
                    <p>12 Pending</p>
                </div>
            </section>

            <section class="users-section">
                <h2>Manage Users</h2>
                <button class="btn-add-user">Add New User</button>
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <!-- <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button> -->
                            </td>
                        </tr>
                        <!-- More rows can be added here -->
                    </tbody>
                </table>
            </section>
           
        </div>
        <?php $this->load->view('includes/footer');?>
    </div>


         <!--  copy for different role start -->
         <?php elseif ($level == 1): ?>
        <div class="main-content">
            <!-- Header section -->
        <?php $this->load->view('includes/header'); ?>
      
            <section class="stats-section">
                <div class="stats-card">
                    <h3>Total Users</h3>
                   <!-- <?php print_r($total_users);
                    // die();?>-->
    
                    <p><?php echo $total_users; ?></p>
                </div>
                <div class="stats-card">
                    <h3>Total children Registrations</h3>
                    <p> <?php echo $total_children; ?></p>
                </div>
                <div class="stats-card">
                    <h3>Admin</h3>
                    <p><?php echo $total_admin; ?></p>
                </div>
                <!-- <div class="stats-card">
                    <h3>Admin Tasks</h3>
                    <p>12 Pending</p>
                </div> -->
            </section>
<!--  
            <section class="users-section">
                <h2>Manage Users</h2>
                <button class="btn-add-user">Add New User</button>
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td>Active</td>
                            <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </section>
           -->
        </div>
        <?php $this->load->view('includes/footer');?>
    </div>

<!--   copy for different role end        -->
    <?php elseif ($level == 2): ?>
        
        <div class="main-content">
       
        <?php $this->load->view('includes/header'); ?>

            <section class="stats-section">
            <div style="display: flex; gap: 20px; max-width: 100%; overflow-x: auto;"> 
    <?php if (!empty($doctors)): ?>
        <?php foreach ($doctors as $doctor): ?>
            <div class="stats-card" style="width: 100%;">
                <h3>Doctor</h3>
                <div class="doctor-cards-container" style="display: flex; flex-wrap: wrap; gap: 20px;">
                    <div class="doctor-card" style="width: 200px; background-color: #f4f4f4; padding: 15px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); text-align: center;">
                        <h4 style="margin-bottom: 10px;">
                            <?= $doctor['username'] ?>
                        </h4>
                        <!-- Add a button next to the doctor's name -->
                        <button style="padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;" on>
                            View Profile
                        </button>
                        <!-- You can add more details here, like the doctor's specialty or ID if needed -->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No doctors found under this Central Admin.</p>
    <?php endif; ?>
</div>

                <!-- <div class="stats-card">
                    <h3>Active Users</h3>
                    <p>850</p>
                </div>  -->
                <!-- <div class="stats-card">
                    <h3>New Signups</h3>
                    <p>300</p>
                </div> -->
                <!-- <div class="stats-card">
                    <h3>Admin Tasks</h3>
                    <p>12 Pending</p>
                </div> -->
            </section>

            
        </div>  <!-- end of main content -->
        </div>  <!-- extra div for dashboard -->
        
    </div>
        <!-- <div class="footer" style ="display: flex ; background-color: black; height: 50px; width: 100%; position: absolute; bottom: 0; color: white; left-margin: 50px; right: 50;">  <p> footer</p> </div>
        </div> -->
        <?php $this->load->view('includes/footer');?>
    </div>
    <?php else: ?>
    <h2>Guest Section</h2>
    <p>Content for guests or unauthorized users.</p>
<?php endif; ?>

<script>
      function openPopup() {
        document.getElementById('popupOverlay').style.display = 'flex';
        // document.body.classList.add('blur-background');

        document.getElementById('dashboard').style.display = 'block';
        document.body.classList.add('blur-background');
    }
    function closePopup() {
        document.getElementById('popupOverlay').style.display = 'none';
        document.body.classList.remove('blur-background');
    }
</script>
</body>
</html>
