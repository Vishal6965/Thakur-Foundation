function validateform() { 

       // calamount();
    var errors=[];
	var ap_amt=$('#approved_grant_amount').val().replace(/,/g, '');
	var first_t_amt=$('#first_tranche_amount').val().replace(/,/g, '');
	var first_expense_tranche_amount=$('#first_expense_tranche_amount').val().replace(/,/g, '');
	var appexpense=$('#approved_expense_amount').val().replace(/,/g, '');

	var intrimtranch=$('#interim_tranche_amount').val().replace(/,/g, '');
	var finaltranch=$('#final_tranche_amount').val().replace(/,/g, '');
	var finalexpense=$('#final_expense_amount').val().replace(/,/g, '');
	
	let res= appexpense_validate();
		if(!res.status){errors.push(res.message);}
	let _first_trech=first_tranche_amount_validate(ap_amt,first_t_amt);
		if(!_first_trech.status){errors.push(_first_trech.message);}
	let _ftev=first_tranche_expense_validate(ap_amt,first_t_amt,appexpense,first_expense_tranche_amount)
		if(!_ftev.status){errors.push(_ftev.message);}

	let _int=intrimtranche_validate(ap_amt,first_t_amt,intrimtranch);
			if(!_int.status){errors.push(_int.message);}
	var _finaltrancheamt=finaltranche_validate(ap_amt,first_t_amt,intrimtranch,finaltranch);
		if(!_finaltrancheamt.status){errors.push(_finaltrancheamt.message);}
	
	var _finalexpense=finalexpense_validate(appexpense,first_expense_tranche_amount,finalexpense);
		if(!_finalexpense.status){errors.push(_finalexpense.message);}

	let dt1=ReceiptReviewDate_Compair();
		if(!dt1.status){errors.push(dt1.message);}
	let dt2=ProjectStartDate_compair();
		if(!dt2.status){errors.push(dt2.message);}
	let dt3=FirstTrancheReleaseDate_compair();
		if(!dt3.status){errors.push(dt3.message);}
	let dt4=ProjectedInterimReviewDate_compair();
		if(!dt4.status){errors.push(dt4.message);}
	let dt5=ActualInterimReviewDate_compair();
		if(!dt5.status){errors.push(dt5.message);}
	let dt6=ProjectedPublicationDate_compair();
		if(!dt6.status){errors.push(dt6.message);}
	// let dt7=ActualPublicationDate_compair();
	// 	if(!dt7.status){errors.push(dt7.message);}
	let dt8=FinalTrancheReleaseDate_compair();
		if(!dt8.status){errors.push(dt8.message);}
	let dt9=PROJECTCOMPLETIONCompletionDate_compair();
		if(!dt9.status){errors.push(dt9.message);}
	let dt10=PROJECTCOMPLETIONCompletionPublicationDate_compair();
		if(!dt10.status){errors.push(dt10.message);}


       if(errors.length > 0 )
       {
		     alert(errors[0]);
		     return false;
       }

        // if (!validatedate('#datepicker2', '#datepicker11')) {
        //     alert('first tranche release date should greater than project start date');
        //     //document.getElementById("first_tranche_release_date").focus();
        //     return false;
        // }

        
        // if (!validatedate('#datepicker10', '#datepicker11')) {
        //     alert('Final tranche release date should be greater than project start date');
        //     //document.getElementById("first_tranche_release_date").focus();
        //     return false;
        // }

        // if (!validatedate('#datepicker8', '#datepicker11')) {
        //     alert('Completion Date should be greater than project start date');
        //     //document.getElementById("first_tranche_release_date").focus();
        //     return false;
        // }
    }


function ReceiptReviewDate_validate(){
	let r=ReceiptReviewDate_Compair();
	if(!r.status){
		alert(r.message);
		$('#datepicker1').val(null);
	}
	return true;
}
  function ProjectStartDate_validate(){
	let r=ProjectStartDate_compair();
		if(!r.status){
			alert(r.message);
			$('#datepicker11').val(null);
		}
		return true;
  }
  function FirstTrancheReleaseDate_validate(){
	let r=FirstTrancheReleaseDate_compair();
		if(!r.status){
			alert(r.message);
			$('#datepicker2').val(null);
		}
		return true;
  }

  	 function ProjectedInterimReviewDate_validate(){
		let r=ProjectedInterimReviewDate_compair();
			if(!r.status){
				alert(r.message);
				$('#datepicker3').val(null);
			}
			return true;
		}
  function ActualInterimReviewDate_validate(){
		let r=ActualInterimReviewDate_compair();
		if(!r.status){
			alert(r.message);
			$('#datepicker4').val(null);
		}
		return true;	

  }

  function ProjectedPublicationDate_validate(){
  	let r=ProjectedPublicationDate_compair();
		if(!r.status){
			alert(r.message);
			$('#datepicker5').val(null);
		}
		return true;	
  }
	function ActualPublicationDate_validate(){
		let r=ActualPublicationDate_compair();
		if(!r.status){
			alert(r.message);
			$('#datepicker6').val(null);
		}
		return true;
	}
	function FinalTrancheReleaseDate_validate(){
		let r=FinalTrancheReleaseDate_compair();
		if(!r.status){
			alert(r.message);
			$('#datepicker10').val(null);
		}
		return true;
	}

	function PROJECTCOMPLETIONCompletionDate_validate(){
		let r=PROJECTCOMPLETIONCompletionDate_compair();
		if(!r.status){
			alert(r.message);
			$('#datepicker8').val(null);
		}
		return true;
	}

	function PROJECTCOMPLETIONCompletionPublicationDate_validate(){
		let r=PROJECTCOMPLETIONCompletionPublicationDate_compair();
		if(!r.status){
			alert(r.message);
			$('#datepicker9').val(null);
		}
		return true;
	}

    function ReceiptReviewDate_Compair()
    {
    	let rview_date=$('#datepicker1').val();
    	if(!rview_date)
    		return {status:true};
    	let recpt_date= $('#datepicker').val();
    	if(!recpt_date)
    		return { message:'Receipt Date cannot be empty.',status:false}
    	if(recpt_date > rview_date)
    		return { message:'Review Date cannot be before Receipt Date.',status:false}
    	return {status:true};
    }

    function ProjectStartDate_compair(){
    	let proj_stdate=$('#datepicker11').val();
    	if(!proj_stdate)
    		return {status:true};
		let recpt_date= $('#datepicker').val();
		let rview_date=$('#datepicker1').val();
		if(!recpt_date)
			return { message:'Receipt Date cannot be empty.',status:false}
		if(!rview_date)
			return { message:'Review Date cannot be empty.',status:false}
		if(proj_stdate < recpt_date)
    		return { message:'Project Start Date cannot be before Receipt Date.',status:false}
    	if(proj_stdate < rview_date)
    		return { message:'Project Start Date cannot be before Review Date.',status:false}
    	return {status:true};

    }
    function FirstTrancheReleaseDate_compair(){
       // debugger;
    	let _ftrdate=$('#datepicker2').val();
    	if(!_ftrdate)
    		return {status:true};
    	let rview_date=$('#datepicker1').val();
        let proj_stdate=$('#datepicker11').val();
        if(!proj_stdate)
            return  { message:'Enter Project Start Date to proceed further.',status:false}
    	if(!rview_date)
			return { message:'Review Date cannot be empty.',status:false}
    	if(rview_date > _ftrdate)
    		return { message:'Tranche 1 - Release Date cannot be before Review Date',status:false}
    	return {status:true}
    }

    function ProjectedInterimReviewDate_compair()
    {
    	let pint_rev_date=$('#datepicker3').val();
    	if(!pint_rev_date)
    		return {status:true};
    	let proj_stdate=$('#datepicker11').val();
    	if(!proj_stdate)
    		return  { message:'Enter Project Start Date to proceed further.',status:false}
    	let _ftrdate=$('#datepicker2').val();
    	if(!_ftrdate)
    		return  { message:'Tranche 1 - Release Date cannot be empty.',status:false}
    	if(proj_stdate > pint_rev_date)
    		return  { message:'Projected Interim Review Date cannot be before Project Start Date.',status:false}
    	if(_ftrdate >  pint_rev_date)
    		return  { message:'Projected Interim Review Date cannot be before Tranche 1 - Release Date.',status:false}
    	return {status:true}
    }

    function ActualInterimReviewDate_compair(){
    	let _act_int_rev_date=$('#datepicker4').val();
    	if(!_act_int_rev_date)
    		return {status:true};
    	let proj_stdate=$('#datepicker11').val();
    	if(!proj_stdate)
    		return  { message:'Enter Project Start Date to proceed further.',status:false}
    	let _ftrdate=$('#datepicker2').val();
    	if(!_ftrdate)
    		return  { message:'Tranche 1 - Release Date cannot be empty.',status:false}
    	if(proj_stdate > _act_int_rev_date)
    		return  { message:'Actual Interim Review Date cannot be before Project Start Date.',status:false}
    	if(_ftrdate >  _act_int_rev_date)
    		return  { message:'Actual Interim Review Date cannot be before Tranche 1 - Release Date.',status:false}
    	return {status:true}

    }

    function ProjectedPublicationDate_compair()
    {
    	let proj_publish_date=$('#datepicker5').val();
    	if(!proj_publish_date)
    		return {status:true};
    	let proj_stdate=$('#datepicker11').val();
    	if(!proj_stdate)
    		return  { message:'Enter Project Start Date to proceed further.',status:false}
    	let _act_int_rev_date=$('#datepicker4').val();
    	if(!_act_int_rev_date)
    		return   { message:'Actual Interim Review Date cannot be empty.',status:false}
    	if(proj_stdate > proj_publish_date)
    		return  { message:'Projected Publication Date cannot be before Project Start Date.',status:false}
    	if(_act_int_rev_date >  proj_publish_date)
    		return  { message:'Projected Publication Date cannot be before Actual Interim Review Date.',status:false}
    	return {status:true}

    }

    // function ActualPublicationDate_compair(){
    // 	let act_pub_date=$('#datepicker6').val();
    // 	if(!act_pub_date)
    // 		return {status:true};
    // 	let proj_stdate=$('#datepicker11').val();
    // 	if(!proj_stdate)
    // 		return  { message:'Enter Project Start Date to proceed further.',status:false}
    // 	let _act_int_rev_date=$('#datepicker4').val();
    // 	if(!_act_int_rev_date)
    // 		return   { message:'Actual Interim Review Date cannot be empty.',status:false}
    // 	if(proj_stdate > act_pub_date)
    // 		return  { message:'Actual Publication Date cannot be before Project Start Date.',status:false}
    // 	if(_act_int_rev_date >  act_pub_date)
    // 		return  { message:'Actual Publication Date cannot be before Actual Interim Review Date.',status:false}
    // 	return {status:true}
    // }

    function FinalTrancheReleaseDate_compair(){
    	let _FinalTrancheReleaseDate=$('#datepicker10').val();
    	if(!_FinalTrancheReleaseDate)
    		return {status:true};
    	let proj_stdate=$('#datepicker11').val();
    	if(!proj_stdate)
    		return  { message:'Enter Project Start Date to proceed further.',status:false}
    	let _act_pub_date=$('#datepicker6').val();
    	// if(!_act_pub_date)
    	// 	return  { message:'Actual Publication Date cannot be empty.',status:false}
    	if(proj_stdate > _FinalTrancheReleaseDate)
    		return  { message:'Grant Tranche 3 – Release Date cannot be before Project Start Date.',status:false}
    	// if(_act_pub_date >  _FinalTrancheReleaseDate)
    	// 	return  { message:'Grant Tranche 3 – Release Date cannot be before Actual Publication Date.',status:false}
    	return {status:true}

    }

    function PROJECTCOMPLETIONCompletionDate_compair(){
    	let _PROJECTCOMPLETIONCompletionDate=$('#datepicker8').val();
    	if(!_PROJECTCOMPLETIONCompletionDate)
    		return {status:true};
    	let proj_stdate=$('#datepicker11').val();
    	if(!proj_stdate)
    		return  { message:'Enter Project Start Date to proceed further.',status:false}
    	if(proj_stdate >= _PROJECTCOMPLETIONCompletionDate)
    		return  { message:'Project Completion Date cannot be equal to OR before Project Start Date.',status:false}
    	return {status:true}
    }
    function PROJECTCOMPLETIONCompletionPublicationDate_compair()
     {
    	let PROJECTCOMPLETIONCompletionPublicationDate=$('#datepicker9').val();
    	if(!PROJECTCOMPLETIONCompletionPublicationDate)
    		return {status:true};
    	let _PROJECTCOMPLETIONCompletionDate=$('#datepicker8').val();
    	if(!_PROJECTCOMPLETIONCompletionDate)
    		return  { message:'Project Completion Date cannot be empty.',status:false}
    	if(_PROJECTCOMPLETIONCompletionDate > PROJECTCOMPLETIONCompletionPublicationDate)
    		return  { message:'Project Publication Date cannot be before Project Completion Date.',status:false}
    	return {status:true}

    }

    function validatedate(end, start) {

       if($.trim($(end).val()) == ''){
         return true;
         }

        if (!/Invalid|NaN/.test(new Date(stringToDate($(end).val(),"mm-dd-yyyy","-")))) {

            return new Date(stringToDate($(end).val(),"mm-dd-yyyy","-")) > new Date(stringToDate($(start).val(),"mm-dd-yyyy","-"));

        }

        return isNaN(stringToDate($(end).val(),"mm-dd-yyyy","-")) && isNaN(stringToDate($(start).val(),"mm-dd-yyyy","-"))

            || (Number(stringToDate($(end).val(),"mm-dd-yyyy","-")) > Number(stringToDate($(start).val(),"mm-dd-yyyy","-")));

    }


function stringToDate(_date,_format,_delimiter)
{
            var formatLowerCase=_format.toLowerCase();
            var formatItems=formatLowerCase.split(_delimiter);
            var dateItems=_date.split(_delimiter);
            var monthIndex=formatItems.indexOf("mm");
            var dayIndex=formatItems.indexOf("dd");
            var yearIndex=formatItems.indexOf("yyyy");
            var month=parseInt(dateItems[monthIndex]);
            month-=1;
            var formatedDate = new Date(dateItems[yearIndex],month,dateItems[dayIndex]);
            return formatedDate;
}



function appexpense(){
	var res= appexpense_validate();
	if(!res.status){
		alert(res.message);
		return res.status;
	}
	return true;
}
 function _blur(){
	$('#first_tranche_amount').blur();
	$('#approved_grant_amount').blur();
	$('#first_expense_tranche_amount').blur();
	$('#approved_expense_amount').blur();
	$('#final_expense_amount').blur();
	$('#final_tranche_amount').blur();
	$('#interim_tranche_amount').blur();
 }
function firsttranche(){
var firstgrantvalue=$('#approved_grant_amount').val().replace(/,/g, '');
var first_tranche_amount=$('#first_tranche_amount').val().replace(/,/g, '');
if(!first_tranche_amount)
	return;
var first_expense_tranche_amount=$('#first_expense_tranche_amount').val().replace(/,/g, '');
var appexpense=$('#approved_expense_amount').val().replace(/,/g, '');

var tranche_amt_valid=first_tranche_amount_validate(firstgrantvalue,first_tranche_amount);
	if(!tranche_amt_valid.status){
		alert(tranche_amt_valid.message);
		_blur();
		return tranche_amt_valid.status;
	}
	var first_expense_validate=first_tranche_expense_validate(firstgrantvalue,
		first_tranche_amount,appexpense,first_expense_tranche_amount);
	if(!first_expense_validate.status && !first_expense_validate.flag){
			alert(first_expense_validate.message);
			_blur();
			return first_expense_validate.status;
		}

}

function appexpense_validate(){
	var grantvalue=$('#approved_grant_amount').val().replace(/,/g, '');
	var appexpense=$('#approved_expense_amount').val().replace(/,/g, '');
	// if(!grantvalue)
	// 	 return { message:'Approved Grant Amount Can not be empty',status:false,flag:false};
	if(parseInt(grantvalue) <= parseInt(appexpense))
		return {message:'Approved Expense Amount should be less than Approved Grant Amount',status:false,flag:false};
	else
		return {status:true,flag:true};
}

function first_tranche_amount_validate(grant_amt,tranch_amt){
	// if(!grant_amt)
	// 	 return { message:'Approved Grant Amount Can not be empty',status:false,flag:false};
	// else if(!tranch_amt)
	// 	return { message:'tranch_amt Can not be empty',status:false,flag:true};
	if(parseInt(grant_amt) < parseInt(tranch_amt))
		return {message:'Grant Tranche 1 Amount should be less than Approved Grant Amount',status:false,flag:false};
	else
		return {status:true,flag:true};
}
function first_tranche_expense_validate(aprve_grant_amt,tranch_amt,aprve_expense,tranch_expense)
{
	// if(!aprve_grant_amt)
	// 	 return { message:'Approved Grant Amount Can not be empty',status:false,flag:false};
	// else if(!aprve_expense)	
	// 	return { message:'Approved Expense Amount Can not be empty',status:false,flag:false};
	// else if(!tranch_amt)
	// 	return { message:'First Tranche Amount  Can not be empty',status:false,flag:true};
	
	if(parseInt(aprve_expense) < parseInt(tranch_expense))
		return {message:'Expense Tranche 1 Amount should be less than Approved Expense Amount',status:false,flag:false};
	if(parseInt(tranch_amt) < parseInt(tranch_expense))
		return {message:'Expense Tranche 1 Amount should be less than  Grant Tranche 1 Amount',status:false,flag:false};
	if(parseInt(aprve_grant_amt) < parseInt(tranch_expense))
		return {message:'Expense Tranche 1 Amount should be less than  Approved Grant Amount',status:false,flag:false};
	else
		return {status:true,flag:true};
}
function finaltranche_validate(aprve_grant_amt,first_tranche_amount,mintrimtranch,finaltranch){
	// if(!aprve_grant_amt)
	// 	 return { message:'Approved Grant Amount Can not be empty',status:false,flag:false};
	if(parseInt(aprve_grant_amt) < parseInt(finaltranch))
		return {message:'Grant Tranche 3 Amount should be less than Approved Grant Amount',status:false,flag:false};
     var approved_grant_amount= parseInt(aprve_grant_amt)-(parseInt(mintrimtranch) + parseInt(first_tranche_amount) );
	if(parseInt(finaltranch) > approved_grant_amount)
        //return {message:'Approved Grant Amount sholud be greater than or equal to sum of  First Tranche Amount,Interim Tranche Amount and Final Tranche Amount',status:false,flag:false};
		return {message:'Tranche amount cannot exceed Approved Grant Amount',status:false,flag:false};
        
	return {status:true,flag:true}
}
function intrimtranche_validate(aprve_grant_amt,first_tranche_amount,mintrimtranch){
	// if(!aprve_grant_amt)
	// 	 return { message:'Approved Grant Amount Can not be empty',status:false,flag:false};
	if(parseInt(aprve_grant_amt) < parseInt(mintrimtranch))
		return {message:'Grant Tranche 2 Amount should be less than Approved Grant Amount',status:false,flag:false};
    
	// if(parseInt(aprve_grant_amt) < (parseInt(mintrimtranch) + parseInt(first_tranche_amount)))
	// 	return {message:'Approved Grant Amount sholud be greater than or equal to sum of  First Tranche Amount and Interim Tranche Amount ',status:false,flag:false};
    var approved_first_tranche_amount = (parseInt(aprve_grant_amt) - parseInt(first_tranche_amount));
    if(parseInt(mintrimtranch) > approved_first_tranche_amount)    
        //return {message:'Approved Grant Amount sholud be greater than or equal to sum of  First Tranche Amount and Interim Tranche Amount ',status:false,flag:false};
        return {message:'Tranche amount cannot exceed Approved Grant Amount',status:false,flag:false};

          
	return {status:true,flag:true}
}

function finalexpense_validate(appexpense,first_exp,final_exp){
	// if(!appexpense)
	// 	 return { message:'Approved Grant Expense Can not be empty',status:false,flag:false};
	if(parseInt(appexpense) < parseInt(final_exp))
		return {message:'Expense Tranche 2 Amount should be less than Approved Grant Expense Amount',status:false,flag:false};
	// if(parseInt(appexpense) < (parseInt(first_exp) + parseInt(final_exp)))
	// 	return {message:'Approved Expense Amount sholud be greater than or equal to sum of First Expense Tranche Amount and Final Expense Amount ',status:false,flag:false};
    if(parseInt(final_exp) > (parseInt(appexpense) - parseInt(first_exp)))
        return {message:'Expense Tranche Amount cannot exceeds Approved Expense Amount',status:false,flag:false};

	return {status:true,flag:true}
}

function firstexpense(){
	var first_tranche_amount=$('#first_tranche_amount').val().replace(/,/g, '');
	if(!first_tranche_amount)
		return;
	var firstgrantvalue=$('#approved_grant_amount').val().replace(/,/g, '');
	var first_expense_tranche_amount=$('#first_expense_tranche_amount').val().replace(/,/g, '');
	var appexpense=$('#approved_expense_amount').val().replace(/,/g, '');
	var r=first_tranche_expense_validate(firstgrantvalue,first_tranche_amount,appexpense,first_expense_tranche_amount)
	if(!r.status){
		alert(r.message);
		 _blur();

		return false;
	}else{
		return true;
	}
}
function intrimtranche(){
	var intrimtranch=$('#interim_tranche_amount').val().replace(/,/g, '');
	if(!intrimtranch)
		return;
	var grantvalue=$('#approved_grant_amount').val().replace(/,/g, '');
	var first_tranche_amount=$('#first_tranche_amount').val().replace(/,/g, '');
	let res=intrimtranche_validate(grantvalue,first_tranche_amount,intrimtranch);
	if(!res.status){
		alert(res.message);
		_blur();
		return false;
	}else{
		return true;
	}
}

function finaltranche(){
	var grantvalue=$('#approved_grant_amount').val().replace(/,/g, '');
	var first_tranche_amount=$('#first_tranche_amount').val().replace(/,/g, '');
	var intrimtranch=$('#interim_tranche_amount').val().replace(/,/g, '');
	var finaltranch=$('#final_tranche_amount').val().replace(/,/g, '');
	var res=finaltranche_validate(grantvalue,first_tranche_amount,intrimtranch,finaltranch);
	if(!res.status){
		alert(res.message);
		_blur();
		return false;
	}else{
		return true;
	}
}

function finalexpense(){
		var appexpense=$('#approved_expense_amount').val().replace(/,/g, '');
		var first_expense_tranche_amount=$('#first_expense_tranche_amount').val().replace(/,/g, '');
		var finalexpense=$('#final_expense_amount').val().replace(/,/g, '');
		var res=finalexpense_validate(appexpense,first_expense_tranche_amount,finalexpense);
		if(!res.status){
			alert(res.message);
			_blur();
			return false;
		}else{
			return true;
		}
}