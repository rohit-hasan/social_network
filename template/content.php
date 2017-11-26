<div id="container">
		
			<div id="diu_image">
			
				<img src="images/logo4.jpg" style="float:left"/>
			
			</div>
			
			<div id="form_container">
				<form method="post">
					<table class="sign_up_table" cellspacing="10">
						<tr>
							<td id="create_account">Sign Up</td>
						</tr>
						
						<tr>
							<td><input type="text" name="first_name" placeholder="First name" required="required"/></td>
							<td><input type="text" name="last_name" placeholder="Last name" required="required"/></td>
						</tr>
						
						<tr >
							<th><input type="email" name="email" placeholder="DIU Email Address" required="required"/></th>
							
						</tr>
						
						<tr>
							<td><input type="password" name="password" placeholder="New password" required="required"/></td>
						</tr>
						
						<tr>
						
							<td>Birthday</td>
							
						</tr>
						
						<tr>
						
							<script> 
							
							$(document).ready(function(){
								
								$("#birthday").datepicker({yearRange: '1950:+0',changeYear:true,changeMonth:true});
							});
							
							</script>
							
						
							<td><input type="text" name="birthday" id="birthday" required="required"/></td>
							
						
						</tr>
						
						<tr>
							<td>
							<p>Gender<p>
							<br/>
							<select name="gender" required="required">
							
							<option value="male">Male</option>
							<option value="female">Female</option>
							</td>
							
							
			
						</tr>
					
						
						
							<tr>
							<td><button name="sign_up" id="sign_up">Sign Up</button></td>
							</tr>
						
						
						
					</table>
					
				</form>
				<?php 
				
				include("user_insert.php");
				
				?>
			</div>
		</div>
		