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
                <div class="header" style="float: center;">
                    <div class="logo" style="text-align: center;">
                        <a href="#"><img src='<?= base_url('images/top_logo.jpg');?>'></a>
                    </div>
                </div>
            </div>

<div class="container login-section" style="margin-top: 60px;">
    <div class="row">&nbsp;</div>
    <div class="row inner-row" style="display: none">
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
				<li>Username: <span>guestuser@helvetas.org.np</span></li>
				<li>Password: <span>guestuser</span></li>
				</ul>
			</div>
						</div>
    </div>
    <!-- new form -->
    <!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="login-box text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            <img src="<?= base_url('images/Bridge_crossing.jpg');?>" height="100"> <br />
            <span class="text-primary" style="font-size: 18px;">Programme Monitoring and Information System</span>
          </h1>
          <p style="color: hsl(217, 10%, 50.8%)">
            For Guest users:<br>
            Username: <span>guestuser@helvetas.org.np</span><br>
            Password: <span>guestuser</span>
          </p>
        </div>

        <div class="col-lg-5 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form class="" action="<?= base_url('user/login') ?>" method="post">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row">
                    <?php if (isset($validation)) : ?>
                    <div class="">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                <?php endif; ?>

                    <!-- <div class="form-group">
                        <label for="email">Username</label>
                        
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div> -->

                  <!-- <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example1" class="form-control" />
                      <label class="form-label" for="form3Example1">First name</label>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example2" class="form-control" />
                      <label class="form-label" for="form3Example2">Last name</label>
                    </div>
                  </div> -->
                </div>
                <h1 class="my-5 display-3 fw-bold ls-tight">User Login</h1>
                <!-- Email input -->
                <div class="form-outline mb-4 login-input">
                    <!-- <label class="form-label" for="email">Username</label> -->
                    <input type="email" class="form-control" name="email" id="email" placeholder="Username" required>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <!-- <label class="form-label" for="password">Password</label> -->
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-center mb-4 hide">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                  <label class="form-check-label" for="form2Example33">
                    Subscribe to our newsletter
                  </label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-success btn-primary btn-login btn-block mb-4">Login</button>

                <!-- Register buttons -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
<!-- ends new form here -->
    
<div class="logo" style="text-align: center; margin-top: 160px;">
                        <a href="#"><img src='<?= base_url('images/bottom_logo.jpg');?>'></a>
                    </div>
</div>
<div class="footer-text mt-auto">
    <p>TBSU/HELVETAS Swiss Intercooperation Nepal © 2023</p>
    <p>For technical problems and feedbacks please email to System Officer: akaram.salamani@helvetas.org </p>
    <p class="visible-xs visible-sm">Not supported in mobile devices.</p>
</div>
</div>
<script type='text/javascript'>
    document.getElementById('email').focus();

</script>
</body>
</html>