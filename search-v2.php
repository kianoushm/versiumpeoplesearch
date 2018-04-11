<?php
//header('Access-Control-Allow-Origin: *');
$ws_url ="";
if(isset($_POST['first_name'])) {
	
$firstName = strtolower($_POST['first_name']);
$lastName = strtolower($_POST['last_name']);
$state = strtolower($_POST['state']);
$url = "https://api.datafinder.com/qdf.php";	
$ws_url = $url."?service=phone&k2=9abbxna7d2b65ivia3p9vljs&cfg_maxrecs=100&d_first=".$firstName."&d_last=".$lastName."&d_state=".$state;
	
//echo("Link: ".$ws_url);	-->  TEST
//header("Location:".$ws_url);  test URL


$json = file_get_contents($ws_url);
$data = json_decode($json, TRUE);


} // end of main check




?>
<!doctype html>
<html>
<head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="./css/bootstrap.min.css">
<!--Custom CSS-->
<link rel="stylesheet" type="text/css" href="./css/style.css">
<!-- jQuery library -->
<script src="./js/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="./js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<meta charset="utf-8">
<!--This project should not be tracked by Search engines-->
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<!--Meta for web responsive design-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Welcome to VPS</title>
</head>

<body onload="makeLoadingGifDisappear()">
<div id="wrapper">
  <div class="row">
    <div class="col-sm-12">
      <table class="headpage">
        <tbody>
          <tr>
            <td><img id="logo" src="./images/logo.png" alt="Versium"/></td>
            <td><h1>Welcome to Versium People Search</h1></td>
            <td><button type="button" class="btn btn-default active submit-retry-btns" onClick="window.location.replace('./search.php')">Reset</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <!-- End of Header -->
  
  <form name="myForm" method="POST" onsubmit="return validateForm()" id="myForm">
    <div class="row">
      <div class="col-sm-12" id="validation_msg"> 
        <!--Showing validation errors here-->
        <div id="msg"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <h3>Input:</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <p>Please insert your First Name, Last Name, and State to find more details about your input!</p>
        <table class="table table-bordered td-style">
          <tbody>
            <tr>
              <td><strong>First Name:</strong></td>
              <td><input type="text" name="first_name" placeholder="eg. John"/></td>
              <td><strong>Last Name:</strong></td>
              <td><input type="text" name="last_name" placeholder="eg. Smith"/></td>
              <td><strong>State:</strong></td>
              <td><input type="text" name="state" placeholder="eg. LA" /></td>
              <td><input type="submit" value="Submit" class="submit-retry-btns"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- End of Input Area -->
    
    <div class="row">
      <div class="col-sm-12">
        <h3>Output:</h3>
      </div>
    </div>
	
    <div class="row">
      <div class="col-sm-12 myoutput">
     				
				
                   
		<script>   
		$(document).ready(function(){
			
			var myPath = "<?php echo($ws_url); ?>";
			myPath = myPath.trim();
			
			if ( myPath!=""){
			$.ajax({
   			 url: myPath,
   			 dataType: 'JSON',
    		jsonpCallback: 'callback',
   			 type: 'GET',
   			 success: function (data) {
      		  console.log(data);
    }
});




			}//end of if
});
		
		
		//$('.myoutput').html(JSON.stringify(myObj));
        </script>      
                    
                    
                    
      </div>
      <img src="images/load.gif" id="myLoadingGif"> </div>
    <!-- End of Result area -->
    
  </form>
</div>
<!-- End of Wrapper --> 

<script>
		//default styling  - Validation error message
		$("#msg").css("padding","none");
		$("#msg").css("border","none");
		$("#msg").css("background-color","fff");
		
		
		//form validation
		function validateForm() {
			
			var msg = "";
			var permit = true;
			var validationMessage="";
			var first_name= document.forms[ "myForm" ][ "first_name" ].value;
			var last_name= document.forms[ "myForm" ][ "last_name" ].value;
			var state= document.forms[ "myForm" ][ "state" ].value;
			state = state.toUpperCase(); //State should be uppercase to be validated
			
			if ( first_name == "" ) {
				msg += ",First Name";
				permit = false;
			} else if ( !first_name.match( /^[a-zA-Z_\- ]+$/ ) ) {
				msg += ",First Name (Not Valid)";
				permit = false;
			}
					
			if ( last_name == "" ) {
				msg += ",Last Name";
				permit = false;
			} else if ( !last_name.match( /^[a-zA-Z_\- ]+$/ ) ) {
				msg += ",Last Name (Not Valid)";
				permit = false;
			}
			
			
			if ( state == "" ) {
				msg += ",State";
				permit = false;
			} else if ( !state.match( /^(?:(A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|P[AR]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY]))$/ ) ) {
				msg += ",State (Not Valid)";
				permit = false;
			}


	if (permit == false) {
	//removing the first comma
	validationMessage= msg.substring(1);
	validationMessage = "* ("+validationMessage + ") must be filled out appropriately!";
		//styling the error message
		$("#msg").html(validationMessage);
		$("#msg").css("padding","20px");
		$("#msg").css("border","1px");
		$("#msg").css("background","yellow");
		
  		}
		if (permit !== false){
		//Loader gif would be on when Form submitted        
  		document.getElementById('myLoadingGif').style.display = 'block';
			} 
				
		return permit;
		} 
		
	</script> 
<script>    
   
//Loader gif would be off when page completely is loaded
function makeLoadingGifDisappear() {
 document.getElementById('myLoadingGif').style.display = 'none';
}
</script>
</body>
</html>