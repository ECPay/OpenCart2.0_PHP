<?php
class ControllerPaymentecpayLogistic extends Controller 
{
	private $error = array(); 
	
	public function index() 
	{
		$this->response->redirect($this->url->link('shipping/ecpaylogistic', 'token=' . $this->session->data['token'], 'SSL'));
	}
	
	private function validate() 
	{
		return true;
	}
	
	public function install() 
	{
		$this->model_extension_extension->install('shipping', 'ecpaylogistic');
		$this->load->model('user/user_group');
		if (method_exists($this->user,"getGroupId")) {
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'payment/ecpaylogistic');
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'payment/ecpaylogistic');
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'shipping/ecpaylogistic');
			$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'shipping/ecpaylogistic');
		} 
		include_once("controller/shipping/ecpaylogistic.inc.php");
		$sFieldName = 'code';
		if (!ecpay_column_exists($this->db, DB_PREFIX."setting", 'code')) {
			$sFieldName = 'group';
		} 
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_status' , `value` = '0';");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_unimart_status' , `value` = '0';");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_fami_status' , `value` = '0';");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_fami_collection_status' , `value` = '0';");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_hilife_status' , `value` = '0';");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_hilife_collection_status' , `value` = '0';");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_unimart_collection_status' , `value` = '0';");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_order_status' , `value` = '1';");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_mid' , `value` = '2000933';");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_hashkey' , `value` = 'XBERn1YOvpM9nfZc';");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_hashiv' , `value` = 'h1ONHk4P4yqbl5LK';");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_type' , `value` = 'C2C';");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_sender_name' , `value` = '綠界科技';");
		$this->db->query("
				CREATE TABLE IF NOT EXISTS `ecpaylogistic_info` (
				  `order_id` INT(11) NOT NULL,
				  `AllPayLogisticsID` VARCHAR(50) NOT NULL,
				  KEY `order_id` (`order_id`)
				) DEFAULT COLLATE=utf8_general_ci;");
	}
	
	public function uninstall() 
	{
		$this->model_extension_extension->uninstall('shipping', 'ecpaylogistic');
		$this->load->model('user/user_group');
		if (method_exists($this->user,"getGroupId")) {
			$this->model_user_user_group->removePermission($this->user->getGroupId(), 'access', 'payment/ecpaylogistic');
			$this->model_user_user_group->removePermission($this->user->getGroupId(), 'modify', 'payment/ecpaylogistic');
			$this->model_user_user_group->removePermission($this->user->getGroupId(), 'access', 'shipping/ecpaylogistic');
			$this->model_user_user_group->removePermission($this->user->getGroupId(), 'modify', 'shipping/ecpaylogistic');
		} 
	}
}
