<?php
session_start();
include('../../../../config/config.php');

$cardCode = $_POST['cardCode'];
$table = $_POST['table'];
$_SESSION['copyFromModalTbl'] = $_POST['copyFromModalTbl'];

?>
						<table class="table table-striped table-bordered table-hover copyFromTable" id="tbl<?php echo $_SESSION['copyFromModalTbl']; ?>">
							<thead>
								<tr>
									<th>#</th>
									<th>Select</th>
									<th class="">Doc No.</th>
									<th class="">Posting Date</th>
									<th class="">Due Date</th>
									<th class="">Customer Name</th>
									<th class="" style="min-width:200px">Remarks</th>
									<th class="">ObjType</th>
									<th class="d-none">Status</th>
									
								</tr>
							</thead>
							<tbody>
								
							
<?php
$itemno = 1;
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
													SELECT 
														T0.DocNum,
														T0.DocDate,
														T0.CardName,
														T0.Comments,
														T0.DocDueDate,
														T0.ObjType
														
														FROM $table T0
														INNER JOIN OCRD T1 ON T0.CardCode = T1.CardCode

														WHERE T1.FatherCard = '$cardCode' AND T0.DocStatus = 'O'

														UNION ALL

													SELECT 
														T0.DocNum,
														T0.DocDate,
														T0.CardName,
														T0.Comments,
														T0.DocDueDate,
														T0.ObjType
														
														FROM $table T0
														INNER JOIN OCRD T1 ON T0.CardCode = T1.CardCode

														WHERE T1.CardCode = '$cardCode' AND T0.DocStatus = 'O'

														

												

														");

	while (odbc_fetch_row($qry)) 
	{
		echo '<tr>
				<td>'.$itemno.'</td>
				<td class="text-center">
					<input type="checkbox" class="item-0" value="'.odbc_result($qry, 'DocNum').'">
				</td>
				<td class="item-1 ">'.odbc_result($qry, 'DocNum').'</td>
				<td class="item-2 ">'.SAPDateFormater(odbc_result($qry, 'DocDate')).'</td>
				<td class="item-5 ">'.SAPDateFormater(odbc_result($qry, 'DocDueDate')).'</td>
				<td class="item-3 ">'.odbc_result($qry, 'CardName').'</td>
				<td class="item-4 ">'.odbc_result($qry, 'Comments').'</td>
				<td class="item-5">'.odbc_result($qry, 'ObjType').'</td>
				<td class="item-6 d-none">N/A</td>
			
			</tr>';
		$itemno++;	  
	}

odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
		</tbody>
	</table>
	<script>
    $(document).ready(function() 
	{
        $('#tbl<?php echo $_SESSION['copyFromModalTbl']; ?>').dataTable({
			"bLengthChange": false,
		});
	});
    </script>
