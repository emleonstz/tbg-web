<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
$id = USER_ID;


$data = $comp_model->get_array("SELECT * FROM users WHERE users.id ='$id'");

?>
<?php 
if(isset($_GET['name'])){
    $uname = $_GET['name'];
    $mail = $_GET['email'];
   $update = $comp_model->update($uname,$mail);
    
}else{
    if(isset($_GET['log'])){
        $sm = "Swal.fire(
            'Saved',
            '',
            'success'
          )";
          echo '<script>'.$sm.'</script>';
    }
}
?>
<style>
    body{
    background-color: #212121;
    
    color: #212121;
}
</style>
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="assets/images/avatar.png" width="100px" height="100px" alt="">
                    <!-- Profile picture help block-->
                    
                    <p class="h3"><?php echo $data['name'] ?></p>
                    <div class="badge badge-success font-italic text-light ">Publisher</div>
                    <p class="h5"><?php 
                        echo "Team Bus Gamer";
                    ?></p>
                    <!-- Profile picture upload button-->
                    <a href="<?php print_link(SITE_ADDR.'forgot/forgot_password.php') ?>"><button class="btn btn-primary" type="button">Request new password</button></a>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Your name</label>
                            <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" name="name" required value="<?php echo $data['name'] ?>">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col">
                                <label class="small mb-1" for="inputFirstName">Email</label>
                                <input class="form-control" id="inputFirstName" type="email" placeholder="Enter your email" name="email" required value="<?php echo $data['nickname'] ?>">
                            </div>
                            <!-- Form Group (last name)-->
                            
                        </div>
                        <!-- Form Row        -->
                        
                        
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">Save changes</button>
                        
                    </form>
                </div>
                <div class="card-footer border border border-danger">
                    Delete my account
                    <small class="text-danger">This process will delete all your information including all the livery you have uploaded</small>
                    <a href="<?php print_link("account/edit") ?>"><button class="btn btn-danger float-right" type="button">Delete Account</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
