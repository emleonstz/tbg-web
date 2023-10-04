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
$simu = $comp_model->ni_simu();
?>
<style>
    body{
        background-color: #212121;
    }
</style>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class=" p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title text-light">View  Livery</h4>
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
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-bordered table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <img src="<?php echo $data['livery']; ?>" class="card-img-top" alt="livery" width="100%" height="260px" style="object-fit: cover;">
                                        <tr  class="td-bus_name">
                                            <th class="title"> Bus Name: </th>
                                            <td class="value"> <?php echo $data['bus_name']; ?></td>
                                        </tr>
                                        <tr  class="td-bus_type">
                                            <th class="title"> Bus Type: </th>
                                            <td class="value"> <?php echo $data['bus_type']; ?></td>
                                        </tr>
                                        <tr  class="td-upload_date">
                                            <th class="title"> Upload Date: </th>
                                            <td class="value"> <?php echo $data['upload_date']; ?></td>
                                        </tr>
                                        <tr  class="td-status">
                                            <th class="title"> Status: </th>
                                            <td class="value"> <?php echo $data['status']; ?></td>
                                        </tr>
                                        <tr  class="td-downloads">
                                            <th class="title"> Downloads: </th>
                                            <td class="value"> <?php echo $data['downloads']; ?></td>
                                        </tr>
                                    </tbody>
                                    <!-- Table Body End -->
                                </table>
                            </div>
                            <div class="p-3 d-flex">
                                
                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("livery/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete ?" data-display-style="modal">
                                    <i class="fa fa-times"></i> Delete
                                </a>
                            </div>
                            <?php
                            }
                            else{
                            ?>
                            <!-- Empty Record Message -->
                            <div class="text-muted p-3">
                                <i class="fa fa-ban"></i> No Record Found
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
