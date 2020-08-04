<?php
session_start();
include('config.php');
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'] ;
}else{

	$user_id="";
}
if(isset($_GET['token'])){
	$app_id=base64_decode($_GET['token']) ;
}else{

	$app_id="";
}


function get_tiny_url($url)  {  
	$ch = curl_init();  
	$timeout = 5;  
	curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
	$data = curl_exec($ch);  
	curl_close($ch);  
	return $data;  
}

?>
<div id="appdetdash">
<?php include('header.php');?>
<?php if(!empty($user_id)){?>
	
	<link rel="stylesheet" type="text/css" href="css/dashboard-style.css" />	
	<div class="main-container" style="padding-top: 180px">
		
			<div class="appdetails">
				<section class="cntarea nwstyle">
				<h1>Application & Grants details</h1>	
				<ul class="dshtabs">
					<li class="active" rel="tab1">Application Information</li>
					<li rel="tab2">Grant Information</li>
				</ul>
				<div class="tab_container">
					
					<?php
					$appId = $app_id;
					$sqlquery = "SELECT gs.name as statusname, ai.area_of_interest, a.*, ga.*,ur.name as username,ur.lastname as lname,ur.mobile as primarynumber,ur.email as useremail from grants_applicants ga LEFT JOIN user_register ur on ur.id=ga.user_id LEFT JOIN admin a on a.application_id=ga.application_id LEFT JOIN area_of_interest ai on ai.id=ga.interest LEFT JOIN grant_status gs on gs.id=a.grant_status  where ga.application_id='$appId' ORDER BY ga.created_date DESC";

					$result = mysqli_query($con, $sqlquery);

					if (!empty($result) && $result->num_rows > 0) {
						$count=1;
						while($rows = $result->fetch_assoc()){
					         //print_r($rows);
							$mail_address1=$rows['mail_address'];
							$primaryphone=$rows['primarynumber'];
							$secondary_phone1=	$rows['secondary_phone'];
							$nationality1	=	$rows['nationality'];
							$age 			=	$rows['age'];
							$resume 		=	$rows['resume'];
							$last_org_work1 =	$rows['last_org_work'];
							$pastbyline1	=	$rows['pastbyline'];
							$ref11			=	$rows['ref1'];
							$ref21			=	$rows['ref2'];
							$ref31			=	$rows['ref3'];
							$description_assignment1=	$rows['description_assignment'];
							$statement_purpose1=	$rows['statement_purpose'];
							$interest1		=	$rows['area_of_interest'];
							$lname 			=	$rows['lname'];
							$fname 			=	$rows['username'];
							$email 			=	$rows['useremail'];
							$grant_status 			=	$rows['statusname'];
							$approved_grant_amount 			=	$rows['approved_grant_amount'];
							$approved_expense_amount 		=	$rows['approved_expense_amount'];
							$first_tranche_amount 			=	$rows['first_tranche_amount'];
							$first_expense_tranche_amount 	=	$rows['first_expense_tranche_amount'];
							$first_tranche_release_date		=	$rows['first_tranche_release_date'];

							$projected_interim_review_date 	=	$rows['projected_interim_review_date'];
							$actual_interim_review_date 	=	$rows['actual_interim_review_date'];
							$interim_tranche_amount 		=	$rows['interim_tranche_amount'];
							$interim_tranche_amount_paid 	=	$rows['interim_tranche_amount_paid'];
							$final_tranche_release_date 	=	$rows['final_tranche_release_date'];
							$final_tranche_amount 			=	$rows['final_tranche_amount'];
							$final_expense_release_date 	=	$rows['final_expense_release_date'];
							$final_expense_amount 			=	$rows['final_expense_amount'];
							$first_expense_tranche_paid 	=	$rows['first_expense_tranche_paid']; 
							$final_expense_paid 			=	$rows['final_expense_paid'];
							$final_tranche_paid				=	$rows['final_tranche_paid'];
							$actual_publication_date		=	$rows['actual_publication_date'];
							$projected_publication_date		=	$rows['projected_publication_date'];
							$first_tranche_amount_paid		=	$rows['first_tranche_amount_paid'];
							$incomplete		=	$rows['incomplete'];
							$complete		=	$rows['complete'];
						}
					}
					else
					{
						print_r("empty");
					}


					?>


					<div id="tab1" class="tab_content">
<!--						<h3 class="d_active tab_drawer_heading app-info" rel="tab1">Application Information</h3>-->
						<div class="appdet">
							<h2 class="app-info">Application ID:<?php echo '<strong>'. $app_id.'</strong>';?></h2>
							<div class="dsp-appdet">
								<ul>
									<li>
										<p>First Name</p>
										<b class="disId"><?=$fname ?></b>
									</li>
									<li>
										<p>Last Name</p>
										<b class="disId"><?=$lname ?></b>
									</li>
									<li>
										<p>E-mail address</p>
										<b class="disId"><?=$email ?></b>
									</li>
									<li>
										<p>Mailing Address</p>
										<b class="disId"><?=$mail_address1 ?></b>
									</li>
								</ul>
								<ul class="upres">
									<li>
										<p>Uploaded Resume</p>
										<?php if(isset($resume)) {
										$rawUrl = 'https://www.thakur-foundation.org/upload/resume/'.$resume;
										?>
										<a href="<?=$rawUrl?>" target="_blank"><?php echo $resume ?></a>
										<?php }else{$resume;}?>


									</li>
									<li>
										<p>Uploaded Portfolio</p>
										<?php 
										$portdetails="SELECT * from portfolio where application_id='". $app_id."' and deleted='0' ";
										$portresultinfouser = $con->query($portdetails);
										if (!empty($portresultinfouser) && $portresultinfouser->num_rows > 0) {
											while($rowp  = $portresultinfouser->fetch_assoc()) {
												$portfolio = $rowp['portfolio'];?>
												<p><a href="https://www.thakur-foundation.org/upload/portfolio/<?php echo $portfolio;?>" target="_blank"><?php echo $portfolio; ?></a></p>
												<?php }}  ?>




											</li>
										</ul>
										<ul>
											<li>
												<p>Last Organization Worked for</p>
												<b class="disId"><textarea class="grntinfo" readonly><?=$last_org_work1 ?></textarea></b>
											</li>
											<li>
												<p>Past By-lines</p>
												<b class="disId"><textarea class="grntinfo" readonly><?=$pastbyline1 ?></textarea></b>
											
											</li>
											<li>
												<p>Reference 1</p>
												<b class="disId"><textarea class="grntinfo" readonly><?=$ref11 ?></textarea></b>
											
											</li>
											<li>
												<p>Reference 2</p>
												<b class="disId"><textarea class="grntinfo" readonly><?=$ref21 ?></textarea></b>
											
											</li>
										</ul>
										<ul>
											<li>
												<p>Reference 3</p>
												<b class="disId"><textarea class="grntinfo" readonly><?=$ref31 ?></textarea></b>
											</li>
											<li>
												<p>Area of interest</p>
												<?php 
												if($interest1=="right_of_information"){
													$interest1='Right of Information';
												}elseif($interest1=="public_health"){
													$interest1='Public Health';

												}elseif($interest1=="civil_rights_and_social_justice"){

													$interest1='Civil Rights and Social Justice';

												}?>
												<b class="disId"><?=$interest1 ?></b>
											</li>
											<li>
												<p>Description of the assignment</p>
												<b class="disId"><textarea class="grntinfo" readonly><?=$description_assignment1 ?></textarea></b>
											</li>

											<li>
												<p>Statement of Purpose</p>
												<b class="disId"><textarea class="grntinfo" readonly><?=$statement_purpose1 ?></textarea></b>
											</li>
										</ul>
										<ul class="upres">

											<li>
												<p>Statutory Documents for Grant Approval</p>
												<?php 
												$docsdetails="SELECT * from  grant_applicants_docs where application_id='". $app_id."' AND deleted='0' ";
												$docsdetailsesultinfouser = $con->query($docsdetails);
												if (!empty($docsdetailsesultinfouser) && $docsdetailsesultinfouser->num_rows > 0) {
													while($rowp  = $docsdetailsesultinfouser->fetch_assoc()) {
									//print_r($rowp);
														$docsgrant = $rowp['doc'];?>
														<p><a href="https://www.thakur-foundation.org/upload/grant_applicants/<?php echo $docsgrant;?>" target="_blank"><?php echo $docsgrant; ?></a></p>
														<?php }}  ?>

													</li>
							<!-- </ul>
							<ul> -->
								<li>
									<p>Project Impact Documents</p>
									<?php 
									$docsdetailsoutcome="SELECT * from  grant_applicants_outcome where application_id='". $app_id."' ";
									$docsdetailsoutcomeuser = $con->query($docsdetailsoutcome);
									if (!empty($docsdetailsoutcomeuser) && $docsdetailsoutcomeuser->num_rows > 0) {
										while($rowp  = $docsdetailsoutcomeuser->fetch_assoc()) {
									//print_r($rowp);
											$docsgrantoutcome = $rowp['outcome_doc'];?>
											<p><a href="https://www.thakur-foundation.org/upload/grant_applicants_outcome/<?php echo $docsgrantoutcome;?>" target="_blank"><?php echo $docsgrantoutcome; ?></a></p>
											<?php }}  ?>




										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- #tab1 -->
						<!--  -->
						<div id="tab2" class="tab_content">
<!--							<h3 class="tab_drawer_heading" rel="tab2">Grant Information</h3>-->
							<div class="appdet">
								<h2 class="app-info">Application ID:<?php echo '<strong>'.$app_id.'</strong>';?></h2>
								<div class="dsp-appdet cmt">
									<ul>
										<li>
											<p>Grant status:</p>
											<?php if($incomplete=='1'){?>
												<b class="disId">NA</b>
											<?php }else if($complete=='1'&& !empty($grant_status) && $grant_status !='Unopened'){?>
												<b class="disId"><?= ucfirst($grant_status) ?></b>
											<?php }else{?>
												<b class="disId">Submitted</b>
											<?php } ?>
											
										</li>
									</ul>
									<div class="clar"></div>
									<div class="capd">

										<h4>Grant Amount: <?php if(!empty($approved_grant_amount)) echo $approved_grant_amount.' INR' ?></h4>
										<br>
										<h3>First Tranche</h3>
										<ul class="">
											<li>
												<p>Tranche 1 - Release Date (YY/MM/DD)</p>
												<b class="disId"><?php if($first_tranche_release_date != '0000-00-00'){ echo $first_tranche_release_date;} ?></b>
											</li>
											<li class="grantli"></li>
											<li>
												<p>Grant Tranche 1 (INR)</p>
												<b class="disId"><?=$first_tranche_amount ?></b>
											</li>
											<li>
												<p>Grant Tranche 1 - Paid (Y/N)</p>
												<b class="disId"><?= ucfirst($first_tranche_amount_paid) ?></b>
											</li>
										</ul>

										<h3>Interim Tranche</h3>

										<ul>
											<li>
												<p>Projected Interim Review Date (YY/MM/DD)</p>
												<b class="disId"><?=$projected_interim_review_date ?></b>
											</li>
											<li>
												<p>Actual Interim Review Date (YY/MM/DD)</p>
												<b class="disId"><?=$actual_interim_review_date ?></b>
											</li>					

											<li>
												<p>Grant Tranche 2 (INR)</p>
												<b class="disId"><?=$interim_tranche_amount ?></b>
											</li>

											<li>
												<p>Grant Tranche 2 – Paid (Y/N)</p>
												<b class="disId"><?= ucfirst($interim_tranche_amount_paid) ?></b>
											</li> 

											<li>
												<p>Projected Publication Date (YY/MM/DD)</p>
												<b class="disId"><?=$projected_publication_date ?></b>
											</li> 

											<li>
												<p>Actual Publication Date (YY/MM/DD)</p>
												<b class="disId"><?=$actual_publication_date ?></b>
											</li> 
									</ul>

									<h3>Final Tranche</h3>

									<ul>
											<li>
												<p>Grant Tranche 3 – Release Date (YY/MM/DD)</p>
												<b class="disId"><?php if($final_tranche_release_date != '0000-00-00'){ echo $final_tranche_release_date;} ?></b>
											</li>
											<li class="grantli"></li>
											<li>
												<p>Grant Tranche 3 (INR)</p>
												<b class="disId"><?=$final_tranche_amount ?></b>
											</li>
											<li>
												<p>Grant Tranche 3 – Paid (Y/N)</p>
												<b class="disId"><?= ucfirst($final_tranche_paid) ?></b>
											</li>


										</ul>
									</div>
										<div class="capd">
											<h4>Expense Amount: <?php if(!empty($approved_expense_amount)) echo $approved_expense_amount.' INR'?></h4><br>
										<h3>First Tranche</h3>

											<ul class="">
												<li>
													<p>Expense Tranche 1 - Release Date (YY/MM/DD)</p>
													<b class="disId"><?php if($first_tranche_release_date != '0000-00-00'){ echo $first_tranche_release_date;} ?></b>
												</li>
												<li class="grantli"></li>
												<li>
													<p>Expense Tranche 1 (INR)</p>
													<b class="disId"><?=$first_expense_tranche_amount ?></b></li>
												<li>
													<p>Expense Tranche 1 – Paid (Y/N)</p>
													<b class="disId"><?= ucfirst($first_expense_tranche_paid) ?></b>
												</li>
												<!-- <li class="grantli"></li>
												<li class="grantli"></li>
												<li class="grantli"></li>
												<li class="grantli"></li>
												<li class="grantli"></li>
												<li class="grantli"></li> -->
												</ul>

												<h3>Final Tranche</h3>

												<ul>

												<li>
													<p>Expense Tranche 2 - Release Date (YY/MM/DD)</p>
													<b class="disId"><?=$final_expense_release_date ?></b>
												</li> 
												<li class="grantli"></li>
												<li>
													<p>Expense Tranche 2 (INR)</p>
													<b class="disId"><?=$final_expense_amount ?></b>
												</li>
												<li>
													<p>Expense Tranche 2 – Paid (Y/N)</p>
													<b class="disId"><?= ucfirst($final_expense_paid) ?></b>
												</li> 
												
											</ul>
										</div>


									</div>
								</div>
							</div>
							<!-- #tab2 -->
						</div>
						<!-- .tab_container -->
					</section>
					</div>
				
			</div>	
			<?php }else{
				echo '<script>window.location.href = "https://www.thakur-foundation.org/";</script>';
			}?>		
		</div>
		
		<!-- <script src="../js/jquery.popupoverlay.min.js" type="text/javascript"></script> -->
		<script src="https://www.thakur-foundation.org/js/dash-board-app.js" type="text/javascript"></script>
		<?php  include('footer.php');?>

