<?php
class ControllerPaymentecpaylogistic extends Controller {
	public function index() {
		$data['button_confirm'] = $this->language->get('button_confirm');

		$data['continue'] = $this->url->link('checkout/success');

		# Get the template
		$config_template = $this->config->get('config_template');
		$payment_template = '';
		if (file_exists(DIR_TEMPLATE . $config_template)) {
			$payment_template = $config_template;
		} else {
			$payment_template = 'default';
		}
		$payment_template .= (strpos(VERSION, '2.2.') !== false) ? '/payment/ecpaylogistic.tpl' : '/template/payment/ecpaylogistic.tpl';

		//if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . $payment_template)) {
		//	return $this->load->view($this->config->get('config_template') . $payment_template, $data);
		//} else {
		//	return $this->load->view('default' . $payment_template, $data);
		//}
		return $this->load->view($payment_template, $data);
	}

	public function confirm() {
		if ($this->session->data['payment_method']['code'] == 'ecpaylogistic') {
			$this->load->model('checkout/order');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('ecpaylogistic_order_status'));
		}
	}
}
