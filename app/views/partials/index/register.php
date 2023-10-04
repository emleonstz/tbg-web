<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
$simu = $comp_model->ni_simu();
?>
<style>
    body{
        background-color: #212121;
    }
</style>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">User registration</h4>
                </div>
                
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card bg-light p-3 animated slideInUp page-content" style="border-radius: 10px;">
                        <form id="users-userregister-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("index/register?csrf_token=$csrf_token") ?>" method="post">
                            <!--[main-form-start]-->
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="name">Nick name <span class="text-danger">*</span></label>
                                    <div id="ctrl-name-holder" class=""> 
                                        <input id="ctrl-name"  value="<?php  echo $this->set_field_value('name',""); ?>" type="text" placeholder="Enter Nick name"  required="" name="name"  data-url="api/json/users_name_value_exist/" data-loading-msg="Checking availability ..." data-available-msg="Available" data-unavailable-msg="Not available" class="form-control  ctrl-check-duplicate" />
                                            <div class="check-status"></div> 
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="nickname">Email <span class="text-danger">*</span></label>
                                        <div id="ctrl-nickname-holder" class=""> 
                                            <input id="ctrl-nickname"  value="<?php  echo $this->set_field_value('nickname',""); ?>" type="email" placeholder="Enter Email"  required="" name="nickname"  data-url="api/json/users_nickname_value_exist/" data-loading-msg="Checking availability ..." data-available-msg="Available" data-unavailable-msg="Not available" class="form-control  ctrl-check-duplicate" />
                                                <div class="check-status"></div> 
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="password">Password <span class="text-danger">*</span></label>
                                            <div id="ctrl-password-holder" class="input-group"> 
                                                <input id="ctrl-password"  value="<?php  echo $this->set_field_value('password',""); ?>" type="password" placeholder="Password"  required="" name="password"  class="form-control  password" />
                                                    <div class="input-group-append cursor-pointer btn-toggle-password">
                                                        <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                                <div id="ctrl-confirm_password-holder" class="input-group"> 
                                                    <input id="ctrl-password-confirm" data-match="#ctrl-password"  class="form-control password-confirm " type="password" name="confirm_password" required placeholder="Confirm Password" />
                                                    <div class="input-group-append cursor-pointer btn-toggle-password">
                                                        <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Password does not match
                                                    </div>
                                                </div>
                                            </div>
                                            <input id="ctrl-secret_key"  value="<?php  echo $this->set_field_value('secret_key',random_chars(12)); ?>" type="hidden" placeholder="Enter Secret Key"  required="" name="secret_key"  class="form-control " />
                                                <input id="ctrl-status"  value="<?php  echo $this->set_field_value('status',"Active"); ?>" type="hidden" placeholder="Enter Status"  name="status"  class="form-control " />
                                                </div>
                                                <!--[main-form-end]-->
                                                <div class="form-group form-submit-btn-holder text-center mt-3">
                                                    <button class="btn btn-primary" type="submit">
                                                        Submit
                                            
                                                    </button>
                                                </div>
                                            </form>
                                            <div class="">
                    <div class="">
                        <div class="text-center">
                        <a class="" href="<?php print_link('') ?>">Already have an account? <b>Login</b>  </a>
                        </div>
                    </div>
                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="container">
    <style>
    .btn-store {
        color: #777777;
        min-width: 254px;
        padding: 12px 20px !important;
        border-color: #dddddd !important;
    }

    .btn-store:focus,
    .btn-store:hover {
        color: #ffffff !important;
        background-color: #168eea;
        border-color: #168eea !important;
    }

    .btn-store .btn-label,
    .btn-store .btn-caption {
        display: block;
        text-align: left;
        line-height: 1;
    }

    .btn-store .btn-caption {
        font-size: 24px;
    }
    </style>
    <div class=" text-center">
        
        <br />
        <p>
            <center>
                <a href="https://play.google.com/store/apps/details?id=com.emleons.team" class="btn btn-store">
                    <span class="fa fa-android fa-3x pull-left"></span>
                    <span class="btn-label">Download on the</span>
                    <span class="btn-caption">Google Play</span>
                </a>
            </center>
        </p>
    </div>
</div>