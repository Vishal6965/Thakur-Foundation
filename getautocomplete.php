 <?php include('config.php');

function temp($id)
{

	echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script>

var id = '". $id."';

    $.ajax({
		type: 'POST',
		url: 'https://www.thakur-foundation.org/getapplinfo.php',
		data:{ id:id },
		success: function(data){
			//debugger;
			console.log(data);
			var obj = JSON.parse(data);

			console.log(obj);
			//console.log(obj['response'][0].application_id);
			$('#appl').attr('readonly',true);
			$('#appl').val(id);
			$('#firstname').val(obj['imgresponse1'][0].name);
			$('#lastname').val(obj['imgresponse1'][0].lastname);
			$('#datepicker').val(obj['imgresponse1'][0].recdate);
			$('#grantstatus').val(obj['imgresponse1'][0].grant_status);
			$('#project_impact_statement').val(obj['response'][0].project_impact_statement);
			$('#datepicker1').val(obj['response'][0].review_date);
			$('#approved_grant_amount').val(obj['response'][0].approved_grant_amount);
			$('#approved_expense_amount').val(obj['response'][0].approved_expense_amount);
			$('#datepicker2').val(obj['response'][0].first_tranche_release_date);
			$('#first_tranche_amount').val(obj['response'][0].first_tranche_amount);
			$('#first_tranche_amount_paid').val(obj['response'][0].first_tranche_amount_paid);
			$('#first_tranche_amount_paid').val(obj['response'][0].first_tranche_amount_paid);
			$('#first_expense_tranche_amount').val(obj['response'][0].first_expense_tranche_amount);
			$('#first_expense_tranche_paid').val(obj['response'][0].first_expense_tranche_paid);
			$('#datepicker3').val(obj['response'][0].projected_interim_review_date);
			$('#datepicker4').val(obj['response'][0].actual_interim_review_date);
			$('#interim_tranche_amount').val(obj['response'][0].interim_tranche_amount);
			$('#interim_tranche_amount_paid').val(obj['response'][0].interim_tranche_amount_paid);
			$('#datepicker5').val(obj['response'][0].projected_publication_date);
			$('#datepicker6').val(obj['response'][0].actual_publication_date);
			$('#datepicker10').val(obj['response'][0].final_tranche_release_date);
			$('#final_tranche_amount').val(obj['response'][0].final_tranche_amount);
			$('#datepicker7').val(obj['response'][0].final_expense_release_date);
			$('#final_expense_amount').val(obj['response'][0].final_expense_amount);
			$('#final_tranche_paid').val(obj['response'][0].final_tranche_paid);
			$('#final_expense_paid').val(obj['response'][0].final_expense_paid);
			$('#grantstatus').val(obj['response'][0].grant_status);
			$('#mentors').val(obj['response'][0].mentor_id);
			$('#datepicker8').val(obj['response'][0].completion_date);
			$('#datepicker9').val(obj['response'][0].publication_date);
			$('#datepicker11').val(obj['response'][0].project_start_release_date);




		} 
	});




</script>";
 
 }
 ?>