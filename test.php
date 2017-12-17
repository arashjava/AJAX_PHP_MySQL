<html>
	<head>
		<title>Project </title>
			
		<script type="text/javascript" src="jquery.js"></script>
			<script type='text/javascript'>
		   function saveProject() 
	      	{
				document.f1.submit();
		    }
			</script>

	</head>
	
	<body>
		<h1> Project Information </h1>
		<script type="text/javascript">
			
			 function on_callPhp()
			{

				var projName=$('#projname').val();
				$.post('testGetData.php', {postProjName:projName},
				function(data)
					   {
						    var responsedata = $.parseJSON(data);
					        document.getElementById("projsite").value= responsedata.projSite;
					        document.getElementById("projstarttime").value= responsedata.projStartTime;
					        document.getElementById("projexpectedtime").value= responsedata.projExtectedTime;
					        document.getElementById("projendedtime").value= responsedata.projEndedTime;

        				});
				
			}
			
		</script>
		<form action ="" method="POST" name ="f1">
			<label>Project name:  
				<input type="text" id= "projname" name= "projname"   onchange="javascript:on_callPhp()"/></label><br><br>
			<label>Project Site/ owner: 
				<input type="text" id= "projsite" name= "projsite"/></label><br><br>
			<label>Date to Start: 
				<input type="date" id= "projstarttime" name= "projstarttime"/></label><br><br>
			<label>Date Expected to finish: 
				<input type="date" id= "projexpectedtime" name= "projexpectedtime"/></label><br><br>
			<label>Date Ended: 
				<input type="date" id= "projendedtime" name= "projendedtime"/></label><br><br>
			<tr>
				<td> <br> <input type='button' value='Save Project' name='s0' onclick='saveProject()'> </td> 
			</tr>
		</form>
		<div id ="result"></div>	

			<?php

			$projName=$projSiteOwner=$projStartTime=$projExpEndTime=$projEndTime="";

			if($_SERVER["REQUEST_METHOD"]=="POST") 
			{
					function saveProject($data) 
					{
						$data=trim($data);
						$data=stripslashes($data);
						$data=htmlspecialchars($data);
						return $data;
					}
					$projName=saveProject($_POST["projname"]);
					$projSiteOwner=saveProject($_POST["projsite"]);
					$projStartTime=saveProject($_POST["projstarttime"]);
					$projExpEndTime=saveProject($_POST["projexpectedtime"]);
					$projEndTime=saveProject($_POST["projendedtime"]);


					//Getting Resource ID
					$res_id=MySQLi_Connect('localhost','root','baaykdazyg','ProjectShare');
					if(MySQLi_Connect_Errno()) {
						echo "<tr align='center'> <td colspan='5'> Failed to connect to MySQL </td> </tr>";
					}
					else 
					{
						$check_proj=MySQLi_Query($res_id,"select * from Projects where proj_name='".$projName."'");
						$r_proj=MySQLi_Fetch_Row($check_proj);

						if($r_proj) {
								$query="update Projects set proj_site_owner= '$projSiteOwner', 
								          proj_start_time= STR_TO_DATE('$projStartTime', '%Y-%m-%d'), 
										  proj_expected_end_time= STR_TO_DATE('$projExpEndTime', '%Y-%m-%d') , 
										  proj_end_time= STR_TO_DATE('$projEndTime', '%Y-%m-%d')
								        where proj_name= '$projName'";
						}

						else
						{

								$query="insert into Projects (proj_name, proj_site_owner, proj_start_time, proj_expected_end_time, proj_end_time)
								values ('$projName','$projSiteOwner',STR_TO_DATE('$projStartTime', '%Y-%m-%d'),STR_TO_DATE('$projExpEndTime', '%Y-%m-%d') ,STR_TO_DATE('$projEndTime', '%Y-%m-%d'))";

							    
					    }
						$res=MySQLi_Query($res_id,$query);
						if($res) {
							echo "<tr align='center'> <td colspan='5'> <font color='green'> Project Saved Successfully! </font> </td> </tr>";
						}
						else {
							echo "<tr align='center'> <td colspan='5'> <font color='red'> Project Failed to be saved! </font> </td> </tr>";
						}

					MySQLi_Close($res_id);
					}
				}
		?> 				
	</body>
</html>
			  
			