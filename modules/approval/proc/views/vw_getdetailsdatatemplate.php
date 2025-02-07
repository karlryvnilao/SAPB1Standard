<?php
session_start();
include_once('../../../../config/config.php');

$code = $_GET['code'];

?>
<div class="">
<table id="tblTemplate" class="table table-striped table-bordered table-sm detailsTable" cellspacing="0"  style="background-color: white; width= 100%" cellspacing="0">
  <thead   style="border-bottom: 0 !important">
    <tr>
	  	<th class="text-right" style=" color: black; max-width:30px;" >#</th>
      <th style="color: black; min-width:300px;" >Approval Description</th>
    </tr>
  </thead>
  <tbody class="">
  

<?php
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."];
	SELECT 
		T1.Code,
		T1.Description,
		T1.TemplateCode,
		T1.DocEntry,
		T1.LineNum
		
		
	FROM [@OAPR] T0 
	INNER JOIN [@APR2] T1 ON T0.Code = T1.Code

	WHERE T0.Code = '$code'
	ORDER BY T1.LineNum ASC");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$Code = odbc_result($qry, "Code");
	$Description = odbc_result($qry, "Description");
	$TemplateCode = odbc_result($qry, "TemplateCode");
	$DocEntry = odbc_result($qry, "DocEntry");
	$LineNum = odbc_result($qry, "LineNum");
    
	echo 
		'<tr style="background-color: white; "  >
	 		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
				<span>'.$ctr.'</span>
				<button type="button" class="btn btnrowfunctionstemplate" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
					<i class="fas fa-caret-down" ></i>
				</button>
				 	<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
						<li class="deleterowapprover" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
				  </ul>
	 		</td>
		   <td>
				<div class="input-group ">
					<input type="hidden" class="form-control matrix-cell approvalstageid" value="'.$TemplateCode.'" style="outline: none; border:none"/>
					<input type="text" class="form-control matrix-cell approvalstagename" value="'.$Description.'" style="outline: none; border:none" readonly/>
					  <button class="btn " type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#ApprovalStageModal" data-backdrop="false">
						<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
					  </button>
				</div>
		  </td>
    	</tr>';
			
	$ctr += 1;
				
	}
	?>
		<tr style="background-color: white; "  >
			<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
				<span><?php echo $ctr; ?></span>
				<button type="button" class="btn d-none btnrowfunctionstemplate" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
					<i class="fas fa-caret-down" ></i>
				</button>
				 	<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
						<li class="deleterowapprover" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
				  </ul>
	 		</td>
	 		<td >
				<div class="input-group ">
					<input type="hidden" class="form-control matrix-cell approvalstageid"  style="outline: none; border:none"/>
					<input type="text" class="form-control matrix-cell approvalstagename" style="outline: none; border:none" readonly/>
					  <button class="btn " type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#ApprovalStageModal" data-backdrop="false">
						<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
					  </button>
				</div>
		  </td>
    	</tr>
	  </tbody>
</table>
</div>

<?php
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
