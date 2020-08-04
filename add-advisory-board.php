<?php
session_start();
include('admin-header.php');
include('config.php');
ini_set('display_errors', '0');
if(!empty($_SESSION) || !isset($_SESSION)) 
{
	if(isset($_SESSION['admin']))
	{
	 	$adminl = $_SESSION['admin'];

		if($adminl != 1)
		{
			echo "<script type='text/javascript'>window.location='https://www.thakur-foundation.org/index.php';</script>";
		}
	}
}
else
{
	echo "<script type='text/javascript'>window.location='https://www.thakur-foundation.org/index.php';</script>";
	
}
$limit =5;

?>
<div id="appdetdash">
<link rel="stylesheet" type="text/css" href="css/add-advisory.css?v=0.1" />
	<style>.add-advbrd form div.user-input input{ margin-bottom: 52px;}</style>

<div class="main-container add-advbrd">
	<section class="cntarea">
		
		<div>
			<h1>Add advisory board member</h1>
			<div class="clear">				   
				 <form id="addmentor" method="post" action="javascript:void(0);" data-parsley-validate novalidate>
						<input type="hidden" name="mentorid" id="mentorid" value="">
					<div class="user-input">
						<input type="text" name="mfirst" id="mfirst" placeholder="First Name"  data-parsley-required-message="Please enter First Name" data-parsley-pattern="/^[a-zA-Z\s-, ]+$/" data-parsley-pattern-message="Please enter valid first name" required>
					</div>
					<div class="user-input">
						<input type="text" name="mlast" id="mlast" placeholder="Last Name" required data-parsley-required-message="Please enter Last Name">
					</div>
					<div class="user-input">
						<input type="email" name="memail"  id="memail" placeholder="Email Address" data-parsley-required-message="Please enter valid email address" data-parsley-pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" data-parsley-pattern-message="Please enter valid email address" required>
					</div>
					<div class="user-input">
						<input type="password" name="mpassword" id="mpassword"  placeholder="Password" data-parsley-pattern='^[a-zA-Z0-9/\"]*$' data-parsley-minlength="6"  data-parsley-minlength-message="Passwords should be at least 6 characters long in alphanumeric." data-parsley-required-message="Please enter password" data-parsley-pattern-message="Passwords should be at least 6 characters long in alphanumeric." required>
					</div>
					<div class="user-input">
						<input type="password" name="mcpassword"  id="mcpassword" class="flexbox" placeholder=" Confirm Password"  data-parsley-pattern='^[a-zA-Z0-9/\"]*$' data-parsley-minlength="6"  data-parsley-minlength-message="Passwords should be at least 6 characters long in alphanumeric." data-parsley-pattern-message="Passwords should be at least 6 characters long in alphanumeric." data-parsley-required-message="Please enter confirm password" data-parsley-equalto="#mpassword" required >
					</div>
					
					<div class="clear"></div>
					
					<div class="all-btns">
						<input type="reset" value="CANCEL" class="btn-cancel sub-botton1">
						<input type="submit" name="msubmit" value="SAVE" class="btn-submit sub-botton1">
					</div>
				</form>
			</div>
		</div>
		
		<?php
			$sql1 = "SELECT id FROM user_register where role =2 and deleted='0'  " ;
			$rs_result1 = mysqli_query($con, $sql1);
			//$row1 = mysqli_fetch_row($rs_result1);
			
			$total_records = $rs_result1->num_rows;//$row1[0];
			$total_pages = ceil($total_records / $limit);

			//print_r($total_pages);
			?>
		<div class="data">
			<h1>List of advisory board member</h1>
			<div class="pagination">
				<a href="javascript:void(0)" onclick='boardpage(1);'></a>
				<?php for ($i=1; $i<=$total_pages; $i++)
				{
					echo "<a id='p_$i' class='pg' href='javascript:void(0)' onclick='boardpage($i)' >".$i."</a>";
				}; ?>
				<a href="javascript:void(0)" onclick='boardpage(<?php echo $total_pages?>);'></a>
				<!-- <a href="#"></a>
				<a href="#" class="actpag">1</a>
				<a href="#">2</a>
				<a href="#">3</a>
				<a href="#"></a> -->
			</div>
		
		
		
		<div class="datatbl">
			<div class="table">
			<!-- top row  -->
			<div class="tr tphead">

					
					<div class="td fname">First Name</div>
					<div class="td lname">Last Name</div>
					<div class="td emailid">Email Address</div>					
					
					<div class="td edit"></div>
					<div class="td delete"></div>
			</div>
			<!-- top row end -->
			<!-- tr  -->
			<?php $info ="SELECT * from user_register where role='2' and deleted='0' LIMIT $limit ";
     		 $resultinfo = $con->query($info);?>
      <div id="paginate">
            <?php if ($resultinfo->num_rows > 0) {
              $count=1;
              while($row = $resultinfo->fetch_assoc()) {?>
			<div class="tr" id="mentor_id_<?php echo $row['id']?>">
					<!-- <div class="td srno name"><?=$count?></div> -->
					<div class="td fname"><?=$row['name']?></div>
					<div class="td lname"><?=$row['lastname']?></div>
					<div class="td emailid"><?=$row['email']?></div>
					
					<!-- <div class="td edit"><a href="#" onclick="editmentor(<?php echo $row['id']?>)" class="btn"><span><img src="images/edit-pencil.png"></span>Edit</a></div> -->

					<!-- <div class="td delete"><a href="#" onclick="deletementor(<?php echo $row['id']?>)" class="btn"><span><img src="images/delete.png"></span>Delete</a></div> -->
					<div class="td edit"><a href="#"  onclick="editmentor(<?php echo $row['id']?>)"  class="btn"><span><img src="images/edit-pencil.png"></span>Edit</a><a href="#" onclick="deletementor(<?php echo $row['id']?>)" class="btn"><span><img src="images/delete.png"></span>Delete</a></div>
			</div>
			  <?php  $count++; }}else{ echo "No records found"; }?>
				
		</div>
		</div>
	</div>
		</div>
		
		
	 
	 </div>

	</section>

</div>



<!-- <script src="../js/jquery.popupoverlay.min.js" type="text/javascript"></script> -->
<script src="http://onlinereviews.org.uk/thakur-foundation/thakurfoundation/js/dash-board-app.js" type="text/javascript"></script>
<script type="text/javascript">
$("#newPass").keypress(function(e) {

			var k 	= e.keyCode,
					$return = ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32  || (k >= 48 && k <= 57));
		      if(!$return) {
		      	$('#error_msg').html("Passwords should be at least 6 characters long in alphanumeric.");
		      	return false;
		      }
		      else
		      {
		      	$('#error_msg').html("");
		      }

	})
	$("#confPass").keypress(function(e) {

	var k 			= e.keyCode,
			$return = ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32  || (k >= 48 && k <= 57));
      if(!$return) {
      	return false;
      }

})

$("#addmentor").submit(function(event) {
	 	//alert('hi');
         var formdata=$('#addmentor').serialize();
        		$.ajax({
		            type: 'post',
		            url: '<?php echo $base_url ?>ajaxaddmentor.php',
		            dataType:'json',
		            data: formdata,
		            success: function(res) {
		                         
		               alert(res.message);
		               //
		               // window.location.href=window.location.href;
		                $('#addmentor')[0].reset();
		                 var list="";
		                 if(res.status=='1'){
		                 	location.reload();
		                 list='<tr><td>'+res.count+'</td><td>'+res.fname+'</td> <td>'+res.lname+'</td><td>'+res.email+'</td></tr>';
		                 
				                $('#mentorlist').append(list);
				             }
				             else if(res.status=='2'){
				             	location.reload();

				             }else if(res.error=='1'){
				             	//console.log(res);
				             	 $('#mfirst').val(res.fname);
					              $('#mlast').val(res.lname);
					              $('#memail').val(res.email);
					              $('#mpassword').val(res.password);
					              $('#mcpassword').val(res.mcpassword);

		             }
		            }
		          });
});
function deletementor(mentorid)
{
    var conf=confirm('Please confirm to delete this advisory board member?');
    if(conf){
          $.ajax({
            type: 'post',
            url: '<?php echo $base_url ?>deletementor.php',
            dataType:'json',
            data: {mentorid:mentorid},
                 success: function(res) {
                   alert(res.message);
                   $('#mentor_id_'+mentorid).remove();
                   location.reload();

               }
          });
		}
}
function editmentor(mentorid)
{
    
          $.ajax({
            type: 'post',
            url: '<?php echo $base_url ?>editmentor.php',
            dataType:'json',
            data: {mentorid:mentorid},
                 success: function(res) {
                  // console.log(res);
                   //console.log(res['response'][0]['fname']);
                   $('#mfirst').val(res['response'][0]['fname']);
                   $('#mlast').val(res['response'][0]['lname']);
                   $('#memail').val(res['response'][0]['email']).prop('readonly',true);
                   $('#mpassword').val(res['response'][0]['password']);
                   $('#mcpassword').val(res['response'][0]['cpassword']);
                   $('#mrole').val(res['response'][0]['role']);
                   $('#mentorid').val(res['response'][0]['id']);

               }
          });
}
  
  /*$(".custom-switch").click(function(){
   function checkmentor(){
    alert('hi');
      var mentorid=$(this).data('id');
      var check=$(this).attr('data_checked');
      alert(mentorid);
	      if(check==0){
	      var conf=confirm('Are you want delete this mentor?');
	    	}else{var conf=confirm('Are you want active this mentor?');}
    			if(conf){
		          $.ajax({
		            type: 'post',
		            url: '<?php echo $base_url ?>deletementor.php',
		            dataType:'json',
		            data: {mentorid:mentorid,checked:check},
		                 success: function(res) {
		                   alert(res);
		                   return false;
		                 // window.location.href=window.location.href;

		               }
		          });

   			 }
	}*/
	function boardpage(val)
{
	$(".pg").removeClass("active_page");

	$("#p_"+val).addClass("active_page");

	var formData = new FormData();
	formData.append('page',val);
	


		//formData.append('sort',sort);
		//alert(userId);
		$.ajax({
			type: 'post',
			url: 'pagination_filter_advisoryboard.php',
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

</script>
<?php  include('footer.php');?>
</div>
