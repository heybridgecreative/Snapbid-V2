    <div class="container container-with-navbar">
      <h1 class="col-sm-offset-2">Sign In</h1>
      <form class="form-horizontal" method="POST">
        <div class="form-group">
          <label for="inputEmail" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="remember" value="TRUE"> Remember me
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-4">
            <button type="submit" class="btn btn-default">Sign in</button>
          </div>
          <div class="col-sm-6 text-right">
            <a class="btn btn-link" href="<?=site_url()?>index.php/account/remind_password" role="button">remind password</a>
          </div>
       </div>
      </form>
      <?php foreach ($this->aauth->get_errors_array() as $error){ ?>
        <div class="alert alert-danger" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <?php echo $error; ?>
        </div>
      <?php } ?>
		</div>