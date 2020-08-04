<?php
echo $_POST["searchvalue"];
include('config.php');
//echo $_POST["searchvalue"];
$limit =2;
if (isset($_GET["page"])) {  $page  =(int)$_GET["page"]; } else { $page=1; }
$start_from = ($page-1) * $limit;





$sql = "SELECT ga.*,ur.name as username,ur.lastname as lname from grants_applicants ga LEFT JOIN user_register ur on ur.id=ga.user_id  where ga.complete='1' ORDER BY ga.id DESC LIMIT $start_from, $limit";
/*}else{*/


/*$sql = "SELECT ga.*,ur.name as username,ur.lastname as lname from grants_applicants ga LEFT JOIN user_register ur on ur.id=ga.user_id  where ga.interest LIKE '$_POST["searchvalue"]%' ";

}*/
$rs_result = mysqli_query($con, $sql);
?>

<div class="datatbl">
              <div class="tp row">
                <div class="col td">
                  <b>Grantee</b>
                </div>
                <div class="col td">
                  <b>Year of grant</b>
                  <p>2017 - 2018</p>
                  <a href="#"><img src="images/arrow-dwn.png" /></a>
                </div>
                <div class="col td">
                  <b>Region</b>
                  <p>5 of 8 Regions</p>
                  <a href="#"><img src="images/arrow-dwn.png" /></a>
                </div>
                <div class="col td">
                  <b>Grant area </b>
                  <p>8 of 3 Thematic Area</p>
                  <a href="#"><img src="images/arrow-dwn.png" /></a>
                </div>
                <div class="col td">
                  <b>Imbact area</b>
                  <p>5 of 5 Imbact  Area</p>
                  <a href="#"><img src="images/arrow-dwn.png" /></a>
                </div>
              </div>
            </div>
             <div class="datatbl">
            <?php if (!empty($rs_result) && $rs_result->num_rows > 0) {
                            // output data of each row
                            while($row = $rs_result->fetch_assoc()) {
                                    //echo '<pre>';print_r($row);?>

              <div class="row">
                <div class="col td">
                  <p><?php echo $row['username'].$row['lname'] ?></p>
                </div>
                <div class="col td">
                  <p><?php
                              $date= $row['created_date'];
                              $newdate=date('Y',strtotime($row['created_date']));

                              echo $newdate;?></p>
                </div>
                <div class="col td">
                <?php
               $cid=$row['nationality'];
               $countryinfo="SELECT country_name from apps_countries where country_code='".$cid."' ";
                        $resultgetcountryinfo = $con->query($countryinfo);

                        if (!empty($resultgetcountryinfo) && $resultgetcountryinfo->num_rows > 0) {
                            // output data of each row
                            while($rowc = $resultgetcountryinfo->fetch_assoc()) {?>


                  <p><?php echo $rowc['country_name'] ?></p>
              <?php }} ?>
                </div>
                <div class="col td">
                        <p><?php echo $row['interest'] ?></p>

                </div>
                <div class="col td">
               <?php
               $idf=$row['application_id'];
               $impactinfo="SELECT impact from impact where application_id='".$idf."' AND deleted='0' ";
                        $resultgetimpactinfo = $con->query($impactinfo);

                        if (!empty($resultgetimpactinfo) && $resultgetimpactinfo->num_rows > 0) {
                            // output data of each row
                            while($rows = $resultgetimpactinfo->fetch_assoc()) {

                              ?>
                  <p><?php echo $rows['impact'] ?></p>
            <?php }}?>
                </div>
              </div>


      <?php } }
?>
 </div>
<?php


$sql = "SELECT COUNT(id) FROM grants_applicants where complete ='1' " ;
$rs_result = mysqli_query($con, $sql);
$row = mysqli_fetch_row($rs_result);
 $total_records = $row[0];
  $total_pages = ceil($total_records / $limit);
?>
<div class="pagenav">
<ul class='pagination text-center' id="pagination">
       <?php  if ($page > 1) {?>

      <li id="<?php echo $page-1;?>"><a href='<?php echo $base_url?>pagination.php?page=<?php echo $page-1;?>' id='1'>«</a></li>
     <!--  <li id="1"><a href='<?php echo $base_url?>pagination.php?page=1' id='1'>«</a></li> -->
      <!-- <li id="<?php echo $page-1;?>"><a href='<?php echo $base_url?>pagination.php?page=<?php echo $page-1;?>' id='<?php echo $page-1;?>'></a> </li> -->
      <?php }?>
<?php if ($page != $total_pages) {?>

     <li id="<?php echo $page+1 ?>"><a href='<?php echo $base_url?>pagination.php?page=<?php echo $page+1 ?>' id="<?php echo $page+1 ?>"></a></li>
  <!--  <li id="<?php echo $total_pages?>"><a href='<?php echo $base_url?>pagination.php?page=<?php echo $total_pages?>' id="<?php echo $total_pages?>">»</a></li> -->
   <li id="<?php echo $page+1 ?>"><a href='<?php echo $base_url?>pagination.php?page=<?php echo $page+1 ?>' id="<?php echo $page+1 ?>">»</a></li>
  <?php }?>


</ul></div>
