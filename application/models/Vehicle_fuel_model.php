<?php

class Vehicle_fuel_model extends Common_model {

	//put your code here
	public $_table = tbl_fuel;
	public $_fields = "*";
	public $_where = array();
	public $_except_fields = array();
    public $column_order = array('f.date','f.fueltype','drivername','f.amount','f.km');
    public $column_search = array('f.date',"CONCAT(p.firstname,' ',p.middlename,' ',p.lastname,' (',p.partycode,')')",'f.amount','f.km');
    public $_order = array('f.id' => 'DESC');
    
	function __construct() {
		parent::__construct();
    }
    
    function get_datatables() {
        $this->_get_datatables_query();
        if($_POST['length'] != -1) {
            $this->readdb->limit($_POST['length'], $_POST['start']);
            $query = $this->readdb->get();
        
            return $query->result();
        }
    }

	function _get_datatables_query(){  
        
        $vehicleid = (isset($_REQUEST['vehicleid']))?$_REQUEST['vehicleid']:0;
        $partyid = (isset($_REQUEST['partyid']))?$_REQUEST['partyid']:0;
        $fromdate = $this->general_model->convertdate($_REQUEST['fromdate']);
        $todate = $this->general_model->convertdate($_REQUEST['todate']);

        $this->readdb->select("f.id,f.date,f.siteid,f.fueltype,f.paymenttype,f.liter,f.km,f.amount,f.createddate,f.partyid,
            CONCAT(p.firstname,' ',p.middlename,' ',p.lastname,' (',p.partycode,')') as drivername
		");

		$this->readdb->from($this->_table." as f");
        $this->readdb->join(tbl_party." as p","p.id=f.partyid","LEFT");
        $this->readdb->where("f.vehicleid=".$vehicleid);
        $this->readdb->where("(f.partyid=".$partyid." OR ".$partyid."=0)");
        $this->readdb->where("(f.date BETWEEN '".$fromdate."' AND '".$todate."')");

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->readdb->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->readdb->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->readdb->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->readdb->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) { // here order processing
            $this->readdb->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->_order)) {
            $order = $this->_order;
            $this->readdb->order_by(key($order), $order[key($order)]);
        }
    }

    function count_all() {
        $this->_get_datatables_query();
        return $this->readdb->count_all_results();
    }
    function count_filtered() {
        $this->_get_datatables_query();
		$query = $this->readdb->get();
        return $query->num_rows();
    }
}