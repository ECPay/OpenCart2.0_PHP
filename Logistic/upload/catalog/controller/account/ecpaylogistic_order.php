<?php
if (isset($this->request->get['order_id'])) {
		$ecpaylogistic_query = $this->db->query("Select * from " . DB_PREFIX . "order where order_id=".$this->request->get['order_id']);
		if ($ecpaylogistic_query->num_rows) {
			$aOrder_Info = $ecpaylogistic_query->rows[0] ;
			if (strpos($aOrder_Info['shipping_code'],"ecpaylogistic.") !== false) {
				$ShowCVSMap = (($_SERVER['HTTPS']) ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'] . str_replace('admin/','',$_SERVER['PHP_SELF']) . '?route=shipping/ecpaylogistic/show_cvs_map_by_order&order_id='.$this->request->get['order_id'];
				$ShowMapCmd = "window.open('" . $ShowCVSMap . "','ecpayLogistic',config='width=1024,height=600,status=no,scrollbars=yes,toolbar=no,location=no,menubar=no');";
				$al_query = $this->db->query("Select * from ecpaylogistic_info where order_id=".$this->request->get['order_id']);
				if (!$al_query->num_rows) {
					$data['shipping_address'] .= "<br>" . '<input type="button" id="ecpaylogistic_store" class="btn btn-primary btn-xs" value="變更門市" onClick="javascript:' . $ShowMapCmd .'"/>';
				}
			}			
		}
}
?>