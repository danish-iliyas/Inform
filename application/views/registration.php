<link rel="stylesheet" href="<?php echo base_url('assets/css/childinformation.css'); ?>">
<!-- Include Google Fonts for better typography -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/css/sliderbar.css'); ?>">
<!--   copy for different role end        -->

<?php if ($level == 2): ?>
<div class="dashboard">
<!-- child_information -->

        <div class="main-content">

        <?php $this->load->view('includes/header'); ?>
            <section class="stats-section">
                
                <!-- <div class="stats-card">
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
                </div> -->
            </section>
            <div class="popup-overlay"  style="display: none; position: relative ;" id="popupOverlay">
             <div class="popup">
            <button class="btn-close"  onclick="closePopup()">X</button>
            <h2>Register New Child</h2>
            <p>Please fill in the form below to register a new child.</p>
            <form action="<?= base_url().'add_child' ?>"  method="post">
                <input type="text" name="name" placeholder="Child's Name" required>
                <input type="text" name="father_name" placeholder="Father's Name" required>
                <input type="text" name="mother_name" placeholder="Mother's Name" required>
                <select name="gender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <button type="submit" class="btn-submit">Submit</button>
            </form>
        </div>
    </div>
            <section class="users-section">
                <!-- <h2>Manage Child</h2> for feature -->
                <button class="btn-add-user" id = "openPopup" onclick="openPopup()"> Child Registrations</button>
                
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Father's Name</th> 
                            <th>Mother's Name</th>
                            <th>Gender</th>
                            <!-- <th>Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                        
                        <?php foreach ($children as $child): ?>
                        <tr>
                        
                            <td><?php echo $child['name'] ?></td>
                            <td><?php echo $child['father_name'] ?></td>
                            <td><?php echo $child['mother_name'] ?></td>
                           <td><?php echo $child['gender'] ?></td>
                           
                            <!-- <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td> -->
                            
                        </tr>
                        <?php endforeach; ?>
                           
                            <!-- <td>
                                <button class="btn-edit">Edit</button>
                                <button class="btn-delete">Delete</button>
                            </td> -->
                            
                   
                        
                        <!-- More rows can be added here -->
                    </tbody>
                </table>    
            </section>
        </div>
    </div>  
    <!-- <?php $this->load->view('includes/footer');?> -->
</div>
<!-- employee_registration section -->
<?php elseif ($level == 1): ?>
    <div class="dashboard">
    <!-- child_information -->
    <div class="main-content">

        <?php $this->load->view('includes/header'); ?>
        <section class="stats-section">
            <!-- <div class="stats-card">
                <h3>Active Users</h3>
                <p>850</p>
            </div> -->
        </section>

        <div class="popup-overlay" style="display: none; position: relative;" id="popupOverlay">
            <div class="popup">
                <button class="btn-close" onclick="closePopup()">X</button>
                <h2>Register New Employee</h2>
                <p>Please fill in the form below to register a new employee.</p>
                <form action="<?= base_url().'add_employee' ?>" method="post">
    <input type="text" name="username" placeholder="Employee's Name" required>
    <input type="email" name="email" placeholder="email" required>
    <input type="password" name="password" placeholder="Password" required>

    <select name="level" id="levelSelect" onchange="handleRoleChange(this.value)">
        <option value="1">Admin</option>
        <option value="2">Central Admin</option>
        <option value="3">Doctor</option>
        <option value="4">Health Worker</option>
        <option value="5">User</option>
    </select>

    <!-- Register by dropdown (Doctor, Health Worker) -->
    <select name="register_by_id" id="registerByDropdown" style="display:none;">
        <!-- Users (e.g., Central Admin, Doctor, Health Worker) will be populated dynamically -->
    </select>

    <!-- Region input, hidden by default (only for Central Admin) -->
    <div id="regionInputDiv" style="display:none;">
        <input type="text" name="region" id="regionInput" placeholder="Enter Region">
    </div>

    <select name="status" required>
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>

    <select name="gender" required>
        <option value="" disabled selected>Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>

    <button type="submit" class="btn-submit">Submit</button>
</form>
            </div>
        </div>

        <!-- employee_Datat -->
        <section class="users-section">
            <!-- <h2>Manage Employee</h2> -->
            <button class="btn-add-user" id="openPopup" onclick="openPopup()">Employee Registrations</button>

            <table class="users-table">
                <thead>
                    <tr>
                        <th>username</th>
                        <th>email</th>
                        <th>level</th>
                        <th>status</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?> 
                    <tr>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['level'] ?></td>
                        <td>
                            <?php if ($user['status'] === '1'): ?>
                            <form action="<?= base_url('Dashboard/toggle_status/'.$user['login_id']) ?>" method="post" style="display:inline;">
                                <input type="hidden" name="status" value="0">
                                <button type="submit" class="btn-deactivate" onclick="return confirm('Are you sure you want to deactivate this user?');">Deactivate</button>
                            </form>
                            <?php else: ?>
                            <form action="<?= base_url('Dashboard/toggle_status/'.$user['login_id']) ?>" method="post" style="display:inline;">
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class="btn-activate" onclick="return confirm('Are you sure you want to activate this user?');">Activate</button>
                            </form>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $user['gender'] ?></td>
                        <td>
                            <form action="<?= base_url('delete_user/'.$user['login_id']) ?>" method="post" style="display:inline;">
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</div>

  
</div>
    <!-- end section -->
<?php else: ?>
    <h2>Guest Section</h2>
    <p>Content for guests or unauthorized users.</p>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function handleRoleChange(selectedLevel) {
        if (selectedLevel == "2") {
            document.getElementById("regionInputDiv").style.display = "block"; // Show region input for Central Admin
            document.getElementById("registerByDropdown").style.display = "none"; // Hide register_by_id for Central Admin
        } else {
            document.getElementById("regionInputDiv").style.display = "none"; // Hide region input for others
            document.getElementById("registerByDropdown").style.display = "block"; // Show register_by_id for Doctor, Health Worker, etc.

            // Fetch and populate the register_by_id dropdown based on the selected level
            fetchUsersByRole(selectedLevel);
        }
    }

    function fetchUsersByRole(selectedLevel) {
        $.ajax({
            url: '<?= base_url("Dashboard/get_users_by_role") ?>',
            type: 'POST',
            data: { selected_level: selectedLevel },
            dataType: 'json',
            success: function(response) {
                var dropdown = $('#registerByDropdown');
                dropdown.empty(); // Clear previous options
                
                $.each(response, function(index, user) {
                    dropdown.append($('<option>', {
                        value: user.login_id,
                        text: user.username
                    }));
                });

                // Show the dropdown if there are users
                if (response.length > 0) {
                    dropdown.show();
                } else {
                    dropdown.hide();
                }
            },
            error: function() {
                alert('Error fetching users');
            }
        });
    }

      function openPopup() {
        document.getElementById('popupOverlay').style.display = 'flex';
        document.getElementById('openPopup').style.display = 'none';
        
        // Hide the user table
        const userTable = document.querySelector('.users-table'); // Correct selector
        if (userTable) {
            userTable.style.display = 'none'; // Hiding the table
        }
    }
    function closePopup() {
        document.getElementById('popupOverlay').style.display = 'none';
        document.body.classList.remove('blur-background');
        document.getElementById('openPopup').style.display = 'block';

        // Show the user table again when the popup is closed
        const userTable = document.querySelector('.users-table');
        if (userTable) {
            userTable.style.display = 'table'; // Displaying the table
        }
    }
</script>