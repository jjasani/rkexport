<?php

class Systemlimit_model extends Common_model {

	//put your code here
	public $_table = tbl_systemlimit;
	public $_fields = "*";
	public $_where = array();
	public $_except_fields = array();

	function __construct() {
		parent::__construct();
	}

	
}
