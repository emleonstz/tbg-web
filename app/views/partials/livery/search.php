
<?php
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
if (!empty($records)) {
foreach ($records as $data) {
$rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
?>
<a href="<?php print_link("livery/view/$rec_id"); ?>" class="search-link">
    <div class="row">
        <div class="col-3">
            <img src="<?php echo $data['livery'] ?>" width="60px" height="60px">
        </div>
        <div class="col-6">
            <div><?php echo $data['bus_name'] ?> <br> <span class="badge badge-info"><?php echo $data['bus_type'] ?></span> </div>
    
        </div>
    </div>
    <div hidden><?php echo $data['id'] ?></div>
    
    
    
</a>
<?php
}
} else {
?>
<h4 class="text-muted text-center no-record-found">
    No Record Found
</h4>
<?php
}
?>
