<?php if(isset($shipping_methods['ecpaylogistic'])){ ?>
<?php 
$quote=$shipping_methods['ecpaylogistic']['quote']; 
//取出額外資訊
if (isset($quote['unimart']['Extra'])) {
	$extra = $quote['unimart']['Extra'];
} elseif (isset($quote['unimart_collection']['Extra'])) {
	$extra = $quote['unimart_collection']['Extra'];
} elseif (isset($quote['fami']['Extra'])) {
	$extra = $quote['fami']['Extra'];
} elseif (isset($quote['fami_collection']['Extra'])) {
	$extra = $quote['fami_collection']['Extra'];
}
?>
<div class="ecpaylogistic-control-area" style="display:none;">
	<div id="ecpaylogistic-store-info">
		<div class="form-horizontal store-info">
			<h4><?php echo $extra['text_store_info'];?></h4>
			<div class=" form-group">
				<div class="col-sm-2"><?php echo $extra['text_store_name']?></div>
				<div class="col-sm-10 ecpaylogistic_stname"></div>
			</div>
			<div class=" form-group">
				<div class="col-sm-2"><?php echo $extra['text_store_address']?></div>
				<div class="col-sm-10 ecpaylogistic_staddr"></div>
			</div>
			<div class=" form-group">
				<div class="col-sm-2"><?php echo $extra['text_store_tel']?></div>
				<div class="col-sm-10 ecpaylogistic_sttel"></div>
			</div>
		</div>
		<p class="ecpaylogistic-warning bg-danger" style="padding:5px;"><?php echo $extra['error_no_storeinfo']; ?></p>
		<input type="hidden" class="checkselectecpaylogistic" value="nonselected" />
		<input type="button" id="ecpaylogistic" class="btn btn-primary btn-xs" value="<?php echo $extra['text_choice']; ?>" onClick="javascript:show_cvs_map()"/>
		<div style="color:red">提醒您，因使用FB及LINE APP內建瀏覽器進行操作時會發生網頁空白的問題，建議您可先複製商品連結後使用其他瀏覽器重新購買。</div>
	</div>
</div>

<script type="text/javascript">
<!--
var show_cvs_url = 'index.php?route=shipping/ecpaylogistic/show_cvs_map&shipping_method=';
var iframe_link = '';
function show_cvs_map() {
	window.open(iframe_link,'CVS map',config='width=1024,height=600,status=no,scrollbars=yes,toolbar=no,location=no,menubar=no');
}
function set_store_info(CVSStoreID,CVSStoreName,CVSAddress,CVSTelephone) {
	$('.ecpaylogistic_stname').html(CVSStoreName);
	$('.ecpaylogistic_staddr').html(CVSAddress);
	$('.ecpaylogistic_sttel').html(CVSTelephone);
	$('.store-info').show();
	$('.ecpaylogistic-warning').hide();
	$('.checkselectecpaylogistic').prop('value','selected');
}
$(document).ready(function(){
	$('input[name=shipping_method]').change(function() {
		$('.checkselectecpaylogistic').prop('value','nonselected');
		$('.ecpaylogistic_stname').html('');
		$('.ecpaylogistic_staddr').html('');
		$('.ecpaylogistic_sttel').html('');
		if ($('input[name=shipping_method]:checked').val().indexOf('ecpaylogistic.') == 0){
			$('#ecpaylogistic-store-info').fadeIn();
			iframe_link = show_cvs_url + $('input[name=shipping_method]:checked').val();
		} else{
			$('#ecpaylogistic-store-info').fadeOut();
		}
	});
	$( "input[name$='shipping_method']" ).each(function( index ) {
		if($( this ).val() == 'ecpaylogistic.<?php echo $extra['last_ecpaylogistic_shipping_code'];?>'){
			var htnlCode=$('.ecpaylogistic-control-area').html();
			$( this ).parent().after(htnlCode);
			$('.ecpaylogistic-control-area').remove();
		}
	});
	$('.ecpaylogistic-warning').hide();
	$('#ecpaylogistic-store-info').hide();
	if ($('input[name=shipping_method]:checked').val().indexOf('ecpaylogistic.') == 0){
		$('#ecpaylogistic-store-info').show();
		iframe_link = show_cvs_url + $('input[name=shipping_method]:checked').val();
	}else{
		$('.ecpaylogistic-warning').hide();
		$('#ecpaylogistic-store-info').hide();
	}
	$('#button-shipping-method').click(function() {
		$('.ecpaylogistic-warning').hide();
		if($('.checkselectecpaylogistic').val() != "selected" && $('input[name=shipping_method]:checked').val().indexOf('ecpaylogistic.') == 0){
			$('.ecpaylogistic-warning').show();
			return false;
		}
	});
 });
//-->
</script>
<?php } ?>
