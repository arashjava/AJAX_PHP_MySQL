<?php
$projName= $_POST['postProjName'];


			   	$res_id=MySQLi_Connect('localhost','root','baaykdazyg','ProjectShare');
				if(MySQLi_Connect_Errno()) {
	                echo "Connection to database Error...";
				}
					else 

					{
						$check_proj=MySQLi_Query($res_id,"select * from Projects where proj_name='".$projName."'");
						$r_proj=MySQLi_Fetch_Row($check_proj);

						if($r_proj) {
							echo json_encode(array('projSite' => $r_proj[2],
												   'projStartTime' => $r_proj[3],
												   'projExtectedTime' => $r_proj[4],
												   'projEndedTime' => $r_proj[5]
												  ));
						}
						else{
							echo json_encode(array('projSite' => '',
												   'projStartTime' => '',
												   'projExtectedTime' => '',
												   'projEndedTime' => ''
												  ));
						} 
						
					}  

?>  
			

