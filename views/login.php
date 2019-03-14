<!DOCTYPE html>  
<html lang="en">
    <?php
	require 'interfaces/default/header.php';
    ?>
    <body>
	<style>
	 .label {
	     font-size : 12pt !Important;
	 }
	 .form-control {
	     font-size : 12pt !Important;
	 }
	 .has-error {
	     border : 1px solid red !Important;
	 }
	</style>
	<!-- Preloader -->
	<div class="preloader">
	    <div class="cssload-speeding-wheel"></div>
	</div>
	<section id="wrapper" class="login">
	    <div class="login-box login-box-position">
		<div class="white-box">
		    <form id="loginform" class="form-horizontal form-material" method="POST">
			<input type="hidden" name="page" value="login">
			<div class="row" style="padding-bottom:20px">
			    <div class="col-md-4"></div>
			    <div class="col-md-4">
				<img src="assets/images/stfb-logo.gif" alt="Logo">			
			    </div>
			    <div class="col-md-4"></div>
			</div>
			<!-- 			    <h3 class="box-title m-b-20"><?php echo $translation->translateLabel("Sign In"); ?></h3> -->
			<div class="form-group">
			    <div class="row">
 				<div class="col-xs-6">
				    <label class="dropdown-label pull-left"><?php echo $translation->translateLabel("Company"); ?>:</label>
				</div>
				<div class="col-xs-6">
				    <select name="company" id="icompany" class="form-control pull-right row b-none" onchange="companySelect(event);">
					<option>DEFAULT</option>
				    </select>
				</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
 				<div class="col-xs-6">
				    <label class="dropdown-label pull-left"><?php echo $translation->translateLabel("Division"); ?>:</label>
				</div>
				<div class="col-xs-6">
				    <select name="division" id="idivision" class="form-control pull-right row b-none">
					<option>DEFAULT</option>
				    </select>
				</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
 				<div class="col-xs-6">
				    <label class="dropdown-label pull-left"><?php echo $translation->translateLabel("Department"); ?>:</label>
				</div>
				<div class="col-xs-6">
				    <select name="department" id="idepartment" class="form-control pull-right row b-none">
					<option>DEFAULT</option>
				    </select>
				</div>
			    </div>
			</div>
			<div class="form-group ">
			    <div class="col-xs-12">
				<input name="name" id="iname" class="form-control" type="text" required="" placeholder="<?php echo $translation->translateLabel("User Name"); ?>">
			    </div>
			</div>
			<div  id="user_wrong_message" style="color:red; padding-bottom:20px; display:none">
			    <strong>These credentials do not match our records.</strong>
			</div>
			<div class="form-group">
			    <div class="col-xs-12">
				<input name="password" id="ipassword" class="form-control" type="password" required="" placeholder="<?php echo $translation->translateLabel("Password"); ?>">
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
 				<div class="col-xs-6">
				    <label class="dropdown-label pull-left"><?php echo $translation->translateLabel("Language"); ?>:</label>
				</div>
				<div class="col-xs-6">
				    <select name="language" class="form-control pull-right row b-none" onchange="changeLanguage(event);">
					<option><?php echo $scope->user["language"]; ?></option>
					<?php
					    foreach($translation->languages as $value)
					    if($value != $scope->user["language"])
						echo "<option>" . $value . "</option>";
					?>
				    </select>
				</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
				<div class="col-xs-6">
				    <input name="captcha" id="icaptcha" class="form-control" type="text" required placeholder="<?php echo $translation->translateLabel("Enter captcha"); ?>">
				</div>
				<div class="col-xs-6">
				    <img id="captcha" src="<?php echo $scope->captchaBuilder->inline(); ?>" />
				</div>
			    </div>
			    <div class="form-group text-center m-t-20">
				<div class="col-xs-12">
				    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit"><?php echo $translation->translateLabel("Log In"); ?></button>
				</div>
			    </div>
			</div>
		    </form>
		</div>
	    </div>
	</section>
	<script>
	 $(function () {
	     $(".preloader").fadeOut();
	     $('#side-menu').metisMenu();
	 });
	 var loginform = $('#loginform');
	 loginform.submit(function(e){
	     var req = $.post("index.php?page=login<?php echo key_exists("config", $_GET) ? "&config={$_GET["config"]}" : ""; ?>", loginform.serialize(), null, 'json')
			.success(function(data) {
			    window.location = "index.php#/?page=dashboard";
			})
			.error(function(err){
			    var res = err.responseJSON;
			    if(res.wrong_captcha)
				$("#icaptcha").addClass("has-error");
			    else
				$("#icaptcha").removeClass("has-error");
			    if(res.wrong_user){
				$("#iname").addClass("has-error");
				$("#ipassword").addClass("has-error");
				$("#user_wrong_message").css("display", "block");
			    }else{
				$("#iname").removeClass("has-error");
				$("#ipassword").removeClass("has-error");
				$("#user_wrong_message").css("display", "none");
			    }
			    document.getElementById('captcha').src = res.captcha; 
			});
	     return false;
	 });
	 var companies = <?php echo json_encode($companies->companies); ?>;
	 $(document).ready(function(){
	     var companiesList = {},
		 companies_options = '',
		 icompany = $("#icompany")[0],
		 ind;

	     for(ind in companies)
		 companiesList[companies[ind].CompanyID] = true;
	     for(ind in companiesList)
		 companies_options += '<option>' + ind + '</option>';

	     icompany.innerHTML = companies_options;
	 });
	 
	 function companySelect(event){
	     var idivision = $("#idivision")[0],
		 ideparment = $("#idepartments")[0],
		 division_options = '',
		 department_options = '',
		 ind,
		 divisions = {},
		 departments = {},
		 company = event.target.value;

	     for(ind in companies){
		 if(companies[ind].CompanyID == company){
		     divisions[companies[ind].DivisionID] = true;
		     departments[companies[ind].DepartmentID] = true;
		 }
	     }

	     for(ind in divisions)
		 division_options += '<option>' + ind + '</option>';
	     for(ind in departments)
		 department_options += '<option>' + ind + '</option>';
	     
	     idivision.innerHTML = division_options;
	     idepartment.innerHTML = department_options;
	 }
	 
	 function changeLanguage(event){
	     $.getJSON("index.php?page=language&setLanguage=" + event.target.value)
	      .success(function(data) {
		  location.reload();
	      })
	      .error(function(err){
		  console.log('something going wrong');
	      });
	 }

	</script>
	<?php
	    require 'interfaces/default/footer.php';
	?>
    </body>
</html>
