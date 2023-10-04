<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
$comp_model = new SharedController;
if(isset($_GET['pass'])){
  $di = USER_ID;
  $message = (isset($_GET['reason']))?$_GET['reason']:"Not said";
$password = $_GET['pass'];

$pass = $comp_model->get_array("SELECT `name`,`password` FROM `users` WHERE `id` = '$di';");
$hash = $pass['password'];
$user_n = $pass['name'];

if(password_verify($password,$hash)){
 $sendreprt = true;
 $send = $comp_model->sendreason($user_n,$message);
  if($sendreprt){
    $futa = $comp_model->futakabisa($di);
  }else{
    $error = "Swal.fire(
      'Unknown error',
      'Unknon error occured during process please try again latter',
      'error'
    )";
    echo '<script>'.$error.'</script>';
  }
    
    
}else{
  $error = "Swal.fire(
    'Incorrect Password',
    'Oparation canceled, incorrect password submited',
    'error'
  )";
  echo '<script>'.$error.'</script>';
}

}else{

}
?>
<div class="container padding-bottom-3x mb-2 mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <div class="forgot">

        <h2>Delete my account</h2>
        <p>Please note that once you delete the account all of your livery will be lost and you will not
          be recovered.</p>
        

      </div>
      <p class="text-danger">Deletion from</p>
      <form method="get" class="card mt-4 border border-danger">
        <div class="card-body">
          <div class="form-group">
            <label for="email-for-pass">Enter your password<span class="text-danger">*</span></label>
            <input class="form-control" type="password" required name="pass" id="email-for-pass" required=""><small class="form-text text-muted">Please enter the password you use to log
              in.</small>
          </div>
          <div class="form-group">
            <label for="email-for-pass">Please at least tell us the reason for deleting the account <span class="text-success">(Optional)</span></label>
            <textarea name="reason"  id="" cols="30" rows="4" class="form-control"></textarea><small class="form-text text-muted"></small>
          </div>
        </div>
        <div class="card-footer">
          <a class="btn btn-success" href="<?php print_link("") ?>" >Back to dashboard</a>
          <button class="btn btn-danger" type="submit">Delete my account</button>
        </div>
      </form>
    </div>
  </div>
</div>