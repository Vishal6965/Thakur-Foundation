<?php
require_once 'classes/thakurfoundation_config.php';

$obj = new FOUNDATION(); 

$action = stripslashes($_REQUEST['action']);

if($action == 'adduser')
{
    $tdata = array();
    
    $tdata = $_POST;
    
    if(!empty($tdata['fname']) && !empty($tdata['email']) && !empty($tdata['mobile']) && !empty($tdata['password']) && !empty($tdata['cpassword']))
    {
        if($tdata['password'] == $tdata['cpassword'])
        {
            if(!$obj->ChkUserEmailExist($tdata['email']))
            {
                $name = $_POST['fname'];
            
                $words = explode(" ", $name);

                $tdata['firstname'] = $words[0];

                if(isset($words[1]))
                {
                    $tdata['lastname'] = $words[1];

                }
                else
                {
                    $tdata['lastname'] = ""; 
                }
                //$lastname1 = $words[1];
                if(isset($words[2]))
                { 
                    $tdata['lastname'] = $words[2];
                }

                $tdata['password'] = md5($_POST['password']);

//                $tdata['cpassword'] = md5($_POST['cpassword']);
                
                if($obj->AddUser($tdata))
                {
                    $err_msg = 'Successfully registered';
                    $response = array('msg'=>$err_msg,'status'=>'0');
                    $tdata[] = $response;
                    echo json_encode($tdata);
                    exit(0);
                }
                else 
                {
                    $err_msg = 'Failed To Register';
                    $response = array('msg'=>$err_msg,'status'=>'1');
                    $tdata[] = $response;
                    echo json_encode($tdata);
                    exit(0);
                }
            }
            else
            {
                $err_msg = 'The Email id '.$tdata['email'].' Already Exist';
                $response = array('msg'=>$err_msg,'status'=>'1');
                $data[] = $response;
                echo json_encode($data);
                exit(0);
            }
        }
        else 
        {
            $err_msg = 'Password and confirm password not matched';
            $response = array('msg'=>$err_msg,'status'=>'1');
            $tdata[] = $response;
            echo json_encode($tdata);
            exit(0);
        }
    }
    else 
    {
        $err_msg = 'All Fields are mandatory';
        $response = array('msg'=>$err_msg,'status'=>'1');
        $tdata[] = $response;
        echo json_encode($tdata);
        exit(0);
    }
				
}

if($action == 'loginuser')
{
    $tdata = array();
    
    $tdata = $_POST;
    
    //print_r($tdata);die();
    
    if($tdata['email'] == '' || $tdata['password'] == '')
    {
        $err_msg = 'Username Or Password Is blank';
        $response = array('msg'=>$err_msg,'status'=>'1');
        $tdata[] = $response;
        echo json_encode($tdata);
        exit(0);
    }
    else 
    {
        if($obj->ChkValidUser($tdata['email'],$tdata['password']))
        {
            if($obj->DoUserLogin($tdata))
            {
                $err_msg = 'Successfully Login';
                $response = array('msg'=>$err_msg,'status'=>'0');
                $tdata[] = $response;
                echo json_encode($tdata);
                exit(0);
            }
            else 
            {
                $err_msg = 'Failed to login';
                $response = array('msg'=>$err_msg,'status'=>'0');
                $tdata[] = $response;
                echo json_encode($tdata);
                exit(0);
            }
        }
        else 
        {
            $err_msg = 'Enter Valid username password';
            $response = array('msg'=>$err_msg,'status'=>'1');
            $tdata[] = $response;
            echo json_encode($tdata);
            exit(0);
        }
    }
}

if($action == 'saveforlater')
{
    $tdata = array();
    
    $tdata = $_POST;
    
    $er = false;

    $err_msg = '';
    
    $tdata['resume'] = $_FILES['resume']['name'];
   
    
    $tdata['portfolio'] = $_FILES['portfolio']['name'];
    $totalFile = $tdata['filecount'];
    //echo $totalFile;
    //print_r($_FILES);die;
    
    if(isset($tdata['portfolio']) && count($tdata['portfolio']) > 0 &&  $tdata['portfolio'] != '' )
    {
        $portfolio = array();
        $portArray = array();
        for($i = 0; $i < $totalFile; $i++)
        {
            $_FILES['portfolio'] = $_FILES['file-'.$i];
            array_push($portArray,$_FILES['file-'.$i]['name']);
            if($_FILES["portfolio"]["name"][$i] != '')
            {
                $tdata['portfolios'] = time().'_'.$_FILES["portfolio"]["name"];
                
                $max_file_size = 26214400; // 25mb
                $valid_exts = array('pdf', 'mp4', 'mp3', 'flv');

                if($_FILES['portfolio']['size'] < $max_file_size )
                {
                    // get file extension
                    $ext = strtolower(pathinfo($_FILES['portfolio']['name'], PATHINFO_EXTENSION));

                    if (in_array($ext, $valid_exts))
                    {
                        $file_path = "upload/portfolio/";
                        
                        $file_path = $file_path.basename($tdata['portfolios']);
                        
                        move_uploaded_file($_FILES['portfolio']['tmp_name'], $file_path);
                        
                        
                    }
                    else
                    {
                        $er = TRUE;
                        $err_msg = 'Portfolio Document is not in proper format';
                        $response=array('msg'=>$err_msg,'status'=>1);
                        $tdata[]=$response;
                        echo json_encode($tdata);
                        exit(0);
                    }
                } 
                else
                {
                    $er = TRUE;
                    $err_msg = 'Size of the Portfolio Document is large';
                    $response=array('msg'=>$err_msg,'status'=>1);
                    $tdata[]=$response;
                    echo json_encode($tdata);
                    exit(0);
                }
            }
        }
    }
    else 
    {
        $tdata['portfolio'] = '';
    }
    
    
    if(isset($tdata['resume']) && $tdata['resume'] != '' )
    {
        $tdata['resume'] = time().'_'.$_FILES["resume"]["name"];
        $max_file_size = 2097152; // 20mb
        $valid_exts = array('pdf', 'doc', 'docx');

        if( $_FILES['resume']['size'] < $max_file_size )
        {
            // get file extension
            $ext = strtolower(pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION));
            
            if (in_array($ext, $valid_exts))
            {
                $file_path = "upload/resume/";
                
                $file_path = $file_path.basename($tdata['resume']);
                
                move_uploaded_file($_FILES['resume']['tmp_name'], $file_path);
            }
            else
            {
                $er = TRUE;
                $err_msg = 'Document is not in proper format';
                $response=array('msg'=>$err_msg,'status'=>1);
                $tdata[]=$response;
                echo json_encode($tdata);
                exit(0);
            }
        } 
        else
        {
            $er = TRUE;
            $err_msg = 'Size of the Document is large';
            $response=array('msg'=>$err_msg,'status'=>1);
            $tdata[]=$response;
            echo json_encode($tdata);
            exit(0);
        }
    }
    elseif(isset($_POST['old_resume']) && $_POST['old_resume'] != '')
    {
        $tdata['resume'] = $_POST['old_resume'];
    }
    else 
    {
        $tdata['resume'] = '';
    }
    
    
    if(!$er)
    {
        $obj->SaveForLater($tdata);
            
        if(isset($tdata['application_id']) && $tdata['application_id'] != '')
        {
            //echo"<pre>";print_r($tdata);die;
            $obj->UpdateUserGrant($tdata);
//            {
//                if($obj->ChkPortfolioExist($tdata['application_id'],$tdata['user_id']))
//                {
//                    $obj->UpdatePortfolio($tdata);
//                }
//                else 
//                {
                    $c = count($tdata['portfolio']);
                        
                    if($c > 0)
                    {
                        $obj->AddGrantPortfolio($tdata['application_id'],$tdata['user_id'],$portArray);
                    }
//                }

                $obj->SendSaveForLaterMail($tdata['fname'],$tdata['application_id'],$tdata['email']);
                
                $err_msg = 'Successfully Updated';
                $response = array('msg'=>$err_msg,'status'=>'0');
                $tdata[] = $response;
                echo json_encode($tdata);
                exit(0);
        }
        else
        {
            $data = $obj->AddUserGrant($tdata);
            
            if($data['result'] == '1')
            {
                if($obj->UpdateGrantApplicationId($data['application_id'],$data['last_id']))
                {
                    $c = count($tdata['portfolio']);
                        
                    if($c > 0)
                    {
                        $obj->AddGrantPortfolio($data['application_id'],$tdata['user_id'],$portArray);
                    }
                        
                    $obj->SendSaveForLaterMail($tdata['fname'],$data['application_id'],$tdata['email']);

                    $err_msg = 'Successfully Saved';
                    $response = array('msg'=>$err_msg,'status'=>'0');
                    $tdata[] = $response;
                    echo json_encode($tdata);
                    exit(0);
                }
                else 
                {
                    $err_msg = 'Failed To Save';
                    $response = array('msg'=>$err_msg,'status'=>'1');
                    $tdata[] = $response;
                    echo json_encode($tdata);
                    exit(0);
                }
                
            }
            else 
            {
                $err_msg = 'Failed To Save';
                $response = array('msg'=>$err_msg,'status'=>'1');
                $tdata[] = $response;
                echo json_encode($tdata);
                exit(0);
            }
        }
    }
				
}

if($action == 'deleteresume')
{
    $tdata = array();
    
    $tdata = $_POST;
    
    if($obj->RemoveResume($tdata))
    {
        $err_msg = 'Deleted Successfully';
        $response = array('msg'=>$err_msg,'status'=>'0');
        $tdata[] = $response;
        echo json_encode($tdata);
        exit(0);
    }
    else
    {
        $err_msg = 'Failed to Delete';
        $response = array('msg'=>$err_msg,'status'=>'1');
        $data[] = $response;
        echo json_encode($data);
        exit(0);
    }
				
}

if($action == 'deleteportfolio')
{
    $tdata = array();
    
    $tdata = $_POST;
    
    if($obj->RemovePortfolio($tdata))
    {
        $err_msg = 'Deleted Successfully';
        $response = array('msg'=>$err_msg,'status'=>'0');
        $tdata[] = $response;
        echo json_encode($tdata);
        exit(0);
    }
    else
    {
        $err_msg = 'Failed to Delete';
        $response = array('msg'=>$err_msg,'status'=>'1');
        $data[] = $response;
        echo json_encode($data);
        exit(0);
    }
				
}

if($action == 'submit')
{
    $tdata = array();
    
    $tdata = $_POST;
    
    $er = false;
    
    $tdata['resume'] = $_FILES['resume']['name'];
    
    $tdata['portfolio'] = $_FILES['portfolio']['name'];

    $totalFile = $tdata['filecount'];

    $isPortfolio = $tdata['is_portfolio'];

    //$po = array_diff($tdata['portfolio'], $tdata['removed_portfolio']);

    //print_r($tdata['portfolio']);

    // foreach($tdata['removed_portfolio'] as $v)
    // {
    //     $pos = array_search('Linus Trovalds', $hackers);

    //     echo 'Linus Trovalds found at: ' . $pos;

    //     unset($hackers[$pos]);
    // } 
    
   // print_r($po);die();
    
    
    if(isset($tdata['portfolio']) && $isPortfolio > 0 &&  $tdata['portfolio'] != '' )
    {
        $portfolio = array();
        $subPortArray = array();
        for($i = 0; $i < $totalFile; $i++)
        {

            $_FILES['portfolio'] = $_FILES['file-'.$i];
            array_push($subPortArray,$_FILES['file-'.$i]['name']);

            if($_FILES["portfolio"]["name"][$i] != '')
            {
                $tdata['portfolios'] = time().'_'.$_FILES["portfolio"]["name"];
                
                $max_file_size = 26214400; // 25mb
                $valid_exts = array('pdf', 'mp4', 'mp3', 'flv');

                if($_FILES['portfolio']['size'] < $max_file_size )
                {
                    // get file extension
                    $ext = strtolower(pathinfo($_FILES['portfolio']['name'], PATHINFO_EXTENSION));
                    //echo json_encode($ext);exit(0);
                    if (in_array($ext, $valid_exts))
                    {
                        $file_path = "upload/portfolio/";
                        
                        $file_path = $file_path.basename($tdata['portfolios']);
                        
                        move_uploaded_file($_FILES['portfolio']['tmp_name'], $file_path);
                        
                        
                    }
                    else
                    {
                        $er = TRUE;
                        $err_msg = 'Portfolio Document is not in proper format';
                        $response=array('msg'=>$err_msg,'status'=>1);
                        $tdata[]=$response;
                        echo json_encode($tdata);
                        exit(0);
                    }
                } 
                else
                {
                    $er = TRUE;
                    $err_msg = 'Size of the Portfolio Document is large';
                    $response=array('msg'=>$err_msg,'status'=>1);
                    $tdata[]=$response;
                    echo json_encode($tdata);
                    exit(0);
                }
            }
        }
    }
    else 
    {
        $tdata['portfolio'] = '';
    }
    
    
    if(isset($tdata['resume']) && $tdata['resume'] != '' )
    {
        $tdata['resume'] = time().'_'.$_FILES["resume"]["name"];
        $max_file_size = 2097152; // 20mb
        $valid_exts = array('pdf', 'doc', 'docx');

        if( $_FILES['resume']['size'] < $max_file_size )
        {
            // get file extension
            $ext = strtolower(pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION));
            
            if (in_array($ext, $valid_exts))
            {
                $file_path = "upload/resume/";
                
                $file_path = $file_path.basename($tdata['resume']);
                
                move_uploaded_file($_FILES['resume']['tmp_name'], $file_path);
            }
            else
            {
                $er = TRUE;
                $err_msg = 'Document is not in proper format';
                $response=array('msg'=>$err_msg,'status'=>1);
                $tdata[]=$response;
                echo json_encode($tdata);
                exit(0);
            }
        } 
        else
        {
            $er = TRUE;
            $err_msg = 'Size of the Document is large';
            $response=array('msg'=>$err_msg,'status'=>1);
            $tdata[]=$response;
            echo json_encode($tdata);
            exit(0);
        }
    }
    elseif(isset($_POST['old_resume']) && $_POST['old_resume'] != '')
    {
        $tdata['resume'] = $_POST['old_resume'];
    }
    else 
    {
        $tdata['resume'] = '';
    }
    
    
    if(!$er)
    {
        

        $obj->SaveForLater($tdata);
           // print_r($tdata['portfolio']);die;
        if($tdata['mail_address'] == '' || $tdata['nationality'] == '' || $tdata['age'] == '' || $tdata['resume'] == '' ||  $isPortfolio == 0 || $tdata['last_org_work'] == '' || $tdata['pastbyline'] == '' || $tdata['ref1'] == '' || $tdata['ref2'] == '' || $tdata['interest'] == '' || $tdata['description_assignment'] == '' || $tdata['statement_purpose'] == '' )
        {
            $err_msg = 'All fields marked with * are required';
                    $response = array('msg'=>$err_msg,'status'=>'1');
                    $tdata[] = $response;
                    echo json_encode($tdata);
                    exit(0);
        }
        // elseif(!isset($tdata['portfolio']) && $isPortfolio < 1 &&  $tdata['portfolio'] == ''  )
        // {
        //         $err_msg = 'portfolio is required';
        //             $response = array('msg'=>$err_msg,'status'=>'1');
        //             $tdata[] = $response;
        //             echo json_encode($tdata);
        //             exit(0);
        // }
        else 
        {
            if(isset($tdata['application_id']) && $tdata['application_id'] != '')
        {
            $obj->SubmitUserGrant($tdata);
            
            $c = count($tdata['portfolio']);

            if($c > 0)
            {
                $obj->AddGrantPortfolio($tdata['application_id'],$tdata['user_id'],$subPortArray);
            }
                
            $obj->SendSubmitMail($tdata['fname'],$tdata['application_id'],$tdata['email']);
            $obj->SendAdminSubmitMail($tdata['fname'],$tdata['application_id']);

            $err_msg = 'Successfully Updated';
            $response = array('msg'=>$err_msg,'status'=>'0');
            $tdata[] = $response;
            echo json_encode($tdata);
            exit(0);
        }
        else
        {
            $data = $obj->AddUserGrantSubmit($tdata);
            
            if($data['result'] == '1')
            {
                if($obj->UpdateGrantApplicationId($data['application_id'],$data['last_id']))
                {
                    $c = count($tdata['portfolio']);
                        
                    if($c > 0)
                    {
                        $obj->AddGrantPortfolio($data['application_id'],$tdata['user_id'],$subPortArray);
                    }

                    $obj->SendSubmitMail($tdata['fname'],$data['application_id'],$tdata['email']);
                        
                    $err_msg = 'Successfully Saved';
                    $response = array('msg'=>$err_msg,'status'=>'0');
                    $tdata[] = $response;
                    echo json_encode($tdata);
                    exit(0);
                }
                else 
                {
                    $err_msg = 'Failed To Save';
                    $response = array('msg'=>$err_msg,'status'=>'1');
                    $tdata[] = $response;
                    echo json_encode($tdata);
                    exit(0);
                }
                
            }
            else 
            {
                $err_msg = 'Failed To Save';
                $response = array('msg'=>$err_msg,'status'=>'1');
                $tdata[] = $response;
                echo json_encode($tdata);
                exit(0);
            }
        }
        }
    }
				
}

