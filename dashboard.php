<?php
session_start();
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'] ;
}else{

	$user_id="";
}
include('config.php');
$limit =5;

if (isset($_GET["page"])) {  $page  =(int)$_GET["page"]; } else { $page=1; }
$start_from = ($page-1) * $limit;
if (isset($_GET["sortby"]))
{
	$sortby = $_GET['sortby'];
	$sql = "SELECT  gs.id as grant_id,gs.name as grant_status, ga.*,ur.name as username,ur.lastname as lname,ur.mobile as primarynumber from grants_applicants ga LEFT JOIN user_register ur on ur.id=ga.user_id LEFT JOIN admin a on a.application_id=ga.application_id LEFT JOIN grant_status gs on gs.id=a.grant_status  where ga.user_id=$user_id ORDER BY ga.created_date $sortby  LIMIT $start_from, $limit";

}
else
{
	$sql = "SELECT gs.id as grant_id,  gs.name as grant_status, ga.*,ur.name as username,ur.lastname as lname,ur.mobile as primarynumber from grants_applicants ga LEFT JOIN user_register ur on ur.id=ga.user_id LEFT JOIN admin a on a.application_id=ga.application_id LEFT JOIN grant_status gs on gs.id=a.grant_status where ga.user_id=$user_id ORDER BY ga.created_date DESC  LIMIT $start_from, $limit";

}

$rs_result = mysqli_query($con, $sql);
//echo "<pre>";print_r($sql);die;?>
<div id="appdashbrd">
	<?php include('dasheader.php');?>

	<!-- <link rel="stylesheet" type="text/css" href="css/dashboard-style.css" /> -->
	<link rel="stylesheet" type="text/css" href="css/dashboard-style.css" />
	<div class="main-container" style="padding-top: 170px;">
	<!-- <header id="header">
		<div class="">
			<div class="logo">
				<a href="#"><img src="img/logo.png" alt=""></a>
			</div>
		</div>
	</header> -->
	<section class="cntarea">
		<style>
		.active_page
		{
			background:#db5c55;
			color:white !important;
		}
		option[value=""][selected] {
  display: none;
}
		</style>
		<div class="topheader">
			<h1>Applicant Dashboard</h1>
			<?php
			$sql1 = "SELECT COUNT(id) FROM grants_applicants where user_id =$user_id " ;
			$rs_result1 = mysqli_query($con, $sql1);
			$row1 = mysqli_fetch_row($rs_result1);
			$total_records = $row1[0];
			$total_pages = ceil($total_records / $limit);
			?>

<div class="slctbg sorting">
	<select id="sorting">
		 <option value="" disabled selected hidden>Sort by date</option>
		<option value="DESC">Newest to oldest</option>
		<option value="ASC">Oldest to newest</option>

	</select>
</div>


			<div class="pagination">
				<a href="#" onclick='queryBuilder(1);'></a>
				<?php for ($i=1; $i<=$total_pages; $i++)
				{
					echo "<a id='p_$i' class='pg' href='#' name='paginate' onclick='queryBuilder($i);'>".$i."</a>";
				}; ?>
				<a href="#" onclick="queryBuilder(<?php echo $total_pages?>);" ></a>

				<!--
echo "<a href='applicant-dashboard.php?page=".$i."'>".$i."</a>";
applicant-dashboard.php?page=<?php echo $total_pages?> -->
</div>

<div class="datatbl"  id="target-content">
	<div class="table">
		<!-- top row  -->
		<div class="tr tphead">
			<div class="td dte">Sr.No</div>
			<div class="td dte">Date</div>
			<div class="td appid">Application ID</div>
			<div class="td grntyp">Grant type</div>
			<div class="td grantsts"><center>Grant status</center></div>
			<div class="td appdtl">Applicant Details</div>
			<div class="td uplgrtdoc"><center>Statutory Documents for Grant Approval</center></div>
			<div class="td upfnl"><center>Project Impact Documents</center></div>
		</div>
		<!-- top row end -->
		<!-- tr  -->
		<div id="paginate">
			<?php if (!empty($rs_result) && $rs_result->num_rows > 0) {
				$count=1;
				while($row = $rs_result->fetch_assoc()) { ?>
				<div class="tr">

					<div class="td dte"><?php echo $count;?></div>
					<div class="td dte"><?php echo date('Y-m-d',strtotime($row['created_date'])) ?></div>
					<div class="td appid"><?php echo $row['application_id']?></div>
					<?php 

					$sql11 = "SELECT area_of_interest FROM `area_of_interest` Where id='".$row['interest']."' ";
					$rs_result2 = mysqli_query($con, $sql11);
					while($rows = $rs_result2->fetch_assoc()) {
						$area=$rows['area_of_interest'];

					}
					?>
					<div class="td grntyp"><?php echo $area ?></div>

					<?php 
				
					if($row['incomplete']=='1'){?>
						<div class="td grantsts"><center>NA</center></div>

					<?php }elseif($row['complete']=='1' && !empty($row['grant_status']) && $row['grant_id'] != 1 && $row['grant_id'] != 2){?>
					<div class="td grantsts"><center><?php echo ucfirst($row['grant_status']);?></center></div>
					<?php }else {?>
					<div class="td grantsts"><center>Submitted</center></div><?php }?>

					<?php if($row['incomplete']=='1'){ ?>
					<div class="td appdtl"><center><a href="<?php echo $base_url?>grant-application.php" class="btn">Application details</a></center></div>
					<?php }else{?>
					<div class="td appdtl"><center><a href="<?php echo $base_url?>application-details.php?token=<?php echo  base64_encode($row['application_id']) ?>" class="btn">Application details</a></center></div>
					<?php }?>

					<?php if($row['grant_id'] == 4 || $row['grant_id']== 9){?>
					<div class="td uplgrtdoc"><center><a href="#" class="btn up_grApp_open" data-id="<?php echo $row['application_id']?>"><span><img src="images/upload-icon.png" alt=""></span>Upload docs</a></center></div>
					<?php }else{?>
					<div class="td uplgrtdoc"><span><center>--</center></span></div><?php }?>
					<?php if($row['grant_id']== 9){?>
					<div class="td upfnl"><center><a href="#" class="btn up_fnlOut_open" data-id="<?php echo $row['application_id']?>"><span><img src="images/upload-icon.png" alt=""></span>Upload docs</a></center></div>
					<?php }else{?>
					<div class="td upfnl"><center>--</center></div>


					<?php } ?>
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
	</div>

</section>
<div id="loader" ><img src="https://www.thakur-foundation.org/images/loading-2.gif" /></div>
<div id="up_grApp"  class="well dshpbg">
	<div class="dsh-title">Statutory Documents for Grant Approval</div>
	<span class="cls_btn up_grApp_close"></span>
	<form id="grant_applicants_docs" action="javascript:void(0);" method="post"  data-parsley-validate novalidate>
		<div class="fileup">
			<input type="file" id="portfolio-file" name="portfolio-file[]" class="hde inputfile1"  multiple  data-parsley-required-message="Please select file" accept="application/pdf,audio/*,video/*" required>
			<label id="upload" for="upload"><span>Upload docs </span><b id="uploadedFiles">Select files</b></label>
		</div>
		<br>
		<span style="color:red">Please select Pdf, Mp4, Mp3, Flv files and total size up to 25MB</span>
		<br>
		<table id="portfoliofileList">

		</table>
		<input type="hidden" id="appid" name="appid" value="" />
		<input type="hidden" id="appid" name="grant_doc" value="0" />
		<input type="hidden" id="grant_doc_port" name="grant_doc_port" value="0" />
		<div class="subbtn"><input type="submit" name="submit" id="submitform" value="submit" class="sub-botton1"> </div>
	</form>


</div>

<div id="up_fnlOut"  class="well dshpbg">
	<div class="dsh-title">Project Impact Documents </div>
	<span class="cls_btn up_fnlOut_close"></span>
	<form id="grant_applicants_docs_outcomes" class="grant_applicants_docs_outcomes" action="javascript:void(0);" method="post" data-parsley-validate novalidate >
		<div class="fileup">
			<input type="file" id="outcome_file" name="outcome_file[]" class="hde inputfile1" data-multiple-caption="{count} files selected"  data-parsley-required-message="Please select file" multiple  required>
			<label for="upload"><span>Upload docs</span><b id="uploadedOutcomeFiles">Select files</b></label>
		</div>
		<br>
		<span style="color:red">Please select Pdf, Mp4, Mp3, Flv files and total size up to 25MB</span>
		<br>
		<table id="outcomefileList">

		</table>
		<input type="hidden" id="appid_outcome" name="appid" value="" />
		<input type="hidden" name="grant_doc" value="1" />
		<div class="subbtn"><input type="submit" name="submit" id="submitoutcomeform" value="submit" class="sub-botton1"> </div>

	</form>
</div>
</div>

<!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="js/dashboard-app.js" type="text/javascript"></script>


<script>

</script>
<script>


$("#sorting").change(function() {
	var selectedText =  $('option:selected', this).val();
	$('#sortText').val(selectedText);
	var pageno = $('#pageno').val();
	queryBuilder(pageno);

});

var names = [];
var file_arr = [];

function queryBuilder(val)
{
	$(".pg").removeClass("active_page");

	$("#p_"+val).addClass("active_page");

	var formData = new FormData();
	formData.append('page',val);
	var sortby = $('#sortText').val();
	formData.append('sort',sortby);


		//formData.append('sort',sort);
		//alert(userId);
		$.ajax({
			type: 'post',
			url: 'pagination_filter.php',
			cache: false,
			contentType: false,
			processData: false,
			data : formData,
			dataType:'json',
			success: function(result){
			//console.log(result);

			$('#paginate').html(result);

			//alert(result.message);

		},
		error: function(err){
			console.log(err);
		}
	});

	}





	$(document).ready(function () {
		 $('#loader').hide();
		$("#p_1").addClass("active_page");
		$('#portfolio-file').on('change', function()
		{

			var x = document.getElementById("portfolio-file").name;
    		var files = document.getElementById("portfolio-file").files;

    		  var c = 0;
                                 var fp = $('input[name="portfolio-file[]"]');
				               var lg = files.length; // get length
				               var items = files;
				               var fileSize = 0;

                               if (lg > 0)
                               {
                               	for (var i = 0; i < lg; i++)
                               	{


                               		fileSize = fileSize+items[i].size;
				                     var fname = items[i].name;
				                     var fileName = files[i].name;

				                    if(names.length > 0)
				                    {
				                        for(var j=0;j<names.length;j++)
				                        {
				                            var counter = names[j];
				                        }

				                       // console.log(counter.index);
				                        iteration = counter.index + 1;
				                        names.push({file:items[i],index:iteration});
				                    }
				                    else
				                    {
				                        arrayCount = names.length;
				                        iteration = arrayCount;
				                        names.push({file:items[i],index:iteration});

				                    }
				                    var arrpush= [];
				                    for(var j=0;j<names.length;j++)
				                    {
				                        arrpush.push(names[j].name);
				                    }
				                     
				                     var extn = fname.substring(fname.lastIndexOf('.')+1, fname.length);
				                     if(extn != "pdf" && extn != "mp4" && extn != "mp3" && extn != "flv")
							    	{
							    		 alert('Please choose pdf,mp4,mp3,flv files');
							    	 	 $("#portfolio-file").val('');

							    		break;

							    	}
							    	else
				               {
				                    file_arr.push(files[i]);

				               	$('#portfoliofileList').append('<tr id="'+iteration+'"><td>&nbsp;&nbsp;&nbsp;&nbsp;'+files[i].name+'</td><td><input type="button"  data-id="'+iteration+'" class="del remport" style="float:right;"></td></tr>');
				               }

                               }
                               //alert(fileSize);
                               if(fileSize > 26214400) {
                               	c = 1;
                               	alert('File size must not be more than 25 MB');
                               	$("#portfolio-file").val('');
                               	return false;
                               }
                               else
				               {
				               	$('#portfoliofileList').append('<tr id="'+iteration+'"><td>&nbsp;&nbsp;&nbsp;&nbsp;'+files[i].name+'<input type="button" data-id="'+iteration+'" class="del remport" style="float:right;"></td></tr>');
				               }

                           }


                       });

			// $('#portfoliofileList').find('tr').remove();
			// var fp = $("#portfolio-file");
   //                             var lg = fp[0].files.length; // get length
   //                             var items = fp[0].files;
   //                             var fileSize = 0;
   //                             var c = 0;

   //                             if (lg > 0)
   //                             {
   //                             	for (var i = 0; i < lg; i++)
   //                             	{
   //                             		fileSize = fileSize+items[i].size;

   //                             		var fname = items[i].name;

   //                             		var extn = fname.substring(fname.lastIndexOf('.')+1, fname.length);

   //                             		if(extn != "pdf" && extn != "mp4" && extn != "mp3" && extn != "flv")
   //                             		{

			// 						        $('#uploadedFiles').text('Select Files');
			// 						    	$("#portfolio-file").val('');
   //                                      	// $("#portfolio-file").val('');
   //                                      	alert('Please choose pdf,mp4,mp3,flv files');
   //                                      	c = 1;

   //                                      	return false;
   //                                      }
   //                                  // get file size
   //                              }
   //                             //alert(fileSize);
   //                             if(fileSize > 26214400) {
   //                             	c = 1;
   //                             	alert('File size must not be more than 25 MB');
   //                             	$("#portfolio-file").val('');
   //                             	return false;
   //                             }

   //                             if(c != 1)
   //                             {
   //                             	var files = document.getElementById("portfolio-file").files;

   //                             	for (var i = 0; i < files.length; i++)
   //                             	{
   //                             		$('#portfoliofileList').append('<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;'+files[i].name+'&nbsp;&nbsp;<input type="button" class="remport" style="border:0 none;font-size:100%;margin:0;padding:0;border:0;outline:0;vertical-align:top;" ></td></tr>');

   //                             	}
   //                             }
   //                         }


   //                     });



$("#portfoliofileList").on('click','.remport',function()
{
	 var iteration = $(this).attr('data-id');

    for(var i = 0; i < names.length; i++) {
    if(names[i].index == iteration) {
        names.splice(i, 1);
        break;
    }
}

    $(this).closest('tr').remove();
});

$('#outcome_file').on('change', function()
{

	var x = document.getElementById("outcome_file").name;
	var files = document.getElementById("outcome_file").files;

	 var fp = $('input[name="outcome_file[]"]');
				               var lg = files.length; // get length
				               var items = files;
				               var fileSize = 0;

                               if (lg > 0)
                               {
                               	for (var i = 0; i < lg; i++)
                               	{


                               		fileSize = fileSize+items[i].size;
				                     var fname = items[i].name;
				                     var fileName = files[i].name;

				                    if(names.length > 0)
				                    {
				                        for(var j=0;j<names.length;j++)
				                        {
				                            var counter = names[j];
				                        }

				                       // console.log(counter.index);
				                        iteration = counter.index + 1;
				                        names.push({file:items[i],index:iteration});
				                    }
				                    else
				                    {
				                        arrayCount = names.length;
				                        iteration = arrayCount;
				                        names.push({file:items[i],index:iteration});

				                    }
				                    var arrpush= [];
				                    for(var j=0;j<names.length;j++)
				                    {
				                        arrpush.push(names[j].name);
				                    }
				                     
				                     // $("input[name=removed_portfolio]").clone().appendTo( $("input[name=removed_portfolio]").parent() ).val('abc.pdf');
				                     //console.log(names);
				                      console.log(names);
				                     var extn = fname.substring(fname.lastIndexOf('.')+1, fname.length);
				                     if(extn != "pdf" && extn != "mp4" && extn != "mp3" && extn != "flv")
							    	{
							    		 alert('Please choose pdf,mp4,mp3,flv files');
							    	 	 $("#outcome_file").val('');

							    		break;

							    	}
							    	else
				               {
				                    file_arr.push(files[i]);

				               	$('#outcomefileList').append('<tr id="'+iteration+'"><td>&nbsp;&nbsp;&nbsp;&nbsp;'+files[i].name+'</td><td><input type="button"  data-id="'+iteration+'" class="del remport" style="float:right;"></td></tr>');
				               }

                               }
                               //alert(fileSize);
                               if(fileSize > 26214400) {
                               	c = 1;
                               	alert('File size must not be more than 25 MB');
                               	$("#outcome_file").val('');
                               	return false;
                               }
                               else
				               {
				               	$('#outcomefileList').append('<tr id="'+iteration+'"><td>&nbsp;&nbsp;&nbsp;&nbsp;'+files[i].name+'</td><td><input type="button" data-id="'+iteration+'" class="del remport" style="float:right;"></td></tr>');
				               }

                           }


// 	var files = document.getElementById("outcome_file").files;
// $('#outcomefileList').find('tr').remove();
// 	for (var i = 0; i < files.length; i++)
// 	{
// 		$('#outcomefileList').append('<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;'+files[i].name+'&nbsp;&nbsp;<input type="button" class="remport" style="border:0 none;font-size:100%;margin:0;padding:0;border:0;outline:0;vertical-align:top;" value=""</td></tr>');

// 	}



// 	var fp = $("#outcome_file");
//                                var lg = fp[0].files.length; // get length
//                                var items = fp[0].files;
//                                var fileSize = 0;

//                                if (lg > 0) {
//                                	for (var i = 0; i < lg; i++) {
//                                		fileSize = fileSize+items[i].size;
//                                		var fname = items[i].name;

//                                		var extn = fname.substring(fname.lastIndexOf('.')+1, fname.length);
//                                		if(extn != "pdf" && extn != "mp4" && extn != "mp3" && extn != "flv")
//                                		{
//                                			$('#uploadedOutcomeFiles').text('Select Files');
// 									    $("#outcome_file").val('');
//                                			alert('Please choose pdf,mp4,mp3,flv files');
//                                			//$("#outcome_file").val('');
//                                			break;

//                                		}
//                                     // get file size
//                                 }
//                                //alert(fileSize);
//                                if(fileSize > 26214400) {
//                                	alert('File size must not be more than 25 MB');
//                                	$("#outcome_file").val('');

//                                }
//                            }


                       });

$("#outcomefileList").on('click','.remport',function()
{
	var iteration = $(this).attr('data-id');

    for(var i = 0; i < names.length; i++) {
    if(names[i].index == iteration) {
        names.splice(i, 1);
        break;
    }
}

    $(this).closest('tr').remove();

});




$("#grant_applicants_docs").on("submit", function(){


	var formData = new FormData($(this)[0]);
	 var rowCount = $('#portfoliofileList tr').length;
	 var finalDataArray = [];
        names.forEach(function (file) {
          // console.log(file.file);
           finalDataArray.push(file.file);
        });
	
	//console.log(finalDataArray);
	for(var i=0;i< finalDataArray.length;i++)
    {            
        formData.append('file-'+i, finalDataArray[i]);
    }

    formData.append('filecount', finalDataArray.length);
    formData.append("is_portfolio",rowCount);

console.log(formData);
$.ajax({
	type: 'POST',
	url: 'uploaddocs.php',
	cache: false,
	contentType: false,
	processData: false,
	data : formData,
	dataType:'json',
	 beforeSend: function(){
	    $('#loader').show();
	},
	complete: function(){
	    $('#loader').hide();
	},
	success: function(result){
		console.log(result);
		alert(result.message);
		location.reload();

	},
	error: function(err){
		console.log(err);
	}
});
});

$("#grant_applicants_docs_outcomes").on("submit", function(){
	var formData = new FormData($(this)[0]);
	var rowCount = $('#outcomefileList tr').length;
	 var finalDataArray = [];
        names.forEach(function (file) {
          // console.log(file.file);
           finalDataArray.push(file.file);
        });
        for(var i=0;i< finalDataArray.length;i++)
    {            
        formData.append('file-'+i, finalDataArray[i]);
    }

    formData.append('filecount', finalDataArray.length);
    formData.append("is_outcome",rowCount);
//formData.append('appid', appid);

//console.log(formData);
$.ajax({
	type: 'POST',
	url: 'uploaddocs.php',
	cache: false,
	contentType: false,
	processData: false,
	data : formData,
	dataType:'json',
	beforeSend: function(){
        $('#loader').show();
    },
    complete: function(){
        $('#loader').hide();
    },
	success: function(result){
		console.log(result);
		alert(result.message);
		location.reload();

	},
	error: function(err){
		console.log(err);
	}
});
});





});





</script>
<script src="../js/jquery.popupoverlay.min.js" type="text/javascript"></script>

<script>
$('.up_grApp_open').click(function(){
	$('.dshpbg #portfoliofileList tr').remove();
	$('.dshpbg #uploadedFiles').text('Select Files');
	$(".dshpbg #portfolio-file").val('');
	var appid=$(this).attr('data-id');
	$('#appid').val(appid);
		//alert(appid);
	})
$('.up_fnlOut_open').click(function(){
	$('.dshpbg #outcomefileList tr').remove();
	$('.dshpbg #uploadedOutcomeFiles').text('Select Files');
	$(".dshpbg #outcome-file").val('');
	var appid_outcome=$(this).attr('data-id');
	$('#appid_outcome').val(appid_outcome);
		//alert(appid);
	})</script>
	<?php  include('footer.php');?>
</div>
