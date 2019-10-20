<?php
defined('BASEPATH') or exit('No direct script access allowed');
class RoleMenu
{
	private $CI;
	private $default_role = null;
	private $system_status = true;
	public function __construct()
	{
		$this->CI = &get_instance();
	}

	// User Controller

	public function init()
	{

		return $this->isAccessGranted();
	}
	/**
	 * return the ID of logged in user
	 */
	public function getLoggedUser()
	{
		if ($this->CI->session->userdata('id_user') != null) {
			return $this->CI->session->userdata('id_user');
		} else {
			return false;
		}
	}

	/**
	 * return the current controller accessed by user
	 */
	public function getController()
	{
		$controller_uri = $this->CI->router->fetch_directory() . $this->CI->router->class;
		return $controller_uri;
	}

	/**
	 * return the role of logged in user
	 */
	public function getUserRole()
	{

		if ($this->getLoggedUser()) {

			$this->CI->db->select('id_akses');
			$this->CI->db->where('id_user', $this->getLoggedUser());
			$result = $this->CI->db->get('user')->row();
			return $result->id_akses;
		} else {

			return $this->default_role;
		}
	}

	/**
	 * if user doesn't have access to the controller, redirect user to somewhere
	 */
	public function isAccessGranted()
	{

		if ($this->system_status) {
			if (!isset($_SESSION["login"])) {

				redirect("auth");
			} elseif ((!isset($_SESSION['id_properti'])) && ($_SESSION['id_akses'] != 1)) {

				redirect("auth/authproperti");
			} else {

				$this->CI = &get_instance();
				$this->CI->db->where(array('id_role' => $this->getUserRole(), 'controller_name' => $this->getController()));
				$query = $this->CI->db->get('tbl_role_access');

				if ($query->num_rows() < 1) {

					redirect("auth/blocked");
				}
			}
		}
	}
}
