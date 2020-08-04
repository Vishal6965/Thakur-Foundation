<?php 
session_start();
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'] ;
}else{

	$user_id="";
}
include('config.php');
$sql = "SELECT a.grant_status, ga.*,ur.name as username,ur.lastname as lname,ur.mobile as primarynumber from grants_applicants ga LEFT JOIN user_register ur on ur.id=ga.user_id LEFT JOIN admin a on a.application_id=ga.application_id  where ga.user_id=$user_id ORDER BY ga.created_date DESC";

$rs_result = mysqli_query($con, $sql);?>
<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">	
	<link href='css/dropzone.css' type='text/css' rel='stylesheet'>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src='js/dropzone.js' type='text/javascript'></script>
</head>
<style type="text/css">
.container{
	margin: 0 auto;
	width: 90%;
}

.content{
	padding: 5px;
	margin: 0 auto;
}
.content span{
	width: 250px;
}

.dz-message{
	text-align: center;
	font-size: 28px;
}
body {
	color: #666;
	font: 14px/24px "Open Sans", "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", Sans-Serif;
}
.tabs {
	max-width: 538px;
}
.tabs-nav li {
	float: left;
	width: 50%;
}
.tabs-nav li:first-child a {
	border-right: 0;
	border-top-left-radius: 6px;
}
.tabs-nav li:last-child a {
	border-top-right-radius: 6px;
}
a {
	background: #eaeaed;
	border: 1px solid #cecfd5;
	color: #0087cc;
	display: block;
	font-weight: 600;
	padding: 10px 0;
	text-align: center;
	text-decoration: none;
}
a:hover {
	color: #ff7b29;
}
.tab-active a {
	background: #fff;
	border-bottom-color: transparent;
	color: #2db34a;
	cursor: default;
}
.tabs-stage {
	border: 1px solid #cecfd5;
	border-radius: 0 0 6px 6px;
	border-top: 0;
	clear: both;
	padding: 24px 30px;
	position: relative;
	top: -1px;
}

</style>
<h1><center>Grant Applicants Details</center></h1>
<table border="1px" width='100%'>
	<th>Sr.No</th>
	
	<th>Application Id</th>
	<th>Grant type</th>
	<th>Grant Status</th>
	<th>Submitted date</th>
	<th>Action</th>
	<th>Upload docs for grant application</th>
	<th>Upload docs for outcome</th>

	<?php  

	if (!empty($rs_result) && $rs_result->num_rows > 0) {
		$count=1;
		while($row = $rs_result->fetch_assoc()) {?>
			<tr>
				<td><?php echo $count;?></td>

				<td><?php echo $row['application_id']?></td>

				<td><?php echo $row['interest']?></td>
				<?php if(empty($row['grant_status'])){?>
					<td>NA</td>
				<?php }else{?>
					<td><?php echo $row['grant_status'];?> </td>
				<?php }?>	



								<!-- 	
					                <td>
					                  		<?php
								               $idf=$row['application_id'];
								               $impactinfo="SELECT portfolio from portfolio where application_id='".$idf."' AND deleted='0' ";
					                        $resultgetimpactinfo = $con->query($impactinfo);

					                        if (!empty($resultgetimpactinfo) && $resultgetimpactinfo->num_rows > 0) {
					                            // output data of each row
					                            while($rows = $resultgetimpactinfo->fetch_assoc()) { ?>
					                           <a href="<?php echo $base_url?>upload/portfolio/<?php echo $rows['portfolio'] ?>" target="_blank"><?php echo  $rows['portfolio'];?></a>
					                 <?php } }?>
					             </td> -->

					             <td><?php echo date('Y-m-d',strtotime($row['created_date'])) ?></td>
					             <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myappview-<?php echo $row['application_id'];?>">View</button><a href="#">Edit </a></td>
					             <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal-<?php echo $row['application_id'];?>">Upload</button></td>
					             <td></td>

					             <?php if($row['incomplete']==1){?>
					             	<td><a href="<?php echo $base_url?>grant1.php?appl_id=<?php echo base64_encode($row['application_id'])?>">Edit</a></td>
					             <?php } ?> 
					         </tr>

					         <!-- Modal -->
					         <div class="modal fade" id="myModal-<?php echo $row['application_id'];?>" role="dialog">
					         	<div class="modal-dialog">

					         		<!-- Modal content-->
					         		<div class="modal-content">
					         			<div class="modal-header">
					         				<button type="button" class="close" data-dismiss="modal">&times;</button>
					         				<h4 class="modal-title">Modal Header</h4>
					         			</div>
					         			<div class="container" >
					         				<div class='content'>
					         					<form action="upload.php" method="post" class="dropzone" id="dropzonewidget">
					         						<input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id'];?>" />
					         						<input type="hidden" id="application_id" name="application_id" value="<?php echo $row['application_id'];?>" />

					         					</form> 
					         				</div> 
					         			</div>
					         			<div class="modal-footer">
					         				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					         			</div>
					         		</div>

					         	</div>
					         </div>

					         <div class="modal fade" id="myappview-<?php echo $row['application_id'];?>" role="dialog">
					         	<div class="modal-dialog">

					         		<!-- Modal content-->
					         		<div class="modal-content">
					         			<div class="modal-header">
					         				<button type="button" class="close" data-dismiss="modal">&times;</button>
					         				<h4 class="modal-title">Modal Header</h4>

					         				<?php
					         				$appId = $row["application_id"];
					         				$sqlquery = "SELECT a.*, ga.*,ur.name as username,ur.lastname as lname,ur.mobile as primarynumber,ur.email as useremail from grants_applicants ga LEFT JOIN user_register ur on ur.id=ga.user_id LEFT JOIN admin a on a.application_id=ga.application_id  where ga.application_id='$appId' ORDER BY ga.created_date DESC";

					         				$result = mysqli_query($con, $sqlquery);

					         				if (!empty($result) && $result->num_rows > 0) {
					         					$count=1;
					         					while($rows = $result->fetch_assoc()){
					         						//print_r($rows);
					         						$mail_address1=$rows['mail_address'];
					         						$primaryphone=$rows['primarynumber'];
					         						$secondary_phone1=$rows['secondary_phone'];
					         						$nationality1	=$rows['nationality'];
					         						$age 			=$rows['age'];
					         						$resume 		=$rows['resume'];
					         						$last_org_work1 =$rows['last_org_work'];
					         						$pastbyline1	=$rows['pastbyline'];
					         						$ref11			=$rows['ref1'];
					         						$ref21			=$rows['ref2'];
					         						$ref31			=$rows['ref3'];
					         						$description_assignment1=$rows['description_assignment'];
					         						$statement_purpose1=$rows['statement_purpose'];
					         						$interest1		=$rows['interest'];
					         						$lname 			=$rows['lname'];
					         						$fname 			=$rows['username'];
					         						$email 			=$rows['useremail'];
					         						$approved_grant_amount 			=$rows['approved_grant_amount'];
					         						$approved_expense_amount 		=$rows['approved_expense_amount'];
					         						$first_tranche_amount 			=$rows['first_tranche_amount'];
					         						$first_expense_tranche_amount 	=$rows['first_expense_tranche_amount'];
					         						
					         						
					         						$projected_interim_review_date 	=$rows['projected_interim_review_date'];
					         						$actual_interim_review_date 	=$rows['actual_interim_review_date'];
					         						$interim_tranche_amount 		=$rows['interim_tranche_amount'];
					         						$interim_tranche_amount_paid 	=$rows['interim_tranche_amount_paid'];
					         						$final_tranche_release_date 	=$rows['final_tranche_release_date'];
					         						$final_tranche_amount 			=$rows['final_tranche_amount'];
					         						$final_expense_release_date 	=$rows['final_expense_release_date'];
					         						$final_expense_amount 			=$rows['final_expense_amount'];
					         						
					         					}
					         				}
					         				else
					         				{
					         					print_r("empty");
					         				}


					         				?>


					         			</div>
					         			<div class="container" >
					         				<div class='content'>

					         					<div class="tabs">
					         						<ul class="tabs-nav">
					         							<li><a href="#tab-1-<?php echo $row['application_id'];?>">Application Details</a></li>
					         							<li><a href="#tab-2-<?php echo $row['application_id'];?>">Admin response</a></li>
					         						</ul>
					         						<div class="tabs-stage">
					         							<div id="tab-1-<?php echo $row['application_id'];?>">
					         								<form class="" id="grantform"  method="post">
					         									<ul id="myfrmdata" class="formbx">
					         										<li>
					         											<p>First Name </p>
					         											<input type="text"  name="fname" value="<?php if(isset($fname)) echo $fname;else $fname;  ?>"  class="text-brd"  readonly  />

					         										</li>
					         										<li>
					         											<p>Last Name </p>
					         											<input type="text"  name="lname" value="<?php if(isset($lname)) echo $lname;else $lname; ?>" class="text-brd"  readonly  />
					         										</li>
					         										<li>
					         											<p>E-mail address </p>
					         											<input type="email"  name="email"  value="<?php if(isset($email)) echo $email;else $email ;?>" class="text-brd" readonly />
					         										</li>

					         										<li>
					         											<p>Mailing Address </p>

					         											<textarea  class="text-brd" readonly><?php  if(isset($mail_address1))echo $mail_address1;else $mail_address1; ?></textarea>
					         										</li>

					         										<li>
					         											<p>Primary Phone Number </p>
					         											<input type="text" name="primaryphone" value="<?php if(isset($primaryphone)) echo $primaryphone;else $primary_phone;  ?>"  class="text-brd" readonly >
					         										</li>

					         										<li>
					         											<p>Secondary Phone Number </p>
					         											<input type="text"  name="secondaryphone" value="<?php if(isset($secondary_phone1)) echo $secondary_phone1;else $secondary_phone1 ?> " readonly>
					         										</li>

					         										<li>
					         											<p>Last Organization Worked for</p>
					         											<textarea class="text-brd" readonly><?php if(isset($last_org_work1)) echo $last_org_work1;else $last_org_work1; ?></textarea>
					         										</li>

					         										<li>
					         											<p>Past By-lines </p>
					         											<textarea readonly><?php if(isset($pastbyline1))echo $pastbyline1; else $pastbyline1; ?></textarea>
					         										</li>

					         										<li>
					         											<p>Reference 1</p>
					         											<textarea  readonly><?php if(isset($ref11)) echo $ref11;else $ref11=""; ?></textarea>
					         										</li>
					         										<li>
					         											<p>Reference 2 </p>
					         											<textarea readonly ><?php if(isset($ref21)) echo $ref21;else $ref21=""; ?></textarea>

					         										</li>
					         										<li>
					         											<p>Reference 3</p>
					         											<textarea readonly><?php if(isset($ref31)) echo $ref31; else $ref31=""; ?></textarea>
					         										</li>
					         										<li>
					         											<p> Area of interest </p>
					         											<input type="text" value="<?php if(isset($interest1)) echo $interest1; else $interest1 =""; ?>" readonly>

						         										</select>
						         									</li>

						         									<li>
						         										<p>Description of the assignment </p>
						         										<textarea readonly><?php if(isset($description_assignment1)) echo $description_assignment1;else $description_assignment1  ?></textarea>

						         									</li>

						         									<li>
						         										<p>Statement of Purpose </p>
						         										<textarea readonly ><?php if(isset($statement_purpose1)) echo $statement_purpose1;else  $statement_purpose1; ?></textarea>

						         									</li>
						         									<li>
						         										<p>Resume: <?php if(isset($resume)) {?>
						         											<p><a href="<?php echo $base_url?>upload/resume/<?php echo $resume;?>" target="_blank"><?php echo $resume ?></a>
						         												<?php }else{$resume;}?></p></p>


						         									</li>
				         											<li>
				         												<p>

				         													Portfolio:<br/>
				         													<?php 
				         													$portdetails="SELECT * from portfolio where application_id='". $appId."' ";
				         													$portresultinfouser = $con->query($portdetails);
				         													if (!empty($portresultinfouser) && $portresultinfouser->num_rows > 0) {
				         														while($rowp  = $portresultinfouser->fetch_assoc()) {
				         															$portfolio = $rowp['portfolio'];?>
				         															<p><a href="<?php echo $base_url?>upload/resume/<?php echo $portfolio;?>"><?php echo $portfolio; ?></a></p>
				         														<?php }}  ?>
			         													</p>	
			         												</li>
			         											</ul>
			         										</form>
			         									</div>
					         									<div id="tab-2-<?php echo $row['application_id'];?>">
					         										<form class="" id="grantform"  method="post">
					         									<ul id="myfrmdata" class="formbx">
					         										<li>
					         											<p>approved_grant_amount </p>
					         											<input type="text"  name="fname" value="<?php if(isset($approved_grant_amount)) echo $approved_grant_amount;else $approved_grant_amount;  ?>"  class="text-brd"  readonly  />

					         										</li>
					         										<li>
					         											<p>approved_expense_amount</p>
					         											<input type="text"  name="lname" value="<?php if(isset($approved_expense_amount)) echo $approved_expense_amount;else $approved_expense_amount; ?>" class="text-brd"  readonly  />
					         										</li>
					         										<li>
					         											<p>first_tranche_amount </p>
					         											<input type="email"  name="email"  value="<?php if(isset($first_tranche_amount)) echo $first_tranche_amount;else $first_tranche_amount ;?>" class="text-brd" readonly />
					         										</li>

					         										<li>
					         											<p>first_expense_tranche_amount </p>
					         												<input type="test"  name="email"  value="<?php if(isset($first_expense_tranche_amount)) echo $first_expense_tranche_amount;else $first_expense_tranche_amount ;?>" class="text-brd" readonly />
					         											
					         										</li>

					         										<li>
					         											<p>projected_interim_review_date </p>
					         											<input type="text" name="primaryphone" value="<?php if(isset($projected_interim_review_date)) echo $projected_interim_review_date;else $projected_interim_review_date;  ?>"  class="text-brd" readonly >
					         										</li>

					         										<li>
					         											<p>actual_interim_review_date </p>
					         											<input type="text"  name="secondaryphone" value="<?php if(isset($actual_interim_review_date)) echo $actual_interim_review_date;else $actual_interim_review_date ?> " readonly>
					         										</li>

					         										<li>
					         											<p>interim_tranche_amount</p>
					         											<input type="text"  name="secondaryphone" value="<?php if(isset($interim_tranche_amount)) echo $interim_tranche_amount;else $interim_tranche_amount ?> " readonly>
					         											
					         										</li>

					         										<li>
					         											<p>interim_tranche_amount_paid </p>
					         											
					         											<input type="text"  name="secondaryphone" value="<?php if(isset($interim_tranche_amount_paid)) echo $interim_tranche_amount_paid;else $interim_tranche_amount_paid ?> " readonly>
					         										</li>

					         										<li>
					         											<p>final_tranche_release_date</p>
					         											<input type="text"  name="secondaryphone" value="<?php if(isset($final_tranche_release_date)) echo $final_tranche_release_date;else $final_tranche_release_date ?> " readonly>
					         										</li>
					         										<li>
					         											<p>final_tranche_amount </p>
					         											<input type="text"  name="secondaryphone" value="<?php if(isset($final_tranche_amount)) echo $final_tranche_amount;else $final_tranche_amount ?> " readonly>

					         										</li>
					         										<li>
					         											<p>final_expense_release_date</p>
					         											<input type="text"  name="secondaryphone" value="<?php if(isset($final_tranche_amount)) echo $final_tranche_amount;else $final_tranche_amount ?> " readonly>
					         										</li>
					         										<li>
					         											<p> final_expense_amount </p>
					         											<input type="text" value="<?php if(isset($final_expense_amount)) echo $final_expense_amount; else $final_expense_amount =""; ?>" readonly>

						         										</select>
						         									</li>

			         											</ul>
			         										</form>
					         									</div>
					         								</div>
					         							</div>



					         						</div> 
					         					</div>
					         					<div class="modal-footer">
					         						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					         					</div>
					         				</div>

					         			</div>
					         		</div>

					         		<?php $count++;} }else{

					         			echo"no records found";
					         		}?>
					         	</table>


					         	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

					         	<script>
					         		Dropzone.autoDiscover = false;
					         		$(".dropzone").dropzone({
					         			addRemoveLinks: true,
					         			removedfile: function(file) {
					         				var name = file.name; 

					         				$.ajax({
					         					type: 'POST',
					         					url: 'upload.php',
					         					data: {name: name,request: 2},
					         					sucess: function(data){
					         						console.log('success: ' + data);
					         					}
					         				});
					         				var _ref;
					         				return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
					         			}
					         		});

// Show the first tab by default
$('.tabs-stage div').hide();
$('.tabs-stage div:first').show();
$('.tabs-nav li:first').addClass('tab-active');

// Change tab class and display content
$('.tabs-nav a').on('click', function(event){
	event.preventDefault();
	$('.tabs-nav li').removeClass('tab-active');
	$(this).parent().addClass('tab-active');
	$('.tabs-stage div').hide();
	$($(this).attr('href')).show();
});




</script>




