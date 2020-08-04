<?php
session_start();
include('config.php');
include('admin-header.php');
$user_id = '';
$admin = '';
if(isset($_SESSION['user_id'])){
$user_id=$_SESSION['user_id'];
}else{

$user_id='';


}
if(isset($_SESSION['admin'])){
  $admin = $_SESSION['admin'];

if($admin == 0 || $admin != 1)
{
  echo "<script type='text/javascript'>window.location='https://www.thakur-foundation.org/index.php';</script>";
}
}else
{
	echo "<script type='text/javascript'>window.location='https://www.thakur-foundation.org/index.php';</script>";
}

$limit =10;

$where_condition=[];

if(isset($_POST['search'])){
//echo"<pre>";print_r($_POST);die;
if(!empty($_POST['app_id'])){

	$app_id=$_POST['app_id'];
	$inserted =["g.application_id='". $app_id."'"];
	$where_condition = array_merge($where_condition,$inserted);
}
if(!empty($_POST['grant_type'])){
	//print_r("hoo");
	$granttype=$_POST['grant_type'];

	if($granttype == 'all')
	{
		$getTypeId = "SELECT id from area_of_interest";
		$result = mysqli_query($con, $getTypeId);
		while($getId[]=$result->fetch_assoc())

			$finalArray = array_column($getId, 'id');
			$finalArray = implode(",",$finalArray);

		$inserted =["g.interest IN (".$finalArray.")"];

	}
	else
	{
		$inserted =["g.interest='".$granttype."'"];
	}
	$where_condition = array_merge($where_condition,$inserted);
}
if(!empty($_POST['grant_status'])){

	$grantstatus=$_POST['grant_status'];
	if($grantstatus == 'all')
	{
		$getStatusId = "SELECT id from grant_status";
		$result = mysqli_query($con, $getStatusId);
		while($getId[]=$result->fetch_assoc())

			$finalArray = array_column($getId, 'id');
			$finalArray = implode(",",$finalArray);

		$inserted =["ad.grant_status IN (".$finalArray.")"];

	}
	else
	{
		$inserted =["ad.grant_status='".$grantstatus."'"];
	}

	$where_condition = array_merge($where_condition,$inserted);

}
if(!empty($_POST['start_date'])){

	$start_date=$_POST['start_date'];
	$inserted =["g.created_date >='".$start_date."'"];
	$where_condition = array_merge($where_condition,$inserted);

}
if(!empty($_POST['end_date'])){

	$end_date=$_POST['end_date'];
	$inserted =["g.created_date <='".$end_date."'"];
	$where_condition = array_merge($where_condition,$inserted);

}

$data = implode(" and ", $where_condition);

if (isset($_GET["page"])) {  $page  =(int)$_GET["page"]; } else { $page=1; }
	$start_from = ($page-1) * $limit;
	if(!empty($data))
	{
		$sql = "SELECT g.id as id,g.application_id as application_id ,a.area_of_interest as grant_type,gs.name as grant_status,g.created_date as created_date,ur.name as username,ur.lastname as lname from grants_applicants g INNER JOIN user_register ur on ur.id=g.user_id INNER JOIN area_of_interest a on g.interest=a.id INNER JOIN admin ad on g.application_id=ad.application_id INNER JOIN grant_status gs on ad.grant_status=gs.id where g.complete='1' and $data ORDER BY g.id DESC LIMIT $start_from, $limit";

	}
	else
	{
		$sql = "SELECT g.id as id,g.application_id as application_id ,a.area_of_interest as grant_type,gs.name as grant_status,g.created_date as created_date,ur.name as username,ur.lastname as lname from grants_applicants g INNER JOIN user_register ur on ur.id=g.user_id INNER JOIN area_of_interest a on g.interest=a.id INNER JOIN admin ad on g.application_id=ad.application_id INNER JOIN grant_status gs on ad.grant_status=gs.id where g.complete='1' ORDER BY g.id DESC LIMIT $start_from, $limit";
	}

	$rs_result = mysqli_query($con, $sql);
	//echo "<pre>";print_r($rs_result);die;
}
else
{
	if (isset($_GET["page"])) {  $page  =(int)$_GET["page"]; } else { $page=1; }
	$start_from = ($page-1) * $limit;
	$sql = "SELECT g.id as id,g.application_id as application_id ,a.area_of_interest as grant_type,gs.name as grant_status,g.created_date as created_date,ur.name as username,ur.lastname as lname from grants_applicants g INNER JOIN user_register ur on ur.id=g.user_id INNER JOIN area_of_interest a on g.interest=a.id INNER JOIN admin ad on g.application_id=ad.application_id INNER JOIN grant_status gs on ad.grant_status=gs.id where g.complete='1' ORDER BY g.id DESC LIMIT $start_from, $limit";

	$rs_result = mysqli_query($con, $sql);
}

?>
<div id="appdashbrd">
<link rel="stylesheet" href="css/pikaday.css">
<link rel="stylesheet" type="text/css" href="css/admin-dashboard.css" />
<div class="main-container">
	<!-- <header id="header">
		<div class="">
			<div class="logo">
				<a href="#"><img src="img/logo.png" alt=""></a>
			</div>
		</div>
	</header> -->
	<section class="cntarea admin-dash">
		<div class="topheader">
			<h1>Admin Dashboard
			<div class="dwnld">
				<form action="search1.php" method="post" id="export-form">
				<p class="select-container">
					<select name="year" id="year">
					<option value="" style="display: none;">Year </option>
					<?php
					$sqlyear = "select distinct(DATE_FORMAT(created_date,'%Y')) as year from grants_applicants";

					$rs_result_year = mysqli_query($con, $sqlyear);
					if (!empty($rs_result_year) && $rs_result_year->num_rows > 0) {
					while($row = $rs_result_year->fetch_assoc()) {
					//print_r($row);?>
					<option value="<?=$row['year']?>"><?=$row['year']?></option>
					<?php }}?>
					<option value="all">All</option>
				</select></p>
					<p class="select-container">
				<select name="interest" id="interest">
					<option value="" style="display: none;">Area </option>
					<?php
						$sqlinterest = "select * from area_of_interest order by area_of_interest ASC";

						$rs_result_interest = mysqli_query($con, $sqlinterest);
						if (!empty($rs_result_interest) && $rs_result_interest->num_rows > 0) {
						while($row = $rs_result_interest->fetch_assoc()) {
						//print_r($row);?>
						<option value="<?=$row['id']?>"><?=$row['area_of_interest']?></option>

					<?php }}?>
					<option value="all">All</option>
				</select></P>
				<p class="select-container">
				<select name="query" id="query">
					<option value="" style="display: none;">Query </option>
					<option value="1">Committed Grants Amount</option>
					<option value="2">Committed Expense Amount</option>
					<option value="3">Dispensed Grant Amount</option>
					<option value="4">Dispensed Expense Amount</option>
					<option value="5">Committed Total Amount </option>
					<option value="6">Dispensed Total Amount</option>
					<option value="7">Application Reviewer</option>
				</select></p>
				<button class="btn-dwnld sub-botton1" name="" id="export" value="">DOWNLOAD</button>
				</form>
			</div>
				<div class="clear"></div>
			</h1>

			<?php
			$sql1 = "SELECT g.id as id,g.application_id as application_id ,a.area_of_interest as grant_type,gs.name as grant_status,g.created_date as created_date,ur.name as username,ur.lastname as lname from grants_applicants g INNER JOIN user_register ur on ur.id=g.user_id INNER JOIN area_of_interest a on g.interest=a.id INNER JOIN admin ad on g.application_id=ad.application_id INNER JOIN grant_status gs on ad.grant_status=gs.id where g.complete='1' ORDER BY g.id DESC" ;
			$rs_result1 = mysqli_query($con, $sql1);
			$total_pages = $rs_result1->num_rows;

			if(!empty($data))
			{
				$mysql = "SELECT g.id as id,g.application_id as application_id ,a.area_of_interest as grant_type,gs.name as grant_status,g.created_date as created_date,ur.name as username,ur.lastname as lname from grants_applicants g INNER JOIN user_register ur on ur.id=g.user_id INNER JOIN area_of_interest a on g.interest=a.id INNER JOIN admin ad on g.application_id=ad.application_id INNER JOIN grant_status gs on ad.grant_status=gs.id where g.complete='1' and $data ORDER BY g.id DESC";
				$rs_result1 = mysqli_query($con, $mysql);
				$total_pages = $rs_result1->num_rows;

			}
			//print_r($total_pages);die;
			$total_pages = ceil($total_pages / $limit);

			?>

			<div class="pagination">
				<a href="javascript:void(0)" onclick='queryBuilder(1);'></a>
				<?php for ($i=1; $i<=$total_pages; $i++)
				{
					echo "<a id='p_$i' class='pg' href='javascript:void(0)' name='paginate' onclick='queryBuilder($i);'>".$i."</a>";
				}; ?>
				<a href="javascript:void(0)" onclick="queryBuilder(<?php echo $total_pages?>);" ></a>
			</div>
		</div>
		<div class="btm-header">
			<div><a class="btn" href="http://www.thakur-foundation.org/add-advisory-board.php"><img src="images/plus.png"> Advisory Board Member</a></div>
			<div>
				<form name="form-search" id="searchall" method="post" action="#">
					<input type="text" name="app_id" id="app_id" class="" value="<?php if(!empty($app_id)){ echo $app_id; } ?>" Placeholder="Search by ID">
					<!-- <input type="text" name="" value="" placeholder="Search by ID" id="app_id"> -->
				<p class="select-container">
					<select name="grant_status" id="grant_status">
						<option value="" style="display: none">Grant Status </option>
						<?php
							$sqlgstatus = "select *  from grant_status where is_active=1 order by name ASC";

							$rs_result_sqlgstatus = mysqli_query($con, $sqlgstatus);
							if (!empty($rs_result_sqlgstatus) && $rs_result_sqlgstatus->num_rows > 0) {
							while($row = $rs_result_sqlgstatus->fetch_assoc()) {
							//print_r($row);
								if(!empty($grantstatus))
								{
									if($grantstatus == $row['id'])
									{?>
										<option value="<?=$row['id']?>" selected><?=$row['name']?></option>
									<?php }
									else
									{ ?>
										<option value="<?=$row['id']?>"><?=$row['name']?></option>
									<?php }
								}
								else
								{ ?>
									<option value="<?=$row['id']?>"><?=$row['name']?></option>
							<?php	}
							?>


						<?php }}?>
						<?php if($grantstatus == 'all')
						{?>
							<option value="all" selected>All</option>
						<?php }else{ ?>
						<option value="all">All</option>
						<?php } ?>
					</select>
				</p>
					<p class="select-container">
					<select name="grant_type" id="grant_type">
						<option value="" style="display: none;">Grant Type </option>
						<?php
						$typeinterest = "select * from area_of_interest where is_active=1 ORDER BY area_of_interest ASC";

						$rs_result_typeinterest = mysqli_query($con, $typeinterest);
						if (!empty($rs_result_typeinterest) && $rs_result_typeinterest->num_rows > 0) {
						while($rows = $rs_result_typeinterest->fetch_assoc()) {

							if(!empty($granttype))
								{
									if($granttype == $rows['id'])
									{?>
										<option value="<?=$rows['id']?>" selected><?=$rows['area_of_interest']?></option>
									<?php }
									else
									{ ?>
										<option value="<?=$rows['id']?>"><?=$rows['area_of_interest']?></option>
									<?php }
								}
								else
								{ ?>
									<option value="<?=$rows['id']?>"><?=$rows['area_of_interest']?></option>
							<?php	}
							?>


							<?php }}?>
							<?php if($granttype == 'all')
						{?>
							<option value="all" selected>All</option>
						<?php }else{ ?>
						<option value="all">All</option>
						<?php } ?>
					</select></p>
					<input type="text" name="start_date" placeholder="Start date" id="start" class="dtepick minw" >
					<input type="text" name="end_date" placeholder="Last date" id="end" class="dtepick minw" >
					<input type="submit" class="btn-search sub-botton1" value="search" id="search" name="search">
					<!-- <button class="btn-search sub-botton1" name="search" value="">SEARCH</button> -->
				</form>
			</div>
			<div class="clear"></div>
		</div>


		<div class="datatbl">
			<div class="table">
			<!-- top row  -->
			<div class="tr tphead">

					<div class="td dte">Date</div>
					<div class="td appid">Application ID</div>
					<div class="td fname">First name</div>
					<div class="td lname">Last name</div>
					<div class="td grntyp">Grant type</div>
					<div class="td grantsts">Grant status</div>
					<div class="td edit">Edit Grant <br>Information</div>
					<div class="td email">Email <br>Application</div>
			</div>
			<!-- top row end -->
			<!-- tr  -->
				<div id="paginate">
					<?php if (!empty($rs_result) && $rs_result->num_rows > 0) {
						$count=1;
						while($row = $rs_result->fetch_assoc()) {

							$application_id=$row['application_id'];
							?>
						<div class="tr">

							<div class="td dte"><?php echo date('Y-m-d',strtotime($row['created_date']));?></div>
							<div class="td appid"><a href="https://www.thakur-foundation.org/grantapplicantdetails.php?token=<?php echo base64_encode($row['application_id']);?>" target="_blank"><?php echo $row['application_id']?></a></div>

							<div class="td fname"><?php echo $row['username']; ?></div>
							<div class="td lname"><?php echo $row['lname']; ?></div>
							<div class="td grntyp"><?php echo $row['grant_type']; ?></div>
							<div class="td grantsts"><?php echo $row['grant_status']; ?></div>
							<div class="td edit"><a href="https://www.thakur-foundation.org/form.php?appl_id=<?php echo base64_encode($row['application_id'])?>" target="_blank" class="btn"><span><img src="images/edit-pencil.png"></span>Edit</a></div>
							<div class="td email"><div class="td upfnl"><a href="#" class="btn up_fnlOut_open" data-fname="<?php echo $row['username'];?>" data-lname="<?php echo $row['lname'];?>" data-grandtype="<?php echo $row['grant_type']; ?>" data-id="<?php echo $row['application_id']?>"><span><img src="images/email.png"></span><!--Email-->Assign Advisor</a></div></div>
						</div>
						<?php $count++;} }else{

							echo "No records found";


						}?>

						<input type="hidden" id="pageno" name="pageno" value="1" />
						<input type="hidden" id="sortText" name="sortText" value="DESC" />
				</div>
				<!-- tr end -->
				<!-- tr  -->
			</div>
			<!-- tr end -->
		</div>
	</div>

	</section>



<div id="up_fnlOut"  class="well dshpbg dshpbg1">
	<div class="dsh-title">Select Advisory Board members </div>
	<span class="cls_btn up_fnlOut_close"></span>
	<div class="fileup fileup-advbrd">
		<form name="assignadvisory" id="assignadvisory" method="post" action="javascript:void(0)">
		 <?php /*
				$sqladvisory = "select *  from user_register where role=2 and deleted='0' ";

							$rs_result_sqladvisory = mysqli_query($con, $sqladvisory);
							if (!empty($rs_result_sqladvisory) && $rs_result_sqladvisory->num_rows > 0) {
									while($rows = $rs_result_sqladvisory->fetch_assoc()) {

										*/?>
										<?php
				$sqladvisory = "select * from user_register where role=2 and deleted='0' ";

							$rs_result_sqladvisory = mysqli_query($con, $sqladvisory);
							if (!empty($rs_result_sqladvisory) && $rs_result_sqladvisory->num_rows > 0) {
									while($rows = $rs_result_sqladvisory->fetch_assoc()) {

										?>
				<div class="advboard">

				<input type="text" name="advisory_name[]" value="<?php echo $rows['name'].' '.$rows['lastname']?>">
				<input type="checkbox" name="advisory_id[]" value="<?=$rows['id']?>" >
				<input type="hidden" class="appid" name="aapid"  value="">
				<input type="hidden" class="userid" value="<?=$user_id?>" name="user_id">

				<input type="hidden" class="fname" value="" name="fname">
				<input type="hidden" class="lname" value="" name="lname">
				<input type="hidden" class="grandtype" value="" name="grandtype">
				<div class="clear"></div>
			</div>
			<?php 	}} ?>
			<div class="">
				<input type="button" id="cancle" value="CLEAR" class="btn-cancel sub-botton1">
				<input type="submit" value="SUBMIT" class="btn-submit sub-botton1">
			</div>
		</form>
	</div>
</div>


</div>



<!-- <script src="../js/jquery.popupoverlay.min.js" type="text/javascript"></script> -->
<script src="js/moment.min.js"></script>
<script src="js/pikaday.js"></script>

<script type="text/javascript">
// var picker = new Pikaday({
//         field: document.getElementById('start'),
//         format: 'D MMM YYYY',
//         onSelect: function() {
//             console.log(this.getMoment().format('Do MMMM YYYY'));
//         }
//     });
	var startDate,
        endDate,
        updateStartDate = function() {
            startPicker.setStartRange(startDate);
            endPicker.setStartRange(startDate);
            endPicker.setMinDate(startDate);
        },
        updateEndDate = function() {
            startPicker.setEndRange(endDate);
            startPicker.setMaxDate(endDate);
            endPicker.setEndRange(endDate);
        },
        startPicker = new Pikaday({
            field: document.getElementById('start'),
						format: 'YYYY-MM-DD',
            minDate: startDate,
            maxDate: new Date(2020, 12, 31),
            onSelect: function() {
                startDate = this.getDate();
                updateStartDate();
            }
        }),
        endPicker = new Pikaday({
            field: document.getElementById('end'),
						format: 'YYYY-MM-DD',
            minDate: startDate,
            maxDate: new Date(2020, 12, 31),
            onSelect: function() {
                endDate = this.getDate();
                updateEndDate();
            }
        }),
        _startDate = startPicker.getDate(),
        _endDate = endPicker.getDate();

        if (_startDate) {
            startDate = _startDate;
            updateStartDate();
        }

        if (_endDate) {
            endDate = _endDate;
            updateEndDate();
        }

</script>


<script src="js/dash-board-app1.js" type="text/javascript"></script>
<?php  include('footer.php');?>

	<!-- <script>

		var picker = new Pikaday(
		{
				field: document.getElementById('datepicker-sdate'),
				firstDay: 1,
				//minDate: new Date(),
				dateFormat: 'Y-m-d',
				maxDate: new Date(2020, 12, 31),
				yearRange: [2000,2020]
		});
		var datepicker1 = new Pikaday({
			 field: document.getElementById('datepicker-ldate')
	 	});

	 	 // $("#datepicker-ldate").datepicker({ dateFormat: 'yy-mm-dd' });
    //     $("#datepicker-sdate").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
    //         var minValue = $(this).val();
    //         minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
    //         minValue.setDate(minValue.getDate()+1);
    //         $("#datepicker-ldate").datepicker( "option", "minDate", minValue );
    //     })

	</script> -->
	<script>

	$("#cancle").on("click", function(){
		$("input:checkbox").prop("checked", false);
	});

	$("#app_id").on('keyup', function(e) {
		var myLength = $(this).val().length;
		//console.log(myLength);
		if(myLength > 4 || myLength == 0)
		{
			$( "#search" ).trigger( "click" );
		//	console.log('submit');
		//$.post( "admin-dashboard.php", $( "#searchall" ).serialize() );
		// $.post("admin-dashboard.php", function(data, status){
		//     //alert("Data: " + data + "\nStatus: " + status);
		//   });
			//$("#searchall").submit();
		}

	});
	$('.up_fnlOut_open').click(function(){

	var appid 	  =	$(this).attr('data-id');
	var fname 	  =	$(this).attr('data-fname');
	var lname 	  =	$(this).attr('data-lname');
	var grandtype = $(this).attr('data-grandtype');

	console.log(fname);
	$('.appid').val(appid);
	$('.fname').val(fname);
	$('.lname').val(lname);
	$('.grandtype').val(grandtype);
})

$("#assignadvisory").on("submit", function(){
	 // var a = $("input[type='checkbox']").length;
	  var a = $('input[type="checkbox"]:checked').length;
	 console.log(a);
	 if(a == 0 ){
	 	alert('Please select checkbox');
	 	return false;
	 }else{
	var formData = new FormData($(this)[0]);
//formData.append('appid', appid);

console.log(formData);
$.ajax({
	type: 'POST',
	url: 'assignadvisory.php',
	cache: false,
	contentType: false,
	processData: false,
	data : formData,
	dataType:'json',
	success: function(result){
		console.log(result);
		alert(result.msg);
		location.reload();


	},
	error: function(err){
		console.log(err);
	}
});
}
});
function queryBuilder(val)
{
	$(".pg").removeClass("active_page");

	$("#p_"+val).addClass("active_page");
	var appid = $('#app_id').val();
	var grantype = $('#grant_type option:selected').val();
	var grantstatus = $('#grant_status option:selected').val();
	var start = $('#start').val();
	var end = $('#end').val();

	var formData = new FormData();
	formData.append('page',val);
	formData.append('app_id',appid);
	formData.append('grant_type',grantype);
	formData.append('grant_status',grantstatus);
	formData.append('start_date',start);
	formData.append('end_date',end);
		//formData.append('sort',sort);
		//alert(userId);
		$.ajax({
			type: 'post',
			url: 'pagination_filter_admindashboard.php',
			cache: false,
			contentType: false,
			processData: false,
			data : formData,
			dataType:'json',
			success: function(result){
			//console.log(result);
			$('#paginate').html('');
			$('#paginate').html(result);

			//alert(result.message);

		},
		error: function(err){
			console.log(err);
		}
	});

	}

$('#export').click(function(){
	// debugger;
var selectedyearvalue=$('#year option:selected').val();
var selectedinterestvalue=$('#interest option:selected').val();
var selectedqueryvalue=$('#query option:selected').val();

if(selectedyearvalue != '' && selectedinterestvalue!= '' && selectedqueryvalue!= '')
{
	$('#export-form').submit();
}
else if(selectedyearvalue == '')
{
	alert('Please select Year ');
	return false;
}
else if(selectedinterestvalue == '')
{
	alert('Please select Area ');
	return false;
}
else if(selectedqueryvalue == '')
{
	alert('Please select Query ');
	return false;
}


});

	</script>


<script>
	$(document).ready(function(){
		$('div .td.edit a').addClass('edit');
	});
</script>

</div>
