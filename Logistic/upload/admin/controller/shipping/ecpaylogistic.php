<?php
class ControllerShippingecpayLogistic extends Controller 
{
	private $error = array(); 
	
	public function index() 
	{
		$this->load->language('shipping/ecpaylogistic');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            if ($this->request->post['ecpaylogistic_unimart_collection_status'] != '1') {
                unset($this->request->post['ecpaylogistic_unimart_collection_fee']);
            }
            
            if ($this->request->post['ecpaylogistic_fami_collection_status'] != '1') {
                unset($this->request->post['ecpaylogistic_fami_collection_fee']);
            }

            if ($this->request->post['ecpaylogistic_hilife_collection_status'] != '1') {
                unset($this->request->post['ecpaylogistic_hilife_collection_fee']);
            }
			
            if ($this->request->post['ecpaylogistic_fami_status'] != '1') {
                unset($this->request->post['ecpaylogistic_fami_fee']);
            }
			
            if ($this->request->post['ecpaylogistic_unimart_status'] != '1') {
                unset($this->request->post['ecpaylogistic_unimart_fee']);
            }

            if ($this->request->post['ecpaylogistic_hilife_status'] != '1') {
                unset($this->request->post['ecpaylogistic_hilife_fee']);
            }
            
			$this->model_setting_setting->editSetting('ecpaylogistic', $this->request->post);
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_general'] = $this->language->get('text_general');
		$data['text_unimart_collection'] = $this->language->get('text_unimart_collection');
		$data['text_fami_collection'] = $this->language->get('text_fami_collection');
		$data['text_unimart'] = $this->language->get('text_unimart');
		$data['text_fami'] = $this->language->get('text_fami');
		$data['text_hilife_collection'] = $this->language->get('text_hilife_collection');
		$data['text_hilife'] = $this->language->get('text_hilife');

		$data['text_sender_cellphone'] = $this->language->get('text_sender_cellphone');

		$data['entry_mid'] = $this->language->get('entry_mid');
		$data['entry_hashkey'] = $this->language->get('entry_hashkey');
		$data['entry_hashiv'] = $this->language->get('entry_hashiv');
		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_FreeShippingAmount'] = $this->language->get('entry_FreeShippingAmount');
		$data['entry_MinAmount'] = $this->language->get('entry_MinAmount');
		$data['entry_MaxAmount'] = $this->language->get('entry_MaxAmount');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_sender_name'] = $this->language->get('entry_sender_name');
		$data['entry_sender_cellphone'] = $this->language->get('entry_sender_cellphone');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['entry_UNIMART_Collection_fee'] = $this->language->get('entry_UNIMART_Collection_fee');
		$data['entry_FAMI_Collection_fee'] = $this->language->get('entry_FAMI_Collection_fee');
		$data['entry_HILIFE_Collection_fee'] = $this->language->get('entry_HILIFE_Collection_fee');
		$data['entry_UNIMART_fee'] = $this->language->get('entry_UNIMART_fee');
		$data['entry_FAMI_fee'] = $this->language->get('entry_FAMI_fee');
		$data['entry_HILIFE_fee'] = $this->language->get('entry_HILIFE_fee');
	
		if (isset($this->error['error_warning'])) {
			$data['error_warning'] = $this->error['error_warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['mid'])) {
			$data['error_mid'] = $this->error['mid'];
		} else {
			$data['error_mid'] = '';
		}
		if (isset($this->error['hashkey'])) {
			$data['error_hashkey'] = $this->error['hashkey'];
		} else {
			$data['error_hashkey'] = '';
		}
		if (isset($this->error['hashiv'])) {
			$data['error_hashiv'] = $this->error['hashiv'];
		} else {
			$data['error_hashiv'] = '';
		}
		if (isset($this->error['UNIMART_Collection_fee'])) {
			$data['error_UNIMART_Collection_fee'] = $this->error['UNIMART_Collection_fee'];
		} else {
			$data['error_UNIMART_Collection_fee'] = '';
		}
		if (isset($this->error['FAMI_Collection_fee'])) {
			$data['error_FAMI_Collection_fee'] = $this->error['FAMI_Collection_fee'];
		} else {
			$data['error_FAMI_Collection_fee'] = '';
		}
		if (isset($this->error['FreeShippingAmount'])) {
			$data['error_FreeShippingAmount'] = $this->error['FreeShippingAmount'];
		} else {
			$data['error_FreeShippingAmount'] = '';
		}
		if (isset($this->error['MinAmount'])) {
			$data['error_MinAmount'] = $this->error['MinAmount'];
		} else {
			$data['error_MinAmount'] = '';
		}
		if (isset($this->error['MaxAmount'])) {
			$data['error_MaxAmount'] = $this->error['MaxAmount'];
		} else {
			$data['error_MaxAmount'] = '';
		}
		if (isset($this->error['UNIMART_fee'])) {
			$data['error_UNIMART_fee'] = $this->error['UNIMART_fee'];
		} else {
			$data['error_UNIMART_fee'] = '';
		}
		if (isset($this->error['FAMI_fee'])) {
			$data['error_FAMI_fee'] = $this->error['FAMI_fee'];
		} else {
			$data['error_FAMI_fee'] = '';
		}
		if (isset($this->error['sender_name'])) {
			$data['error_sender_name'] = $this->error['sender_name'];
		} else {
			$data['error_sender_name'] = '';
		}
		if (isset($this->error['sender_cellphone'])) {
			$data['error_sender_cellphone'] = $this->error['sender_cellphone'];
		} else {
			$data['error_sender_cellphone'] = '';
		}
		
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_shipping'),
			'href' => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL')
		);
		$data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('shipping/ecpaylogistic', 'token=' . $this->session->data['token'], 'SSL')
        );          
		
		$data['ecpaylogistic_types'] = array();
		$data['ecpaylogistic_types'][] = array(
			'value' => 'C2C',
			'text' => 'C2C'
		);
		$data['ecpaylogistic_types'][] = array(
			'value' => 'B2C',
			'text' => 'B2C'
		);
		
		$data['ecpaylogistic_statuses'] = array();
		$data['ecpaylogistic_statuses'][] = array(
			'value' => '1',
			'text' => $this->language->get('text_enabled')
		);
		$data['ecpaylogistic_statuses'][] = array(
			'value' => '0',
			'text' => $this->language->get('text_disabled')
		);
		
		$this->load->model('localisation/geo_zone');
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		$this->load->model('localisation/order_status');
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		$data['action'] = $this->url->link('shipping/ecpaylogistic', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['ecpaylogistic_mid'])) {
			$data['ecpaylogistic_mid'] = $this->request->post['ecpaylogistic_mid'];
		} else {
			$data['ecpaylogistic_mid'] = $this->config->get('ecpaylogistic_mid');
		}
		if (isset($this->request->post['ecpaylogistic_hashkey'])) {
			$data['ecpaylogistic_hashkey'] = $this->request->post['ecpaylogistic_hashkey'];
		} else {
			$data['ecpaylogistic_hashkey'] = $this->config->get('ecpaylogistic_hashkey');
		}
		if (isset($this->request->post['ecpaylogistic_hashiv'])) {
			$data['ecpaylogistic_hashiv'] = $this->request->post['ecpaylogistic_hashiv'];
		} else {
			$data['ecpaylogistic_hashiv'] = $this->config->get('ecpaylogistic_hashiv');
		}
		if (isset($this->request->post['ecpaylogistic_type'])) {
			$data['ecpaylogistic_type'] = $this->request->post['ecpaylogistic_type'];
		} else {
			$data['ecpaylogistic_type'] = $this->config->get('ecpaylogistic_type');
		}
		if (isset($this->request->post['ecpaylogistic_unimart_collection_fee'])) {
			$data['ecpaylogistic_unimart_collection_fee'] = $this->request->post['ecpaylogistic_unimart_collection_fee'];
		} else {
			$data['ecpaylogistic_unimart_collection_fee'] = $this->config->get('ecpaylogistic_unimart_collection_fee');
		}
		if (isset($this->request->post['ecpaylogistic_fami_collection_fee'])) {
			$data['ecpaylogistic_fami_collection_fee'] = $this->request->post['ecpaylogistic_fami_collection_fee'];
		} else {
			$data['ecpaylogistic_fami_collection_fee'] = $this->config->get('ecpaylogistic_fami_collection_fee');
		}
		if (isset($this->request->post['ecpaylogistic_hilife_collection_fee'])) {
			$data['ecpaylogistic_hilife_collection_fee'] = $this->request->post['ecpaylogistic_hilife_collection_fee'];
		} else {
			$data['ecpaylogistic_hilife_collection_fee'] = $this->config->get('ecpaylogistic_hilife_collection_fee');
		}
		if (isset($this->request->post['ecpaylogistic_geo_zone_id'])) {
			$data['ecpaylogistic_geo_zone_id'] = $this->request->post['ecpaylogistic_geo_zone_id'];
		} else {
			$data['ecpaylogistic_geo_zone_id'] = $this->config->get('ecpaylogistic_geo_zone_id');
		}
		if (isset($this->request->post['ecpaylogistic_status'])) {
			$data['ecpaylogistic_status'] = $this->request->post['ecpaylogistic_status'];
		} else {
			$data['ecpaylogistic_status'] = $this->config->get('ecpaylogistic_status');
		}
		if (isset($this->request->post['ecpaylogistic_unimart_status'])) {
			$data['ecpaylogistic_unimart_status'] = $this->request->post['ecpaylogistic_unimart_status'];
		} else {
			$data['ecpaylogistic_unimart_status'] = $this->config->get('ecpaylogistic_unimart_status');
		}
		if (isset($this->request->post['ecpaylogistic_unimart_collection_status'])) {
			$data['ecpaylogistic_unimart_collection_status'] = $this->request->post['ecpaylogistic_unimart_collection_status'];
		} else {
			$data['ecpaylogistic_unimart_collection_status'] = $this->config->get('ecpaylogistic_unimart_collection_status');
		}
		if (isset($this->request->post['ecpaylogistic_fami_status'])) {
			$data['ecpaylogistic_fami_status'] = $this->request->post['ecpaylogistic_fami_status'];
		} else {
			$data['ecpaylogistic_fami_status'] = $this->config->get('ecpaylogistic_fami_status');
		}
		if (isset($this->request->post['ecpaylogistic_hilife_status'])) {
			$data['ecpaylogistic_hilife_status'] = $this->request->post['ecpaylogistic_hilife_status'];
		} else {
			$data['ecpaylogistic_hilife_status'] = $this->config->get('ecpaylogistic_hilife_status');
		}
		if (isset($this->request->post['ecpaylogistic_fami_collection_status'])) {
			$data['ecpaylogistic_fami_collection_status'] = $this->request->post['ecpaylogistic_status'];
		} else {
			$data['ecpaylogistic_fami_collection_status'] = $this->config->get('ecpaylogistic_fami_collection_status');
		}
		if (isset($this->request->post['ecpaylogistic_hilife_collection_status'])) {
			$data['ecpaylogistic_hilife_collection_status'] = $this->request->post['ecpaylogistic_status'];
		} else {
			$data['ecpaylogistic_hilife_collection_status'] = $this->config->get('ecpaylogistic_hilife_collection_status');
		}
		if (isset($this->request->post['ecpaylogistic_unimart_fee'])) {
			$data['ecpaylogistic_unimart_fee'] = $this->request->post['ecpaylogistic_unimart_fee'];
		} else {
			$data['ecpaylogistic_unimart_fee'] = $this->config->get('ecpaylogistic_unimart_fee');
		}
		if (isset($this->request->post['ecpaylogistic_fami_fee'])) {
			$data['ecpaylogistic_fami_fee'] = $this->request->post['ecpaylogistic_fami_fee'];
		} else {
			$data['ecpaylogistic_fami_fee'] = $this->config->get('ecpaylogistic_fami_fee');
		}
		if (isset($this->request->post['ecpaylogistic_hilife_fee'])) {
			$data['ecpaylogistic_hilife_fee'] = $this->request->post['ecpaylogistic_hilife_fee'];
		} else {
			$data['ecpaylogistic_hilife_fee'] = $this->config->get('ecpaylogistic_hilife_fee');
		}
		if (isset($this->request->post['ecpaylogistic_free_shipping_amount'])) {
			$data['ecpaylogistic_free_shipping_amount'] = $this->request->post['ecpaylogistic_free_shipping_amount'];
		} else {
			$data['ecpaylogistic_free_shipping_amount'] = $this->config->get('ecpaylogistic_free_shipping_amount');
		}
		if (isset($this->request->post['ecpaylogistic_max_amount'])) {
			$data['ecpaylogistic_max_amount'] = $this->request->post['ecpaylogistic_max_amount'];
		} else {
			$data['ecpaylogistic_max_amount'] = $this->config->get('ecpaylogistic_max_amount');
		}
		if (isset($this->request->post['ecpaylogistic_min_amount'])) {
			$data['ecpaylogistic_min_amount'] = $this->request->post['ecpaylogistic_min_amount'];
		} else {
			$data['ecpaylogistic_min_amount'] = $this->config->get('ecpaylogistic_min_amount');
		}
		if (isset($this->request->post['ecpaylogistic_order_status'])) {
			$data['ecpaylogistic_order_status'] = $this->request->post['ecpaylogistic_order_status'];
		} else {
			$data['ecpaylogistic_order_status'] = $this->config->get('ecpaylogistic_order_status'); 
		} 
		if (isset($this->request->post['ecpaylogistic_sender_name'])) {
			$data['ecpaylogistic_sender_name'] = $this->request->post['ecpaylogistic_sender_name'];
		} else {
			$data['ecpaylogistic_sender_name'] = $this->config->get('ecpaylogistic_sender_name');
		}
		if (isset($this->request->post['ecpaylogistic_sender_cellphone'])) {
			$data['ecpaylogistic_sender_cellphone'] = $this->request->post['ecpaylogistic_sender_cellphone'];
		} else {
			$data['ecpaylogistic_sender_cellphone'] = $this->config->get('ecpaylogistic_sender_cellphone');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('shipping/ecpaylogistic.tpl', $data));
	}
	
	private function validate() 
	{
		if (!$this->user->hasPermission('modify', 'shipping/ecpaylogistic')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (empty($this->request->post['ecpaylogistic_mid'])) {
			$this->error['mid'] = $this->language->get('error_mid');
		}
		if (empty($this->request->post['ecpaylogistic_hashkey'])) {
			$this->error['hashkey'] = $this->language->get('error_hashkey');
		}
		if (empty($this->request->post['ecpaylogistic_hashiv'])) {
			$this->error['hashiv'] = $this->language->get('error_hashiv');
		}
		if (empty($this->request->post['ecpaylogistic_sender_name'])) {
			$this->error['sender_name'] = $this->language->get('error_sender_name');
		}
		$bite_sender_name = $this->bite_str($this->request->post['ecpaylogistic_sender_name'],0,10);
		if ($bite_sender_name != $this->request->post['ecpaylogistic_sender_name']) {
			$this->error['sender_name'] = $this->language->get('error_sender_name_length');
		}
		if ($this->request->post['ecpaylogistic_type'] == 'C2C' && empty($this->request->post['ecpaylogistic_sender_cellphone'])) {
			$this->error['sender_cellphone'] = $this->language->get('error_sender_cellphone');
		}
        if ($this->request->post['ecpaylogistic_unimart_collection_status'] == '1') {
            if(!is_numeric($this->request->post['ecpaylogistic_unimart_collection_fee']) || $this->request->post['ecpaylogistic_unimart_collection_fee'] < 0){
                $this->error['UNIMART_Collection_fee'] = $this->language->get('error_UNIMART_Collection_fee');
            }
        }
		if ($this->request->post['ecpaylogistic_fami_collection_status'] == '1') {
            if(!is_numeric($this->request->post['ecpaylogistic_fami_collection_fee']) || $this->request->post['ecpaylogistic_fami_collection_fee'] < 0){
                $this->error['FAMI_Collection_fee'] = $this->language->get('error_FAMI_Collection_fee');
            }
        }
		if ($this->request->post['ecpaylogistic_hilife_collection_status'] == '1') {
            if(!is_numeric($this->request->post['ecpaylogistic_hilife_collection_fee']) || $this->request->post['ecpaylogistic_hilife_collection_fee'] < 0){
                $this->error['HILIFE_Collection_fee'] = $this->language->get('error_HILIFE_Collection_fee');
            }
        }
		if ($this->request->post['ecpaylogistic_fami_status'] == '1') {
            if(!is_numeric($this->request->post['ecpaylogistic_fami_fee']) || $this->request->post['ecpaylogistic_fami_fee'] < 0){
                $this->error['FAMI_fee'] = $this->language->get('error_FAMI_fee');
            }
        }
		if ($this->request->post['ecpaylogistic_hilife_status'] == '1') {
            if(!is_numeric($this->request->post['ecpaylogistic_hilife_fee']) || $this->request->post['ecpaylogistic_hilife_fee'] < 0){
                $this->error['HILIFE_fee'] = $this->language->get('error_HILIFE_fee');
            }
        }
        if ($this->request->post['ecpaylogistic_unimart_status'] == '1') {
            if(!is_numeric($this->request->post['ecpaylogistic_unimart_fee']) || $this->request->post['ecpaylogistic_unimart_fee'] < 0){
                $this->error['UNIMART_fee'] = $this->language->get('error_UNIMART_fee');
            }
        }
		if (!is_numeric($this->request->post['ecpaylogistic_min_amount']) || $this->request->post['ecpaylogistic_min_amount'] < 0){
			$this->error['MinAmount'] = $this->language->get('error_MinAmount');
		}
		if (!is_numeric($this->request->post['ecpaylogistic_free_shipping_amount']) || $this->request->post['ecpaylogistic_free_shipping_amount'] < 0){
			$this->error['FreeShippingAmount'] = $this->language->get('error_FreeShippingAmount');
		}
		if (!is_numeric($this->request->post['ecpaylogistic_max_amount']) || $this->request->post['ecpaylogistic_max_amount'] < 0 || $this->request->post['ecpaylogistic_max_amount'] <= $this->request->post['ecpaylogistic_min_amount']){
			$this->error['MaxAmount'] = $this->language->get('error_MaxAmount');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	public function create_shipping_order() 
	{
		$this->load->language('shipping/ecpaylogistic');
		$order_id = $this->request->get['order_id'];
		$ecpaylogistic_query = $this->db->query("Select * from ecpaylogistic_info where order_id=".$order_id);
		if (!$ecpaylogistic_query->num_rows) {
			$this->load->model('sale/order');
			$order_info = $this->model_sale_order->getOrder($order_id);
			if ($order_info) {
				include_once("controller/shipping/ECPay.Logistics.Integration.php");
				include_once("controller/shipping/ecpaylogistic.inc.php");
				$sFieldName = 'code';
				if (!ecpay_column_exists($this->db, DB_PREFIX."setting", 'code')) {
					$sFieldName = 'group';
				}
				$get_ecpaylogistic_setting_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `" . $sFieldName . "` = 'ecpaylogistic'");
				$ecpaylogisticSetting=array();
				foreach($get_ecpaylogistic_setting_query->rows as $value){
					$ecpaylogisticSetting[$value["key"]]=$value["value"];
				}

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

				$logisticSubType = explode(".", $order_info['shipping_code']);

				if (array_key_exists($logisticSubType[1], $shippingMethod)) {
					$_LogisticsSubType = $shippingMethod[$logisticSubType[1]];
				}

				$_IsCollection = IsCollection::NO;
				$_CollectionAmount = 0;
				if (strpos($order_info['shipping_code'],"_collection") !== false) {
					$_IsCollection = IsCollection::YES;
					$_CollectionAmount = (int)ceil($order_info['total']);
				}
				
				$products = $this->model_sale_order->getOrderProducts($order_id);
				$aGoods = array();
				foreach ($products as $product) {
					$aGoods[] = $product['name'] . '(' . $product['model'] . ')';
				}
				//$_Goods = $this->bite_str(implode('#',$aGoods),0,47,3);
				$_Goods = '網路商品一批';
				$_SenderCellPhone = '';
				if (isset($ecpaylogisticSetting['ecpaylogistic_sender_cellphone']) && !empty($ecpaylogisticSetting['ecpaylogistic_sender_cellphone'])) {
					$_SenderCellPhone = $ecpaylogisticSetting['ecpaylogistic_sender_cellphone'];
				}
				
				try {
					$AL = new ECPayLogistics();
					$AL->HashKey = $ecpaylogisticSetting['ecpaylogistic_hashkey'];
					$AL->HashIV = $ecpaylogisticSetting['ecpaylogistic_hashiv'];
					$AL->Send = array(
						'MerchantID' => $ecpaylogisticSetting['ecpaylogistic_mid'],
						'MerchantTradeNo' => 'order' . date('YmdHis') . $order_id,
						'MerchantTradeDate' => date('Y/m/d H:i:s'),
						'LogisticsType' => LogisticsType::CVS,
						'LogisticsSubType' => $_LogisticsSubType,
						'GoodsAmount' => (int)ceil($order_info['total']),
						'CollectionAmount' => $_CollectionAmount,
						'IsCollection' => $_IsCollection,
						'GoodsName' => $_Goods,
						'SenderName' => $ecpaylogisticSetting['ecpaylogistic_sender_name'],
						'SenderCellPhone' => $_SenderCellPhone,
						'ReceiverName' => $order_info['shipping_firstname'] . $order_info['shipping_lastname'],
						'ReceiverCellPhone' => $order_info['telephone'],
						'ReceiverEmail' => $order_info['email'],
						'ServerReplyURL' => (($_SERVER['HTTPS']) ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'] . str_replace("admin/","",$_SERVER['PHP_SELF']) . '?route=shipping/ecpaylogistic/response',
						'LogisticsC2CReplyURL' => (($_SERVER['HTTPS']) ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'] . str_replace("admin/","",$_SERVER['PHP_SELF']) . '?route=shipping/ecpaylogistic/LogisticsC2CReply',
						'Remark' => 'OC2_ECPayLogistic_1.0.0930',
					);
					$AL->SendExtend = array(
						'ReceiverStoreID' => $order_info['shipping_address_1'],
						'ReturnStoreID' => $order_info['shipping_address_1']
					);
					if ($_IsCollection == IsCollection::NO) {
						unset($AL->Send['CollectionAmount']);
					}
					if ($_LogisticsSubType != LogisticsSubType::UNIMART_C2C && $_LogisticsSubType != LogisticsSubType::HILIFE_C2C) {
						unset($AL->Send['SenderCellPhone']);
					}
					$Result = $AL->BGCreateShippingOrder(); 
					if ($Result['ResCode'] == 1) {
						$this->db->query("INSERT INTO `ecpaylogistic_info` SET `order_id` =" . $order_id .", `AllPayLogisticsID` = '" . $Result['AllPayLogisticsID'] ."';");
						$sComment = "建立綠界科技物流訂單<br>綠界科技物流訂單編號: " . $Result['AllPayLogisticsID'];
						if (isset($Result["CVSPaymentNo"]) && !empty($Result["CVSPaymentNo"])) {
							$sComment .= "<br>寄貨編號: " . $Result["CVSPaymentNo"];
						}
						$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$order_id . "', order_status_id = 3, notify = '0', comment = '" . $this->db->escape($sComment) . "', date_added = NOW()");
						$this->db->query("UPDATE " . DB_PREFIX . "order SET order_status_id = 3 WHERE order_id = ".$order_id);
						echo '<p><b>' . $Result['RtnMsg'] . '</b></p>';
						echo '<table border=1>';
						foreach ($Result as $key => $value) {
							if ($key == 'CheckMacValue' || $key == 'RtnMsg') {
								continue;
							}
							echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
						}
						echo '</table>';
						echo '<script>window.opener.location.reload();</script>';
					} else {
						echo "<pre>";
						var_dump($Result);
						echo "</pre>";
						//echo "<b>" . $Result['ErrorMessage'] . "</b>";
					}
				} catch(Exception $e) {
					echo $e->getMessage();
				}

			} else {
				echo $this->language->get('error_order_info');
			}
		} else {
			echo $this->language->get('error_shipping_order_exists');
		}
	}
	
	private function bite_str($string, $start, $len, $byte=3)
	{
		$str     = "";
		$count   = 0;
		$str_len = strlen($string);
		for ($i=0; $i<$str_len; $i++) {
			if (($count+1-$start)>$len) {
				$str  .= "...";
				break;
			} elseif ((ord(substr($string,$i,1)) <= 128) && ($count < $start)) {
				$count++;
			} elseif ((ord(substr($string,$i,1)) > 128) && ($count < $start)) {
				$count = $count+2;
				$i     = $i+$byte-1;
			} elseif ((ord(substr($string,$i,1)) <= 128) && ($count >= $start)) {
				$str  .= substr($string,$i,1);
				$count++;
			} elseif ((ord(substr($string,$i,1)) > 128) && ($count >= $start)) {
				$str  .= substr($string,$i,$byte);
				$count = $count+2;
				$i     = $i+$byte-1;
			}
		}
		return $str;
	}
	
	public function show_cvs_map_by_order() {
		$order_id = $this->request->get['order_id'];
		$this->load->model('sale/order');
		$aorder_info = $this->model_sale_order->getOrder($order_id);
		if ($aorder_info) {
			include_once("controller/shipping/ECPay.Logistics.Integration.php");
			include_once("controller/shipping/ecpaylogistic.inc.php");
			$sServerReply = $this->url->link('shipping/ecpaylogistic/set_store_info_by_order', 'token=' . $this->session->data['token'], 'SSL');
			ecpay_show_cvs_map_by_order($this->db,$order_id,$sServerReply);
		} else {
			echo "訂單編號不存在";
			exit;
		}
	}
	
	public function set_store_info_by_order() {
		$order_id = $this->request->post['ExtraData'];
		$this->load->model('sale/order');
		$aorder_info = $this->model_sale_order->getOrder($order_id);
		if (!$aorder_info) {
			echo "訂單編號不存在";
			exit;
		}
		if($this->request->post['CVSStoreID']){
			include_once("controller/shipping/ecpaylogistic.inc.php");
			ecpay_set_store_info_by_order($this->db,$this->request->post);
		} else {
			echo "門市資訊錯誤";
			exit;
		}
	}
	
	public function install() 
	{
		$this->model_extension_extension->install('payment', 'ecpaylogistic');
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
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_hilife_status' , `value` = '0';");
		$this->db->query("INSERT INTO `" . DB_PREFIX . "setting` SET `store_id` = 0 , `" . $sFieldName . "` = 'ecpaylogistic' , `key` = 'ecpaylogistic_fami_collection_status' , `value` = '0';");
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
		$this->model_extension_extension->uninstall('payment', 'ecpaylogistic');
		$this->load->model('user/user_group');
		if (method_exists($this->user,"getGroupId")) {
			$this->model_user_user_group->removePermission($this->user->getGroupId(), 'access', 'payment/ecpaylogistic');
			$this->model_user_user_group->removePermission($this->user->getGroupId(), 'modify', 'payment/ecpaylogistic');
			$this->model_user_user_group->removePermission($this->user->getGroupId(), 'access', 'shipping/ecpaylogistic');
			$this->model_user_user_group->removePermission($this->user->getGroupId(), 'modify', 'shipping/ecpaylogistic');
		} 
	}
}
