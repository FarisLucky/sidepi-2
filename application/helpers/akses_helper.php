<?php

function getCompanyLogo()
{
    $CI =& get_instance();
    $CI->db->select('logo_perusahaan,pemilik,nama,alamat,email,telepon');
    $get = $CI->db->get('perusahaan',1)->row();
    return $get;
}

function getProperti($properti,$id)
{
    $CI =& get_instance();
    $query = $CI->db->get_where('user_assign_properti',['id_properti'=>"$properti",'id_user'=>$id]);
    if ($query->num_rows() > 0) {
        $value = "checked";
    }else{
        $value = "";
    }
    return $value;
}
function getSasaran($sasaran,$unit)
{
    $CI =& get_instance();
    $query = $CI->db->get_where('persyaratan_unit',['kelompok_persyaratan'=>"$sasaran",'id_unit'=>$unit]);
    if ($query->num_rows() > 0) {
        $value = "checked";
    }else{
        $value = "";
    }
    return $value;
}
function getKelompok($tbl,$where)
{
    $CI =& get_instance();
    $query = $CI->db->get_where($tbl,$where);
    if ($query->num_rows() > 0) {
        $value = "checked";
    }else{
        $value = "";
    }
    return $value;
}

function addMonths($date,$months) {
    $orig_day = $date->format("d");
    $date->modify("+".$months." months");
    while ($date->format("d") < $orig_day && $date->format("d") < 5) {
        $date->modify("-1 day");
    }
}
function get_where($tbl,$where) {
    $CI =& get_instance();
    $id_user = $CI->db->get_where($tbl,$where);
    return $id_user;
}
function getController() {

    $CI =& get_instance();
    $controller_uri = $CI->router->fetch_directory() . $CI->router->class;
    return $controller_uri;

}
function getDataWhere($select,$tbl,$where,$order = null,$order_by = null) {

    $CI =& get_instance();
    $CI->db->select($select);
    $CI->db->from($tbl);
    $CI->db->where($where);
    if ($order != null) {
        $CI->db->order_by($order, $order_by);
    }
    $query = $CI->db->get();
    return $query;

}

function get_time()
{
    return time();
}