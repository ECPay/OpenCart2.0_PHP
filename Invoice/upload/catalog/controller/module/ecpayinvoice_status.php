<?php
$data['ecpayinvoice_enabled'] = false;
foreach ($results as $result) {
	if ($result['code'] == 'ecpayinvoice' && $this->config->get($result['code'] . '_status')) {
		$data['ecpayinvoice_enabled'] = true;
	}
}
?>
