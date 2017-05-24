<?php
class ModelShippingecpaylogistic extends Model {
	function getQuote($address) {
		$this->load->language('shipping/ecpaylogistic');
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('ecpaylogistic_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
	
		if (!$this->config->get('ecpaylogistic_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}

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
		//超商取貨金額範圍
		if ($this->cart->getSubTotal()<$ecpaylogisticSetting['ecpaylogistic_min_amount'] || $this->cart->getSubTotal()>$ecpaylogisticSetting['ecpaylogistic_max_amount'] ) {
			$status = false;
		} 
		//免運費金額
		$isFreeShipping = false;
		if ($this->cart->getSubTotal()>=$ecpaylogisticSetting['ecpaylogistic_free_shipping_amount']) {
			$isFreeShipping = true;
		}
		
		if ($status) {
			//if($ecpaylogisticSetting["ecpaylogistic_status"] == "1"){
			//}
			
			// shipping_method.tpl 所需的額外資訊
			$Extra = array();
			// 定義 ecpaylogistic-control-area 的位置
			$Extra['last_ecpaylogistic_shipping_code'] = '';
			// 語系
			$Extra['text_choice'] = $this->language->get('text_choice');
			$Extra['text_rechoice'] = $this->language->get('text_rechoice');
			$Extra['text_store_name'] = $this->language->get('text_store_name');
			$Extra['text_store_address'] = $this->language->get('text_store_address');
			$Extra['text_store_tel'] = $this->language->get('text_store_tel');
			$Extra['text_store_info'] = $this->language->get('text_store_info');
			$Extra['error_no_storeinfo'] = $this->language->get('error_no_storeinfo');

			if ($ecpaylogisticSetting['ecpaylogistic_unimart_status']) {
				$shipping_cost = ($isFreeShipping) ? 0 : $ecpaylogisticSetting['ecpaylogistic_unimart_fee'];
				$quote_text = (strpos(VERSION, '2.2.') !== false) ? $this->currency->format($shipping_cost, $this->session->data['currency']) : $this->currency->format($shipping_cost);
				$quote_data['unimart'] = array(
						'code'         => 'ecpaylogistic.unimart',
						'title'        => $this->language->get('text_unimart'),
						'cost'         => $shipping_cost,
						'tax_class_id' => 0,
						'text'         => $quote_text,
				);
				$Extra['last_ecpaylogistic_shipping_code'] = 'unimart';
			}
			if ($ecpaylogisticSetting['ecpaylogistic_unimart_collection_status']) {
				$shipping_cost = ($isFreeShipping) ? 0 : $ecpaylogisticSetting['ecpaylogistic_unimart_collection_fee'];
				$quote_text = (strpos(VERSION, '2.2.') !== false) ? $this->currency->format($shipping_cost, $this->session->data['currency']) : $this->currency->format($shipping_cost);
				$quote_data['unimart_collection'] = array(
						'code'         => 'ecpaylogistic.unimart_collection',
						'title'        => $this->language->get('text_unimart_collection'),
						'cost'         => $shipping_cost,
						'tax_class_id' => 0,
						'text'         => $quote_text,
				);
				$Extra['last_ecpaylogistic_shipping_code'] = 'unimart_collection';
			}
			
			if ($ecpaylogisticSetting['ecpaylogistic_fami_status']) {
				$shipping_cost = ($isFreeShipping) ? 0 : $ecpaylogisticSetting['ecpaylogistic_fami_fee'];
				$quote_text = (strpos(VERSION, '2.2.') !== false) ? $this->currency->format($shipping_cost, $this->session->data['currency']) : $this->currency->format($shipping_cost);
				$quote_data['fami'] = array(
						'code'         => 'ecpaylogistic.fami',
						'title'        => $this->language->get('text_fami'),
						'cost'         => $shipping_cost,
						'tax_class_id' => 0,
						'text'         => $quote_text,
				);
				$Extra['last_ecpaylogistic_shipping_code'] = 'fami';
			}
			
			if ($ecpaylogisticSetting['ecpaylogistic_fami_collection_status']) {
				$shipping_cost = ($isFreeShipping) ? 0 : $ecpaylogisticSetting['ecpaylogistic_fami_collection_fee'];
				$quote_text = (strpos(VERSION, '2.2.') !== false) ? $this->currency->format($shipping_cost, $this->session->data['currency']) : $this->currency->format($shipping_cost);
				$quote_data['fami_collection'] = array(
						'code'         => 'ecpaylogistic.fami_collection',
						'title'        => $this->language->get('text_fami_collection'),
						'cost'         => $shipping_cost,
						'tax_class_id' => 0,
						'text'         => $quote_text,
				);
				$Extra['last_ecpaylogistic_shipping_code'] = 'fami_collection';
			}

			unset($quote_text);
			
			if (!isset($quote_data)) {
				$status = false;
			} else {
				$quote_data[$Extra['last_ecpaylogistic_shipping_code']]['Extra'] = $Extra;
			}
		}
		
		$method_data = array();
		if ($status) {
			$method_data = array(
					'code'       => 'ecpaylogistic',
					'title'      => $this->language->get('heading_title'),
					'quote'      => $quote_data,
					'sort_order' => $this->config->get('ecpaylogistic_sort_order'),
					'extra' => $Extra,
					'error'      => false
			);
		}
			
		return $method_data;
	}
}
