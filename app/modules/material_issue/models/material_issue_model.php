<?php
class material_issue_model extends ET_BaseModel {
	function __construct()
	{
		parent::__construct();
        $this->afterInit();
	}
    public function afterInit(){
        $this->table = 'material_issue';
        $this->idFld = 'id';
    }

    /*
    * Get overall list
    */
    public function getOverallList($region = '') {
        $sql = "SELECT a.`id`,a.`requisition_num`,a.`issued_date`,a.`lot`,a.`units`,b.`type`,b.`diameter`,b.`rate`,c.`name` as diametername,f.`name` as materialtype,f.`unit` as materialunit FROM `material_issue` a LEFT JOIN `material_receipt` b ON a.lot = b.id LEFT JOIN diameter c ON b.diameter=c.id LEFT JOIN `material_type` f ON b.type=f.id";
        if($region != '') {
            $sql .=" WHERE b.region = '$region' ";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    /*
    * Get the issued materials list by requisition id
    */
    public function issueInfo($req_num,$material_type = '') {    	
        if($material_type) {
            $sql = "SELECT a.`requisition_num`,a.`lot`,a.`units`,b.`type`,b.`diameter`,b.`rate`,c.`name` as diametername,f.`name` as materialtype,f.`unit` as materialunit FROM `material_issue` a LEFT JOIN `material_receipt` b ON a.lot = b.id LEFT JOIN diameter c ON b.diameter=c.id LEFT JOIN `material_type` f ON b.type=f.id WHERE a.`requisition_num`='$req_num' AND b.`type` = '$material_type'";
        } else {
            $sql = "SELECT a.`requisition_num`,a.`lot`,a.`units`,b.`type`,b.`diameter`,b.`rate`,c.`name` as diametername,f.`name` as materialtype,f.`unit` as materialunit FROM `material_issue` a LEFT JOIN `material_receipt` b ON a.lot = b.id LEFT JOIN diameter c ON b.diameter=c.id LEFT JOIN `material_type` f ON b.type=f.id WHERE a.`requisition_num`='$req_num'";
        }       
    	$query = $this->db->query($sql);
		return $query->result();
    }

    /*
    * Get the issued requisition details like number, bridge name, organization, district ...
    */
    public function issueDetail($req_num) {
        //$sql = "SELECT a.`requisition_num`,a.`units`,a.`issued_date`,b.`bridge_name`,b.`bridge_num`,c.`name` as org_name,d.`dist_name`,d.`dist_state`,e.`diameter`,e.`rate`,e.`units`,f.`name` as materialtype,f.`unit` as materialunit FROM `material_issue` a LEFT JOIN `requisition` b ON a.requisition_num=b.id LEFT JOIN `organization` c ON b.issued_for=c.organization_id LEFT JOIN `district` d ON b.district=d.dist_id LEFT JOIN `material_receipt` e ON a.lot=e.id LEFT JOIN `material_type` f ON e.type=f.id WHERE a.id='$req_num'";        
        $sql = "SELECT a.`requisition_num`,a.`issued_date`,a.`lot`,a.`units`,b.`req_id`,b.`bridge_name`,b.`bridge_num`,c.`name` as org_name,d.`dist_name`,d.`dist_state`,m.`muni01name` FROM `requisition` b LEFT JOIN `material_issue` a ON a.requisition_num=b.id  LEFT JOIN `organization` c ON b.issued_for=c.organization_id LEFT JOIN `district` d ON b.district=d.dist_id LEFT JOIN `material_receipt` e ON a.lot=e.id LEFT JOIN `material_type` f ON e.type=f.id LEFT JOIN muni01municipality_vcd m ON b.palika = m.muni01id WHERE b.id='$req_num'";     
 
        $query = $this->db->query($sql);
        return $query->row();
    }


    /*
    * Get the requisition list that is issued
    */
    public function getIssuedList($region = '') {

        //$sql = "SELECT a.`requisition_num`,a.`id` as issueid,b.`req_id` FROM `material_issue` a INNER JOIN `requisition` b ON a.`requisition_num`=b.`id`";
        $sql = "SELECT `id`,`req_id` FROM `requisition`";
        if($region != '') {
            $sql .=" WHERE `region` = '$region'";
        }
        $query = $this->db->query($sql);
        return $query->result();

    }

    /*
    * Get the issued requisition by material type
    */
    public function getIssues($type) {

        //$sql = "SELECT a.`requisition_num`,a.`id` as issueid,b.`req_id` FROM `material_issue` a INNER JOIN `requisition` b ON a.`requisition_num`=b.`id`";
        $sql = "SELECT `id`,`req_id` FROM `material_issue` a LEFT JOIN `requisition` b ON a.requisition_num=b.id LEFT JOIN `material_receipt` c ON b.issued_for = c.id WHERE b.issued_for = '$type'";
        $query = $this->db->query($sql);
        return $query->result();

    }

    public function getIssueList($receipt_id) {
        $sql = "SELECT a.`id`,a.`units`,a.`issued_date`,b.`req_id`,b.bridge_name FROM `material_issue` a LEFT JOIN `requisition` b ON a.`requisition_num`=b.`id` LEFT JOIN `material_receipt` c ON b.`issued_for` = c.`id` WHERE a.`lot` = '$receipt_id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /*
    * Get the issue detail by organization
    */
    public function getIssueByOrganization($organization,$type,$region='') {

        $sql = "SELECT a.issued_date,a.lot,a.units,b.diameter,d.name as diametername,e.name as organization_name FROM material_issue a LEFT JOIN material_receipt b ON a.lot = b.id LEFT JOIN requisition c ON a.requisition_num = c.id LEFT JOIN diameter d ON b.diameter = d.id LEFT JOIN organization e ON c.issued_for = e.organization_id WHERE c.issued_for = '$organization' AND b.type = '$type'";
        if($region != '') {
            $sql .=" AND c.`region` = '$region'";
        }
        $sql .=" order by b.diameter ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /*
     * Get the overall summary of material issued
     */
    public function getIssuedOrganizationList($type) {

        $sql = "SELECT DISTINCT(e.name) as organization_name,e.organization_id FROM material_issue a LEFT JOIN material_receipt b ON a.lot = b.id LEFT JOIN requisition c ON a.requisition_num = c.id LEFT JOIN organization e ON c.issued_for = e.organization_id WHERE b.type = '$type' order by e.organization_id ASC";
       // $sql = "SELECT a.issued_date,a.lot,SUM(a.units),b.diameter,d.name as diametername,e.name as organization_name FROM material_issue a LEFT JOIN material_receipt b ON a.lot = b.id LEFT JOIN requisition c ON a.requisition_num = c.id LEFT JOIN diameter d ON b.diameter = d.id LEFT JOIN organization e ON c.issued_for = e.organization_id WHERE b.type = '$type' GROUP BY e.organization_id ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function totalUnitsByOrganization_($organization='',$type='') {

        $sql = "SELECT a.issued_date,a.lot,SUM(a.units) as totalunits,b.diameter,d.name as diametername,e.name as organization_name FROM material_issue a LEFT JOIN material_receipt b ON a.lot = b.id LEFT JOIN requisition c ON a.requisition_num = c.id LEFT JOIN diameter d ON b.diameter = d.id LEFT JOIN organization e ON c.issued_for = e.organization_id WHERE c.issued_for = '$organization' AND b.type = '$type' GROUP BY e.organization_id GROUP BY diametername";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /*
     * Get overall issue units by organization
     */
    public function totalUnitsOrganization($type='',$region='') {

        $sql = "SELECT a.issued_date,a.lot,SUM(a.units) as total_issue,SUM(b.units) as total_receipt,b.diameter,d.name as diametername,e.name as organization_name FROM material_issue a LEFT JOIN material_receipt b ON a.lot = b.id LEFT JOIN requisition c ON a.requisition_num = c.id LEFT JOIN diameter d ON b.diameter = d.id LEFT JOIN organization e ON c.issued_for = e.organization_id WHERE b.type = '$type'";
        if($region !='') {
            $sql .=" AND b.`region` = '$region'";
        }
        $sql .=" GROUP BY organization_name,diametername";
        //echo $sql;exit;
        $query = $this->db->query($sql);
        return $query->result();
    }

    /*
     * Get stock overall issue (by organization)
     */
    public function totalIssueOrganization($type='',$region='') {

        $sql = "SELECT a.issued_date,a.lot,SUM(a.units) as total_issue,b.diameter,d.name as diametername,e.name as organization_name FROM material_issue a LEFT JOIN material_receipt b ON a.lot = b.id LEFT JOIN requisition c ON a.requisition_num = c.id LEFT JOIN diameter d ON b.diameter = d.id LEFT JOIN organization e ON c.issued_for = e.organization_id WHERE b.type = '$type'";
        if($region !='') {
            $sql .=" AND b.`region` = '$region'";
        }
        $sql .=" GROUP BY organization_name,diametername";
        echo $sql;exit;
        $query = $this->db->query($sql);
        return $query->result();
    }

    /*
     * Get overall issue units by diameter
     */
    public function totalUnitsDiameter($type='',$agency='', $region = '') {

        //$sql = "SELECT SUM(a.units) as totalunits,d.name as diametername FROM material_issue a LEFT JOIN material_receipt b ON a.lot = b.id LEFT JOIN requisition c ON a.requisition_num = c.id LEFT JOIN diameter d ON b.diameter = d.id WHERE b.type = '$type'";
		$sql = "SELECT SUM(a.units) as totalunits,d.name as diametername FROM stock a LEFT JOIN diameter d ON a.diameter = d.id WHERE a.material_type = '$type'";
       /* if($agency != '') {
            $sql .=" AND b.purchased_by = '$agency'";
        }*/
        if($region !='') {
            $sql .=" AND a.`region` = '$region'";
        }
        $sql .=" GROUP BY diametername";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /*
     * Get overall issue units by reel number
     */
    public function totalUnitsReelno($type='',$agency='',$region='') {

       // $sql = "SELECT SUM(b.units) as totalunits,b.lot,a.units as total_issue, d.name as diametername FROM material_receipt b LEFT JOIN material_issue a ON b.id=a.lot LEFT JOIN diameter d ON b.diameter = d.id WHERE b.type = '$type'";
        $sql = "SELECT b.units as total_receipt,b.id,b.lot, d.name as diametername FROM material_receipt b LEFT JOIN diameter d ON b.diameter = d.id WHERE b.type = '$type'";
        if($agency != '') {
            $sql .=" AND b.purchased_by = '$agency'";
        }
        if($region !='') {
            $sql .=" AND b.`region` = '$region'";
        }
        $sql .=" GROUP BY lot";
        $query = $this->db->query($sql);
        //echo $sql;exit;
        return $query->result();
    }

    /*
     * Get region wise summary
     */
    public function totalUnitsRegion($type='',$agency='',$region ='') {

       // $sql = "SELECT SUM(a.units) as total_receipt, a.id, SUM(b.units) as totalunits, d.name as diametername FROM material_receipt a LEFT JOIN material_issue b ON a.id = b.lot LEFT JOIN diameter d ON a.diameter = d.id WHERE a.type = '$type' AND a.region = '$region'";

        // $sql = "SELECT SUM(a.units) as total_receipt,a.id,d.name as diametername FROM material_receipt a LEFT JOIN (SELECT SUM(units) as total_issue FROM material_issue) b ON a.id =b.lot LEFT JOIN diameter d ON a.diameter = d.id WHERE a.type = '$type' AND a.region = '$region'";
        $sql = "SELECT SUM(a.units) as total_receipt,a.diameter,d.name as diametername FROM material_receipt a LEFT JOIN diameter d ON a.diameter = d.id WHERE a.type = '$type'";
        if($agency != '') {
            $sql .=" AND a.purchased_by = '$agency'";
        }
        if($region !='') {
            $sql .=" AND a.`region` = '$region'";
        }
        $sql .=" GROUP BY a.diameter";
        //echo $sql;exit;
        $query = $this->db->query($sql);
        $resultArray = $query->result();
        return $resultArray;
    }

    /*
     * Get overall summary
     */
    public function totalOverallUnits($type='',$agency='',$region ='') {

        $sql = "SELECT SUM(a.units) as total_issue,SUM(b.units) as total_receipt,d.name as diametername FROM material_receipt b LEFT JOIN material_issue a ON b.id = a.lot LEFT JOIN diameter d ON b.diameter = d.id WHERE b.type = '$type'";
        if($region != '') {
            $sql .=" AND b.region = '$region'";
        }
        if($agency != '') {
            $sql .=" AND b.purchased_by = '$agency'";
        }
        $sql .=" GROUP BY b.diameter";   
        $query = $this->db->query($sql);
        return $query->result();
    }

    /*
    * Get total issue per diameter
    */
    public function totalUnitsPerDiameter($type='',$diameter='',$region ='',$agency='') {

        $sql = "SELECT SUM(a.units) as total_issue,d.name as diametername FROM material_issue a LEFT JOIN material_receipt b ON a.lot = b.id LEFT JOIN diameter d ON b.diameter = d.id WHERE b.type = '$type' AND b.diameter = '$diameter'";
        if($region != '') {
            $sql .=" AND b.region = '$region'";
        }
        if($agency != '') {
            $sql .=" AND b.purchased_by = '$agency'";
        }
        $sql .=" GROUP BY b.diameter";   
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function totalUnitsByOrganization($organization='',$type='',$region = '') {

        $sql = "SELECT a.issued_date,a.lot,SUM(a.units) as totalunits,b.diameter,d.name as diametername,e.name as organization_name FROM material_issue a LEFT JOIN material_receipt b ON a.lot = b.id LEFT JOIN requisition c ON a.requisition_num = c.id LEFT JOIN diameter d ON b.diameter = d.id LEFT JOIN organization e ON c.issued_for = e.organization_id WHERE c.issued_for = '$organization' AND b.type = '$type' ";
        if($region != '') {
            $sql .=" AND c.`region` = '$region'";
        }
        $sql .=" group by b.diameter ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function totalIssueLot($lot) {

        $sql = "SELECT SUM(a.units) as total_issue FROM material_issue a WHERE a.lot = '$lot'";
        $query = $this->db->query($sql);
        $resultArray = $query->result();
        return $resultArray;

    }

     public function receiptUnitsRegion($type='',$agency='',$region ='',$diameter) {

       // $sql = "SELECT SUM(a.units) as total_receipt, a.id, SUM(b.units) as totalunits, d.name as diametername FROM material_receipt a LEFT JOIN material_issue b ON a.id = b.lot LEFT JOIN diameter d ON a.diameter = d.id WHERE a.type = '$type' AND a.region = '$region'";

        // $sql = "SELECT SUM(a.units) as total_receipt,a.id,d.name as diametername FROM material_receipt a LEFT JOIN (SELECT SUM(units) as total_issue FROM material_issue) b ON a.id =b.lot LEFT JOIN diameter d ON a.diameter = d.id WHERE a.type = '$type' AND a.region = '$region'";
        $sql = "SELECT a.id FROM material_receipt a WHERE a.type = '$type'";
        if($agency != '') {
            $sql .=" AND a.purchased_by = '$agency'";
        }
        if($region !='') {
            $sql .=" AND a.`region` = '$region'";
        }
        if($diameter !='') {
            $sql .=" AND a.`diameter` = '$diameter'";
        }
        //$sql .=" GROUP BY a.diameter";
        //echo $sql;exit;
        $query = $this->db->query($sql);
        $resultArray = $query->result();
        return $resultArray;
    }

}