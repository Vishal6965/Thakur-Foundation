<?php

session_start() ;
include('header.php');
?>

<section>
  <div class="banner-inner">
    <img src="images/publication-report-banner.jpg" alt="Banner" class="banner-img hidden-lg">
    <img src="images/publication-report-banner-sm.jpg" alt="Banner" class="banner-img hidden-sm">
    <div class="banner-txt">
      <h2>Creating awareness and accessibility for empowerment.</h2>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="para-txt">
      <p>In order to view impact-related documents and reports-in-progress created by our grantees, you can explore our database. All publications and documents can be downloaded from our website. We encourage sharing and citation of our publications.</p>
    </div>


<section class="data-grid" id="past-grants">
    <div class="main_container">
    <div class="title">View Past Grants Awarded</div>
        <div class="serach-bar">
             <p><input type="text"  class="text-brd" placeholder="Search grant database"/><span class="focus-border"></span></p>
             <p><input type="button" id="btnsearch" value="Search" class="btn" /></p>
             <p><a href ="<?php echo $base_url?>grant-announcement.php" target="_blank"><input type="button" value="VIEW PAST GRANT ANNOUNCEMENTS" class="btn btn-blue"></a></p>
        </div>
        <div class="clear">
        </div>
        <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Grantee</th>
                <th>Year of grant</th>
                <th>Region</th>                
                <th>Grant area</th>
                <th>Impact area</th>
                
            </tr>
        </thead> 
             
    </table>
</div>
</section>
</div>
</section>

<?php  include('footer.php');?>
