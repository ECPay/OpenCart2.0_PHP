<?php 
if (isset($this->session->data['shipping_method']['code']) && strpos($this->session->data['shipping_method']['code'],"ecpaylogistic.") !== false) {
	$order_data['shipping_address_1'] = $this->session->data["shipping_methods"]["ecpaylogistic"]['CVSStoreID'];

	$order_data['shipping_address_2'] = $this->session->data["shipping_methods"]["ecpaylogistic"]['CVSStoreName']." ".$this->session->data["shipping_methods"]["ecpaylogistic"]['CVSAddress'];
	if (strpos($this->session->data['shipping_method']['code'],"ecpaylogistic.unimart") !== false) {
		$order_data['shipping_address_2'] = "統一超商" . $order_data['shipping_address_2'];
	}
	if (!empty($this->session->data["shipping_methods"]["ecpaylogistic"]['CVSTelephone'])) {
		$order_data['shipping_address_2'] .= "(".$this->session->data["shipping_methods"]["ecpaylogistic"]['CVSTelephone'].")";
	}
	
	$order_data['shipping_country'] = 'Taiwan';
	$order_data['shipping_country_id'] = '206';
	$order_data['shipping_zone'] = '';
}
?>