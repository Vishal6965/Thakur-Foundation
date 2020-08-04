<?php 
$base_url='https://www.thakur-foundation.org/';
ini_set('display_errors', '0');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Thakur Foundation</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/style.css?v=0.4" />
<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="css/media-new.css?v=0.2" />
<link rel="stylesheet" href="css/intlTelInput.min.css">
<!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->
<!-- <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script> -->


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<!--<link rel="stylesheet" type="text/css" href="css/owl.theme.default.css">-->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src= "<?php echo $base_url?>js/owl.carousel.min.js"></script>
<script src= "<?php echo $base_url?>js/parsley.min.js"></script>


<!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/gh/vast-engineering/jquery-popup-overlay@2/jquery.popupoverlay.min.js"></script>
<!-- <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>   -->

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N8X2HFF');</script>

</head>

<body>
<section class="section1">
  <div class="container">
    <!--new header-->
    <header>
      <div class="logo"><a href="index.php"><img src="images/logo.png" alt=""></a></div>
    <?php
    //session_start();
    
    if (isset($_SESSION['loggedin'])==1) {?>
     <!--  <a href="#"><button id="#" class=" login btn-small">LOGOUT</button>
       
      </a> 17-6-2020 -->

   <?php }else{?>
    <button id="#" class="popup1_open login btn-small">LOGIN/ SIGN UP</button>
     <?php }?>

    <nav id="cssmenu">
      <div id="head-mobile"></div>
      <div class="button"></div>
      <ul>
        <li class="active"><a href="index.php">HOME</a></li>
        <li>
          <a href="#">GRANTS</a>
          <ul>
            <li><a href="public-health.php">Public Health</a></li>
            <li><a href="civil-rights.php">Civil Liberties</a></li>
            <li><a href="grant-announcement.php">Grant Announcement</a></li>
          </ul>
        </li>
        <li>
          <a href="#">APPLY</a>
          <ul>
            <li><a href="how-to-apply.php">How To Apply</a></li>
            <li><a href="grant-application.php">Application Form</a></li>
            <li><a href="how-to-apply.php#deadline">Deadlines</a></li>
            <li><a href="faq.php">FAQs</a></li>
          </ul>
        </li>
        <li>
          <a href="#">OUR IMPACT</a>
            <ul>
              <li><a href="our-impact.php">Accomplishments</a></li>
              <li><a href="publicaion-reports.php">Publications &amp; Reports</a></li>
              <li><a href="publicaion-reports.php#past-grants">Past Grants</a></li>
            </ul>           
        </li>
        <li class=""><a href="about-us.php">ABOUT US</a></li>

      </ul>

     <div class="lgnbtn1">
      
          <?php  if (isset($_SESSION['loggedin'])==1) {?>
          <p class="welmsg">Welcome <span><?php echo  $_SESSION['username'];?></span></p>

          <?php if(isset($_SESSION['loggedin'])==1 && ($_SESSION['admin'])==1)
            {

              ?>
               <div class="toplinksec admin-toplinksec">
              <div class="slctbg">
                <select id="drpdwn" class="selectbx">
                   <option value="" disabled selected>My Account</option>
                   <option value="https://www.thakur-foundation.org/admin-dashboard.php">Admin Dashboard</option>
                  

                </select>
              </div>
              </div>
            <?php }else{ ?>
          <div class="toplinksec">
              <div class="slctbg">
                <ul class="accMenu">
                  <li>
                    <a href="#">MY ACCOUNT</a>
                    <ul>
                      <li><a href="<?php echo $base_url?>dashboard.php">My Account</a></li>
                      <li><a href="<?php echo $base_url?>reset-password.php">Change Password</a></li>
                      <li><a href="<?php echo $base_url?>logout.php">Logout</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

              </div>
              <?php } ?>
           <!-- <div class="toplinksec">
              <a href="<?php //echo $base_url?>dashboard.php">My Account /</a>
              <a href="<?php //echo $base_url?>reset-password.php">Change Password</a>
            </div> -->

          <!-- <a class="lgout" href="<?php //echo $base_url?>logout.php"><button id="#" class="login btn-large">LOGOUT</button> 17-6-2020-->

            </a>
            <!-- <p>Welcome <span><?php echo  $_SESSION['username'];?></span></p> -->
          <?php    }else{?>
          <button id="#" class="popup1_open login btn-large">LOGIN/ SIGN UP</button>
          <?php }?>

      </div>
    </nav>

    </header>
    <!--end new header-->



    <div class="clear"></div>
  </div>
</section>
</body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N8X2HFF"height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>