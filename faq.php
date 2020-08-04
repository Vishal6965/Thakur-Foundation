<?php
session_start();
include( 'header.php' );
$role="";
if(isset($_SESSION['user_role'])){
	$role = $_SESSION['user_role'];
	}
?>

<section>
  <div class="banner-inner">
    <img src="images/faq-banner.jpg" alt="Banner" class="banner-img hidden-lg">
    <img src="images/faq-banner-sm.jpg" alt="Banner" class="banner-img hidden-sm">
    <div class="banner-txt">
      <h2>Frequently asked questions.</h2>
    </div>
  </div>
</section>
<section class="ourser">
	<div class="container">
		<?php if($role == ''){?>
		<div class="faq-admin">
			<p class="salmon">Browse through the most frequently asked questions we receive from applicants and visitors.</p>
			<div class="accordion-container">
			  <p class="heading">ACCOUNT</p>
			  <div class="set">
				<a href="#"> How do I register and log into the Thakur Foundation website? <img src="images/arrow-dwn.png" alt="arrow"></a>
				<div class="content">
					<ul>
						<li><span>To sign up, perform the following steps:</span></li>
						<ul>
							<li><span>Visit <a href="https://www.thakur-foundation.org/" target="_blank">https://www.thakur-foundation.org/</a> and click <b>LOGIN/SIGN UP</b> at the top-right corner.</span></li>
							<li><span>Enter your credentials and your contact number, starting with a (+) sign and your country code. Next, enter a password.</span></li>
							<li><span>Click <b>SIGN UP</b>.</span></li>
							<li><span>You will receive an email confirming your registration on the website.</span></li>
						</ul>
						<img src="images/faq-19.jpg" alt="Screenshot 19">
						<li><span>To login, perform the following steps:</span></li>
						<ul>
							<li><span>Visit <a href="https://www.thakur-foundation.org/" target="_blank">https://www.thakur-foundation.org/</a> and click <b>LOGIN/SIGN UP</b> at the top-right corner.</span></li>
							<li><span>Enter your email address and password, when prompted.</span></li>
							<li><span>Click <b>LOGIN</b>.</span></li>
						</ul>
						<img src="images/faq-20.jpg" alt="Screenshot 20">
					</ul>
				</div>
			  </div>
			  <p class="heading">GRANTS</p>
			  <div class="set">
				<a href="#"> Who can apply for grants? <img src="images/arrow-dwn.png" alt="arrow"></a>
				<div class="content">
					<ul>
						<li><span>Writers, print and broadcast journalists, documentary filmmakers, activists, organizations, and individuals with an interest in the areas of public health, civil liberties, the RTI Act, and evidence-based science can apply for grants. The aim of our grants is to engage and create a debate, in order to inform policy making and its implementation.</span></li>
					</ul>
				</div>
			  </div>
			  <div class="set">
				<a href="#"> What is the grant review process like?<img src="images/arrow-dwn.png" alt="arrow"></a>
				<div class="content">
					<ul>
						<li><span>Our review is completely transparent and based on merit. When awarding grants, we follow a professional, transparent, accountable, and development-focused approach. Our advisory board consists of credible leaders who stand by our values and hope to enable individuals championing our causes.</span></li>
					</ul>
				</div>
			  </div>
			  <div class="set">
				<a href="#"> On what basis does the Thakur Foundation award grants?<img src="images/arrow-dwn.png" alt="arrow"></a>
				<div class="content">
					<ul>
						<li><span>The Thakur Foundation has a two-fold approach to awarding grants. The first involves awarding grants based on the application submitted by the individual. The second involves inviting people to research specific issues and funding this research and investigation with the help of a grant.</span></li>
					</ul>
				</div>
			  </div>
			  <div class="set">
				<a href="#"> When are grants awarded?<img src="images/arrow-dwn.png" alt="arrow"></a>
				<div class="content">
					<ul>
						<li><span>The deadline for each grant varies depending on your field of interest. We award grants on a rolling basis throughout the year with online announcements inviting applicants. Interested applicants are required to follow the process for submission of proposals in a time-bound manner.</span></li>
					</ul>
				</div>
			  </div>
			  <p class="heading">APPLICATION</p>
			  <div class="set">
				<div class="content">
				  <ul>
						<li><span>Visit <a href="https://www.thakur-foundation.org/index.php" target="_blank">How To Apply</a> for a step-by-step guide to applying through our online application.</span></li>
						<li><span>If you are unable to fill the application in one go, save your incomplete application by clicking <b>Save For Later</b>. This enables you to return at a later date and edit the application by logging into your account.</span></li>
						<li><span>When you return, click <b>My Account</b> on the top-right corner. This will take you to your Application Dashboard where you can locate your application ID. In the sixth column, click <b>Application Details</b> to open your incomplete application.</span></li>
						<li><span>Once complete, click <b>Submit</b>. Remember, you cannot edit your application after submitting it.</span></li>
					</ul>
				</div>
			  </div>
			  <div class="set">
				<a href="#"> Which documents should I upload? <img src="images/arrow-dwn.png" alt="arrow"> </a>
				<div class="content">
					<ul>
						<li><span>Upload your resume.</span></li>
						<ul>
							<li><span>Please ensure that you upload a single PDF/Doc/Docx file, upto 2 MB.</span></li>
						</ul>
						<li><span>Upload your portfolio and documents.</span></li>
						<ul>
							<li><span>You can upload multiple PDF/Mp4/Mp3/Flv files pertaining to your application, upto 25 MB.</span></li>
						</ul>
					</ul>
					<img src="images/faq-23.jpg" alt="Screenshot 23">
				</div>
			  </div>
			  <div class="set">
				<a href="#"> How can I add, delete, or replace files in my application? <img src="images/arrow-dwn.png" alt="arrow"></a>
				<div class="content">
					<ul>
						<li><span>If you have already submitted your application, you cannot make changes to it. However, if you have saved a partially-filled application, follow these steps:</span></li>
						<ul>
							<li><span>Sign into your account using your account credentials.</span></li>
							<li><span>Click the menu on the top-right corner (below LOGOUT), and select <b>My Account</b>. This will open your personal dashboard.</span></li>
							<li><span>Locate your application ID. On the sixth column, click <b>Application Details</b>. This will open your incomplete application.</span></li>
							<li><span>Add, delete, and replace the following files within the specified size limits:</span></li>
							<ul>
								<li><span><b>Resume</b> <br> Please ensure that you upload a single PDF/Doc/Docx file, upto 2 MB.</span></li>
								<li><span><b>Portfolio, Documents</b> <br> You can upload multiple PDF/Mp4/Mp3/Flv files pertaining to your application, upto 25 MB.</span></li>
							</ul>
						</ul>
					</ul>
					<img src="images/faq-24.jpg" alt="Screenshot 24">
					<img src="images/faq-25.jpg" alt="Screenshot 25">
				</div>
			  </div>
			  <div class="set">
				<a href="#"> Which documents are required for the ‘Statutory documents for grant approval’ column of the applicant dashboard? <img src="images/arrow-dwn.png" alt="arrow"> </a>
				<div class="content">
					<ul>
						<li><span>The following is the list of statutory documents for grant approval:</span></li>
						<ul>
							<li><span>Legal and contractual documents required for investigative grants in Public Health from the Thakur Foundation.</span></li>
							<li><span>Services contract.</span></li>
							<ul>
								<li><span><a href="https://www.thakur-foundation.org//pdf/tff-investigative-grants-in-public-health-announcement.pdf" target="_blank"> TFF - Investigative Grants in Public Health - AGREEMENT FOR SERVICES.pdf</a></span></li>
							</ul>
							<li><span>Grant-making policies for Public Health.</span></li>
							<ul>
								<li><span><a href="https://www.thakur-foundation.org/pdf/international-grant-making-policy.pdf" target="_blank"> International Grant-Making Policy.pdf</a></span></li>
								<li><span><a href="https://www.thakur-foundation.org/pdf/affidavit-packet-for-non-us-grant-applicants.pdf" target="_blank"> Affidavit packet for Non-US Grant Applicants.pdf</a></span></li>
								<li><span><a href="https://www.thakur-foundation.org/pdf/grant-making-affidavit.pdf" target="_blank"> Grant-making Affidavit.pdf</a></span></li>
								<li><span><a href="https://www.thakur-foundation.org/pdf/grant-making-affidavit-update.pdf" target="_blank"> Grant-making Affidavit Update.pdf</a></span></li>
								<li><span><a href="https://www.thakur-foundation.org/pdf/investigative-reporting-grant-policy.pdf" target="_blank"> Investigative Reporting Grant Policy.pdf</a></span></li>
							</ul>
						</ul>
					</ul>
					<img src="images/faq-30.jpg" alt="Screenshot 30">
					<img src="images/faq-31.jpg" alt="Screenshot 31">
					<img src="images/faq-32.jpg" alt="Screenshot 32">
				</div>
			  </div>
			  <div class="set">
				<a href="#"> How can I view the status of my incomplete application? <img src="images/arrow-dwn.png" alt="arrow"> </a>
				<div class="content">
					<ul>
						<li><span>Check the status of your incomplete application in one of the following ways:</span></li>
						<ul>
							<li><span>View your emails from the Thakur Foundation on your registered email address. You can log in via your application email.</span></li>
							<li><span>View the application dashboard by signing into your account, clicking the menu to the top-right corner, and selecting <b>My Account</b>. Locate your application ID, and check the status of your grant application in the fifth column.</span></li>
						</ul>
					</ul>
				</div>
			  </div>
			  <div class="set">
				<a href="#"> How can I view the status of my completed application? <img src="images/arrow-dwn.png" alt="arrow"> </a>
				<div class="content">
					<ul>
						<li><span>Check the status of your completed application by performing these steps:</span></li>
						<ul>
							<li><span>Sign into your account using your account credentials.</span></li>
							<li><span>Click the menu on the top-right corner (below LOGOUT), and select <b>My Account</b>. This will open your personal dashboard.</span></li>
							<li><span>Locate your application ID. On the sixth column, click <b>Application Details</b>. This will open the <b>Application &amp; Grants</b> page.</span></li>
							<li><span>View the status and details of your application in the <b>Application Information</b> tab.</span></li>
							<li><span>View the grant payments and expense reimbursements in the <b>Grant Information</b> tab.</span></li>
						</ul>
					</ul>
				</div>
			  </div>
			  <div class="set">
				<a href="#"> Can I edit my application after submission? <img src="images/arrow-dwn.png" alt="arrow"> </a>
				<div class="content">
					<ul>
						<li><span>No, you cannot edit your application after submitting it. However, you can create a fresh application for the same grant with your updated details and edits, and submit the application once again.</span></li>
						<li><span>Please remember to email us at information@thakur-foundation.org regarding deleting your previous application from our system. The email subject line must contain your application ID in the following manner: “Please delete application ID GT****.</span></li>
						<li><span>This is so that we process the correct application submitted by you. Failure to inform us may lead to the wrong application getting processed, and your application may be rejected.</span></li>
					</ul>
				</div>
			  </div>
			  <div class="set">
				<a href="#"> How can I report a change of address after submitting my application? <img src="images/arrow-dwn.png" alt="arrow"> </a>
				<div class="content">
					<ul>
						<li><span>Email us directly with the details of your new address at <a href="mailto:information@thakur-foundation.org">information@thakur-foundation.org</a>. You can also submit your issue on the Thakur Foundation website using the ‘Write To Us’ form, available on our website footer.</span></li>
					</ul>
				</div>
			  </div>
			</div>
		</div>
		<?php }else if($role == 2){?>
		<div class="faq-admin">
			<div class="title">Advisory Board Member</div>
			<p class="sub-title">The FAQs have been designed to be viewed on a desktop.</p>
			<div class="accordion-container">
			  <div class="set">
				<a href="#"> 1. How do I register myself on the Thakur Family Foundation website? <img src="images/arrow-dwn.png" alt="arrow"></a>
				<div class="content">
					<ul>
						<li><span>The administrator will create your account and the login credentials will be sent to your registered email address.</span></li>
						<li><span>Visit <a href="https://www.thakur-foundation.org/" target="_blank">https://www.thakur-foundation.org/</a> and click on the “LOGIN/SIGN UP” button located on the top right corner.</span></li>
						<li><span>Enter your details and click on “LOG IN” button.</span></li>
					</ul>
					<img src="images/faq-17.jpg" alt="Screenshot 17">
				</div>
			  </div>
			  <div class="set">
				<a href="#"> 2. How do I check the grant application assigned to me by the admininstrator? <img src="images/arrow-dwn.png" alt="arrow"></a>
				<div class="content">
					<ul>
						<li><span>For every application that you need to review, you will receive a personalized email message on your registered email address from Thakur Family Foundation.</span></li>
						<li><span>Open the email and click on the Grant Application ID mentioned therein.</span></li>
						<li><span>This will open the Grant &amp; Applicant details page containing information about the applicant including all documents uploaded by the applicant.</span></li>
						<li><span>In case you are not logged in, you will be directed to the homepage where you will have to login using your login credentials.</span></li>
						<li><span>After signing in, come back to the email from Thakur family Foundation and click on the grant application ID. This will open the Grant &amp; Applicant details page containing information about the applicant.</span></li>
					</ul>
					<img src="images/faq-18.jpg" alt="Screenshot 18">
				</div>
			  </div>
			</div>
		</div>

	<?php	}else if($role == 1){ ?>
		<div class="faq-admin">
			<div class="title">FAQs</div>
			<p class="sub-title">The FAQs have been designed to be viewed on a desktop.</p>
			<div class="tab">
			  <button class="tablinks active" onclick="openCity(event, 'admin')">Administrator FAQs</button>
			  <button class="tablinks" onclick="openCity(event, 'user')">Visitor / Applicant FAQs</button>
			  <button class="tablinks" onclick="openCity(event, 'advisory')">Advisory Board FAQs</button>
			</div>
			<div id="admin" class="tabcontent" style="display: block;">
				<span class="heading">Administrator FAQs</span>
			  <div class="accordion-container">
				  <div class="set">
					<a href="#"> 1. How do I access the Administrator Dashboard on the Thakur Family Foundation website? <img src="images/arrow-dwn.png" alt="arrow"></a>
					<div class="content">
						<ul>
							<li><span>Visit <a href="https://www.thakur-foundation.org/" target="_blank">https://www.thakur-foundation.org/</a> and click on the “LOGIN/SIGN UP” button located at the top right corner.</span></li>
							<li><span>Enter the administrator’s login credentials and click on the “SIGN IN” button.</span></li>
							<li><span>This will open the Admin Dashboard.</span></li>
						</ul>
						<img src="images/faq-1.jpg" alt="Screenshot 1">
						<img src="images/faq-2.jpg" alt="Screenshot 2">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 2. How can I run a Grants and Expenses query? <img src="images/arrow-dwn.png" alt="arrow"></a>
					<div class="content">
						<ul>
							<li><span>Visit <a href="https://www.thakur-foundation.org/" target="_blank">https://www.thakur-foundation.org/</a> and enter your login credentials. This will open the Admin Dashboard.</span></li>
							<li><span>Select “Year” from the dropdown.</span></li>
							<li><span>Select the “Area” of grant from the drop-down.</span></li>
							<li><span>Select the type of query and hit “Download”.</span></li>
						</ul>
						<p>You can select from a list of six queries calling data as per the “Year”, the grant “Area” from the respective drop-down menus.</p>
						<img src="images/faq-3.jpg" alt="Screenshot 3">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 3. Definitions of Query reports <img src="images/arrow-dwn.png" alt="arrow"></a>
					<div class="content">
					  <ul>
							<li><span><strong>What is Committed Grants Amount?</strong></span></li>
							<span> This is the “Approved Grant Amount”. The report contains the total grant amount approved against each application ID. </span>
							<li><span><strong>What is Committed Expense Amount?</strong></span></li>
							<span>This is the “Approved Expense Amount”. The report contains the expense reimbursement amount approved against each application ID.</span>
							<li><span><strong>What is Committed Total Amount?</strong></span></li>
							<span>This report contains the sum of Approved Grant Amount and Approved Expense Amount against each application ID.</span>
							<li><span><strong>What is Dispensed Grants Amount?</strong></span></li>
							<span>This is the sum of dispensed grant amounts. Grants are essentially paid in three tranches viz.</span>
							<ul>
								<li><span>First Tranche.</span></li>
								<li><span>Interim Tranche.</span></li>
								<li><span>Final Tranche.</span></li>
							</ul>
							<span>In certain circumstances, not all tranches will be paid. Hence the report will derive the actual dispensed grant amount i.e. the amount which is the sum of First tranche and/or Interim Tranche and/or Final Tranche against each application ID.</span>
							<li><span><strong>What is Dispensed Expense Amount?</strong></span></li>
							<span>This is the sum of dispensed expense amounts. Expenses are essentially reimbursed in two tranches viz.</span>
							<ul>
								<li><span>First Tranche.</span></li>
								<li><span>Final Tranche.</span></li>
							</ul>
							<span>In certain circumstances, not all tranches will be paid. Hence the report will derive the actual dispensed expense amount i.e. the amount which is the sum of First tranche and/or Final Tranche against each application ID.</span>
							<li><span><strong>What is Dispensed Total Amount?</strong></span></li>
							<span>This report contains the sum of Dispensed Grant amount and Dispensed Expense amount.</span>
							<span>This is the total of First Grant Tranche + Interim Grant Tranche + Final Grant Tranche payments and the total of First Expense Tranche + Final Expense Tranche reimbursements.</span>
							<li><span><strong>What is Application Reviewer? </strong></span></li>
							<span>This report  lists individual grant applications assigned to individual advisory board members.</span>
						</ul>
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 4. How can I add an Advisory Board Member?  <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>Login to the Admin Dashboard on the Thakur Foundation website, click on the “+ Advisory Board Member” button.</span></li>
							<li><span>There you must fill in the Advisory Board Member details and hit the “Save” button.</span></li>
							<li><span>The registered name will be visible in the “List of advisory board members” table below.</span></li>
						</ul>
						<img src="images/faq-4.jpg" alt="Screenshot 4">
						<img src="images/faq-5.jpg" alt="Screenshot 5">
						<img src="images/faq-6.jpg" alt="Screenshot 6">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 5. How can I edit Advisory Board members’ information? <img src="images/arrow-dwn.png" alt="arrow"></a>
					<div class="content">
						<ul>
							<li><span>Login to the Admin Dashboard on Thakur Foundation website, click on the “+ Advisory Board Member” button.</span></li>
							<li><span>Scroll down to find the list of advisory board members. <br> <strong>Note</strong>: The list is displayed only when there is more than one entry of advisory board member.</span></li>
							<li><span>Click on the ‘Edit’ button to make changes. <br> <strong>Note</strong>: The email address cannot be edited.</span></li>
						</ul>
						<img src="images/faq-7.jpg" alt="Screenshot 7">
						<img src="images/faq-8.jpg" alt="Screenshot 8">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 6. How can I delete an advisory board member entry? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>Login to the Admin Dashboard on Thakur Foundation website, click on the “+ Advisory Board Member” button.</span></li>
							<li><span>Scroll down to find the list of advisory board members. <br> <strong>Note</strong>: The list is displayed only when there is more than one entry of advisory board member.</span></li>
							<li><span>Click on the “Delete” button. This will delete the advisory board member entry.</span></li>
						</ul>
						<img src="images/faq-9.jpg" alt="Screenshot 9">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 7. How can I view grant applications basis grant statuses? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>Visit <a href="http://onlinereviews.org.uk/thakur-foundation/thakurfoundation/admin-dashboard.php" target="_blank">http://onlinereviews.org.uk/thakur-foundation/thakurfoundation/admin-dashboard.php</a> and click on the “Grant Status” drop-down.</span></li>
							<li><span>Select any grant status and click on “Search” button.</span></li>
							<li><span>A list of all applicants with that particular grant status will be displayed.</span></li>
							<li><span>In case you want to see a list of all applications across all grant statuses, select All from “Grant Status” drop-down menu.</span></li>
						</ul>
						<img src="images/faq-10.jpg" alt="Screenshot 10">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 8. How can I filter applications based on Grant Type? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>Visit <a href="http://onlinereviews.org.uk/thakur-foundation/thakurfoundation/admin-dashboard.php" target="_blank">http://onlinereviews.org.uk/thakur-foundation/thakurfoundation/admin-dashboard.php</a> and click on the “Grant Type” drop-down.</span></li>
							<li><span>Select a grant type and click on the “Search” button.</span></li>
							<li><span>A list of all applicants who have applied for that grant type will be displayed.</span></li>
							<li><span>In case you want a list of all applications across all grant types, select All from the “Grant Type” drop-down menu.</span></li>
						</ul>
						<img src="images/faq-11.jpg" alt="Screenshot 11">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 9. How can I delete Statutory Documents uploaded by the applicant for Grant Approval? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>Login to the Admin Dashboard on Thakur Foundation website, click on the “Application ID” button of the applicant.</span></li>
							<li><span>In the “Application Information” tab of Grant &amp; Applicant details page, you can scroll down to the bottom left corner where you will see all the Statutory Documents uploaded by that applicantion ID.</span></li>
							<li><span>Select “X” beside the file name, enter the reason for deleting the document and click submit.</span></li>
						</ul>
						<img src="images/faq-12.jpg" alt="Screenshot 12">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 10. How can I edit/assign a grant status to an applicant? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>Login to the Admin Dashboard on the Thakur Foundation website, click on the “Edit” button in the admin dashboard.</span></li>
							<li><span>This will open the Grant Applicant Information page.</span></li>
							<li><span>From this page you can edit the applicant’s grant status and enter the Grant payment and Expense reimbursement amount.</span></li>
						</ul>
						<img src="images/faq-13.jpg" alt="Screenshot 13">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 11. How will I assign applications to the advisory board members? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>You will have to click on “Assign Advisor” button after logging in to admin dashboard which will open a small window where the list of registered advisory board members will be displayed.</span></li>
							<li><span>You will then select the names of the advisory board members and click submit.</span></li>
						</ul>
						<img src="images/faq-14.jpg" alt="Screenshot 14">
						<img src="images/faq-15.jpg" alt="Screenshot 15">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 12. How will I track applications assigned to advisory board members? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>From the uppermost line, you will have to select the “Year” and “Area” of the grant and in the “Query” drop-down menu select “Application Reviewer”.</span></li>
							<li><span>An MS Excel report will be downloaded containing the details of the applications assigned to advisory board members.</span></li>
						</ul>
						<img src="images/faq-16.jpg" alt="Screenshot 16">
					</div>
				  </div>
				</div>
			</div>
			<div id="user" class="tabcontent">
				<span class="heading">Visitor / Applicant FAQs</span>
			  <div class="accordion-container">
				  <div class="set">
					<a href="#"> 1. Who can apply for grants? <img src="images/arrow-dwn.png" alt="arrow"></a>
					<div class="content">
						<ul>
							<li><span>Writers, print &amp; broadcast journalists, documentary filmmakers, activists, organizations and other individuals with an interest in the areas of Public health/ Right to Information/ Civil Liberties/ Evidence-based Science can apply for grants. The aim of such grants is to engage, inform, create a debate, and to inform policy making and its implementation.</span></li>
						</ul>
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 2. How do I register myself and login on the Thakur Family Foundation website? <img src="images/arrow-dwn.png" alt="arrow"></a>
					<div class="content">
						<ul>
							<li><span>SIGN UP:</span></li>
							<ul>
								<li><span>Visit <a href="https://www.thakur-foundation.org/" target="_blank">https://www.thakur-foundation.org/</a> and click on the “LOGIN/SIGN UP” button located at the top right corner.</span></li>
								<li><span>Enter your  First Name, Last Name, Email address, and your Contact No. starting with (+) sign and your country code. Next, enter  a password that you would like to use when accessing the content on our website.</span></li>
								<li><span>Click on “SIGN UP” button.</span></li>
								<li><span>You will receive an email confirming your registration on the website at the email address provided.</span></li>
							</ul>
							<img src="images/faq-19.jpg" alt="Screenshot 19">
							<li><span>LOGIN:</span></li>
							<ul>
								<li><span>Visit <a href="https://www.thakur-foundation.org/" target="_blank">https://www.thakur-foundation.org/</a> and click on the “LOGIN/SIGN UP” button located at the top right corner.</span></li>
								<li><span>Enter your your Email ID and Password when prompted.</span></li>
								<li><span>Click on the “LOGIN” button.</span></li>
							</ul>
							<img src="images/faq-20.jpg" alt="Screenshot 20">
						</ul>
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 3. How can I apply for grants?  <img src="images/arrow-dwn.png" alt="arrow"></a>
					<div class="content">
					  <ul>
							<li><span>You can visit <a href="http://onlinereviews.org.uk/thakur-foundation/thakurfoundation/grant.php" target="_blank">http://onlinereviews.org.uk/thakur-foundation/thakurfoundation/grant.php</a> and apply for a grant in your area of interest. You must complete all the fields and upload relevant documents in order to complete your application.</span></li>
							<li><span>If you are unable to fill the form in one go, you can save your partially filled application by clicking on “Save for later”.</span></li>
							<li><span><strong>You can always come back later and edit the application by following these steps:</strong></span></li>
							<ul>
								<li><span>Visit <a href="https://www.thakur-foundation.org/" target="_blank">https://www.thakur-foundation.org/</a> and sign in using your account credentials.</span></li>
								<li><span>On the top right corner below the LOGOUT button, click on the menu and select “My Account”. This will open your personal Dashboard.</span></li>
								<li><span>Now locate your application ID and on the sixth column click on the “Application details” button. This will open the partially filled form.</span></li>
								<li><span>From here, you can edit and/or add any information pertaining to your grant application.</span></li>
								<li><span>Once you have filled the entire application, and uploaded all the necessary documents, click on the “Submit” button.</span></li>
							</ul>
							<li><span><strong>IMPORTANT:</strong> You cannot edit your application after submitting it.</span></li>
						</ul>
						<img src="images/faq-21.jpg" alt="Screenshot 21">
						<img src="images/faq-22.jpg" alt="Screenshot 22">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 4. What documents should I upload? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>Upload Resume.</span></li>
							<ul>
								<li><span>You need to upload a single Pdf/Doc/Docx file of your resume up to size 2 MB.</span></li>
							</ul>
							<li><span>Upload Portfolio, Documents.</span></li>
							<ul>
								<li><span>You can upload multiple Pdf/Mp4/Mp3/Flv files pertaining to your application totalling up to 25 MB.</span></li>
							</ul>
						</ul>
						<img src="images/faq-23.jpg" alt="Screenshot 23">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 5. How can I add/delete/replace files from my application? <img src="images/arrow-dwn.png" alt="arrow"></a>
					<div class="content">
						<ul>
							<li><span>If you have already ‘Submitted’ your application, you cannot make changes to it.</span></li>
							<li><span>However, if you have saved a partially filled application, to do any of the above please follow these steps:</span></li>
							<ul>
								<li><span>Visit <a href="https://www.thakur-foundation.org/" target="_blank">https://www.thakur-foundation.org/</a> and sign in using your account credentials.</span></li>
								<li><span>On the top right corner below the LOGOUT button, click on the menu and select “My Account”. This will open your personal dashboard.</span></li>
								<li><span>Now locate your application ID, and on the sixth column click on the “Application details” button. This will open the partially filled form.</span></li>
								<li><span>From here you can add, delete, and replace files within the specified limits.</span></li>
								<ul>
									<li><span>A single Pdf/Doc/Docx file of your resume up to size 2 MB only.</span></li>
									<li><span>Multiple Pdf/Mp4/Mp3/Flv files pertaining to your portfolio totalling up to 25 MB only.</span></li>
								</ul>
								<li><span>From here you can add, delete, and replace files within the specified limits.</span></li>
							</ul>
						</ul>
						<img src="images/faq-24.jpg" alt="Screenshot 24">
						<img src="images/faq-25.jpg" alt="Screenshot 25">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 6. How can I check the status of my application at any stage? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>You can check the status of your application in one of two ways.</span></li>
							<ul>
								<li><span>Email from Thakur Foundation.</span></li>
								<ul>
									<li><span>You can look out for email messages sent to you by Thakur Foundation on your registered email address.</span></li>
								</ul>
								<li><span>Via the Application Dashboard by following these steps.</span></li>
								<ul>
									<li><span><a href="https://www.thakur-foundation.org/" target="_blank">https://www.thakur-foundation.org/</a> and sign in using your account credentials.</span></li>
									<li><span>On the top right corner below the LOGOUT button, click on the menu and select “My Account”. This will open your Dashboard.</span></li>
									<li><span>Now locate your application ID and on the fifth column you can check the status of your grant application.</span></li>
								</ul>
							</ul>
						</ul>
						<img src="images/faq-26.jpg" alt="Screenshot 26">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 7. How can I edit my grant application after submission? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>You will not be able to make changes after submitting the grant application. However, you can make another fresh application for the same grant by filling up and submitting the Grant Application form again. </span></li>
							<li><span>But please remember to contact us asking to delete your earlier application from our system. Otherwise, there may be more than one application for the same grant from you and the one you intend for us to process may not be the one getting processed.</span></li>
							<li><span>To delete your application from our system, you can write to us at information@thakur-foundation.org.</span></li>
							<li><span>Please use this email subject line with your application ID clearly called out: “Please delete application ID GT****. </span></li>
						</ul>
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 8. Where can I check my application after submitting it? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>You can check the status of your completed application by following these steps:</span></li>
							<ul>
								<li><span><a href="https://www.thakur-foundation.org/" target="_blank">https://www.thakur-foundation.org/</a> and sign in using your account credentials.</span></li>
								<li><span>On the top right corner below the LOGOUT button, click on the menu and select “My Account”. This will open the Applicant Dashboard.</span></li>
								<li><span>Now locate your application ID and, on the sixth column click on the “Application details” button. This will open Application &amp; Grant details page.</span></li>
								<li><span>Here you can check the details of your application in the “<strong>Application Information</strong>” tab and the Grant payments and Expense reimbursements in the “<strong>Grant Information</strong>” tab.</span></li>
							</ul>
						</ul>
						<img src="images/faq-27.jpg" alt="Screenshot 27">
						<img src="images/faq-28.jpg" alt="Screenshot 28">
						<img src="images/faq-29.jpg" alt="Screenshot 29">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 9. What if I forget to upload some documents after submission? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>You will not be able to make changes after submitting the grant application. However, you can make another fresh application for the same grant by filling up and submitting the Grant Application form again. </span></li>
							<li><span>But please remember to contact us asking to delete your earlier application from our system. Otherwise, there may be more than one application from you and the one you intend us to process may not be the one getting processed.</span></li>
							<li><span>To delete your application from our system, you can write to us at <a href="mailto:information@thakur-foundation.org" target="_blank">information@thakur-foundation.org</a>.</span></li>
							<li><span>Please use this email subject line with your application ID clearly called out: “Please delete application ID GT****.</span></li>
							<li><span>You will not be able to make changes after submitting the grant application. However, you can reapply for the grant by filling up and submitting the Grant Application form and please remember to contact us asking to delete the unwanted application. You can write to us at: <a href="mailto:information@thakur-foundation.org" target="_blank">information@thakur-foundation.org</a>.</span></li>
							<li><span>Kindly use this email subject line: “Please delete application ID GT****.</span></li>
						</ul>
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 10. What documents should I upload in the “Statutory documents for grant approval” column in the applicant dashboard? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>While filling in your application, you will notice a link to the The list of documents to be uploaded in the “Statutory documents for grant application” column is mentioned in at the bottom of the Grant Application form beside the “Save for later and “Submit” button.</span></li>
							<li><span>If you haven’t yet done so, You you can also download the below mentioned documents from here. The following is a list of the documents.</span></li>
							<li><span>Legal and Contractual documents required for Investigative Grants in Public Health from Thakur Foundation.</span></li>
							<ul>
								<li><span>Services Contract.</span></li>
								<ul>
									<li><span>TFF - Investigative Grants in Public Health - AGREEMENT FOR SERVICES.pdf</span></li>
								</ul>
								<li><span>Grant making policies for Public Health.</span></li>
								<ul>
									<li><span>International Grant-Making Policy.pdf</span></li>
									<li><span>Affidavit packet for Non-US Grant Applicants. Pdf</span></li>
									<li><span>Grant-making Affidavit.pdf</span></li>
									<li><span>Grant-making Affidavit Update.pdf</span></li>
									<li><span>Investigative Reporting Grant Policy.pdf</span></li>
								</ul>
							</ul>
						</ul>
						<img src="images/faq-30.jpg" alt="Screenshot 30">
						<img src="images/faq-31.jpg" alt="Screenshot 31">
						<img src="images/faq-32.jpg" alt="Screenshot 32">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 11. How can I report ‘Change of address’ after I have submitted my application? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>You can reach us in one of the following ways:</span></li>
							<ul>
								<li><span><strong>Via email:</strong> For any issues/or queries, please write to us at: <a href="mailto:nformation@thakur-foundation.org" target="_blank">information@thakur-foundation.org</a></span></li>
								<li><span>Submitting your issue directly via the Thakur Foundation website: In tHow can I report ‘Change of address’ after I have submitted my application?his case, you will have to enter your First name, Last name, contact no., email address and describe your concern.</span></li>
							</ul>
						</ul>
						<img src="images/faq-33.jpg" alt="Screenshot 33">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 12. How can I view my applications in ascending or descending order? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>On your dashboard, You you need to click on the “Sort by date” drop-down in the applicant dashboard. There are 2 options in this drop-down viz:</span></li>
							<ul>
								<li><span>Newest to Oldest- To show the latest application on top.</span></li>
								<li><span>Oldest to Newest- To show the oldest applications on top.</span></li>
							</ul>
						</ul>
						<img src="images/faq-34.jpg" alt="Screenshot 34">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 13. How do I convert my Doc/Docx file into a Pdf file? <img src="images/arrow-dwn.png" alt="arrow"> </a>
					<div class="content">
						<ul>
							<li><span>Open the Doc/Docx file in Microsoft Word.</span></li>
							<li><span>Click on the File tab in the top left corner.</span></li>
							<li><span>Click on “Save As” and from the “Save as” dropdown select Pdf.</span></li>
							<li><span>Click “Save”.</span></li>
						</ul>
					</div>
				  </div>
				</div> 
			</div>
			<div id="advisory" class="tabcontent">
				<span class="heading">Advisory Board FAQs</span>
			  <div class="accordion-container">
				  <div class="set">
					<a href="#"> 1. How do I register myself on the Thakur Family Foundation website? <img src="images/arrow-dwn.png" alt="arrow"></a>
					<div class="content">
						<ul>
							<li><span>The administrator will create your account and the login credentials will be sent to your registered email address.</span></li>
							<li><span>Visit <a href="https://www.thakur-foundation.org/" target="_blank">https://www.thakur-foundation.org/</a> and click on the “LOGIN/SIGN UP” button located on the top right corner.</span></li>
							<li><span>Enter your details and click on “LOG IN” button.</span></li>
						</ul>
						<img src="images/faq-17.jpg" alt="Screenshot 17">
					</div>
				  </div>
				  <div class="set">
					<a href="#"> 2. How do I check the grant application assigned to me by the admininstrator? <img src="images/arrow-dwn.png" alt="arrow"></a>
					<div class="content">
						<ul>
							<li><span>For every application that you need to review, you will receive a personalized email message on your registered email address from Thakur Family Foundation.</span></li>
							<li><span>Open the email and click on the Grant Application ID mentioned therein.</span></li>
							<li><span>This will open the Grant &amp; Applicant details page containing information about the applicant including all documents uploaded by the applicant.</span></li>
							<li><span>In case you are not logged in, you will be directed to the homepage where you will have to login using your login credentials.</span></li>
							<li><span>After signing in, come back to the email from Thakur family Foundation and click on the grant application ID. This will open the Grant &amp; Applicant details page containing information about the applicant.</span></li>
						</ul>
						<img src="images/faq-18.jpg" alt="Screenshot 18">
					</div>
				  </div>
				</div>
			</div>
			
		</div>
	<?php } ?>
	</div>
</section>

<script>
$(document).ready(function() {
  $(".set > a").on("click", function() {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(this)
        .siblings(".content")
        .slideUp(200);
      $(".set > a i")
        .removeClass("fa-minus")
        .addClass("fa-plus");
		return false;
    } else {
      $(".set > a i")
        .removeClass("fa-minus")
        .addClass("fa-plus");
      $(this)
        .find("i")
        .removeClass("fa-plus")
        .addClass("fa-minus");
      $(".set > a").removeClass("active");
      $(this).addClass("active");
      $(".content").slideUp(200);
      $(this)
        .siblings(".content")
        .slideDown(200);
		return false;
    }
  });
});

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

</script>




<?php  include('footer.php');?>