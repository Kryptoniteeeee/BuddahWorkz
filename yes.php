<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('dbcon.php'); ?>
<?php include('navbar_dasboard.php'); ?>
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
				<img src="">
					<br>
					<br>
					
				<div class="alert alert-info">Policy Schedule</div>

		<!-- reservation -->
	<?php
if (isset($_POST['yes'])) {
    $session_id = $_POST['session_id'];
    $date1 = $_POST['date1'];
    $service1 = $_POST['service1'];
    $equal = $_POST['equal'];

    // Insert the schedule into the database
    mysqli_query($conn, "INSERT INTO schedule (member_id, date, service_id, Time, status) VALUES ('$session_id', '$date1', '$service1', '$equal', 'Pending')") or die(mysqli_error($conn));

    // Retrieve the policy schedule from the database
    $query = "SELECT * FROM schedule WHERE member_id = '$session_id' AND date = '$date1' AND service_id = '$service1' AND Time = '$equal'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Generate the policy schedule for the user
        $policySchedule = generatePolicySchedule($row);

        // Display the appointment confirmation and policy schedule
        echo '<div class="yes">';
        echo '<h3>Your appointment has been set on ' . $date1 . '. THANK YOU</h3>';
        echo '<h4></h4>';
        echo '<p>' . $policySchedule . '</p>';
        echo '</div>';
    } else {
        // If the schedule was not found or there was an error, display an error message
        echo '<script>alert("Error retrieving the policy schedule.");</script>';
    }
} else {
    echo '<script>alert("Error.");</script>';
}

// Function to generate the policy schedule based on the schedule data
function generatePolicySchedule($scheduleData)
{
    // Add your code here to generate the policy schedule based on the provided schedule data
    // You can format the schedule in the desired way, including the relevant details and formatting

    // For example:

    $policySchedule = "\n";
    $policySchedule .= "Member ID: " . $scheduleData['member_id'] . "\n";
    $policySchedule .= "Date: " . $scheduleData['date'] . "\n";
    $policySchedule .= "Service ID: " . $scheduleData['service_id'] . "\n";
    $policySchedule .= "Time: " . $scheduleData['Time'] . "\n";

    return $policySchedule;
}
?>

	
	<!-- end reservation -->
	


	
	
	
				</div>
				<div class="span3">
				
				
				<div class="alert alert-info">Details about Services</div>
						<table class="table  table-bordered">
                            
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
				<div class="alert alert-info">Location</div>	
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3863.293775734533!2d120.97851267497136!3d14.467812886002935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397cda040e00d2f%3A0x95c9d248d1bbd898!2sBuddahWorkz!5e0!3m2!1sen!2sph!4v1684853170543!5m2!1sen!2sph" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
				</div>
				
			</div>
		</div>
    </div>
