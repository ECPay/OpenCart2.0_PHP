<?php
class ModelPaymentecpaylogistic extends Model {
	public function getMethod($address, $total) {
		$this->load->language('payment/ecpaylogistic');	
		
		$method_data = array();
		
		if(isset($this->session->data["shipping_methods"]["ecpaylogistic"]) && ($this->session->data["shipping_method"]["code"] == 'ecpaylogistic.unimart_collection' || $this->session->data["shipping_method"]["code"] == 'ecpaylogistic.fami_collection')){
     		$method_data = array( 
        		'code'       => 'ecpaylogistic',
        		'title'      => $this->language->get('text_title'),
				'terms' => '',
				'sort_order' => 1
      		);
		}
//$fp=fopen("/var/tmp/log","a");
//fputs($fp, $this->session->data["shipping_method"]["code"]."\n");
//fclose($fp);
		return $method_data;
	}
}
?>
