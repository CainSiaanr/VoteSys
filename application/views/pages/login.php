<div class="form">
	<form id="stripe-login" action="<?php echo site_url(); ?>/login_verification" method="POST">
		<div class="cardLogin">
			<div class="card-header">
				<h1 class="title">Ur<span class="v-letter">v</span>oice</h1>
				<h3 class="slogan">Sampaikan Aspirasimu</h3>
				<h2 class="sign-in">Sign In</h2>
			</div>
			<p class="notification"><?php if($query_result != NULL){echo $query_result; }?></p>
			<!-- Username -->
			<div class="form-group">
				<label for="username" class="label">Username :</label>
				<input type="text" name="username" id="username" class="field" required>
			</div>
			<!-- Password -->
			<div class="form-group">
				<label for="password" class="label">Password : </label>
				<input type="password" name="password" id="password" class="field" required>
			</div>
			<!-- Button -->
			<div class="form-group">
				<button type="submit" class="btn" name="tekan">Sign In</button>
			</div>
		</div>
	</form>
</div>
