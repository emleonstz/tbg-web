<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	function conn(){
		$con = mysqli_connect('localhost', 'tbg', 'qwerty', 'tbg') or die("database connection fail");
		return $con;
	}
	function query($sql){
		$db = $this->conn();
		$query = mysqli_query($db,$sql);
		return $query;
	}
	/**
     * livery_upload_by_default_value Model Action
     * @return Value
     */
	function livery_upload_by_default_value(){
		$db = $this->GetModel();
		$sqltext = "SELECT `id` FROM `users` WHERE `id` = '".USER_ID."';";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}
	/*count numbers */
	function count($sql){
		$query = $this->query($sql);
		$array = mysqli_fetch_array($query);
		$val = $array['num'];
		return $val;
	}
	/*fomart */
	function fomart($num){
		$format = new NumberFormatter("en_US",NumberFormatter::PADDING_POSITION);
		$numba = $format->format($num);
		return $numba;
	}
	/**get array */
	function get_array($sql){
		$query = $this->query($sql);
		$reteurn_array = mysqli_fetch_array($query);
		return $reteurn_array;
	}
	/**
     * users_name_value_exist Model Action
     * @return array
     */
	function users_name_value_exist($val){
		$db = $this->GetModel();
		$db->where("name", $val);
		$exist = $db->has("users");
		return $exist;
	}
	//chek if mobile
	function ni_simu(){
		if(is_mobile()){

		}else{
			
			$swall  = "Swal.fire(
				'Best for mobile devices',
				'This site is designed for mobile devices. for best experience please open it with your smartphone or try to use inpector',
				'info'
			  )";
			  echo '<script>'.$swall.'</script>';
		}
	}
	//tell us reason 
	function sendreason($user,$message){
		$query = $this->query("INSERT INTO `delete_reason` (`id`, `username`, `message`) VALUES (NULL, '$user', '$message')");
	}
	//remove special characters
	function clean($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	 
		 preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
		return $string = str_replace('-', ' ', preg_replace('/[^A-Za-z0-9\-]/', '', $string));
	 }
	/**futa delete account */
	function futakabisa($livery_id){
		$mfute = $this->query("DELETE FROM `favorite` WHERE `upload_by` =  '$livery_id'");
        $mfute = $this->query("DELETE FROM `favorite` WHERE `upload_by` =  '$livery_id'");
        $mfute = $this->query("DELETE FROM `livery` WHERE `upload_by` =  '$livery_id'");
        $mfute = $this->query("DELETE FROM `users` WHERE `id`= '$livery_id'");
            if($mfute){
				session_destroy();
                $msg= "Swal.fire(
					'Account Deleted',
					'Your account has been permanently deleted. You can create a new account and continue enjoying this service.',
					'success'
				  )";
				  echo '<script>'.$msg.'</script>';
            }
	}
	//get upolad
	function upload_limt(){
		$query = $this->query("SELECT * FROM `upload_limit`");
		$get_array = mysqli_fetch_array($query);
		$dayupload = $this->query("SELECT COUNT(`bus_name`) AS num FROM `livery` WHERE `upload_by` = '".USER_ID."' AND DATE(`upload_date`) = DATE(NOW());");
		$rowlm = mysqli_fetch_array($dayupload);
		$today = $rowlm['num'];

		$limit = $get_array['limiti'];
		$current= $limit - $today;
		if($current<1){
			return 'hidden';
		}else{
			return 'visible';
		}
	}
	function get_arrey($sql){
        $query = $this->query($sql);
        $array = mysqli_fetch_array($query);
        return $array;
    }
	/**update account */
	function update($name,$email){
		$i = USER_ID;
		$sql = "UPDATE `users` SET `name`='$name',`nickname`='$email' WHERE users.`id` = '$i'";
		$query = $this->query($sql);
		if($query){
			$msq = SITE_ADDR."account?log=update";
			  echo '<script> window.location.href="'.$msq.'";</script>';
		}
	}
	/**
     * users_nickname_value_exist Model Action
     * @return array
     */
	function users_nickname_value_exist($val){
		$db = $this->GetModel();
		$db->where("nickname", $val);
		$exist = $db->has("users");
		return $exist;
	}

}
