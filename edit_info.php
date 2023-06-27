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
					
				<div class=""></div>
					
					
			
				
				</div>
				<div class="span6">
				
					
				<div class="alert alert-info">Edit Personal Information</div>
	<?php 
	$member_query = mysqli_query($conn,"select * from members where member_id='$session_id'")or die(mysqli_error($conn));
	$member_row= mysqli_fetch_array($member_query);
	?>
	 <form class="form-horizontal" method="POST">
		<div class="control-group">
			<label class="control-label" for="inputEmail">Firstname</label>
			<div class="controls">
			<input type="text" value="<?php echo $member_row['firstname']; ?>" name="firstname" id="inputEmail" placeholder="Firstname" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Lastname</label>
			<div class="controls">
			<input type="text" name="lastname" id="inputPassword" placeholder="Lastname" value="<?php echo $member_row['lastname']; ?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Middlename</label>
			<div class="controls">
			<input type="text" name="middlename" id="inputPassword" value="<?php echo $member_row['middlename']; ?>" placeholder="Middlename" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Address</label>
			<div class="controls">
			<input type="text" name="address" value="<?php echo $member_row['address']; ?>" id="inputPassword" placeholder="Address" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Email</label>
			<div class="controls">
			<input type="text" name="email" id="inputPassword" value="<?php echo $member_row['email']; ?>" placeholder="Email" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Age</label>
			<div class="controls">
			<input type="text" name="age" class="span1" value="<?php echo $member_row['age']; ?>" id="inputPassword" placeholder="Age" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Gender</label>
			<div class="controls">
			<select class="span2" name="gender" required>
			<option><?php echo $member_row['gender']; ?></option>
			<option>Male</option>
			<option>Female</option>
			</select>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			<button type="submit" name="update" class="btn btn-success"><i class="icon-pencil"></i>&nbsp;Update</button>
			</div>
		</div>
    </form>
	
	<?php
	if (isset($_POST['update'])){
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$middlename = $_POST['middlename'];
	$address = $_POST['address'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
		
	mysqli_query($conn,"update members set firstname='$firstname' , lastname='$lastname' , middlename='$middlename' , address='$address' ,
	age='$age' , gender='$gender' , email='$email' where member_id='$session_id' ") or die(mysqli_error($conn));
	?>
	<script>
	window.location = 'edit_info.php'; 
	</script>
	<?php
	}	
	?>

	
	
	
				</div>
				<div class="span3">
			
					 <div class="alert alert-danger"><li class="nav-header">NOTE</li></div>
						
					
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
