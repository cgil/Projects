<?php
//Insert large amounts of data into the database
class Bulk_insert_model extends MY_Model{  
    //Insert into 'target' table all of a users friends as potential targets
	function Insert_targets($rows){     
    	$columns = array('target_name', 'target_id', 'foreign_pk_access');
    	$this->insert_rows('target', $columns, $rows); 
  	}
}

?>