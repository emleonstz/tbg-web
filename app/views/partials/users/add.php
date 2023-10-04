<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Add New Users</h4>
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
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="users-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("users/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="name">Name </label>
                                    <div id="ctrl-name-holder" class=""> 
                                        <input id="ctrl-name"  value="<?php  echo $this->set_field_value('name',""); ?>" type="text" placeholder="Enter Name"  name="name"  data-url="api/json/users_name_value_exist/" data-loading-msg="Checking availability ..." data-available-msg="Available" data-unavailable-msg="Not available" class="form-control  ctrl-check-duplicate" />
                                            <div class="check-status"></div> 
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="nickname">Email </label>
                                        <div id="ctrl-nickname-holder" class=""> 
                                            <input id="ctrl-nickname"  value="<?php  echo $this->set_field_value('nickname',""); ?>" type="email" placeholder="Enter Email"  name="nickname"  data-url="api/json/users_nickname_value_exist/" data-loading-msg="Checking availability ..." data-available-msg="Available" data-unavailable-msg="Not available" class="form-control  ctrl-check-duplicate" />
                                                <div class="check-status"></div> 
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="password">Password </label>
                                            <div id="ctrl-password-holder" class="input-group"> 
                                                <input id="ctrl-password"  value="<?php  echo $this->set_field_value('password',""); ?>" type="password" placeholder="Enter Password" maxlength="255"  name="password"  class="form-control  password password-strength" />
                                                    <div class="input-group-append cursor-pointer btn-toggle-password">
                                                        <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                    </div>
                                                </div>
                                                <div class="password-strength-msg">
                                                    <small class="font-weight-bold">Should contain</small>
                                                    <small class="length chip">6 Characters minimum</small>
                                                    <small class="caps chip">Capital Letter</small>
                                                    <small class="number chip">Number</small>
                                                    <small class="special chip">Symbol</small>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="confirm_password">Confirm Password </label>
                                                <div id="ctrl-confirm_password-holder" class="input-group"> 
                                                    <input id="ctrl-password-confirm" data-match="#ctrl-password"  class="form-control password-confirm " type="password" name="confirm_password"  placeholder="Confirm Password" />
                                                    <div class="input-group-append cursor-pointer btn-toggle-password">
                                                        <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Password does not match
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label class="control-label" for="secret_key">Secret Key </label>
                                                <div id="ctrl-secret_key-holder" class=""> 
                                                    <input id="ctrl-secret_key"  value="<?php  echo $this->set_field_value('secret_key',""); ?>" type="text" placeholder="Enter Secret Key"  name="secret_key"  class="form-control " />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="status">Status </label>
                                                    <div id="ctrl-status-holder" class=""> 
                                                        <input id="ctrl-status"  value="<?php  echo $this->set_field_value('status',""); ?>" type="text" placeholder="Enter Status"  name="status"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-submit-btn-holder text-center mt-3">
                                                    <div class="form-ajax-status"></div>
                                                    <button class="btn btn-primary" type="submit">
                                                        Submit
                                                        <i class="fa fa-send"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
