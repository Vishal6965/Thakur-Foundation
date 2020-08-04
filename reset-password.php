<?php
session_start();
include('config.php');
include('header.php');

if(isset($_SESSION['user_id']))
{
	$userid =  $_SESSION['user_id'];
}
else
{
	$id=$_GET['token'];
	$userid=base64_decode($id);
}
// print_r($sessionUserId);
$sqlQuery = "SELECT id from user_register where id='".$userid."' ";
				$resultinfo = $con->query($sqlQuery);

         		$resultinfo->num_rows;
				if ($resultinfo->num_rows == 1) {
					$flag = 1;
				}
				else
				{
					$flag = 0;
				}
?>
<div id="prvplcy">

	<section id="reset-header" class="header-parallax">
		<div class="main_container">
			<div class="tbl">

					<div class="serbx">
					 <!-- <h1>People <br>
					 <span class="textbt">behind the Thakur Foundation</span> </h1> -->
					</div>

			</div>

		</div>
	</section>
<?php if($flag == 1 ) { ?>
<section>
	<div class="resetpass">
		<span class="title">RESET YOUR PASSWORD</span>
      <form id="resetpassword" method="post" action="javascript:void(0);" data-parsley-validate novalidate >
        <p><input type="password" name="oldPass" class="flexbox" placeholder="Old Password" required data-parsley-required-message="Please enter old password"></p>
        <p><input type="password" id="newPass" name="newPass"  class="flexbox" placeholder="New Password (Special characters are not allowed)" data-parsley-pattern='^[a-zA-Z0-9/\"]*$' data-parsley-minlength="6"  data-parsley-minlength-message="Passwords should be at least 6 characters long in alphanumeric." data-parsley-required-message="Please enter password" data-parsley-pattern-message="Passwords should be at least 6 characters long in alphanumeric." data-parsley-required-message="Please enter password"  required >
        	<span id="error_msg" style="color:red"></span>
        </p>
				<p><input type="password" name="confPass" id="confPass"  class="flexbox" placeholder="Confirm Password (Special characters are not allowed)" data-parsley-required-message="Please enter confirm password"  data-parsley-pattern='^[a-zA-Z0-9/\"]*$' data-parsley-minlength="6"  data-parsley-minlength-message="Passwords should be at least 6 characters long in alphanumeric."  data-parsley-pattern-message="Passwords should be at least 6 characters long in alphanumeric."   data-parsley-equalto="#newPass" required  ></p>
				<input type="hidden" name="user" value='<?php echo $userid;?>'>
				<p><input type="submit" name="fsubmit" value="Save" class="sub-botton2"></p>
      </form>

    </div>
</section>
<?php }else{ ?>
<section>
	<div class="resetpass">
		<center><span style="font-size:14px;"><b>User does not exist.Please contact to administrator</b></span><center>
	</div>
</section>
<?php } ?>

<div id="changepassword" class="popup">
    <div class="close changepassword_close "><span class="rt-close cls_btn"></span></div>
    <div class="table">
      <p id="changepswd">
      </p>
    </div>
</div>
<script type="text/javascript">


	$("#newPass").keypress(function(e) {

	var k 			= e.keyCode,
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

	 $("#resetpassword").submit(function(event) {
	 	//alert('hi');
         var formdata=$('#resetpassword').serialize();
         //console.log(formdata);
//return false;

          $.ajax({
            type: 'post',
            url: '<?php echo $base_url ?>changepassword.php',
            dataType:'json',
            data: formdata,
            success: function(res) {
              $('#changepswd').html(res.message);              
               //alert(res.message);
               if(res.flag == 1)
               {
                  $('#changepassword').popup('show');
                  setTimeout(function(){                  
                  window.location.href = '<?php echo $base_url;?>';
                  }, 2200);
              		
              	}
              	else
              	{
                  alert(res.message);
              		return false;
              	}
            }
          });

        });

</script>




	<?php  include('footer.php');?>
</div>
