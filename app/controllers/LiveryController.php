<?php 
/**
 * Livery Page Controller
 * @category  Controller
 */
class LiveryController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "livery";
	}
	//remove special characters
	function clean($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	 
		 preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
		return $string = str_replace('-', ' ', preg_replace('/[^A-Za-z0-9\-]/', '', $string));
	 }
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id", 
			"livery", 
			"bus_name", 
			"bus_type", 
			"upload_by", 
			"downloads");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				livery.id LIKE ? OR 
				livery.livery LIKE ? OR 
				livery.bus_name LIKE ? OR 
				livery.bus_type LIKE ? OR 
				livery.upload_date LIKE ? OR 
				livery.upload_by LIKE ? OR 
				livery.status LIKE ? OR 
				livery.editors_choice LIKE ? OR 
				livery.downloads LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "livery/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("livery.id", ORDER_TYPE);
		}
		$db->where("livery.upload_by", get_active_user('id') );
		$db->where("status !='pending' AND upload_by='". USER_ID . "'");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "My Livery";
		$this->render_view("livery/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"livery", 
			"bus_name", 
			"bus_type", 
			"upload_date", 
			"upload_by", 
			"status", 
			"editors_choice", 
			"downloads");
		$db->where("livery.upload_by", get_active_user('id') );
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("livery.id", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$record['upload_date'] = format_date($record['upload_date'],'M d/Y');
			$page_title = $this->view->page_title = "View  Livery";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No livery found");
			}
		}
		return $this->render_view("livery/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("bus_name","bus_type","livery","upload_by","status","editors_choice","downloads");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'bus_name' => 'required',
				'bus_type' => 'required',
				'livery' => 'required',
				'status' => 'required',
				'editors_choice' => 'required',
			);
			$this->sanitize_array = array(
				'bus_name' => 'sanitize_string',
				'bus_type' => 'sanitize_string',
				'livery' => 'sanitize_string',
				'upload_by' => 'sanitize_string',
				'status' => 'sanitize_string',
				'editors_choice' => 'sanitize_string',
				'downloads' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Livery uploaded successfu", "success");
					return	$this->redirect("livery/pending");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "New Livery";
		$this->render_view("livery/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","bus_name","bus_type","livery","upload_by","status","editors_choice","downloads");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'bus_name' => 'required',
				'bus_type' => 'required',
				'livery' => 'required',
				'status' => 'required',
				'editors_choice' => 'required',
			);
			$this->sanitize_array = array(
				'bus_name' => 'sanitize_string',
				'bus_type' => 'sanitize_string',
				'livery' => 'sanitize_string',
				'upload_by' => 'sanitize_string',
				'status' => 'sanitize_string',
				'editors_choice' => 'sanitize_string',
				'downloads' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		$db->where("livery.upload_by", get_active_user('id') );
				$db->where("livery.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("livery");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("livery");
					}
				}
			}
		}
		$db->where("livery.upload_by", get_active_user('id') );$db->where("livery.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit Livery";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("livery/edit.php", $data);
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("livery.id", $arr_rec_id, "in");
		$db->where("livery.upload_by", get_active_user('id') );
		$bool = $db->delete($tablename);
		if($bool){
		#Statement to execute after delete record
		$db->rawQuery("DELETE FROM `favorite` WHERE `livery_id` = '$rec_id'");
		# End of after delete statement
			$this->set_flash_msg("Livery deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("livery");
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function pending($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id", 
			"livery", 
			"bus_name", 
			"bus_type");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				livery.id LIKE ? OR 
				livery.livery LIKE ? OR 
				livery.bus_name LIKE ? OR 
				livery.bus_type LIKE ? OR 
				livery.upload_date LIKE ? OR 
				livery.upload_by LIKE ? OR 
				livery.status LIKE ? OR 
				livery.editors_choice LIKE ? OR 
				livery.downloads LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "livery/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("livery.id", ORDER_TYPE);
		}
		$db->where("status = 'pending' AND upload_by ='".USER_ID ."'");
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "My Livery";
		$this->render_view("livery/pending.php", $data); //render the full page
	}
}
