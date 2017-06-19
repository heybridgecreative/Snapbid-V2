<div class="container container-with-navbar">
      <h1 class="col-sm-offset-2">Remind Password</h1>
      <form class="form-horizontal" method="POST">
        <div class="form-group">
          <label for="inputEmail" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">remind password</button>
          </div>
        </div>
      </form>
      <?php foreach ($this->aauth->get_infos_array() as $info){ ?>
        <div class="alert alert-success" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <?php echo $info; ?>
        </div>
      <?php } ?>