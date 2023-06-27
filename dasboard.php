<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('dbcon.php'); ?>
<?php include('navbar_dasboard.php'); ?>

<link rel="stylesheet" href="dropdown.css" />
    <div class="container">
		<div class="margin-top">
			<div class="row">
				
				<div class="span3">
					    
						<p><strong>Today is:</strong></p>
				 <div class="alert alert-success">
                        <i class="icon-calendar icon-large"></i>
                        <?php
                        $Today = date('d:m:y');
                        $new = date('l, F d, Y', strtotime($Today));
                        echo $new;
                        ?>
                    </div>		
				<div class="alert alert-info">Office Hours</div>
						<p>📍Monday - Closed</p>
						<p>📍Tuesday - Sunday (10:00 am to 7:00 pm)</p>
					
						<p>During Office hours, we strive to respond to all mails and inquiries within 24 hours.Once you make a reservation, we will confirm your appointment via email within 24hrs.</p>
						<p>If you have an urgent matter, please call our office directly for immediate assistance, contact number: </p>
					
						
						<p>📢In addition to phone calls and email, you can reach us through our social media channels: Facebook and Instagram. </p>
						
						<p>We respond to messages on these platforms within one business day</p>
							
				<div class="alert alert-info">FAQ:</div>
						<p>Q: Can I drop by the office without an appointment during office hours?</p>
						<p>A: We recommend scheduling an appointment to ensure availability. However, if you need immediate assistance, you are welcome to visit our office hours, and we will do our best to accomodate you.</p>
					
						<p>Q: How long does a typical repair take? </p>
						<p>A: Repair times vary depending on the complexity of the issue.Our technicians will provide an estimated timeframe when you drop off or during your appointment reservation. </p>
					
				<div class=""></div>
				<div class="testimonial_div">
					<p>
				
					</p>
					</div>		
				</div>
				<div class="span6">
					<br>
                    <br><br>
					
					
				<div class="alert alert-info">Select Date of Appointment and Service Offer</div>
	
		<!-- reservation -->
	<?php
if (isset($_POST['sub'])) {
    $date = $_POST['date'];
    $service = $_POST['service'];

    // Check if the desired time is already booked for the current user
    $query = mysqli_query($conn, "SELECT * FROM schedule WHERE date = '$date'") or die(mysqli_error($conn));
    $count = mysqli_num_rows($query);

    if ($count > 0) {
        // The time slot is already booked by another user
        ?>
        <script>
            alert('This time slot is already reserved. Please select a different time.');
        </script>
        <?php
    } else {
        // The time slot is available, proceed with the appointment booking

        // Check if the desired time is already booked for the current user
        $query = mysqli_query($conn, "SELECT * FROM schedule WHERE date = '$date' AND member_id = '$session_id'") or die(mysqli_error($conn));
        $count = mysqli_num_rows($query);

        if ($count > 0) {
            // The time slot is already booked for the current user
            ?>
            <script>
                alert('You have already scheduled an appointment on this date');
            </script>
            <?php
        }else {
    // Calculate the next available time with a 1-hour gap
    $nextHour = strtotime($date) + 3600; // Add 1 hour in seconds (3600 seconds)
    $nextHourFormatted = date('Y-m-d H:i:s', $nextHour);

    // Check if there is a 1-hour gap between the selected time and the next available time
    $query = mysqli_query($conn, "SELECT * FROM schedule WHERE date >= '$nextHourFormatted'") or die(mysqli_error($conn));
    $count = mysqli_num_rows($query);

    // Check if the desired time is already booked for the current user
    $queryCurrentUser = mysqli_query($conn, "SELECT * FROM schedule WHERE date = '$date' AND member_id = '$session_id'") or die(mysqli_error($conn));
    $countCurrentUser = mysqli_num_rows($queryCurrentUser);

    if ($count > 0 || $countCurrentUser > 0) {
        // There is a time slot within the next hour or already booked by the current user, so the selected time is not valid
        ?>
        <script>
            alert('There should be a 1-hour gap between appointments. Please select a different time.');
        </script>
        <?php
    } else {
        $equal = $count + 1;
        ?>


                <div class="question">
                    <div class="alert alert-success">You are the number <strong><?php echo $equal; ?></strong> client on this date <strong><?php echo $date; ?></strong></div>
                    <form method="POST" action="yes.php">
                        <input type="hidden" name="session_id" value="<?php echo $session_id; ?>">
                        <input type="hidden" name="date1" value="<?php echo $date; ?>">
                        <input type="hidden" name="service1" value="<?php echo $service; ?>">
                        <input type="hidden" name="equal" value="<?php echo $equal; ?>">
                        <p>Are you sure you want to set your appointment on this date?</p>
                        <button name="yes" class="btn btn-success"><i class="icon-check icon-large"></i>&nbsp;Yes</button> &nbsp; <a href="dasboard.php" class="btn"><i class="icon-remove"></i>&nbsp;No</a>
                    </form>
                </div>
                <br>
                <br>
            <?php
            }
        }
    }
}
?>



<!-- end reservation -->

<form class="form-horizontal" method="POST">
    <div class="control-group">
        <label class="control-label" for="inputEmail">Date</label>
        <div class="controls">
            <input type="datetime-local" class="w8em format-d-m-y highlight-days-67 range-low-today" name="date" id="sd" maxlength="100" style="border: 3px double #CCCCCC;" required/>
            <script>
                // Get the input element
                var input = document.getElementById("sd");

                // Disable past dates and restrict to working hours
                input.addEventListener("input", function() {
                    var selectedDate = new Date(input.value);
                    var today = new Date();
                    var workStartTime = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 8, 0, 0); // Set your work start time (e.g., 08:00 AM)
                    var workEndTime = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 18, 0, 0); // Set your work end time (e.g., 06:00 PM)

                    if (selectedDate < today) {
                        input.setCustomValidity("Past dates are not allowed");
                    } else if (selectedDate.getHours() < workStartTime.getHours() || selectedDate.getHours() >= workEndTime.getHours()) {
                        input.setCustomValidity("Appointments are only available between 08:00 AM and 06:00 PM.");
                    } else {
                        input.setCustomValidity("");
                    }
                });
            </script>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputPassword">Service</label>
        <div class="controls">
      
        <ul class="menu">
            <li><a href="#">Services</a>
                  <ul class="submenu">
                    <li><a href="">Cleaning</a>
                        <ul class="submenu2">
                            <li><a href="">FI Cleaning</a></li>
                                <li><a href="">CVT Cleaning</a></li>
                                <li><a href="">Throttle Body Cleaning</a></li>
                                <li><a href="">Injector Ultrasonic Cleaning</a></li>
                        </ul>
                    </li>
                        <li><a href="">Installation</a>
                         <ul class="submenu2">
                            <li><a href="">Scooter Repair</a></li>
                                <li><a href="">Horn and Mini Driving Light Wiring</a></li>
                  </ul>
              </li>
               <li><a href="">Others</a>
                         <ul class="submenu3">
                            <li><a href="">Clutch Bell RE-GROOVE</a></li>
                                <li><a href="">Pulley Drive Face Re-Angle</a></li>
                                <li><a href="">Racing/Tourning/Daily Setup Thru</a></li>
                  </ul>
              </li>

            </ul>

</li>
            <select name="service" required>
                <option></option>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM service") or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <option value="<?php echo $row['service_id']; ?>"><?php echo $row['Service_Offer'] ?><?php echo $row['Turnaround_Time'] ?>
                        
                    </option> 

                <?php } ?>
            </select>

        </div>
    </div>
    
    <div class="control-group">
        <div class="controls">
            <button type="submit" name="sub" class="btn btn-info"><i class="icon-check icon-large"></i>&nbsp;Submit</button>
        </div>
    </div>
</form>

	

	
	
	
				</div>
				<div class="span3">
				
				    <ul class="nav nav-list">
					
						
					
				<?php 
				$note_query = mysqli_query($conn,"select * from note ")or die(mysqli_error($conn));
				$note_count =mysqli_num_rows($note_query);
				while($note_row = mysqli_fetch_array($note_query)){
				if ($note_count > 0){ ?>
				
				<li><i class="icon-stop icon-large"></i>&nbsp;<?php echo $note_row['message'] ?></li>
				<?php
				}  } 
				?>
				</ul>
				<br>
			
				
				<div class="alert alert-info">List of Services</div>
						<table class="alert alert-info">
                            
                                <thead>
                                        <tr>

                                        <th>Service ID</th>
                                        <th>Service Offer</th>
                                        <th>Turnaround Time</th>                                    
                                     
                                    </tr>
                                </thead>
                                <tbody>
								 
                                  <?php $user_query=mysqli_query($conn,"select * from service")or die(mysqli_error($conn));
									while($row=mysqli_fetch_array($user_query)){
									$id=$row['service_id']; ?>
									 <tr class="del<?php echo $id ?>">
									 	<td><?php echo $row['service_id']; ?></td> 
                                    <td><?php echo $row['Service_Offer']; ?></td> 
                                    <td><?php echo $row['Turnaround_Time']; ?></td>                         
									<?php } ?>
                           
                                </tbody>
                            </table>
					<h1> Location:</h1>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3863.293775734533!2d120.97851267497136!3d14.467812886002935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397cda040e00d2f%3A0x95c9d248d1bbd898!2sBuddahWorkz!5e0!3m2!1sen!2sph!4v1684853170543!5m2!1sen!2sph" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
				</div>
				
			</div>
		</div>
    </div>
    



