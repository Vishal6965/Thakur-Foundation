<?php
require_once 'thakurfoundation_config.php';
require_once 'class.smtp.php';
require_once 'class.phpmailer.php';
require_once 'PHPMailerAutoload.php';

class FOUNDATION
{
    public function ChkUserEmailExist($email)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = FALSE;
        try
            {
                $sql = "SELECT `email` from `user_register` where `email` = :email ";
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':email' => $email
                ));
                $row_affected = $STH->rowCount();
                if($row_affected == 1)
                {
                    $return = TRUE;
                }
                $DBH->commit();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        return $return;
    }
    
    public function AddUser($tdata)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = FALSE;
        try
            {
                $sql = "INSERT into `user_register`(`name`,`email`,`lastname`,`mobile`,`password`)"
                        ."VALUES(:name,:email,:lastname,:mobile,:password)";
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':name' => addslashes($tdata['firstname']),
                    ':lastname' => addslashes($tdata['lastname']),
                    ':mobile' => $tdata['mobile'],
                    ':email' => $tdata['email'],
                    ':password' => $tdata['password']
                ));
                $row_affected = $STH->rowCount();
                if($row_affected == 1)
                {
                    $return = TRUE;
                }
                $DBH->commit();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        return $return;
    }
    
    public function ChkValidUser($username,$password) 
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = False;
        try {
                $sql = "SELECT id FROM `user_register` WHERE `email` = :username AND `password` = :password AND `status` = :status ";
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':username' => $username,
                    ':password' => md5($password),
                    ':status' => '1'
                ));
                $rows_affected = $STH->rowCount();
                if ($rows_affected > 0)
                {
                    $return = true;
                }
                
                $DBH->commit();
            } 
            catch (Exception $e) 
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
            
        return $return;
    }
    
    function DoUserlogin($tdata)
    {
        $login_data = $this->GetUserData($tdata);
//        print_r($login_data);die();
        //$return = FALSE;
        
        $_SESSION['user_id']       = $login_data['id'];
        $_SESSION['name']       = $login_data['name'];
        $_SESSION['mobile']     = $login_data['mobile']; 
        $_SESSION['email']     = $login_data['email']; 
            
        $return = TRUE;
        
        return $return;
    }
    
    public function GetUserData($tdata)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = '';
        try {
                $sql = "SELECT id,name,mobile,email,lastname FROM `user_register` WHERE `email` = :username AND `password` = :password AND `status` = :status " ;
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':username' => $tdata['email'],
                    ':password' => md5($tdata['password']),
                    ':status' => '1'
                ));
                $row_count = $STH->rowCount();
                if ($row_count == 1) 
                {
                    $r = $STH->fetch(PDO::FETCH_ASSOC);
                    $return = $r;
                }
            } 
            catch (Exception $e) 
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        
        return $return;
    }
    
    public function IsUserLogin() 
    {
        $return = false;
        
        if(isset($_SESSION['user_id']) && ($_SESSION['user_id'] > 0) && ($_SESSION['user_id'] != ''))
        {
            $user_id = $_SESSION['user_id'];
            
            if($this->ChkValidUserById($user_id))
            {
                $return = TRUE;
            }
        }
        return $return;
    }
    
    public function ChkValidUserById($user_id) 
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = False;
        try {
                $sql = "SELECT id FROM `user_register` WHERE `id` = :user_id ";
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':user_id' => $user_id
                ));
                $rows_affected = $STH->rowCount();
                if ($rows_affected > 0)
                {
                    $return = true;
                }
                
                $DBH->commit();
            } 
            catch (Exception $e) 
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
            
        return $return;
    }
    
    function DoUserLogout()
    {
        $return = true;	

        $_SESSION['user_id'] = '';
        $_SESSION['name'] = '';
        $_SESSION['mobile'] = '';
        $_SESSION['email'] = '';
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['mobile']);
        unset($_SESSION['email']);
        session_destroy();
        session_start();
        session_regenerate_id();
        $new_sessionid = session_id();

        return $return;
    }
    
    //grant start
    
    public function GetCountryList($country_id)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $option_str = '';
        try {
                $sql = "SELECT id,country_code,country_name FROM `apps_countries` Where 1 ";
                $STH = $DBH->prepare($sql);
                $STH->execute();
                $rows_affected = $STH->rowCount();
                if ($rows_affected > 0)
                {
                    while ($row = $STH->fetch(PDO::FETCH_ASSOC))
                    {
                        if ($row['country_code'] == $country_id)
                        {
                            $option_str .= '<option value="' . $row['country_code'] . '" selected>' . $row['country_name'] . '</option>';
                        } 
                        else
                        {
                            $option_str .= '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
                        }
                    }
                }

                $DBH->commit();
            } 
            catch (Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }  
            
        return $option_str;
    }
    
    public function GetPortfolio($application_id)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $data = array();
        
        try {
                $sql = "SELECT portfolio,id,user_id FROM `portfolio` WHERE `application_id` = :application_id AND deleted = :deleted " ;
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':application_id' => $application_id,
                    ':deleted' => '0'
                ));
                $rows_affected = $STH->rowCount();
                if ($rows_affected > 0)
                {
                    while ($row = $STH->fetch(PDO::FETCH_ASSOC))
                    {
                        $data[] = $row; 
                    }
                }

                $DBH->commit();
            } 
            catch (Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }  
            
        return $data;
    }
    
    public function GetUserGrantdata($user_id)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $data = '';
        
        try {
                $sql = "SELECT * FROM `grants_applicants` WHERE `user_id` = :user_id AND incomplete = :incomplete " ;
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':user_id' => $user_id,
                    ':incomplete' => '1'
                ));
                $rows_affected = $STH->rowCount();
                if ($rows_affected > 0)
                {
                    $row = $STH->fetch(PDO::FETCH_ASSOC);
                    $data = $row; 
                }

                $DBH->commit();
            } 
            catch (Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }  
            
        return $data;
    }
    
    public function GetUserDataById($user_id)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = '';
        try {
                $sql = "SELECT id,name,mobile,email,lastname FROM `user_register` WHERE `id` = :user_id " ;
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':user_id' => $user_id
                ));
                $row_count = $STH->rowCount();
                if ($row_count == 1) 
                {
                    $r = $STH->fetch(PDO::FETCH_ASSOC);
                    $return = $r;
                }
            } 
            catch (Exception $e) 
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        
        return $return;
    }
    
    public function SaveForLater($tdata)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = FALSE;
        try
            {
                $sql = "UPDATE `user_register` set `name` = :name,`email` = :email,`lastname` = :lastname,`mobile` = :mobile where `id` = :user_id ";
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':name' => addslashes($tdata['fname']),
                    ':lastname' => addslashes($tdata['lname']),
                    ':mobile' => $tdata['mobile'],
                    ':email' => $tdata['email'],
                    ':user_id' => $tdata['user_id']
                ));
                $row_affected = $STH->rowCount();
                if($row_affected == 1)
                {
                    $return = TRUE;
                }
                $DBH->commit();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        return $return;
    }
    
    public function ChkGrantExist($application_id) 
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = False;
        try {
                $sql = "SELECT id FROM `grants_applicants` WHERE `application_id` = :application_id ";
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':application_id' => $application_id
                ));
                $rows_affected = $STH->rowCount();
                if ($rows_affected > 0)
                {
                    $return = true;
                }
                
                $DBH->commit();
            } 
            catch (Exception $e) 
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
            
        return $return;
    }
    
    public function AddUserGrant($tdata)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = '';
        $d['result'] = '0';
        try
            {
                $sql = "INSERT into `grants_applicants`(`user_id`,`mail_address`,`secondary_phone`,`nationality`,`age`,"
                        ."`resume`, `last_org_work`,`pastbyline`,`ref1`,`ref2`,`ref3`,`interest`,`description_assignment`,"
                        ."`statement_purpose`,`incomplete`,`application_id`)"
                        ."VALUES(:user_id,:mail_address,:secondary_phone,:nationality,:age,:resume,:last_org_work,:pastbyline,"
                        .":ref1,:ref2,:ref3,:interest,:description_assignment,:statement_purpose,:incomplete,:application_id)";
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':user_id' => $tdata['user_id'],
                    ':mail_address' => $tdata['mail_address'],
                    ':secondary_phone' => $tdata['secondary_phone'],
                    ':nationality' => $tdata['nationality'],
                    ':age' => $tdata['age'],
                    ':resume' => $tdata['resume'],
                    ':last_org_work' => addslashes($tdata['last_org_work']),
                    ':pastbyline' => addslashes($tdata['pastbyline']),
                    ':ref1' => addslashes($tdata['ref1']),
                    ':ref2' => addslashes($tdata['ref2']),
                    ':ref3' => addslashes($tdata['ref3']),
                    ':interest' => addslashes($tdata['interest']),
                    ':description_assignment' => addslashes($tdata['description_assignment']),
                    ':statement_purpose' => addslashes($tdata['statement_purpose']),
                    ':incomplete' => '1',
                    ':application_id' => ''
                ));
                $row_affected = $STH->rowCount();
                if($row_affected > 0)
                {
                    
                    $d['last_id'] = $DBH->lastInsertId();
                    
                    $d['application_id'] = 'GT'.$d['last_id'];
                    
//                    if($this->UpdateGrantApplicationId($application_id,$last_id))
//                    {
//                        $c = count($tdata['portfolio']);
//                        
//                        if($c > 0)
//                        {
//                            $this->AddGrantPortfolio($application_id,$tdata);
//                        }
                        

                        $d['result'] = '1';
                        
                        $return = $d;
//                    }
                }
                $DBH->commit();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        return $return;
    }
    

    public function AddUserGrantSubmit($tdata)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = '';
        $d['result'] = '0';
        try
            {
                $sql = "INSERT into `grants_applicants`(`user_id`,`mail_address`,`secondary_phone`,`nationality`,`age`,"
                        ."`resume`, `last_org_work`,`pastbyline`,`ref1`,`ref2`,`ref3`,`interest`,`description_assignment`,"
                        ."`statement_purpose`,`incomplete`,`complete`,`application_id`)"
                        ."VALUES(:user_id,:mail_address,:secondary_phone,:nationality,:age,:resume,:last_org_work,:pastbyline,"
                        .":ref1,:ref2,:ref3,:interest,:description_assignment,:statement_purpose,:incomplete,:complete,:application_id)";
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':user_id' => $tdata['user_id'],
                    ':mail_address' => $tdata['mail_address'],
                    ':secondary_phone' => $tdata['secondary_phone'],
                    ':nationality' => $tdata['nationality'],
                    ':age' => $tdata['age'],
                    ':resume' => $tdata['resume'],
                    ':last_org_work' => addslashes($tdata['last_org_work']),
                    ':pastbyline' => addslashes($tdata['pastbyline']),
                    ':ref1' => addslashes($tdata['ref1']),
                    ':ref2' => addslashes($tdata['ref2']),
                    ':ref3' => addslashes($tdata['ref3']),
                    ':interest' => addslashes($tdata['interest']),
                    ':description_assignment' => addslashes($tdata['description_assignment']),
                    ':statement_purpose' => addslashes($tdata['statement_purpose']),
                    ':incomplete' => '0',
                    ':complete' => '1',
                    ':application_id' => ''
                ));
                $row_affected = $STH->rowCount();
                if($row_affected > 0)
                {
                    
                    $d['last_id'] = $DBH->lastInsertId();
                    
                    $d['application_id'] = 'GT'.$d['last_id'];

                    $this->insertAdminData($d['application_id']);
                    
//                    if($this->UpdateGrantApplicationId($application_id,$last_id))
//                    {
//                        $c = count($tdata['portfolio']);
//                        
//                        if($c > 0)
//                        {
//                            $this->AddGrantPortfolio($application_id,$tdata);
//                        }
                        

                        $d['result'] = '1';
                        
                        $return = $d;
//                    }
                }
                $DBH->commit();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        return $return;
    }

    public function insertAdminData($id)
    {

        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = false;
        try
            {
                $sql = "INSERT INTO admin (`application_id`,`receipt_date`,`review_date`,`project_start_date`,"
                ."`approved_grant_amount`,`approved_expense_amount`,`first_tranche_release_date`,`first_tranche_amount`,"
                ."`first_expense_tranche_amount`,`first_tranche_amount_paid`,`first_expense_tranche_paid`,`projected_interim_review_date`,"
                ."`actual_interim_review_date`,`interim_tranche_amount`,`interim_tranche_amount_paid`,`projected_publication_date`,`actual_publication_date`,"
                ."`final_tranche_release_date`,`final_tranche_amount`,`final_expense_release_date`,`final_expense_amount`,`final_tranche_paid`,"
                ."`final_expense_paid`,`grant_status`,`mentor_id`,`completion_date`,`publication_date`,`saveforlater`,`submit`)"
                ."VALUES (:application_id,:receipt_date,:review_date,:project_start_date,:approved_grant_amount,:approved_expense_amount,"
                    .":first_tranche_release_date,:first_tranche_amount,:first_expense_tranche_amount,:first_tranche_amount_paid,:first_expense_tranche_paid,"
                    .":projected_interim_review_date,:actual_interim_review_date,:interim_tranche_amount,:interim_tranche_amount_paid,:projected_publication_date,"
                    .":actual_publication_date,:final_tranche_release_date,:final_tranche_amount,:final_expense_release_date,:final_expense_amount,:final_tranche_paid,"
                    .":final_expense_paid,:grant_status,:mentor_id,:completion_date,:publication_date,:saveforlater,:submit)";
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':application_id' => $id,
                    ':receipt_date' => NULL,
                    ':review_date' => NULL,
                    ':project_start_date' => NULL,
                    ':approved_grant_amount' => '',
                    ':approved_expense_amount' => '',
                    ':first_tranche_release_date' => NULL,
                    ':first_tranche_amount' => '',
                    ':first_expense_tranche_amount' => '',
                    ':first_tranche_amount_paid' => '',
                    ':first_expense_tranche_paid' => '',
                    ':projected_interim_review_date' => NULL,
                    ':actual_interim_review_date' => NULL,
                    ':interim_tranche_amount' => '',
                    ':interim_tranche_amount_paid' => '',
                    ':projected_publication_date' => NULL,
                    ':actual_publication_date' => NULL,
                    ':final_tranche_release_date' => NULL,
                    ':final_tranche_amount' => '',
                    ':final_expense_release_date' => NULL,
                    ':final_expense_amount' => '',
                    ':final_tranche_paid' => '',
                    ':final_expense_paid' => '',
                    ':grant_status' => '1',
                    ':mentor_id' => '0',
                    ':completion_date' => NULL,
                    ':publication_date' => NULL,
                    ':saveforlater' => '0',
                    ':submit' => '1'
                ));
                $row_affected = $STH->rowCount();
                if($row_affected > 0)
                {
                    $return = TRUE;
                }
                $DBH->commit();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        return $return;
       
    }


    public function UpdateGrantApplicationId($application_id,$last_id)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = FALSE;
        try
            {
                $sql = "UPDATE `grants_applicants` set `application_id` = :application_id where `id` = :id ";
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':application_id' => $application_id,
                    ':id' => $last_id
                ));
                $row_affected = $STH->rowCount();
                if($row_affected > 0)
                {
                    $return = TRUE;
                }
                $DBH->commit();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        return $return;
    }
    
    public function AddGrantPortfolio($application_id,$user_id,$port)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = FALSE;
        $count = count($port);
        
        $portfolio = $port;
        
        if($count > 0)
        {
        
            try
                {
                    for($p = 0; $p < $count; $p++)
                    {
                        if($portfolio[$p] != '')
                        {
                            $sql = "INSERT into `portfolio`(`user_id`,`application_id`,`portfolio`)"
                                    ."VALUES(:user_id,:application_id,:portfolio)";
                            $STH = $DBH->prepare($sql);
                            $STH->execute(array(
                                ':user_id' => $user_id,
                                ':application_id' => $application_id,
                                ':portfolio' => time().'_'.$portfolio[$p]
                            ));
                            
                            $row_affected = $STH->rowCount();
                        }
                        else 
                        {
                            $row_affected = 1;
                        }
                    }
                    
                    if($row_affected > 0)
                    {
                        $return = TRUE;
                    }
                    $DBH->commit();
                }
                catch(Exception $e)
                {
                    echo $e->getMessage();
                    $DBH->rollBack();
                }
        }
        return $return;
    }
    
    public function UpdateUserGrant($tdata)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = FALSE;
        try
            {
                $sql = "UPDATE `grants_applicants` set `mail_address` = :mail_address,`secondary_phone` = :secondary_phone,"
                            ."`nationality` = :nationality,`age` = :age, `resume` = :resume, `last_org_work` = :last_org_work,"
                            ."`pastbyline` = :pastbyline, `ref1` = :ref1, `ref2` = :ref2, `ref3` = :ref3, `interest` = :interest,"
                            ."`description_assignment` = :description_assignment, `statement_purpose` = :statement_purpose where `application_id` = :application_id ";
                
                    $STH = $DBH->prepare($sql);
                    $STH->execute(array(
                        ':mail_address' => $tdata['mail_address'],
                        ':secondary_phone' => $tdata['secondary_phone'],
                        ':nationality' => $tdata['nationality'],
                        ':age' => $tdata['age'],
                        ':resume' => $tdata['resume'],
                        ':last_org_work' => addslashes($tdata['last_org_work']),
                        ':pastbyline' => addslashes($tdata['pastbyline']),
                        ':ref1' => addslashes($tdata['ref1']),
                        ':ref2' => addslashes($tdata['ref2']),
                        ':ref3' => addslashes($tdata['ref3']),
                        ':interest' => addslashes($tdata['interest']),
                        ':description_assignment' => addslashes($tdata['description_assignment']),
                        ':statement_purpose' => addslashes($tdata['statement_purpose']),
                        ':application_id' => $tdata['application_id']
                    ));
                $row_affected = $STH->rowCount();
                if($row_affected == 1)
                {
                    $return = TRUE;
                }
                $DBH->commit();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        return $return;
    }
    
    public function RemoveResume($tdata)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = FALSE;
        try
            {
                $sql = "UPDATE `grants_applicants` set `resume` = '' where `id` = :grantid AND `user_id` = :user_id ";
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':grantid' => $tdata['grantid'],
                    ':user_id' => $tdata['userid']
                ));
                $row_affected = $STH->rowCount();
                if($row_affected == 1)
                {
                    $return = TRUE;
                }
                $DBH->commit();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        return $return;
    }
    
    public function ChkPortfolioExist($application_id,$user_id)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = FALSE;
        try
            {
                $sql = "SELECT `id` from `portfolio` where `application_id` = :application_id AND `user_id` = :user_id ";
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':application_id' => $application_id,
                    ':user_id' => $user_id
                ));
                $row_affected = $STH->rowCount();
                if($row_affected > 0)
                {
                    $return = TRUE;
                }
                $DBH->commit();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        return $return;
    }
    
    public function RemovePortfolio($tdata)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = FALSE;
        try
            {
                $sql = "UPDATE `portfolio` set `deleted` = :deleted where `id` = :grantid AND `user_id` = :user_id ";
                $STH = $DBH->prepare($sql);
                $STH->execute(array(
                    ':grantid' => $tdata['id'],
                    ':user_id' => $tdata['userid'],
                    ':deleted' => '1'
                ));
                $row_affected = $STH->rowCount();
                if($row_affected == 1)
                {
                    $return = TRUE;
                }
                $DBH->commit();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        return $return;
    }
    
    public function SubmitUserGrant2($tdata)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = FALSE;
        try
            {
                $sql = "UPDATE `grants_applicants` set `mail_address` = :mail_address,`secondary_phone` = :secondary_phone,"
                            ."`nationality` = :nationality,`age` = :age, `resume` = :resume, `last_org_work` = :last_org_work,"
                            ."`pastbyline` = :pastbyline, `ref1` = :ref1, `ref2` = :ref2, `ref3` = :ref3, `interest` = :interest,"
                            ."`description_assignment` = :description_assignment, `statement_purpose` = :statement_purpose, `incomplete` = :incomplete where `application_id` = :application_id ";
                
                    $STH = $DBH->prepare($sql);
                    $STH->execute(array(
                        ':mail_address' => $tdata['mail_address'],
                        ':secondary_phone' => $tdata['secondary_phone'],
                        ':nationality' => $tdata['nationality'],
                        ':age' => $tdata['age'],
                        ':resume' => $tdata['resume'],
                        ':last_org_work' => addslashes($tdata['last_org_work']),
                        ':pastbyline' => addslashes($tdata['pastbyline']),
                        ':ref1' => addslashes($tdata['ref1']),
                        ':ref2' => addslashes($tdata['ref2']),
                        ':ref3' => addslashes($tdata['ref3']),
                        ':interest' => addslashes($tdata['interest']),
                        ':description_assignment' => addslashes($tdata['description_assignment']),
                        ':statement_purpose' => addslashes($tdata['statement_purpose']),
                        ':application_id' => $tdata['application_id'],
                        ':incomplete' => '0'
                    ));
                $row_affected = $STH->rowCount();
                if($row_affected == 1)
                {
                    $return = TRUE;
                }
                $DBH->commit();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        return $return;
    }

    public function SubmitUserGrant($tdata)
    {
        $my_DBH = new DatabaseHandler();
        $DBH = $my_DBH->raw_handle();
        $DBH->beginTransaction();
        $return = FALSE;
        try
            {
                $sql = "UPDATE `grants_applicants` set `mail_address` = :mail_address,`secondary_phone` = :secondary_phone,"
                            ."`nationality` = :nationality,`age` = :age, `resume` = :resume, `last_org_work` = :last_org_work,"
                            ."`pastbyline` = :pastbyline, `ref1` = :ref1, `ref2` = :ref2, `ref3` = :ref3, `interest` = :interest,"
                            ."`description_assignment` = :description_assignment, `statement_purpose` = :statement_purpose, `incomplete` = :incomplete, `complete` = :complete where `application_id` = :application_id ";
                
                    $STH = $DBH->prepare($sql);
                    $STH->execute(array(
                        ':mail_address' => $tdata['mail_address'],
                        ':secondary_phone' => $tdata['secondary_phone'],
                        ':nationality' => $tdata['nationality'],
                        ':age' => $tdata['age'],
                        ':resume' => $tdata['resume'],
                        ':last_org_work' => addslashes($tdata['last_org_work']),
                        ':pastbyline' => $tdata['pastbyline'],
                        ':ref1' => addslashes($tdata['ref1']),
                        ':ref2' => addslashes($tdata['ref2']),
                        ':ref3' => addslashes($tdata['ref3']),
                        ':interest' => addslashes($tdata['interest']),
                        ':description_assignment' => addslashes($tdata['description_assignment']),
                        ':statement_purpose' => addslashes($tdata['statement_purpose']),
                        ':application_id' => $tdata['application_id'],
                        ':incomplete' => '0',
                        ':complete' => '1'
                    ));
                $row_affected = $STH->rowCount();
                if($row_affected == 1)
                {
                    $this->insertAdminData($tdata['application_id']);
                    $return = TRUE;
                }
                $DBH->commit();
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
                $DBH->rollBack();
            }
        return $return;
    }

    public function SaveForLaterEmailTemplate($username,$applicationid)
    {
        $template='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
                    <html>
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                            <title>Link to your saved application</title>
                            <meta name="viewport" content="width=device-width">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="x-apple-disable-message-reformatting">
                            <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
                            <!--[if mso]>
                                    <style>
                                        * {font-family:Arial, sans-serif !important;}
                                    </style>
                            <![endif]-->
                            <style type="text/css">
                                /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
                            html,
                            body {
                                margin: 0 auto !important;
                                padding: 0 !important;
                                height: 100% !important;
                                width: 100% !important;
                                font-family:Raleway, Arial, Tahoma, Segoe;
                                font-size: 14px;
                                font-weight: 600;
                                background: #e4e0e1;
                            }

                            /* What it does: Stops email clients resizing small text. */
                            * {
                                -ms-text-size-adjust: 100%;
                                -webkit-text-size-adjust: 100%;
                            }
                             /* iOS BLUE LINKS */
                        a[x-apple-data-detectors] {
                            color: inherit !important;
                            text-decoration: none !important;
                            font-size: inherit !important;
                            font-family: inherit !important;
                            font-weight: inherit !important;
                            line-height: inherit !important;
                        }
                        table,
                            td {
                                mso-table-lspace: 0pt !important;
                                mso-table-rspace: 0pt !important;
                            }

                            /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
                            table {
                                border-spacing: 0 !important;
                                border-collapse: collapse !important;
                                table-layout: fixed !important;
                                margin: 0 auto !important;
                            }
                         /* MOBILE STYLES */
                        @media screen and (max-width: 600px) {

                            /* ALLOWS FOR FLUID TABLES */
                            .wrapper {
                              width: 100% !important;
                                max-width: 100% !important;

                            }

                            /* ADJUSTS LAYOUT OF LOGO IMAGE */
                            .logo img {
                              margin: 0 auto !important;
                            }

                            .img-max {
                              max-width: 100% !important;
                              width: 100% !important;
                              height: auto !important;
                            }



                            }
                            @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
                                    .wrapper {
                                        min-width: 375px !important;
                                    }
                                }
                            /* ANDROID CENTER FIX */

                            </style>
                        </head>

                        <body style="padding:0;margin:0;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tbody>
                                <tr>
                                  <td scope="col">
                                    <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
                                      <tbody>           
                                        <tr>
                                          <th scope="col" height="20" valign="top">
                                            <img src="https://thakur-foundation.org/newsletter-images/top-bar.jpg" />
                                          </th>
                                        </tr>
                                        <tr>
                                          <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://thakur-foundation.org/newsletter-images/logo.png" alt="" /></td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top">
                                                <table width="550" cellpadding="0" cellspacing="0">
                                                    <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>
                                                    <tr><td height="30" style="line-height: 22px;font-size: 14px;color: #000">Dear '.$username.',</td></tr>
                                                    <tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
                                                    <tr><td style="line-height: 24px;font-size: 14px;color: #000">
                                                    Thank you for applying for a grant to the Thakur Foundation. We noticed that your application is partially filled. <br><br>
                                                        Please log in to complete your application when you are ready to provide us with the remainder of the information we need to review your application.
                                                        <br> 

                                                        Grant application ID <span style="color: #db5c55; text-decoration: none;">"'.$applicationid.'"</span><br>

                            <a href="https://thakur-foundation.org/grant.php" style="color: #db5c55; text-decoration: none;">Login</a>
                                                    </td></tr>
                                                    <tr><td height="20" style="line-height: 20px;font-size: 0"></td></tr>

                                                    <tr><td height="20" style="line-height: 22px;font-size: 14px;color: #000">We look forward to reviewing your completed application.</td></tr>
                                                    <tr><td height="20" style="line-height: 20px;font-size: 0"></td></tr>

                                                    <tr><td style="line-height: 22px;font-size: 14px;color: #000">Sincerely, <br>Thakur Foundation</td></tr>
                                                    <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>

                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" style="background:#f1f1f1;">
                                                <table width="550" cellpadding="0" cellspacing="0">
                                                    <tr><td height="25" style="line-height: 15px;font-size: 0"></td></tr>
                            <!--                        <tr><td height="20" style="line-height: 20px;font-size: 0"></td></tr>-->
                                                    <tr><td style="line-height:13px;font-size:11px;color: #231f20">
                                                    This e-mail communication and any attachments may be privileged and confidential to Thakur Family Foundation, Inc and are intended only for the use of the recipients named above. If you are not the intended recipient, please do not review, disclose, disseminate, distribute or copy this e-mail and its attachments. If you have received this email in error, please delete this message along with all its attachments and notify us immediately at <a href="mailto:support@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">support@thakur-foundation.org</a>. <br> Thank you.<br><br>

                                                    Thakur Family Foundation, Inc<br>
                                                    100 1st Ave North, Ste 3603
                                                    St Petersburg, FL 33701<br>
                                                    +1.727.471.7453<br>
                                                    <a href="https://thakur-foundation.org/" style="color: #db5c55; text-decoration: none;">www.thakur-foundation.org</a>

                                                    </td></tr>
                                                    <tr><td height="5" style="line-height:5px;font-size: 0"></td></tr>

                                                </table>
                                            </td>
                                        </tr>

                                          <tr>
                                          <td height="40" style="background: #f1f1f1;;font-size: 12px;color: #000;" valign="middle" align="center">Copyright &copy; 2019 - All Right Reserved</td>
                                        </tr>

                                      </tbody>
                                    </table>

                                  </td>
                                </tr>
                              </tbody>
                            </table>
                        </body>
                    </html>';
        
        return $template;
    }
    
    public function SendSaveForLaterMail($fname,$application_id,$email)
    {
        $return = FALSE;
        
        $template = $this->SaveForLaterEmailTemplate($fname,$application_id);
        
        $mail = new PHPMailer;

        //$mail->IsSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
        $mail->Port = 465;                                    // Set the SMTP port
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'grants.administrator@thakur-foundation.org';                // SMTP username
        $mail->Password = 'QR-5=ZDA85^U';                  // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
        $mail->SMTPDebug=1;
        $mail->SetFrom = 'grants.administrator@thakur-foundation.org';
        $mail->AddReplyTo('grants.administrator@thakur-foundation.org', 'Thakur Foundation');
        $mail->FromName = 'Thakur Foundation';
        $mail->AddAddress($email);  // Add a recipient
        //$mail->AddAddress('ellen@example.com');               // Name is optional

        $mail->IsHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Thakur Foundation - Thank you for your interest in applying for a grant';
        //$body = ''
        $reg = $template;
        $mail->Body    = $reg ;

        if($mail->Send())
        {
            $return = TRUE;
        }
        
        return $return;
    }

    public function SubmitEmailTemplate($username,$applicationid)
    {
        $template='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
                    <html>
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    <title>Thank you for submitting your grant application</title>
                    <meta name="viewport" content="width=device-width">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="x-apple-disable-message-reformatting">
                    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
                    <!--[if mso]>
                            <style>
                                * {font-family:Arial, sans-serif !important;}
                            </style>
                    <![endif]-->
                    <style type="text/css">
                    /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
                            html,
                            body {
                                margin: 0 auto !important;
                                padding: 0 !important;
                                height: 100% !important;
                                width: 100% !important;
                                font-family:Raleway, Arial, Tahoma, Segoe;
                                font-size: 14px;
                                font-weight: 600;
                                background: #e4e0e1;
                            }

                            /* What it does: Stops email clients resizing small text. */
                            * {
                                -ms-text-size-adjust: 100%;
                                -webkit-text-size-adjust: 100%;
                            }
                             /* iOS BLUE LINKS */
                        a[x-apple-data-detectors] {
                            color: inherit !important;
                            text-decoration: none !important;
                            font-size: inherit !important;
                            font-family: inherit !important;
                            font-weight: inherit !important;
                            line-height: inherit !important;
                        }
                        table,
                            td {
                                mso-table-lspace: 0pt !important;
                                mso-table-rspace: 0pt !important;
                            }

                            /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
                            table {
                                border-spacing: 0 !important;
                                border-collapse: collapse !important;
                                table-layout: fixed !important;
                                margin: 0 auto !important;
                            }
                         /* MOBILE STYLES */
                        @media screen and (max-width: 600px) {

                            /* ALLOWS FOR FLUID TABLES */
                            .wrapper {
                              width: 100% !important;
                                max-width: 100% !important;

                            }

                            /* ADJUSTS LAYOUT OF LOGO IMAGE */
                            .logo img {
                              margin: 0 auto !important;
                            }

                            .img-max {
                              max-width: 100% !important;
                              width: 100% !important;
                              height: auto !important;
                            }



                        }
                        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
                                .wrapper {
                                    min-width: 375px !important;
                                }
                            }
                        /* ANDROID CENTER FIX */

                    </style>
                    </head>

                    <body style="padding:0;margin:0;">



                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tbody>
                        <tr>
                          <td scope="col">
                            <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
                              <tbody>           
                                <tr>
                                  <th scope="col" height="20" valign="top">
                                    <img src="https://thakur-foundation.org/newsletter-images/top-bar.jpg" />
                                  </th>
                                </tr>
                                <tr>
                                  <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://thakur-foundation.org/newsletter-images/logo.png" /></td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">
                                        <table width="550" cellpadding="0" cellspacing="0">
                                            <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>
                                            <tr><td height="30" style="line-height: 22px;font-size: 14px;color: #000">Dear  '.$username.',</td></tr>
                                            <tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
                                            <tr>
                                              <td style="line-height: 24px;font-size: 14px;color: #000">
                                            Thank you for applying for a grant with the Thakur Foundation. <br>Please save this information for future communication with us. <br><br>

                                             Grant application ID<span style="color: #db5c55; text-decoration: none;"> "'.$applicationid.'"</span><br>
                                                  <a href="https://thakur-foundation.org/grant.php" style="color: #db5c55; text-decoration: none;">Login</a><br>

                                                <br>
                                                  Your application will be reviewed by the Foundation within the timeframe advertised. We may contact you should we ascertain that we need more information from you before making a decision. Once a decision has been made, we will inform you of the outcome. <br> In the meantime, you can check the status of your application at the link provided above. 

                                            </td></tr>
                                            <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                                            <tr><td style="line-height: 22px;font-size: 14px;color: #000">Sincerely, <br>Thakur Foundation</td></tr>
                                            <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>

                                        </table>
                                    </td>
                                </tr>
                                  <tr>
                                    <td align="center" valign="top" style="background:#f1f1f1;">
                                        <table width="550" cellpadding="0" cellspacing="0">
                                            <tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
                                            <tr><td style="line-height:13px;font-size:11px;color: #231f20">
                                            This e-mail communication and any attachments may be privileged and confidential to Thakur Family Foundation, Inc and are intended only for the use of the recipients named above. If you are not the intended recipient, please do not review, disclose, disseminate, distribute or copy this e-mail and its attachments. If you have received this email in error, please delete this message along with all its attachments and notify us immediately at <a href="mailto:support@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">support@thakur-foundation.org</a>. <br> Thank you.<br><br>

                                            Thakur Family Foundation, Inc<br>
                                            100 1st Ave North, Ste 3603
                                            St Petersburg, FL 33701<br>
                                            +1.727.471.7453<br>
                                            <a href="https://thakur-foundation.org/" style="color: #db5c55; text-decoration: none;">www.thakur-foundation.org</a>

                                            </td></tr>
                                            <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>

                                        </table>
                                    </td>
                                </tr>
                                 <tr>
                                  <td height="40" style="background: #f1f1f1;font-size: 12px;color: #000;" valign="middle" align="center">Copyright &copy; 2019 - All Right Reserved</td>
                                </tr>
                              </tbody>
                            </table>

                          </td>
                        </tr>
                      </tbody>
                    </table>

                    </body>
                    </html>';
        
        return $template;
    }
    
    public function SendSubmitMail($fname,$application_id,$email)
    {
        $return = FALSE;
        
        $template = $this->SubmitEmailTemplate($fname,$application_id);
        
        $mail = new PHPMailer;

        //$mail->IsSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
        $mail->Port = 465;                                    // Set the SMTP port
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'grants.administrator@thakur-foundation.org';                // SMTP username
        $mail->Password = 'QR-5=ZDA85^U';                  // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
        $mail->SMTPDebug=1;
        $mail->SetFrom = 'grants.administrator@thakur-foundation.org';
        $mail->AddReplyTo('grants.administrator@thakur-foundation.org', 'Thakur Foundation');
        $mail->FromName = 'Thakur Foundation';
        $mail->AddAddress($email);  // Add a recipient
        //$mail->AddAddress('ellen@example.com');               // Name is optional

        $mail->IsHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Thakur Foundation - Thank you for your interest in applying for a grant';
        //$body = ''
        $reg = $template;
        $mail->Body    = $reg ;

        if($mail->Send())
        {
            $return = TRUE;
        }
        
        return $return;
    }

    public function SendAdminSubmitMail($fname,$application_id)
    {
        $return = FALSE;
        
        $template = $this->SubmitAdminEmailTemplate($fname,$application_id);
        
        $mail = new PHPMailer;

        //$mail->IsSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
        $mail->Port = 465;                                    // Set the SMTP port
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'grants.administrator@thakur-foundation.org';                // SMTP username
        $mail->Password = 'QR-5=ZDA85^U';                  // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
        $mail->SMTPDebug=1;
        $mail->SetFrom = 'grants.administrator@thakur-foundation.org';
        $mail->AddReplyTo('grants.administrator@thakur-foundation.org', 'Thakur Foundation');
        $mail->FromName = 'Thakur Foundation';
        $mail->AddAddress('grants.administrator@thakur-foundation.org');  // Add a recipient
        //$mail->AddAddress('ellen@example.com');               // Name is optional

        $mail->IsHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Thakur Foundation - A new application has been submitted';
        //$body = ''
        $reg = $template;
        $mail->Body    = $reg ;

        if($mail->Send())
        {
            $return = TRUE;
        }
        
        return $return;
    }

    public function SubmitAdminEmailTemplate($fname,$application_id)
    {
        $template='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title> A new application has been submitted</title>
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="x-apple-disable-message-reformatting">
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
        <!--[if mso]>
                <style>
                    * {font-family:Arial, sans-serif !important;}
                </style>
        <![endif]-->
        <style type="text/css">
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
                html,
                body {
                    margin: 0 auto !important;
                    padding: 0 !important;
                    height: 100% !important;
                    width: 100% !important;
                    font-family:Raleway, Arial, Tahoma, Segoe;
                    font-size: 14px;
                    font-weight: 600;
                    background: #e4e0e1;
                }

                /* What it does: Stops email clients resizing small text. */
                * {
                    -ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%;
                }
                 /* iOS BLUE LINKS */
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }
            table,
                td {
                    mso-table-lspace: 0pt !important;
                    mso-table-rspace: 0pt !important;
                }

                /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
                table {
                    border-spacing: 0 !important;
                    border-collapse: collapse !important;
                    table-layout: fixed !important;
                    margin: 0 auto !important;
                }
             /* MOBILE STYLES */
            @media screen and (max-width: 600px) {

                /* ALLOWS FOR FLUID TABLES */
                .wrapper {
                  width: 100% !important;
                    max-width: 100% !important;
                    
                }

                /* ADJUSTS LAYOUT OF LOGO IMAGE */
                .logo img {
                  margin: 0 auto !important;
                }

                .img-max {
                  max-width: 100% !important;
                  width: 100% !important;
                  height: auto !important;
                }



            }
            @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
                    .wrapper {
                        min-width: 375px !important;
                    }
                }
            /* ANDROID CENTER FIX */

        </style>
        </head>

        <body style="padding:0;margin:0;">
         


        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td scope="col">
                <table style="margin:auto; mso-line-height-rule: exactly;background: #fff;" width="600" class="wrapper" cellpadding="0" cellspacing="0">
                  <tbody>           
                    <tr>
                      <th scope="col" height="20" valign="top">
                        <img src="https://thakur-foundation.org/newsletter-images/top-bar.jpg" />
                      </th>
                    </tr>
                    <tr>
                      <td style="background: #231f20;padding: 20px 0 20px 20px" bgcolor="#231f20"><img src="https://thakur-foundation.org/newsletter-images/logo.png" /></td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <table width="550" cellpadding="0" cellspacing="0">
                                <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>
                                <tr>
                                  <td height="30" style="line-height: 22px;font-size: 14px;color: #000">Dear Grants Administrator,</td></tr>
                                <tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
                                <tr>
                                  <td style="line-height: 24px;font-size: 14px;color: #000">
                                A new grant application has been submitted by  <span style="color: #db5c55; text-decoration: none;"> '.$fname.'.</span> <br>
                                Below is the application id. 
                                </td></tr> 
                                <tr><td height="5" style="line-height:5px;font-size: 0"></td></tr>
                                
                                <tr>
                                  <td style="line-height: 24px;font-size: 14px;color: #000">
                                Grant Application ID: <span style="color: #db5c55; text-decoration: none;"> "'.$application_id.'"</span>
                                </td></tr>
                                <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                                <tr><td style="line-height: 22px;font-size: 14px;color: #000">Sincerely, <br>Thakur Foundation</td></tr>
                                <tr><td height="30" style="line-height: 30px;font-size: 0"></td></tr>
                                
                            </table>
                        </td>
                    </tr>
                     <tr>
                        <td align="center" valign="top" style="background:#f1f1f1;">
                            <table width="550" cellpadding="0" cellspacing="0">
                                <tr><td height="15" style="line-height: 15px;font-size: 0"></td></tr>
                                <tr><td style="line-height:13px;font-size:11px;color: #231f20">
                                This e-mail communication and any attachments may be privileged and confidential to Thakur Family Foundation, Inc and are intended only for the use of the recipients named above. If you are not the intended recipient, please do not review, disclose, disseminate, distribute or copy this e-mail and its attachments. If you have received this email in error, please delete this message along with all its attachments and notify us immediately at <a href="mailto:support@thakur-foundation.org" style="color: #db5c55; text-decoration: none;">support@thakur-foundation.org</a>. <br> Thank you.<br><br>
                                  
                                Thakur Family Foundation, Inc<br>
                                100 1st Ave North, Ste 3603
                                St Petersburg, FL 33701<br>
                                +1.727.471.7453<br>
                                <a href="https://thakur-foundation.org/" style="color: #db5c55; text-decoration: none;">www.thakur-foundation.org</a>
                            
                                </td></tr>
                                <tr><td height="20" style="line-height:20px;font-size: 0"></td></tr>
                                
                            </table>
                        </td>
                    </tr>
                     <tr>
                      <td height="40" style="background: #f1f1f1;font-size: 12px;color: #000;" valign="middle" align="center">Copyright &copy; 2019 - All Right Reserved</td>
                    </tr>
                  </tbody>
                </table>

              </td>
            </tr>
          </tbody>
        </table>

        </body>
        </html>
        ';
        return $template;
    }

    //grant end
}

