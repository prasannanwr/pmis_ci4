<?php

use App\Modules\district_name\Models\district_name_model;
use App\Modules\User\Models\UserModel;
use CodeIgniter\Model;

//$CI4 = new \App\Controllers\BaseController;

function register_ci_instance(\App\Controllers\BaseController &$_ci)
{
    global $CI_INSTANCE;
    $CI_INSTANCE[0] = &$_ci;
}

function &get_instance(): \App\Controllers\BaseController
{
    global $CI_INSTANCE;
    return $CI_INSTANCE[0];
}

if (!function_exists('et_getObjProp')) {
    function et_getObjProp($obj, $prop)
    {
        $ret = '';

        if (is_array($obj) && $obj[$prop] != '') {
            $ret = $obj[$prop];
        } elseif (isset($obj->{$prop}) && $obj->{$prop} != ''){
                $ret = $obj->{$prop};
        }
        return $ret;
    }
}

if (!function_exists('et_setFormVal')) {
    function et_setFormVal($fldName, $oldRec = '')
    {
        if (et_getObjProp($oldRec, $fldName) != '') {
            return set_value($fldName, et_getObjProp($oldRec, $fldName));
        } else {
            return set_value($fldName, 0);
        }
    }
}

if (!function_exists('et_setFormValBlank')) {
    function et_setFormValBlank($fldName, $oldRec = '')
    {
        if (et_getObjProp($oldRec, $fldName) != '') {
            return set_value($fldName, et_getObjProp($oldRec, $fldName));
        } else {
            return set_value($fldName, '');
        }
    }
}

if (!function_exists('et_form_dropdown_db')) {
    function et_form_dropdown_db($strName,  $strTableName, $strShowFld, $strBindFld, $strSelVal, $strWhere = '', $strExtraParam = '', $arrExtraOpt = '')
    {
        $arrOptions = array();
        if (is_array($arrExtraOpt)) {
            if (isset($arrExtraOpt['AddNone'])) {
                $nonCap = (isset($arrExtraOpt['NoneCaption']) ? $arrExtraOpt['NoneCaption'] : 'None');
                $nonVal = (isset($arrExtraOpt['NoneValue']) ? $arrExtraOpt['NoneValue'] : '');
                $arrOptions[$nonVal] = $nonCap;
            }
        }

        // $objVModel = new Model();
        // $objVModel->table = $strTableName;
        $db      = \Config\Database::connect();
        $builder = $db->table($strTableName);
        if (is_array($strWhere)) {
            foreach ($strWhere as $k => $v) {
                //var_dump($v);
                if (is_array($v))
                    $builder->{$v[1]}($v[0], $v[2]);
            }
        }
        if (isset($arrExtraOpt['SortBy'])) {
            $builder->orderBy($arrExtraOpt['SortBy']);
        }
        $output = $builder->get();
        $arrDBRec = $output->getResult();
        //echo $objVModel->db->last_query();
        if (is_array($arrDBRec)) {
            $arrOptions[" "] = "-- Please select --";
            foreach ($arrDBRec as $objRec) {
                $arrOptions[$objRec->{$strBindFld}] = $objRec->{$strShowFld};
            }
        }
        //var_dump( $arrOptions );
        $strExtraParam .= ' id = "' . $strName . '" ';
        return form_dropdown($strName, $arrOptions, $strSelVal, $strExtraParam);
    }
}

if (!function_exists('et_form_dropdown_db_dist')) {
    function et_form_dropdown_db_dist($strName,  $strTableName, $strShowFld, $strBindFld, $strSelVal, $strWhere = '', $strExtraParam = '', $arrExtraOpt = '')
    {
        $arrOptions = array();
        if (is_array($arrExtraOpt)) {
            if (isset($arrExtraOpt['AddNone'])) {
                $nonCap = (isset($arrExtraOpt['NoneCaption']) ? $arrExtraOpt['NoneCaption'] : 'None');
                $nonVal = (isset($arrExtraOpt['NoneValue']) ? $arrExtraOpt['NoneValue'] : '');
                $arrOptions[$nonVal] = $nonCap;
            }
        }

        //$objVModel = new Model();
        //$objVModel->table = $strTableName;
        $db      = \Config\Database::connect();
        $objVModel = $db->table($strTableName);
        if ($strWhere != '' && is_array($strWhere)) {
            $objVModel->whereIn("dist01id", $strWhere);
        }
        if (isset($arrExtraOpt['SortBy'])) {
            $objVModel->orderBy($arrExtraOpt['SortBy']);
        }
        $output = $objVModel->get();
        $arrDBRec = $output->getResult();
        //echo $objVModel->db->last_query();
        if (is_array($arrDBRec)) {
            $arrOptions[" "] = "-- Please select --";
            foreach ($arrDBRec as $objRec) {
                $arrOptions[$objRec->{$strBindFld}] = $objRec->{$strShowFld};
            }
        }
        //var_dump( $arrOptions );
        $strExtraParam .= ' id = "' . $strName . '" ';
        return form_dropdown($strName, $arrOptions, $strSelVal, $strExtraParam);
    }
}
function _day()
{
    return date('Y/m/d');
}

function getPermittedDistCondStr()
{
    $CI = get_instance();
    $CI->load->model('users/users_model');
    $arrPerm = $CI->users_model->getArrPermitedDistList();

    $blnIsLogged = $CI->users_model->is_logged_in();
    $intUserType = ($blnIsLogged) ? $CI->users_model->getLoggedType() : ENUM_GUEST;
    //var_dump($blnIsLogged);
    if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
        //comma seperated value
        if (count($arrPerm) > 0) {
            $ret = array('dist01id', 'where_in', $arrPerm);
        } else {
            $ret = array('dist01id', 'where', null);
        }
    } else {
        $ret = '';
    }
    return $ret;
}

function getPermittedDists()
{
    $CI = get_instance();
    $users_model = new UserModel();
    $arrPerm = $users_model->getArrPermitedDistList();

    $blnIsLogged = $users_model->is_logged_in();
    $intUserType = ($blnIsLogged) ? $users_model->getLoggedType() : ENUM_GUEST;
    //var_dump($blnIsLogged);
    if ($intUserType == ENUM_REGIONAL_MANAGER || $intUserType == ENUM_REGIONAL_OPERATOR) {
        //comma seperated value
        if (count($arrPerm) > 0) {
            $ret = $arrPerm;
        } else {
            $ret = null;
        }
    } else {
        $ret = '';
    }
    return $ret;
}

function BlockOperator()
{
    $CI = get_instance();
    $CI->load->model('users/users_model');
    $ut = $CI->users_model->getLoggedType();

    if (!($ut == ENUM_ADMINISTRATOR ||
        $ut == ENUM_CENTRAL_MANAGER ||
        $ut == ENUM_REGIONAL_MANAGER)) {

        $message = 'Not ';
        redirect('dashboard', 'refresh');
    }
}

/**
		Function to get the current timestamp for uinque id
 */
function getTimeStamp()
{
    $x = microtime();
    $x = preg_replace('/\./', '', $x);
    $x = preg_replace('/ /', '', $x);
    return $x;
}

function getAppRoot()
{
    return dirname(dirname(dirname(__FILE__)));
}

function uploadFile($strFld)
{
    $approot = getAppRoot();
    $arrAllowedTypes = array('jpg', 'gif', 'png', 'bmp');
    if (isset($_FILES[$strFld]['name'])) {
        $tmpName = $_FILES[$strFld]['tmp_name'];
        $fileType = $_FILES[$strFld]['type'];
        $fileExt = strtolower(substr($_FILES[$strFld]['name'], strrpos($_FILES[$strFld]['name'], '.')));
        $newFileName = getTimeStamp() . $fileExt;
        $destLoc = $approot . '/uploads/';
        $extOnly = substr($fileExt, 1);
        //Check the file type
        if (is_array($arrAllowedTypes)) {
            if (!in_array($extOnly, $arrAllowedTypes)) {
                return array(false, 'Invalid File Type...');
            }
        } elseif ($arrAllowedTypes != '' && $arrAllowedTypes !== $extOnly) {
            return array(false, 'Invalid File Type...');
        }

        if (move_uploaded_file($tmpName, $destLoc . $newFileName)) {
            $strReturn = array(true, $newFileName);
        }
        return $strReturn;
    }
}

function choosename($str = '')
{
    if ($str !== '') {
        $x = "Major Maintenance Bridge Report";
    } else {
        $x = "New Bridge Report";
    }
    return $x;
}

//ADoR (Allocatecd District of reponsibity )
function user_ador($strName,  $strTableName, $strShowFld, $strBindFld, $strSelVal, $strWhere = '', $strExtraParam = '', $arrExtraOpt = '')
{
    $ci = &get_instance();
    $district_name_model = new district_name_model();
    $arrDBRec = $district_name_model->findAll();

    $arrOptions = array();
    if (is_array($arrExtraOpt)) {
        if (isset($arrExtraOpt['AddNone'])) {
            $nonCap = (isset($arrExtraOpt['NoneCaption']) ? $arrExtraOpt['NoneCaption'] : 'None');
            $nonVal = (isset($arrExtraOpt['NoneValue']) ? $arrExtraOpt['NoneValue'] : '');
            $arrOptions[$nonVal] = $nonCap;
        }
    }

    //echo $objVModel->db->last_query();
    if (is_array($arrDBRec)) {
        foreach ($arrDBRec as $objRec) {
            $arrOptions[$objRec[$strBindFld]] = $objRec[$strShowFld];
        }
    }
    //var_dump( $arrOptions );
    $strExtraParam .= ' id = "' . $strName . '" ';
    return form_dropdown("district", $arrOptions, $strSelVal, $strExtraParam);
}

// if (!function_exists('check_access')) {
//     function check_access($emp_access_arr, $dept_id = 0)
//     {
//         $CI = &get_instance();

//         //Full access for admin
//         if ($CI->session->userdata('user_id') == 1) {
//             return TRUE;
//         }

//         $my_access = My_access::get_access_dept($dept_id);

//         //if($dept_id != 0)
//         //printt($my_access);

//         if (!is_array($emp_access_arr)) {
//             return FALSE;
//         } else {
//             if (empty($my_access)) {
//                 return FALSE;
//             }

//             foreach ($my_access as $acc) {
//                 $emp_access = elements($emp_access_arr, $acc);
//                 /*if($dept_id != 0)
// 				printt($emp_access);*/

//                 if (in_array('Y', $emp_access)) {
//                     return TRUE;
//                 }
//             }
//         }
//         return FALSE;
//     }
// }

if (!function_exists('check_access_general')) {
    function check_access_general($emp_access_arr)
    {
        $CI = &get_instance();

        //Full access for admin
        if (session()->get('user_id') == 1) {
            return TRUE;
        }
        
        return FALSE;
    }
}

if (!function_exists('is_checked')) {
    function is_checked($emp_access_arr, $val)
    {
        if (empty($emp_access_arr)) {
            return '';
        }

        if ($emp_access_arr->{$val} == 'Y') {
            return 'checked';
        }

        return '';
    }
}

if (!function_exists('printt')) {
    function printt($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}

if (!function_exists('log_query')) {
    function log_query($message = '')
    {
        $CI = &get_instance();
        $data['query'] = $CI->db->last_query();
        $data['message'] = $message;
        $data['issued_by'] = $CI->session->userdata('user_id');
        $data['issued_on'] = date('Y-m-d H:i:s');
        $CI->db->insert('query_log', $data);
    }
}

if (!function_exists('get_user_organizations')) {
    function get_user_organizations($emp_id = FALSE)
    {
        $CI = &get_instance();

        $emp_id = isset($emp_id) ? $emp_id : $CI->session->userdata('user_id');

        $mysql_query = "SELECT DISTINCT organization_ref AS org_id FROM employee_designation WHERE employee_ref = " . $emp_id;

        $query = $CI->db->query($mysql_query);
        return $query->result_array();
    }
}

if (!function_exists('get_user_departments')) {
    function get_user_departments($emp_id = FALSE)
    {
        $CI = &get_instance();

        $emp_id = ($emp_id != FALSE) ? $emp_id : $CI->session->userdata('user_id');

        $mysql_query = "SELECT DISTINCT department_ref AS dep_id FROM employee_designation WHERE employee_ref = " . $emp_id;

        $query = $CI->db->query($mysql_query);
        return $query->result_array();
    }
}

if (!function_exists('_check')) {
    function _check($check_arr, $chk_func = '', $param = '', $msg = '', $msg_type = 'info', $redirect = NULL)
    {
        $CI = &get_instance();

        $fname = ($chk_func == '') ? 'check_access' : 'check_access_' . $chk_func;

        $val = ($param == '') ? $fname($check_arr) : $fname($check_arr, $param);

        if (!$val) {
            $CI->session->set_flashdata('message_type', $msg_type);
            $CI->session->set_flashdata('message', $msg);

            if ($redirect) {
                redirect($redirect);
            }
        }
    }
}

if (!function_exists('set_message')) {
    function set_message($msg, $msg_type = 'info')
    {
        $CI = &get_instance();
        $CI->session->set_flashdata('message_type', $msg_type);
        $CI->session->set_flashdata('message', $msg);
    }
}