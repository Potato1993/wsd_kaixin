<?php 
	//add in the db connection details using require_once
	require_once 'db.php';
	//create a new connection to the db 
	$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	//create SQL query to run
	$sql = "SELECT * FROM incident_type";
	//create var results to contain the result-set from SQL query
	$result = $conn ->query($sql);
	//create array var incident types 
	$incidentTypes = [];
	//use while loop to extract each row of the results-set to var row
	while ($row = $result->fetch_assoc()){
		//assign the column value for incident_type_id to var id
		$id = $row['incident_type_id'];
		//assign the column value for incident_type_desc to var id
		$type = $row['incident_type_desc'];
		//create array var incidentType to hold the column value of each row
		$incidentType = ["id" => $id, "type" => $type];
		//using the array push function to push assign all rows of the result set into array var incidentTypes
		array_push($incidentTypes, $incidentType);

	}
	$conn->close();
?>

<script type="text/javascript">
	//validation codes (i hope at least)
	function validate(){
		if($callerName == ""){
			alert("Caller Name must contain alphabet characters only.");
			return false;  
		}
		if($contactNo == ""){
			alert("Contact number must be 8 digits with no spaces and symbols.");
			return false;
		}
		if($locationOfIncident == ""){
			alert("Location of Incident is required.");
			return false;
		}
		if($typeOfIncident == ""){
			alert("Please select Type of Incident.");
			return false;
		}
		if($descriptionofIncident == "") {
			alert("Description of Incident is required.");
			return false;
		}
		return ( true );
	}
</script>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Log Call</title>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container" style="width: 80%">
			<!-- Use php require_once expression to include header image and navigation bar form nav.php-->

			<?php require_once 'nav.php' ?>
			<!--Create section container to place web form-->
			<section style="margin-top: 20px;">

			<!-- Create web form with caller name, contact number, location of incident, type of incident, description of incident input field-->

			<form action="dispatch.php" method="post" onsubmit="return (validate());">

				<!--Row for caller name label and textbox input-->
				<div class="form-group row">
					<label for="callerName" class="col-lg-4 col-form-label">Caller's Name</label>
					<div class="col-lg-8">
						<input type="text" name="callerName" class="form-control" id="callerName">
					</div>
				</div> <!--form group caller name div-->
				
				<!--Row for contact no label and textbox input-->
					<div class="form-group row">
					<label for="contactNo" class="col-lg-4 col-form-label">Contact Number (Required)</label>
					<div class="col-lg-8">
						<input type="text" name="contactNo" class="form-control" id="contactNo">
					</div>
				</div> <!--form group contact no div-->

				<!--Row for location of incident label and textbox input-->
					<div class="form-group row">
					<label for="locationOfIncident" class="col-lg-4 col-form-label">Location of incident (Required)</label>
					<div class="col-lg-8">
						<input type="text" name="locationOfIncident" class="form-control" id="locationOfIncident">
					</div>
				</div> <!--form group location of incident div-->

				<!--Row for type of incident label and textbox input-->
					<div class="form-group row">
					<label for="typeOfIncident" class="col-lg-4 col-form-label">Type of incident (Required)</label>
					<div class="col-lg-8">
						<select name="typeOfIncident" class="form-control" id="typeOfIncident">
							<option>Select</option>

							<?php 
							//using for loop to retrive the data from array var incidentTypes
							for ($i = 0; $i < count($incidentTypes); $i++) {
								$incidentType = $incidentTypes[$i];
								echo "<option value='" .$incidentType['id']."'>" .$incidentType['type']. "</option>";
							}
							?>
						</select>
					</div>
				</div> <!--form group type of incident div-->

				<!--Row for type of description label and textbox input-->
				<div class="form-group row">
    				<label for="descriptionofIncident" class="col-lg-4 col-form-label">Description of Incident (Required)</label>
    				<div class="col-lg-8">
        				<textarea rows="5" class="form-control" id="descriptionofIncident" name="descriptionofIncident"></textarea>
    				</div>
				</div> <!--form group description of incident div-->

				<!--Row for process call and reset button -->
				<div class="form-group row">
					<div class="col-lg-4"></div>
					<div class="col-lg-8" style="text-align: center;">
						<input type="submit" name="btnProcessCall" class="btn btn-primary" value="Process Call">
						<input type="reset" name="btnReset" class="btn btn-primary" value="Reset">
					</div>
				</div>

			<!--End of web form-->	
			</form>
			<!--End of section-->
			</section>
			<!--Footer-->
			<footer class="page-footer font-small blue pt-4 footer-copyright text-center py-3">
				&copy;2021 Copyright
				<a href="www.ite.edu.sg">ITE</a>
			</footer>

		</div> <!--container div-->
	</body>
</html>