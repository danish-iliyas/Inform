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
        <?php if ($level == 4): ?>
<div class="main-content">
    <?php $this->load->view('includes/header'); ?>

    <section class="stats-section">
        <div class="stats-card">
            <h3>Total Children</h3>
            <p><?= $total_children ?></p>
        </div>
    </section>

    <!-- <?php $this->load->view('includes/footer'); ?> -->
</div>


         <!--  copy for different role start -->
         <?php elseif ($level == 3): ?>
<div class="main-content">
    <?php $this->load->view('includes/header'); ?>

    <section class="stats-section">
        <div style="display: flex; gap: 20px; max-width: 100%; overflow-x: auto;">
            <?php if (!empty($health_workers)): ?>
                <?php foreach ($health_workers as $hw): ?>
                    <div class="stats-card" style="width: 100%;">
                        <h3>Health Worker</h3>
                        <div class="doctor-cards-container" style="display: flex; flex-wrap: wrap; gap: 20px;">
                            <div class="doctor-card" style="width: 200px; background-color: #f4f4f4; padding: 15px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); text-align: center;">
                                <h4 style="margin-bottom: 10px;">
                                    <?= $hw['userid'] ?>
                                </h4>
                                <button style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;" onclick="fetchHWChildren(<?= $hw['id'] ?>, this)">
                                    View Children
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No health workers found under this doctor.</p>
            <?php endif; ?>
        </div>
    </section>

    <div id="children-data-container" style="margin-top: 20px; max-height: 300px; overflow-y: auto; border: 1px solid #ddd; padding: 20px;">
        <!-- Children will be appended here dynamically -->
    </div>
</div>

<?php $this->load->view('includes/footer'); ?>
</div>


    <?php elseif ($level == 1): ?>
        <div class="main-content">
    <?php $this->load->view('includes/header'); ?>

    <section class="stats-section">
        <div class="stats-card">
            <h3>Total Users</h3>
            <p> <?php ?> 27</p>
        </div>
        <!-- <div class="stats-card">
            <h3>Total children Registrations</h3>
            <p> <?php ?></p>
        </div>
        <div class="stats-card">
            <h3>Admin</h3>
            
        </div> -->
        <!-- <div class="stats-card">
            <h3>Admin Tasks</h3>
            <p>12 Pending</p>
        </div> -->
    </section>
    
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
                                    <?= $doctor['userid'] ?>
                                </h4>
                                <!-- Button to view children -->
                                <button id="view-children-btn" style="padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;" onclick="fetchChildren(<?= $doctor['id'] ?>, this)">
                                    View Children
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No doctors found under this Central Admin.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Placeholder div where children data will be shown dynamically -->
    <div id="children-data-container" style="margin-top: 20px; max-height: 300px; overflow-y: auto; border: 1px solid #ddd; padding: 20px;">
    <!-- Children data will be appended here dynamically after clicking a doctor -->
</div>

</div>
  <!-- end of main content -->
        </div>  <!-- extra div for dashboard -->
        
    </div>
        <!-- <div class="footer" style ="display: flex ; background-color: black; height: 50px; width: 100%; position: absolute; bottom: 0; color: white; left-margin: 50px; right: 50;">  <p> footer</p> </div>
        </div> -->
        <!-- <//?php $this->load->view('includes/footer');?> -->
    </div>
    <?php else: ?>
    <h2>Guest Section</h2>
    <p>Content for guests or unauthorized users.</p>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    // geting children data from database
    function fetchChildren(doctorId, button) {
    var childrenDiv = document.getElementById('children-data-container');
    var doctorName = button.closest('.doctor-card').querySelector('h4').innerText;

    $.ajax({
        url: '<?= base_url("Dashboard/children/") ?>' + doctorId,
        type: 'GET',
        success: function(children) {
            console.log("Raw response:", children);

            var headerHtml = '<h3>' + doctorName + '\'s Children</h3>';

            // 🔍 Search box
            var searchHtml = `
                <div style="text-align: right; margin-bottom: 10px;">
                    <input type="text" id="hwSearchInput" onkeyup="filterByHW()" placeholder="Search by Health Worker name..."
                        style="padding: 6px 10px; width: 250px; border: 1px solid #ccc; border-radius: 4px;" />
                </div>
            `;

            if (Array.isArray(children) && children.length > 0) {
                var html = `
                    <table id="childrenTable" style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                        <thead style="background-color: #f4f4f4; font-weight: bold;">
                            <tr>
                                <th style="border: 1px solid #ddd; padding: 8px;">Child Name</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Date of Birth</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Gender</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Father's Name</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Mother's Name</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Health Worker</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                children.forEach(function(child) {
                    html += `
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px;">${child.child_name}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">${child.dateofbirth}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">${child.gender}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">${child.father_name}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">${child.mother_name}</td>
                            <td class="hw-name" style="border: 1px solid #ddd; padding: 8px;">${child.health_worker_name || 'N/A'}</td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                <span title="Approve" style="color: green; cursor: pointer; margin-right: 10px;"><i class="fas fa-check-circle"></i></span>
                                <span title="Disapprove" style="color: red; cursor: pointer; margin-right: 10px;"><i class="fas fa-times-circle"></i></span>
                                <span title="Edit" style="color: blue; cursor: pointer;"><i class="fas fa-edit"></i></span>
                            </td>
                        </tr>
                    `;
                });

                html += `
                        </tbody>
                    </table>
                    <p id="noMatchMessage" style="display: none; color: red; text-align: center; margin-top: 10px;">
                        No children found for this Health Worker.
                    </p>
                `;

                childrenDiv.innerHTML = headerHtml + searchHtml + html;
            } else {
                childrenDiv.innerHTML = headerHtml + '<p>No children found for this doctor.</p>';
            }

            childrenDiv.scrollIntoView({ behavior: 'smooth' });
        },
        error: function() {
            childrenDiv.innerHTML = '<p>Error fetching children data. Please try again later.</p>';
        }
    });
}

function filterByHW() {
    var input = document.getElementById("hwSearchInput");
    var filter = input.value.toLowerCase();
    var table = document.getElementById("childrenTable");
    var rows = table.getElementsByTagName("tr");
    var anyVisible = false;

    for (var i = 1; i < rows.length; i++) { // Skip header
        var hwCell = rows[i].getElementsByClassName("hw-name")[0];
        if (hwCell) {
            var hwText = hwCell.textContent || hwCell.innerText;
            if (hwText.toLowerCase().includes(filter)) {
                rows[i].style.display = "";
                anyVisible = true;
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    // Show or hide "no match" message
    var noMatchMessage = document.getElementById("noMatchMessage");
    if (noMatchMessage) {
        noMatchMessage.style.display = anyVisible ? "none" : "block";
    }
}

//  Doctor login functionality 
function fetchHWChildren(healthworkerId, button) {
    var childrenDiv = document.getElementById('children-data-container');
    var hwName = button.closest('.doctor-card').querySelector('h4').innerText;
        console.log(healthworkerId,"hwName");
    $.ajax({
        url: '<?= base_url("Dashboard/children_by_hw/") ?>' + healthworkerId,
        type: 'GET',
        success: function(response) {
            console.log("Children fetched:", children);
            var children = (typeof response === "string") ? JSON.parse(response) : response;
            var headerHtml = '<h3>' + hwName + '\'s Children</h3>';

            if (Array.isArray(children) && children.length > 0) {
                var html = '<table style="width: 100%; border-collapse: collapse; margin-top: 10px;">' +
                    '<thead style="background-color: #f4f4f4; font-weight: bold;">' +
                    '<tr>' +
                    '<th style="border: 1px solid #ddd; padding: 8px;">Child Name</th>' +
                    '<th style="border: 1px solid #ddd; padding: 8px;">DOB</th>' +
                    '<th style="border: 1px solid #ddd; padding: 8px;">Gender</th>' +
                    '<th style="border: 1px solid #ddd; padding: 8px;">Father\'s Name</th>' +
                    '<th style="border: 1px solid #ddd; padding: 8px;">Mother\'s Name</th>' +
                    '<th style="border: 1px solid #ddd; padding: 8px;">Actions</th>' +
                    '</tr></thead><tbody>';

                children.forEach(function(child) {
                    html += '<tr>' +
                        '<td style="border: 1px solid #ddd; padding: 8px;">' + child.child_name + '</td>' +
                        '<td style="border: 1px solid #ddd; padding: 8px;">' + child.dateofbirth + '</td>' +
                        '<td style="border: 1px solid #ddd; padding: 8px;">' + child.gender + '</td>' +
                        '<td style="border: 1px solid #ddd; padding: 8px;">' + child.father_name + '</td>' +
                        '<td style="border: 1px solid #ddd; padding: 8px;">' + child.mother_name + '</td>' +
                        '<td style="border: 1px solid #ddd; padding: 8px; text-align: center;">' +
                            '<span title="Approve" style="color: green; cursor: pointer; margin-right: 10px;"><i class="fas fa-check-circle"></i></span>' +
                            '<span title="Disapprove" style="color: red; cursor: pointer; margin-right: 10px;"><i class="fas fa-times-circle"></i></span>' +
                            '<span title="Edit" style="color: blue; cursor: pointer;"><i class="fas fa-edit"></i></span>' +
                        '</td>' +
                        '</tr>';
                });

                html += '</tbody></table>';
                childrenDiv.innerHTML = headerHtml + html;
            } else {
                childrenDiv.innerHTML = '<p>No children found for this health worker.</p>';
            }

            childrenDiv.scrollIntoView({ behavior: 'smooth' });
        },
        error: function() {
            childrenDiv.innerHTML = '<p>Error fetching children. Try again.</p>';
        }
    });
}

</script>
</body>
</html>
   