<?php

class ControllerPaymentECPay extends Controller {
	
	private $error = array();
	private $require_settings = array('merchant_id', 'hash_key', 'hash_iv');

	public function index() {
		# Load the translation file
		$this->load->language('payment/ecpay');
		
		# Set the title
		$heading_title = $this->language->get('heading_title');
		$this->document->setTitle($heading_title);
		$data['heading_title'] = $heading_title;
		
		# Load the Setting
		$this->load->model('setting/setting');
		
		# Process the saving setting
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			# Save the setting
			$this->model_setting_setting->editSetting('ecpay', $this->request->post);
			
			# Define the success message
			$this->session->data['success'] = $this->language->get('ecpay_text_success');
			
			# Back to the payment list
			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		# Get the translation
		$data['ecpay_text_status'] = $this->language->get('ecpay_text_status');
		$data['ecpay_text_enabled'] = $this->language->get('ecpay_text_enabled');
		$data['ecpay_text_disabled'] = $this->language->get('ecpay_text_disabled');
		$data['ecpay_text_merchant_id'] = $this->language->get('ecpay_text_merchant_id');
		$data['ecpay_text_hash_key'] = $this->language->get('ecpay_text_hash_key');
		$data['ecpay_text_hash_iv'] = $this->language->get('ecpay_text_hash_iv');
		$data['ecpay_text_payment_methods'] = $this->language->get('ecpay_text_payment_methods');
		$data['ecpay_text_credit'] = $this->language->get('ecpay_text_credit');
		$data['ecpay_text_credit_3'] = $this->language->get('ecpay_text_credit_3');
		$data['ecpay_text_credit_6'] = $this->language->get('ecpay_text_credit_6');
		$data['ecpay_text_credit_12'] = $this->language->get('ecpay_text_credit_12');
		$data['ecpay_text_credit_18'] = $this->language->get('ecpay_text_credit_18');
		$data['ecpay_text_credit_24'] = $this->language->get('ecpay_text_credit_24');
		$data['ecpay_text_webatm'] = $this->language->get('ecpay_text_webatm');
		$data['ecpay_text_atm'] = $this->language->get('ecpay_text_atm');
		$data['ecpay_text_cvs'] = $this->language->get('ecpay_text_cvs');
		$data['ecpay_text_barcode'] = $this->language->get('ecpay_text_barcode');
		$data['ecpay_text_geo_zone'] = $this->language->get('ecpay_text_geo_zone');
		$data['ecpay_text_all_zones'] = $this->language->get('ecpay_text_all_zones');
		$data['ecpay_text_sort_order'] = $this->language->get('ecpay_text_sort_order');
		
		# Get the error
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		# Get the error of the require fields
		foreach ($this->require_settings as $setting_name) {
			$tmp_error_name = 'ecpay_error_' . $setting_name;
			if(isset($this->error[$tmp_error_name])) {
				$data[$tmp_error_name] = $this->error[$tmp_error_name];
			} else {
				$data[$tmp_error_name] = '';
			}
		}
		
		# Set the breadcrumbs
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('ecpay_text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('ecpay_text_payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
		);
		$data['breadcrumbs'][] = array(
			'text' => $heading_title,
			'href' => $this->url->link('payment/ecpay', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		# Set the form action
		$data['ecpay_action'] = $this->url->link('payment/ecpay', 'token=' . $this->session->data['token'], 'SSL');
		
		# Set the cancel button
		$data['ecpay_cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		# Get ECPay setting
		$ecpay_settings = array(
			'status',
			'merchant_id',
			'hash_key',
			'hash_iv',
			'payment_methods',
			'geo_zone_id',
			'sort_order'
		);
		foreach ($ecpay_settings as $setting_name) {
			$tmp_setting_name = 'ecpay_' . $setting_name;
			if (isset($this->request->post[$tmp_setting_name])) {
				$data[$tmp_setting_name] = $this->request->post[$tmp_setting_name];
			} else {
				$data[$tmp_setting_name] = $this->config->get($tmp_setting_name);
			}
		}
		
		# Test merchant info
		if (empty($data['ecpay_merchant_id'])) {$data['ecpay_merchant_id'] = '2000132';}
		if (empty($data['ecpay_hash_key'])) {$data['ecpay_hash_key'] = '5294y06JbISpM5x9';}
		if (empty($data['ecpay_hash_iv'])) {$data['ecpay_hash_iv'] = 'v77hoKGq4kWxNNIS';}
		
		# Get the geo zone
		$this->load->model('localisation/geo_zone');
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		# View's setting
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('payment/ecpay.tpl', $data));
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/ecpay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		foreach ($this->require_settings as $setting_name) {
			if (!$this->request->post['ecpay_' . $setting_name]) {
				$this->error['ecpay_error_' . $setting_name] = $this->language->get('ecpay_error_' . $setting_name);
			}
		}
		
		return !$this->error; 
	}
}
