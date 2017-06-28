<?php
class ControllerShippingecpayLogistic extends Controller {
	protected function index() {
	}
	
	public function show_cvs_map() {
		include_once("admin/controller/shipping/ecpaylogistic.inc.php");
		$sFieldName = 'code';
		if (!ecpay_column_exists($this->db, DB_PREFIX."setting", 'code')) {
			$sFieldName = 'group';
		} 
		$get_ecpaylogistic_setting_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `" . $sFieldName . "` = 'ecpaylogistic'");
		$ecpaylogisticSetting=array();
		foreach($get_ecpaylogistic_setting_query->rows as $value){
			$ecpaylogisticSetting[$value["key"]]=$value["value"];
		}
		
		include_once("admin/controller/shipping/ECPay.Logistics.Integration.php");
		
		if ( $ecpaylogisticSetting['ecpaylogistic_type'] == 'C2C' ) {
			$shippingMethod = [
				'fami' => LogisticsSubType::FAMILY_C2C,
				'fami_collection' => LogisticsSubType::FAMILY_C2C,
				'unimart' => LogisticsSubType::UNIMART_C2C,
				'unimart_collection' => LogisticsSubType::UNIMART_C2C,
				'hilife' => LogisticsSubType::HILIFE_C2C,
				'hilife_collection' => LogisticsSubType::HILIFE_C2C
			];
		} else {
			$shippingMethod = [
				'fami' => LogisticsSubType::FAMILY,
				'fami_collection' => LogisticsSubType::FAMILY,
				'unimart' => LogisticsSubType::UNIMART,
				'unimart_collection' => LogisticsSubType::UNIMART,
				'hilife' => LogisticsSubType::HILIFE,
				'hilife_collection' => LogisticsSubType::HILIFE
			];
		}

		$logisticSubType = explode(".", $this->request->get['shipping_method']);

		if (array_key_exists($logisticSubType[1], $shippingMethod)) {
			$al_subtype = $shippingMethod[$logisticSubType[1]];
		}

		if (!isset($al_subtype)) {
			exit;
		}
		$al_iscollection = (strpos($this->request->get['shipping_method'],'_collection')) ? IsCollection::YES : IsCollection::NO;
		$al_srvreply = (($_SERVER['HTTPS']) ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '/index.php?route=shipping/ecpaylogistic/set_store_info';
		
		try {
			$AL = new ECPayLogistics();
			$AL->Send = array(
				'MerchantID' => $ecpaylogisticSetting['ecpaylogistic_mid'],
				'MerchantTradeNo' => 'no' . date('YmdHis'),
				'LogisticsSubType' => $al_subtype,
				'IsCollection' => $al_iscollection,
				'ServerReplyURL' => $al_srvreply,
				'ExtraData' => '',
				'Device' => Device::PC
			);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		$html = $AL->CvsMap('');
		echo $html;
	}
	
	public function show_cvs_map_by_order() {
		$order_id = $this->request->get['order_id'];
		
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/order/info', 'order_id=' . $order_id, 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}
		$this->load->model('account/order');

		$aorder_info = $this->model_account_order->getOrder($order_id);
		
		if ($aorder_info) {
			include_once("admin/controller/shipping/ECPay.Logistics.Integration.php");
			include_once("admin/controller/shipping/ecpaylogistic.inc.php");
			$sServerReply = (($_SERVER['HTTPS']) ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '/index.php?route=shipping/ecpaylogistic/set_store_info_by_order';
			ecpay_show_cvs_map_by_order($this->db,$order_id,$sServerReply);
		} else {
			echo "訂單編號不存在";
			exit;
		}
	}
	
	public function set_store_info() {
		if($this->request->post['CVSStoreID']){
			$this->session->data["shipping_methods"]["ecpaylogistic"]['CVSStoreID'] = $this->request->post['CVSStoreID'];
			$this->session->data["shipping_methods"]["ecpaylogistic"]['CVSStoreName'] = $this->request->post['CVSStoreName'];
			$this->session->data["shipping_methods"]["ecpaylogistic"]['CVSAddress'] = $this->request->post['CVSAddress'];
			$this->session->data["shipping_methods"]["ecpaylogistic"]['CVSTelephone'] = (isset($this->request->post['CVSTelephone'])) ? $this->request->post['CVSTelephone'] : '';
			
			header("Content-Type:text/html; charset=utf-8");
			echo "<script type='text/javascript'>";
			echo "window.opener.set_store_info('" . $this->request->post['CVSStoreID'] . "','" . $this->request->post['CVSStoreName'] . "','". $this->request->post['CVSAddress'] ."','" . $this->request->post['CVSTelephone'] . "');";
			echo "window.close();";
			echo "</script>";
		}
	}
	
	public function set_store_info_by_order() {
		$order_id = $this->request->post['ExtraData'];
		
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/order/info', 'order_id=' . $order_id, 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}
		$this->load->model('account/order');

		$aorder_info = $this->model_account_order->getOrder($order_id);
		if (!$aorder_info) {
			echo "訂單編號不存在";
			exit;
		}
		
		if($this->request->post['CVSStoreID']){
			include_once("admin/controller/shipping/ecpaylogistic.inc.php");
			ecpay_set_store_info_by_order($this->db,$this->request->post);
		} else {
			echo "門市資訊錯誤";
			exit;
		}
	}
	
	public function response() {
		include_once("admin/controller/shipping/ECPay.Logistics.Integration.php");
		include_once("admin/controller/shipping/ecpaylogistic.inc.php");
		$sFieldName = 'code';
		if (!ecpay_column_exists($this->db, DB_PREFIX."setting", 'code')) {
			$sFieldName = 'group';
		} 
		$get_ecpaylogistic_setting_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `" . $sFieldName . "` = 'ecpaylogistic'");
		$ecpaylogisticSetting=array();
		foreach($get_ecpaylogistic_setting_query->rows as $value){
			$ecpaylogisticSetting[$value["key"]]=$value["value"];
		}
		try {
			$AL = new ECPayLogistics();
			$AL->HashKey = $ecpaylogisticSetting['ecpaylogistic_hashkey'];
			$AL->HashIV = $ecpaylogisticSetting['ecpaylogistic_hashiv'];
			$AL->CheckOutFeedback($this->request->post);
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int)$this->request->post['MerchantTradeNo'] . "'" );
            $aOrder_Info_Tmp = $query->rows[0] ;
			$sMsg = "綠界科技廠商管理後台物流訊息:<br>" . print_r($this->request->post, true);
			if ($this->request->post['RtnCode'] == '2067' || $this->request->post['RtnCode'] == '3022') {
				$aOrder_Info_Tmp['order_status_id'] = 5;
			}
			$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$this->request->post['MerchantTradeNo'] . "', order_status_id = '" . (int)$aOrder_Info_Tmp['order_status_id'] . "', notify = '0', comment = '" . $this->db->escape($sMsg) . "', date_added = NOW()");
			echo '1|OK';
		} catch(Exception $e) {
			echo '0|' . $e->getMessage();
		}
	}
	
	public function LogisticsC2CReply() {
		include_once("admin/controller/shipping/ECPay.Logistics.Integration.php");
		$get_ecpaylogistic_setting_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `code` = 'ecpaylogistic'");
		$ecpaylogisticSetting=array();
		foreach($get_ecpaylogistic_setting_query->rows as $value){
			$ecpaylogisticSetting[$value["key"]]=$value["value"];
		}
		try {
			$AL = new ECPayLogistics();
			$AL->HashKey = $ecpaylogisticSetting['ecpaylogistic_hashkey'];
			$AL->HashIV = $ecpaylogisticSetting['ecpaylogistic_hashiv'];
			$AL->CheckOutFeedback($this->request->post);
			$query = $this->db->query("SELECT * FROM `ecpaylogistic_info` WHERE AllPayLogisticsID =".$this->db->escape($this->request->post['AllPayLogisticsID']));
			if ($query->num_rows) {
				$aAL_info = $query->rows[0];
				$this->db->query("UPDATE " . DB_PREFIX . "order SET order_status_id = 1 WHERE order_id = ".(int)$aAL_info['order_id']);
				$sMsg = "綠界科技廠商管理後台更新門市通知:<br>" . print_r($this->request->post, true);
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$aAL_info['order_id'] . "', order_status_id = '1', notify = '0', comment = '" . $this->db->escape($sMsg) . "', date_added = NOW()");
				echo '1|OK';
			} else {
				echo '0|AllPayLogisticsID not found';
			}
		} catch(Exception $e) {
			echo '0|' . $e->getMessage();
		}
	}
}
?>