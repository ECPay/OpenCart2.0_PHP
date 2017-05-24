<?php
function ecpay_column_exists($db_conn, $sTableName, $sColumnName) {
	$bRtn = false;
	$query = $db_conn->query("SHOW COLUMNS FROM " . $sTableName . " LIKE '" . $sColumnName . "'");
	if ($query->num_rows) {
		$bRtn = true;
	} 
	return $bRtn;
}

function ecpay_show_cvs_map_by_order($db_conn,$sExtra,$sReplyURL) 
{
	$al_query = $db_conn->query("Select * from ecpaylogistic_info where order_id=".$sExtra);
	if ($al_query->num_rows) {
		echo "物流訂單已建立, 無法變更門市";
		exit;
	}
	$ecpaylogistic_query = $db_conn->query("Select * from " . DB_PREFIX . "order where order_id=".$sExtra);
	$order_info = $ecpaylogistic_query->rows[0] ;
	
	$sFieldName = 'code';
	if (!ecpay_column_exists($db_conn, DB_PREFIX."setting", 'code')) {
		$sFieldName = 'group';
	} 
	$get_ecpaylogistic_setting_query = $db_conn->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `" . $sFieldName . "` = 'ecpaylogistic'");
	$ecpaylogisticSetting=array();
	foreach($get_ecpaylogistic_setting_query->rows as $value){
		$ecpaylogisticSetting[$value["key"]]=$value["value"];
	}
	
	if ($ecpaylogisticSetting['ecpaylogistic_type'] == 'C2C') {
		$al_subtype = (strpos($order_info['shipping_code'],'fami')) ? LogisticsSubType::FAMILY_C2C : LogisticsSubType::UNIMART_C2C;
	} else {
		$al_subtype = (strpos($order_info['shipping_code'],'fami')) ? LogisticsSubType::FAMILY : LogisticsSubType::UNIMART;
	}
	if (!isset($al_subtype)) {
		exit;
	}
	$al_iscollection = (strpos($order_info['shipping_code'],'_collection')) ? IsCollection::YES : IsCollection::NO;
	$al_srvreply =  $sReplyURL;
	
	try {
		$AL = new ECPayLogistics();
		$AL->Send = array(
			'MerchantID' => $ecpaylogisticSetting['ecpaylogistic_mid'],
			'MerchantTradeNo' => 'no' . date('YmdHis'),
			'LogisticsSubType' => $al_subtype,
			'IsCollection' => $al_iscollection,
			'ServerReplyURL' => $al_srvreply,
			'ExtraData' => $sExtra,
			'Device' => Device::PC
		);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	$html = $AL->CvsMap('');
	echo $html;
}

function ecpay_set_store_info_by_order($db_conn,$sExtra) 
{
	$order_id = $sExtra['ExtraData'];
	$ecpaylogistic_query = $db_conn->query("Select * from " . DB_PREFIX . "order where order_id=".$order_id);
	$order_info = $ecpaylogistic_query->rows[0] ;
	if($sExtra['CVSStoreID']){		
		$shipping_address_1 = $sExtra['CVSStoreID'];
		$shipping_address_2 = $sExtra['CVSStoreName'] . ' ' . $sExtra['CVSAddress'];
		if ( !empty($sExtra['CVSTelephone'])) {
			$shipping_address_2 .= '(' . $sExtra['CVSTelephone'] . ')';
		}
		$db_conn->query("UPDATE " . DB_PREFIX . "order SET shipping_address_1='" . $db_conn->escape($shipping_address_1) . "',shipping_address_2='" . $db_conn->escape($shipping_address_2) . "' WHERE order_id = " . (int)$order_id);
		$sMsg = '變更門市<br>門市店號: ' . $shipping_address_1 . '<br>門市資訊: ' . $shipping_address_2;
		$db_conn->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$order_info['order_id'] . "', order_status_id = '" . (int)$order_info['order_status_id'] . "', notify = '0', comment = '" . $db_conn->escape($sMsg) . "', date_added = NOW()");
		echo '<script>window.opener.location.reload();window.close();</script>';
	}
}
?>