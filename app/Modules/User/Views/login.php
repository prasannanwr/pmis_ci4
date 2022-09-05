<!DOCTYPE html>
<html lang="en">
<head>
  <title>PMIS - Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?=base_url("css/bootstrap.min.css");?>">
  <script src="<?=base_url("js/jquery.min.js");?>"></script>
  <script src="<?php //base_url("js/bootstrap.min.js");?>"></script>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="<?=base_url("css/jquery-ui.min.css");?>">
  <link rel="stylesheet" href="<?=base_url("css/style.css");?>">
</head>
<body>
<div id="wrapper">
            <div class="login-header">
                <div class="header" style="float: left;">
                    <div class="logo" style="text-align: center;">
                        <a href="#"><img src='<?= base_url('images/0349198001423239216.jpg');?>'></a>
                    </div>
                </div>
            </div>

<div class="container login-section">
    <div class="row">&nbsp;</div>
    <div class="row inner-row">
        <div class="col-2">&nbsp;</div>
        <div class="panel panel-primary col-5 xs login-form col-lg-offset-3">
            <div class="panel-heading">TBIS - User Login</div>
            <div class="panel-body">
                <?php if (isset($validation)) : ?>
                    <div class="">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <form class="" action="<?= base_url('user/login') ?>" method="post">
                    <div class="form-group">
                        <label for="email">Username</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-success">Login</button>
                </form>
            </div>
        </div>
        <div class="info-section col-5 hidden-xs col-lg-offset-3" >
				<div class="inner-info-section">
				<p>For Guest users,</p>
				<ul>
				<li>Username: <span>guestuser</span></li>
				<li>Password: <span>guestuser</span></li>
				</ul>
			</div>
						</div>
    </div>
    

</div>
<div class="footer-text mt-auto">
    <p>TBSU/HELVETAS Swiss Intercooperation Nepal © 2022</p>
    <p>For technical problems and feedbacks please email to System Officer: akaram.salamani@helvetas.org </p>
    <p class="visible-xs visible-sm">Not supported in mobile devices.</p>
</div>
</div>
<script type='text/javascript'>
    document.getElementById('email').focus();

</script>
</body>
</html>