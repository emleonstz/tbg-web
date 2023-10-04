<?php
$comp_model = new SharedController;
$page_element_id = "edit-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$simu = $comp_model->ni_simu();
$page_id = $this->route->page_id;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="edit" data-display-type=""
    data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Edit Livery</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div class="bg-light p-3 animated fadeIn page-content">
                        <form novalidate id="" role="form" enctype="multipart/form-data"
                            class="form page-form form-vertical needs-validation"
                            action="<?php print_link("livery/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="bus_name">Bus Name <span
                                            class="text-danger">*</span></label>
                                    <div id="ctrl-bus_name-holder" class="">
                                        <input id="ctrl-bus_name" value="<?php  echo $data['bus_name']; ?>" type="text"
                                            placeholder="Enter Bus Name" required="" name="bus_name"
                                            class="form-control " />
                                            <small>no special characters</small>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="bus_type">Bus Type <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg mb-3"
                                    id="ctrl-bus_type" name="bus_type" aria-label=".form-select-lg example">
                                        <option value="<?php  echo $data['bus_type']; ?>" selected><?php  echo $data['bus_type']; ?></option>
                                        <option value="Yudistira HD">Yudistira HD</option>
                                        <option value="Nakula SHD">Nakula SHD"</option>
                                        <option value="Sadewa SHD">Sadewa SHD</option>
                                        <option value="Ajura XHD">Ajura XHD</option>
                                        <option value="Bimasena SSD">Bimasena SSD</option>
                                        <option value="Srikandi SHD">Srikandi SHD</option>
                                        <option value="Other">Other</option>
                                    </select>
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
                                                value="<?php  echo $data['livery']; ?>" type="text" />
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                        </div>
                                    </div>
                                    <?php Html :: uploaded_files_list($data['livery'], '#ctrl-livery'); ?>
                                    <small class="form-text">png or jpg 5mb max</small>
                                </div>
                                <input id="ctrl-upload_by" value="<?php  echo $data['upload_by']; ?>" type="hidden"
                                    placeholder="Enter Upload By" name="upload_by" class="form-control " />
                                <input id="ctrl-status" value="<?php  echo $data['status']; ?>" type="hidden"
                                    placeholder="Enter Status" required="" name="status" class="form-control " />
                                <input id="ctrl-editors_choice" value="<?php  echo $data['editors_choice']; ?>"
                                    type="hidden" placeholder="Enter Editors Choice" required="" name="editors_choice"
                                    class="form-control " />
                                <input id="ctrl-downloads" value="<?php  echo $data['downloads']; ?>" type="hidden"
                                    placeholder="Enter Downloads" name="downloads" class="form-control " />
                            </div>
                            <div class="form-ajax-status"></div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit">
                                    Update
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