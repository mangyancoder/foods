<div class="hamburger-menu">
    <i class="close__hamburger-menu fa fa-long-arrow-right"></i>
    <div class="hamburger-menu__header text-center">
      <img src="<?=base_url()?>/assets/images/backgrounds/logo.png" alt=" logo" class="mb-20">
      <b>LOGIN</b>
      <?php if(session()->getFlashdata('msg')):?>
        <div class="alert alert-danger" id="forgot-message" role="alert">
          <i class="fa-solid fa-x"></i>
             <?= session()->getFlashdata('msg') ?>
          </div>
      <?php endif;?>
      <?php if(isset($validation)):?>
      <div class="alert alert-warning">
         <?= $validation->listErrors() ?>
      </div>
      <?php endif;?>
      <div class="progress hidden" id="forgot-progress">
        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
          Checking your account
        </div>
      </div>
      <div class="alert alert-success hidden" id="forgot-message" role="alert">
        <i class="fa fa-check"></i> We have sent link to your email
      </div>
      <div class="alert alert-success hidden" id="forgot-emessage" role="alert">
        <i class="fa fa-check"></i> We cannot find this email.
      </div>

      <div class="progress hidden" id="login-progress">
        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
          Log In...
        </div>
      </div>

      <div class="alert alert-success hidden" id="login-message" role="alert">
        <i class="fa fa-check"></i> Login Success. Please wait for loading.
      </div>
      <div class="alert alert-success hidden" id="login-emessage" role="alert">
        <i class="fa fa-check"></i> Login Failed. Invalid Username or password.
      </div>

      <div class="box">
        <form id="login-form">
          <div class="control">
            <div class="label">Email Address</div>
            <input type="text" id="username" class="form-control" placeholder="Email" value="admin"/>
          </div>
          <div class="control">
            <div class="label">Password</div>
            <input type="password"id="password" class="form-control" value="Christian31" />
          </div>
          <br>
          <div class="login-button">
            <input type="submit" class="btn btn__primary btn__hover2 btn__block" value="Login">
          </div>
        </form>
        <form id="register-form" class="hidden" action="<?=base_url()?>/register" action="post">
          <div class="control">
            <div class="label">Complete Name</div>
            <input type="text" name="name" class="form-control" placeholder="complete name"/>
          </div>
          <div class="control">
            <div class="label">Email Address</div>
            <input type="text" name="email" class="form-control" placeholder="Email"/>
          </div>
          <div class="control">
            <div class="label">Password</div>
            <input type="password"name="password" class="form-control" />
          </div>
          <div class="control">
            <div class="label">Password</div>
            <input type="password" name="confirmpassword" class="form-control" />
          </div>
          <div class="login-button">
            <br>
            <input type="submit" class="btn btn__primary btn__hover2 btn__block" value="Register">
          </div>
        </form>
        <form id="forgot-form" class="hidden">
          <div class="control">
            <div class="label">Email Address</div>
            <input type="text" id="femail" class="form-control" placeholder="Email"/>
          </div>
          <div class="login-button">
            <br>
            <input type="submit" class="btn btn__primary btn__hover2 btn__block" value="Send email">
          </div>
        </form>
      </div>
      <div class="info-box" id="info-login">
        <span class="text-left"><a id="register">Create new account</a></span>
        <span class="text-right"><a id="forgot">Forgot password?</a></span>
        <div class="clear-both"></div>
      </div>
      <div class="info-box hidden" id="inreg">
        <span class="text-left"><a id="login">Login</a></span>
        <span class="text-right"><a id="forgot">Forgot password?</a></span>
        <div class="clear-both"></div>
      </div>




      <br>

    </div>

    <div class="hamburger-menu__footer">
      <ul class="contact__list list-unstyled mb-20">
    <a id="register" href="#">Register</a>
      </ul><!-- /.contact-list -->
      <!-- <a href="reservation.html" class="btn btn__primary btn__hover2 btn__block">Make A Reservation</a> -->
    </div><!-- /.hamburger-menu-footer -->
  </div>
