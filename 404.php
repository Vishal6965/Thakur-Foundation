<?php
include('header.php');

?>
<div id="f04">
<div class="clear"></div>
	<section id="reset-header" class="header-parallax">
		<div class="main_container">
			<div class="tbl">
					<!-- <div class="serbx">
					 <h1>404</h1>
					</div> -->
			</div>

		</div>
	</section>

<section>
	<div class="f04">
	<p>404</p>
<span>page not found</span>
    </div>
</section>
</div>
<script type="text/javascript">

	 $("#resetpassword").submit(function(event) {
	 	//alert('hi');
         var formdata=$('#resetpassword').serialize();
         console.log(formdata);
//return false;

          $.ajax({
            type: 'post',
            url: '<?php echo $base_url ?>changepassword.php',
            dataType:'json',
            data: formdata,
            success: function(res) {
               alert(res.message);
               if(res.flag == 1)
               {
              		window.location.href = '<?php echo $base_url;?>';
              	}
              	else
              	{
              		return false;
              	}
            }
          });

        });

</script>




	<?php  include('footer.php');?>

