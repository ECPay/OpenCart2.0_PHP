<?php
if (strpos($order_info['shipping_code'],"ecpaylogistic.") !== false) {
	$CreateShippingOrder = $this->url->link('shipping/ecpaylogistic/create_shipping_order&order_id='.$data['order_id'], 'token=' . $this->session->data['token'], 'SSL');
	$WindowOpenCmd = "window.open('" . $CreateShippingOrder . "','ecpayLogistic',config='width=800,height=600,status=no,scrollbars=yes,toolbar=no,location=no,menubar=no');";
	$ShowCVSMap = $this->url->link('shipping/ecpaylogistic/show_cvs_map_by_order&order_id='.$data['order_id'], 'token=' . $this->session->data['token'], 'SSL');
	$ShowMapCmd = "window.open('" . $ShowCVSMap . "','ecpayLogistic',config='width=1024,height=600,status=no,scrollbars=yes,toolbar=no,location=no,menubar=no');";
	$ecpaylogistic_query = $this->db->query("Select * from ecpaylogistic_info where order_id=".$data['order_id']);
	if (!$ecpaylogistic_query->num_rows) {
		if (isset($data['shipping_address_1'])) {
			$data['shipping_address_1'] .= "&nbsp;" . '<input type="button" id="ecpaylogistic_store" class="btn btn-primary btn-xs" value="變更門市" onClick="javascript:' . $ShowMapCmd .'"/>';
		} else {
			$data['shipping_address'] .= "<br>" . '<input type="button" id="ecpaylogistic_store" class="btn btn-primary btn-xs" value="變更門市" onClick="javascript:' . $ShowMapCmd .'"/>';
		}
		$data['shipping_method'] .= "&nbsp;" . '<input type="button" id="ecpaylogistic" class="btn btn-primary btn-xs" value="建立物流訂單" onClick="javascript:' . $WindowOpenCmd .'"/>';
	}
}
?>