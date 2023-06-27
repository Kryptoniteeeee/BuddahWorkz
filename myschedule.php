<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('dbcon.php'); ?>
<?php include('navbar_dasboard.php'); ?>

    <div class="container">
		<div class="margin-top">
			<div class="row">
				
				<div class="span3">
					    <ul class="nav nav-tabs nav-stacked">
							<li class="active">
							<a href="#"><i class="icon-pencil icon-large"></i>&nbsp;Create Account</a>
							</li>
					
						</ul>
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
					
					
					
					
			
				<div class="testimonial_div">
				
					</div>		
				</div>
				<div class="span6">
					
					<br>
					<br>
					
				<div class="alert alert-info">My Schedule</div>

<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
    <thead>
        <tr>
            <th>My Number</th>
            <th>Date/Time</th>
            <th>Service</th>
            <th>Turnaround_Time</th>
            <th>Action</th>
        </tr>
    </thead>
  
   <tbody>
<?php
$current_date = date("Y-m-d");
$user_query = mysqli_query($conn, "SELECT * FROM schedule WHERE member_id = '$session_id'") or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($user_query)) {
    $id = $row['id'];
    $member_id = $row['member_id'];
    $service_id = $row['service_id'];

    /* member query */
    $member_query = mysqli_query($conn, "SELECT * FROM members WHERE member_id = '$member_id'") or die(mysqli_error($conn));
    $member_row = mysqli_fetch_array($member_query);

    /* service query */
    $service_query = mysqli_query($conn, "SELECT * FROM service WHERE service_id = '$service_id'") or die(mysqli_error($conn));
    $service_row = mysqli_fetch_array($service_query);

    // Check if appointment date is greater than or equal to current date
    if ($row['date'] >= $current_date) {
        ?>
        <tr class="del<?php echo $id ?>">
            <td width="100"><?php echo $row['status']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $service_row['Service_Offer']; ?></td>
            <td><?php echo $service_row['Turnaround_Time']; ?></td>
            <td>
                <a rel="tooltip" title="Delete" id="<?php echo $id; ?>" class="btn btn-danger"><i class="icon-trash icon-large"></i></a>
            </td>
            <?php include('toolttip_edit_delete.php'); ?>
        </tr>
    <?php
    }
}
?>
</tbody>

</table>
</div>
<script type="text/javascript">
        $(document).ready( function() {
            $('.btn-danger').click( function() {
                var id = $(this).attr("id");
                if(confirm("Are you sure you want to delete this appointment?")){
                    $.ajax({
                        type: "POST",
                        url: "remove_appointment.php",
                        data: ({id: id}),
                        cache: false,
                        success: function(html){
                        $(".del"+id).fadeOut('slow'); 
                        } 
                    }); 
                }else{
                    return false;}
            });				
        });
    </script>


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