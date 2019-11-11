<?php

if(!empty($_SESSION['lalom_cid'])){
} else{
echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=login>"; 
exit();
}
if (!empty($_GET[member_type_id])  ) {
				$member_type_id =$_GET[member_type_id]; 
				#$condition = " concat(c.provcode,c.distcode) = '$distid' and p.hospcode = '".$_GET[hospcode]."' and";
				}


$sql = "SELECT
b.register_id,
b.cid,
b.pname,concat(p.prename,
b.fname,'  ',
b.lname) fullname,
if(b.sex = '1','ชาย','หญิง') sex,
b.birthdate,
b.member_type_id,
b.username,
b.`password`,
b.last_login,
b.version_usage,
b.profile_link,
b.occupation,c.occupationname,TIMESTAMPDIFF(YEAR,b.birthdate,date(NOW())) age_y,m.member_type_name
FROM bmi_trends.bmi_register_user  b  
LEFT JOIN bmi_trends.cprename  p on b.pname = p.id_prename
left join bmi_trends.coccupation c on b.occupation = c.occupationcode
left join bmi_trends.member_type m on b.member_type_id = m.member_type_id
where b.member_type_id in ($member_type_id)
group by b.register_id 
";
$query_sql = mysqli_query($con,$sql);

$i=1;
?>

<!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                       <i class="material-icons ">group</i> จัดการผู้ใช้งาน APPLICATION
                            </h2>
                            
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                            
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table ">
  
<tr>
    <td width="18%" align="right"><strong><h4>ประเภทผู้ใช้งาน :</h4></strong></td>
    <td ><div class="col-lg-7">
                <select class="form-control" id="member_type_id" name="member_type_id" data-placeholder="กรุณาเลือก ประเภท"onchange = "Refresh();" required="required">
       <option value="">เลือก</option>
																  <?
	$sql_race= "SELECT
m.member_type_id,
m.member_type_name
FROM bmi_trends.member_type  m
 ";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
      <? if($obj_race["member_type_id"]==$member_type_id){  ?>
      <option selected="selected" value="<?=$obj_race["member_type_id"];?>"><?=$obj_race["member_type_name"];?></option>
      <? }else { ?>
 
       <option  value="<?=$obj_race["member_type_id"];?>"><?=$obj_race["member_type_name"];?></option>
          <? } ?>
      <?
	}
	?>
       </select>
     </div></td>
    <td width="16%"><strong>
      <h4>&nbsp;</h4>
    </strong></td>
    <td width="33%"><div class="col-sm-10"></div></td>
  </tr> 
 

</table>
               
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
                                    <thead>
                                        <tr>
										<th width="5px">ที่</th>
										<td align="center" width="8px"><b>register_id</b></td>
                                            <td align="center"><strong>ชื่อ-สกุล</strong></td>
                                            <td align="center"><strong>USERNAME</strong></td>
                                         <!--   <th>PASSWORD</th> -->
                                            <td align="center"><strong>ประเภท</strong></td>
                                            <td align="center"><b>จัดการ</b></td>
                                    
                                        </tr>
                                    </thead>
                                    <tbody>
									<? while($row_data = mysqli_fetch_array($query_sql)) { ?>
                                        <tr>
                                            <td><?=$i++; ?></td>
											<td><?=$row_data['register_id']; ?></td>
                                            <td><?=$row_data['fullname']; ?></td>
                                           <td align="center"><?=$row_data['username']; ?></td>
                                         <!--   <td><?=$row_data['password']; ?></td> -->
                                            <td align="center"><?=$row_data['member_type_name']; ?></td>
                  <td align="center"> <a  href="index.php?floder=inc&service=user_manager_edit&register_id=<?=$row_data['register_id']; ?>" target="_blank" class="btn bg-cyan btn-circle waves-effect waves-circle waves-float waves-light">
                                    <i class="material-icons">border_color</i>
                                </a>
								<button   onclick="Ajax_Deleting(<?php echo $row_data['register_id']; ?>)" class="btn bg-red btn-circle waves-effect waves-circle waves-float waves-light">
                                    <i class="material-icons">delete</i>
                                </button>
</td>
                                        </tr>
                   <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
			
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
   var table = $('#dataTable').DataTable( {
        scrollY:			'500px',
				scrollX:true,
				scrollCollapse: true,
				DeferRender: true,
				AutoWidth:true,
				paging:       false,
				info:false,
				searching: true,
				aaSorting: [],
				columnDefs: [
				{ width: '40%', targets: 1}
									
				],		
    } );
 
    new $.fn.dataTable.FixedColumns( table, {
        leftColumns: 2,
    
    } );
} );

				function Refresh(){
					var member_type_id = $('#member_type_id').val();	


					window.location.href = "index.php?floder=inc&service=user_manager&member_type_id="+member_type_id;
					
				}
				
				
				
				function Ajax_Deleting(register_id){
		var con = confirm("คุณต้องการลบข้อมูลใช่หรือไม่");
		if(con){
			$.ajax({
				type: "POST",
				url: "ajax/Del_Get_Person.php",
				data: "register_id="+register_id,

				cache: false,
				success: function(data){
					if(data=="TRUE"){
						alert("ลบข้อมูลเรียบร้อย"+register_id);
				
				window.location.href = "index.php?floder=inc&service=user_manager";

					}
				}
			});
		}
	}
			</script>        
