<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transport_type extends Admin_Controller {

	public $viewData = array();
	function __construct(){
		parent::__construct();
		$this->viewData = $this->getAdminSettings('submenu','Transport_type');
		$this->load->model('Transport_type_model','Transport_type');
	}
	public function index() {

		$this->viewData['title'] = "Transport Type";
		$this->viewData['module'] = "transport_type/Transport_type";

        if($this->viewData['submenuvisibility']['managelog'] == 1){
            $this->general_model->addActionLog(4,'Transport Type','View payment type.');
		}

		$this->admin_headerlib->add_javascript("transport_type","pages/transport_type.js");
		$this->load->view(ADMINFOLDER.'template',$this->viewData);
	}
	public function listing() {

		$edit = explode(',', $this->viewData['submenuvisibility']['submenuedit']);
        $delete = explode(',', $this->viewData['submenuvisibility']['submenudelete']);
        $rollid = $this->session->userdata[base_url().'ADMINUSERTYPE'];
        $createddate = $this->general_model->getCurrentDateTime();
        $list = $this->Transport_type->get_datatables();

        $data = array();       
        $counter = $_POST['start'];
        $pokemon_doc = new DOMDocument();
        foreach ($list as $datarow) { 
        	$row = array();
        	$actions = '';
            $checkbox = '';
            //Edit Button
            if(in_array($rollid, $edit)) {
                $actions .= '<a class="'.edit_class.'" href="'.ADMIN_URL.'transport-type/edit-transport-type/'. $datarow->id.'/'.'" title="'.edit_title.'">'.edit_text.'</a>';
            }
            //Delete and Enable/Disable Button
            if(in_array($rollid, $delete)) {
                $actions.='<a class="'.delete_class.'" href="javascript:void(0)" title="'.delete_title.'" onclick=deleterow('.$datarow->id.',"","Additional-rights","'.ADMIN_URL.'transport_type/delete_mul_transport_type") >'.delete_text.'</a>';

                $checkbox = '<div class="checkbox"><input id="deletecheck'.$datarow->id.'" onchange="singlecheck(this.id)" type="checkbox" value="'.$datarow->id.'" name="deletecheck'.$datarow->id.'" class="checkradios">
                            <label for="deletecheck'.$datarow->id.'"></label></div>';
            }
            
            
        	$row[] = ++$counter;
            $row[] = $datarow->type;
            $row[] = $this->general_model->displaydatetime($datarow->createddate);
            $row[] = $actions;
            $row[] = $checkbox;
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Transport_type->count_all(),
                        "recordsFiltered" => $this->Transport_type->count_filtered(),
                        "data" => $data,
                        );
        echo json_encode($output);  
	}
	public function add_transport_type() {
		
		$this->viewData['title'] = "Add Additional Rights";
		$this->viewData['module'] = "transport_type/Add_transport_type";

		$this->admin_headerlib->add_javascript("add_transport_type","pages/add_transport_type.js");
		$this->load->view(ADMINFOLDER.'template',$this->viewData);
	}
	public function edit_transport_type($id) {
		
		$this->viewData['title'] = "Edit Additional Rights";
		$this->viewData['module'] = "transport_type/Add_transport_type";
		$this->viewData['action'] = "1";//Edit

		//Get Admission Inquiry Status Data By ID
		$this->viewData['additionalrightsrow'] = $this->Transport_type->getAdditionalrightsDataByID($id);
		
		$this->admin_headerlib->add_javascript("add_transport_type","pages/add_transport_type.js");
		$this->load->view(ADMINFOLDER.'template',$this->viewData);

	}
	public function transport_type_add() {

		$PostData = $this->input->post();

		$createddate = $this->general_model->getCurrentDateTime();
		$addedby = $this->session->userdata(base_url().'ADMINID');
		
		
		$type = $PostData['type'];

        $this->form_validation->set_rules('type', 'Transport Type', 'required');
		
		$json = array();
        if ($this->form_validation->run() == FALSE) {
        	$validationError = implode('<br>', $this->form_validation->error_array());
        	$json = array('error'=>3, 'message'=>$validationError);
	    }else{
                $this->Transport_type->_where = ("type='".$type."'");
                $Count = $this->Transport_type->CountRecords();
                
                if($Count==0){
                    
                    $insertdata = array("type"=>$type,
                                "createddate"=>$createddate,
                                "addedby"=>$addedby,
                                "modifieddate"=>$createddate,
                                "modifiedby"=>$addedby);
                    $insertdata=array_map('trim',$insertdata);
                    
                    $Add = $this->Transport_type->Add($insertdata);
                    if($Add){
                        if($this->viewData['submenuvisibility']['managelog'] == 1){
                            $this->general_model->addActionLog(1,'Additional Rights','Add new additional rights.');
                        }
                        $json = array('error'=>1); //Rights successfully added.
                    }else{
                        $json = array('error'=>0); //Rights not added.
                    }
                }else{
                    $json = array('error'=>2); //Rights already exist.
                }
           
			
		}
		echo json_encode($json);
	}
	public function update_transport_type() {

		$PostData = $this->input->post();
		$modifieddate = $this->general_model->getCurrentDateTime();
		$modifiedby = $this->session->userdata(base_url().'ADMINID');

		$id = $PostData['id'];
		$type = $PostData['type'];

		$this->form_validation->set_rules('type', 'Transport Type', 'required');
        

		$json = array();
        if ($this->form_validation->run() == FALSE) {
        	$validationError = implode('<br>', $this->form_validation->error_array());
        	$json = array('error'=>3, 'message'=>$validationError);
	    }else{
         
                $this->Transport_type->_where = ("id!=".$id." AND type='".$type."'");

                $Count = $this->Transport_type->CountRecords();
            
                if ($Count==0) {
                    $updatedata = array(
                        "type"=>$type,
                        "modifieddate"=>$modifieddate,
                        "modifiedby"=>$modifiedby
                    );

                    $updatedata=array_map('trim', $updatedata);

                    $this->Transport_type->_where = array("id"=>$id);
                    $Edit = $this->Transport_type->Edit($updatedata);
                    if ($Edit) {
                        if($this->viewData['submenuvisibility']['managelog'] == 1){
                            $this->general_model->addActionLog(2,'Transport Type','Edit '.$type.' payment type.');
                        }
                        $json = array('error'=>1); //Rights successfully updated.
                    } else {
                        $json = array('error'=>0); //Rights not updated.
                    }
                } else {
                    $json = array('error'=>2); //Rights already exist.
                }
          
		}
		echo json_encode($json);
	}
	public function delete_mul_transport_type(){
		$PostData = $this->input->post();
		$ids = explode(",",$PostData['ids']);
		$count = 0;
		foreach($ids as $row){
            if($this->viewData['submenuvisibility']['managelog'] == 1){

                $this->Transport_type->_where = array("id"=>$row);
                $data = $this->Transport_type->getRecordsById();
            
                $this->general_model->addActionLog(3,'Additional Rights','Delete '.$data['name'].' additional rights.');
            }
  			$this->Transport_type->Delete(array("id"=>$row));
		}
	}
}
?>