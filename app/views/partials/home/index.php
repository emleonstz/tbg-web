<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
$delimiter = $comp_model->get_arrey("SELECT COUNT(`bus_name`) AS num FROM `livery` WHERE `upload_by` = '".USER_ID."' AND DATE(`upload_date`) = DATE(NOW());");
$day_limi = $comp_model->get_arrey("SELECT * FROM `upload_limit`");
?>
<style>
    body{
        background-color: #212121;
    }
</style>
<div>
    <div  class=" p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h4 class="text-light">Dashobard</h4>
                </div>
            </div>
            <style>
                 .card-counter{
    box-shadow: 2px 2px 10px #222;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #222;
    transition: .3s linear all;
  }

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }
  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }  
  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }
  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 0.5;
    display: block;
    font-size: 18px;
  }
            </style>
            <div class="">
                <div class="row">
                <div class="col-md-3">
                <a href="<?php print_link("livery") ?>">
      <div class="card-counter success">
      <i class="fa fa-image "></i>
        <span class="count-numbers"><?php $count = $comp_model->count("SELECT COUNT(`bus_name`) AS num  FROM `livery`  WHERE `status` != 'pending' AND `upload_by` = '".USER_ID."'"); echo $comp_model->fomart($count); ?></span>
        <span class="count-name">Live on TBG</span>
      </div>
                </a>
    </div>
    
    <div class="col-md-3">
    <a href="<?php print_link("livery/pending") ?>">
      <div class="card-counter danger">
      <i class="fa fa-file-image-o "></i>
        <span class="count-numbers"><?php $count = $comp_model->count("SELECT COUNT(`bus_name`) AS num  FROM `livery` WHERE `status` = 'pending' AND `upload_by` = '".USER_ID."'"); echo $comp_model->fomart($count); ?></span>
        <span class="count-name">Pending</span>
      </div>
      </a>
    </div>
    
    <div class="col-md-3" >
      <div class="card-counter info">
      <i class="fa fa-cloud-download "></i>
        <span class="count-numbers"><?php $count = $comp_model->count("SELECT SUM(`downloads`) num FROM `livery` WHERE `upload_by` = '".USER_ID."'"); echo $comp_model->fomart($count); ?></span>
        <span class="count-name">Total downloads</span>
      </div>
    </div>
    <script>
      function showuo(){
        Swal.fire(
  'Daily upload limit',
  'We have set a limit for uploading livery per day, if you reach the daily limit, you will not be able to upload for that day until the next day. We have done this to save disk space, we are sorry for the inconvenience.',
  'info'
)
      }
      function tel(){
        Swal.fire(
  'Number of downloads <i class="fa fa-cloud-download" aria-hidden="true"></i>',
  'the number of people who download your liveries in general',
  'info'
)
      }
      function welcome(){
        Swal.fire({
  title: 'TEAM BUS GAMER',
  text: 'Download the user application from playstore to be able to download livery',
  imageUrl: '<?php print_link(SITE_LOGO); ?>',
  imageWidth: 100,
  imageHeight: 100,
  imageAlt: 'Custom image',
  showCancelButton: true,
  confirmButtonText: '<i class="fa fa-cloud-download"> Download now',
  cancelButtonText: 'Not now',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href= "https://play.google.com/store/apps/details?id=com.emleons.team";
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    
  }
})
      }
      window.onload= function(){
       
      }
    </script>
           
    <div class="col-md-3" >
      <a href="<?php print_link("livery/pending") ?>"> 
      <div class="card-counter info">
      <i class="fa fa-cloud-upload" aria-hidden="true"></i>
        <span class="count-numbers"><?php echo $delimiter['num'] ?>/<?php echo $day_limi['limiti'] ?></span>
        <span class="count-name">Uploaded today</span>
      </div>
      </a>
    </div>
            
                </div>
            </div>
        </div>
    </div>
</div>
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
		<h5>Team Bus Gammer</h5>
		<br/>
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
  
