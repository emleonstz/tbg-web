<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
$delimiter = $comp_model->get_arrey("SELECT COUNT(`bus_name`) AS num FROM `livery` WHERE `upload_by` = '".USER_ID."' AND DATE(`upload_date`) = DATE(NOW());");
$day_limi = $comp_model->get_arrey("SELECT * FROM `upload_limit`");
$limit = $comp_model->upload_limt();
$auto_hide = ($limit == "hidden")?"hidden":"";
$authide = ($limit == "hidden")?"":"hidden";
$simu = $comp_model->ni_simu();
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add" data-display-type=""
    data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Upload Livery</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div class="">
        <div class="container" <?php echo $auto_hide ?> >
            <div class="row ">
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div class="bg-light p-3 animated slideInUp page-content">
                        <center><p>You can only upload <?php echo $day_limi['limiti'] ?>/Livery Day</p></center>
                        <form id="livery-add-form" role="form" novalidate enctype="multipart/form-data"
                            class="form page-form form-vertical needs-validation"
                            action="<?php print_link("livery/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="bus_name">Bus Name <span
                                            class="text-danger">*</span></label>
                                    <div id="ctrl-bus_name-holder" class="">
                                        <input id="ctrl-bus_name"
                                            value="<?php  echo $this->set_field_value('bus_name',""); ?>" type="text"
                                            placeholder="Enter Bus Name" required="" name="bus_name"
                                            class="form-control " />
                                        <small>Special characters not allowed</small>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="bus_type">Bus Type <span
                                            class="text-danger">*</span></label>
                                    <div id="ctrl-bus_type-holder" class="">
                                        <select id="ctrl-bus_type" name="bus_type"
                                            class="form-control form-control-lg mb-3"
                                            aria-label=".form-select-lg example" required>

                                            <option value="Yudistira HD" selected>Yudistira HD</option>
                                            <option value="Nakula SHD">Nakula SHD"</option>
                                            <option value="Sadewa SHD">Sadewa SHD</option>
                                            <option value="Ajura XHD">Ajura XHD</option>
                                            <option value="Bimasena SSD">Bimasena SSD</option>
                                            <option value="Srikandi SHD">Srikandi SHD</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="livery">Livery <span
                                            class="text-danger">*</span></label>
                                    <div id="ctrl-livery-holder" class="">
                                        <div class="dropzone required" input="#ctrl-livery" fieldname="livery"
                                            data-multiple="false" dropmsg="select a file  to upload" btntext="Browse"
                                            extensions=".jpg,.png" filesize="5" maximum="1">
                                            <input name="livery" id="ctrl-livery" required=""
                                                class="dropzone-input form-control"
                                                value="<?php  echo $this->set_field_value('livery',""); ?>"
                                                type="text" />
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                        </div>
                                    </div>
                                    <small class="form-text">png or jpg 5mb max</small>
                                </div>
                                <input id="ctrl-upload_by"
                                    value="<?php echo $comp_model->livery_upload_by_default_value() ?>" type="hidden"
                                    placeholder="Enter Upload By" name="upload_by" class="form-control " />
                                <input id="ctrl-status"
                                    value="<?php  echo $this->set_field_value('status',"pending"); ?>" type="hidden"
                                    placeholder="Enter Status" required="" name="status" class="form-control " />
                                <input id="ctrl-editors_choice"
                                    value="<?php  echo $this->set_field_value('editors_choice',"no"); ?>" type="hidden"
                                    placeholder="Enter Editors Choice" required="" name="editors_choice"
                                    class="form-control " />
                                <input id="ctrl-downloads"
                                    value="<?php  echo $this->set_field_value('downloads',"0"); ?>" type="hidden"
                                    placeholder="Enter Downloads" name="downloads" class="form-control " />
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
        <div class="container" <?php echo $authide ?>>
            <p class="h4">Max upload limit reached you can only upload <?php echo $delimiter['num'] ?> Livery per day. You have uploaded <?php echo $delimiter['num'] ?>/<?php echo $day_limi['limiti'] ?> Today</p><br>
            <p class="h3 text-success">Don't worry this message will disappear by itself tomorrow.</p>

        </div>
    </div>
</section>