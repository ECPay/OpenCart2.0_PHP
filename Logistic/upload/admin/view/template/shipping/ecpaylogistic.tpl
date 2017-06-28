<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-popular" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if (!empty($error_warning)) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
	  <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-ecpaylogistic" class="form-horizontal">
		<div class="row">
            <div class="col-sm-2">
              <ul class="nav nav-pills nav-stacked">
			    <!-- 一般設定 //-->
                <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $text_general; ?></a></li>
				<!-- 統一超商取貨 //-->
                <li><a href="#tab-unimart" data-toggle="tab"><?php echo $text_unimart; ?></a></li>
				<!-- 統一超商取貨付款 //-->
                <li><a href="#tab-unimart-collection" data-toggle="tab"><?php echo $text_unimart_collection; ?></a></li>
				<!-- 全家超商取貨 //-->
                <li><a href="#tab-fami" data-toggle="tab"><?php echo $text_fami; ?></a></li>
				<!-- 全家超商取貨付款 //-->
                <li><a href="#tab-fami-collection" data-toggle="tab"><?php echo $text_fami_collection; ?></a></li>
				<!-- 萊爾富超商取貨 //-->
                <li><a href="#tab-hilife" data-toggle="tab"><?php echo $text_hilife; ?></a></li>
				<!-- 萊爾富超商取貨付款 //-->
                <li><a href="#tab-hilife-collection" data-toggle="tab"><?php echo $text_hilife_collection; ?></a></li>
              </ul>
            </div>
			
			<div class="col-sm-10">
			  <div class="tab-content">
                <!-- 一般設定 //-->
			    <div class="tab-pane active" id="tab-general">
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_mid; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_mid" value="<?php echo $ecpaylogistic_mid; ?>" placeholder="<?php echo $entry_mid; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_mid)) { ?>
					  <div class="text-danger"><?php echo $error_mid; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_hashkey; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_hashkey" value="<?php echo $ecpaylogistic_hashkey; ?>" placeholder="<?php echo $entry_hashkey; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_hashkey)) { ?>
					  <div class="text-danger"><?php echo $error_hashkey; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_hashiv; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_hashiv" value="<?php echo $ecpaylogistic_hashiv; ?>" placeholder="<?php echo $entry_hashiv; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_hashiv)) { ?>
					  <div class="text-danger"><?php echo $error_hashiv; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-ecpaylogistic-type"><?php echo $entry_type; ?></label>
					<div class="col-sm-10">
					  <select name="ecpaylogistic_type" id="input-ecpaylogistic-type" class="form-control">
						<?php foreach ($ecpaylogistic_types as $ecpayl_type) { ?>
							<?php if ($ecpayl_type['value'] == $ecpaylogistic_type) { ?>
								<option value="<?php echo $ecpayl_type['value']; ?>" selected="selected"><?php echo $ecpayl_type['text']; ?></option>
							<?php } else { ?>
								<option value="<?php echo $ecpayl_type['value']; ?>"><?php echo $ecpayl_type['text']; ?></option>
							<?php } ?>
						<?php } ?>
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_sender_name; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_sender_name" value="<?php echo $ecpaylogistic_sender_name; ?>" placeholder="<?php echo $entry_sender_name; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_sender_name)) { ?>
					  <div class="text-danger"><?php echo $error_sender_name; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_sender_cellphone; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_sender_cellphone" value="<?php echo $ecpaylogistic_sender_cellphone; ?>" placeholder="<?php echo $text_sender_cellphone; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_sender_cellphone)) { ?>
					  <div class="text-danger"><?php echo $error_sender_cellphone; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_FreeShippingAmount; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_free_shipping_amount" value="<?php echo $ecpaylogistic_free_shipping_amount; ?>" placeholder="<?php echo $entry_FreeShippingAmount; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_FreeShippingAmount)) { ?>
					  <div class="text-danger"><?php echo $error_FreeShippingAmount; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_MinAmount; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_min_amount" value="<?php echo $ecpaylogistic_min_amount; ?>" placeholder="<?php echo $entry_MinAmount; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_MinAmount)) { ?>
					  <div class="text-danger"><?php echo $error_MinAmount; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_MaxAmount; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_max_amount" value="<?php echo $ecpaylogistic_max_amount; ?>" placeholder="<?php echo $entry_MaxAmount; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_MaxAmount)) { ?>
					  <div class="text-danger"><?php echo $error_MaxAmount; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="ecpaylogistic_order_status"><?php echo $entry_order_status; ?></label>
					<div class="col-sm-10">
					<select name="ecpaylogistic_order_status" class="form-control">
					<?php foreach ($order_statuses as $order_status) { ?>
						  <?php if ($order_status['order_status_id'] == $ecpaylogistic_order_status) { ?>
							<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
						  <?php } else { ?>
							<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
						  <?php } ?>
						<?php } ?>
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
					<div class="col-sm-10">
					  <select name="ecpaylogistic_geo_zone_id" id="input-geo-zone" class="form-control">
						<option value="0"><?php echo $text_all_zones; ?></option>
						<?php foreach ($geo_zones as $geo_zone) { ?>
						<?php if ($geo_zone['geo_zone_id'] == $ecpaylogistic_geo_zone_id) { ?>
						<option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
						<?php } ?>
						<?php } ?>
					  </select>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-ecpaylogistic-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
					  <select name="ecpaylogistic_status" id="input-ecpaylogistic-status" class="form-control">
						<?php foreach ($ecpaylogistic_statuses as $ecpayl_status) { ?>
							<?php if ($ecpayl_status['value'] == $ecpaylogistic_status) { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>" selected="selected"><?php echo $ecpayl_status['text']; ?></option>
							<?php } else { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>"><?php echo $ecpayl_status['text']; ?></option>
							<?php } ?>
						<?php } ?>
					  </select>
					</div>
				  </div>
			    </div>
				<!-- 統一超商取貨 //-->
				<div class="tab-pane" id="tab-unimart">
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_UNIMART_fee; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_unimart_fee" value="<?php echo $ecpaylogistic_unimart_fee; ?>" placeholder="<?php echo $entry_UNIMART_fee; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_UNIMART_fee)) { ?>
					  <div class="text-danger"><?php echo $error_UNIMART_fee; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-ecpaylogistic-unimart-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
					  <select name="ecpaylogistic_unimart_status" id="input-ecpaylogistic-unimart-status" class="form-control">
						<?php foreach ($ecpaylogistic_statuses as $ecpayl_status) { ?>
							<?php if ($ecpayl_status['value'] == $ecpaylogistic_unimart_status) { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>" selected="selected"><?php echo $ecpayl_status['text']; ?></option>
							<?php } else { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>"><?php echo $ecpayl_status['text']; ?></option>
							<?php } ?>
						<?php } ?>
					  </select>
					</div>
				  </div>
				</div>
				<!-- 統一超商取貨付款 //-->
				<div class="tab-pane" id="tab-unimart-collection">
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_UNIMART_Collection_fee; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_unimart_collection_fee" value="<?php echo $ecpaylogistic_unimart_collection_fee; ?>" placeholder="<?php echo $entry_UNIMART_Collection_fee; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_UNIMART_Collection_fee)) { ?>
					  <div class="text-danger"><?php echo $error_UNIMART_Collection_fee; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-ecpaylogistic-unimart-collection-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
					  <select name="ecpaylogistic_unimart_collection_status" id="input-ecpaylogistic-unimart-collection-status" class="form-control">
						<?php foreach ($ecpaylogistic_statuses as $ecpayl_status) { ?>
							<?php if ($ecpayl_status['value'] == $ecpaylogistic_unimart_collection_status) { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>" selected="selected"><?php echo $ecpayl_status['text']; ?></option>
							<?php } else { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>"><?php echo $ecpayl_status['text']; ?></option>
							<?php } ?>
						<?php } ?>
					  </select>
					</div>
				  </div>				  
				</div>
				<!-- 全家超商取貨 //-->
				<div class="tab-pane" id="tab-fami">
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_FAMI_fee; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_fami_fee" value="<?php echo $ecpaylogistic_fami_fee; ?>" placeholder="<?php echo $entry_FAMI_fee; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_FAMI_fee)) { ?>
					  <div class="text-danger"><?php echo $error_FAMI_fee; ?></div>
					  <?php } ?>
					</div>
				  </div>	
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-ecpaylogistic-fami-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
					  <select name="ecpaylogistic_fami_status" id="input-ecpaylogistic-fami-status" class="form-control">
						<?php foreach ($ecpaylogistic_statuses as $ecpayl_status) { ?>
							<?php if ($ecpayl_status['value'] == $ecpaylogistic_fami_status) { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>" selected="selected"><?php echo $ecpayl_status['text']; ?></option>
							<?php } else { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>"><?php echo $ecpayl_status['text']; ?></option>
							<?php } ?>
						<?php } ?>
					  </select>
					</div>
				  </div>				  
				</div>
				<!-- 全家超商取貨付款 //-->
				<div class="tab-pane" id="tab-fami-collection">
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_FAMI_Collection_fee; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_fami_collection_fee" value="<?php echo $ecpaylogistic_fami_collection_fee; ?>" placeholder="<?php echo $entry_FAMI_Collection_fee; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_FAMI_Collection_fee)) { ?>
					  <div class="text-danger"><?php echo $error_FAMI_Collection_fee; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-ecpaylogistic-fami-collection-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
					  <select name="ecpaylogistic_fami_collection_status" id="ecpaylogistic-fami-collection-status" class="form-control">
						<?php foreach ($ecpaylogistic_statuses as $ecpayl_status) { ?>
							<?php if ($ecpayl_status['value'] == $ecpaylogistic_fami_collection_status) { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>" selected="selected"><?php echo $ecpayl_status['text']; ?></option>
							<?php } else { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>"><?php echo $ecpayl_status['text']; ?></option>
							<?php } ?>
						<?php } ?>
					  </select>
					</div>
				  </div>
				</div>

				<!-- 萊爾富超商取貨 //-->
				<div class="tab-pane" id="tab-hilife">
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_HILIFE_fee; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_hilife_fee" value="<?php echo $ecpaylogistic_hilife_fee; ?>" placeholder="<?php echo $entry_HILIFE_fee; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_HILIFE_fee)) { ?>
					  <div class="text-danger"><?php echo $error_HILIFE_fee; ?></div>
					  <?php } ?>
					</div>
				  </div>	
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-ecpaylogistic-hilife-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
					  <select name="ecpaylogistic_hilife_status" id="input-ecpaylogistic-hilife-status" class="form-control">
						<?php foreach ($ecpaylogistic_statuses as $ecpayl_status) { ?>
							<?php if ($ecpayl_status['value'] == $ecpaylogistic_hilife_status) { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>" selected="selected"><?php echo $ecpayl_status['text']; ?></option>
							<?php } else { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>"><?php echo $ecpayl_status['text']; ?></option>
							<?php } ?>
						<?php } ?>
					  </select>
					</div>
				  </div>				  
				</div>
				<!-- 萊爾富超商取貨付款 //-->
				<div class="tab-pane" id="tab-hilife-collection">
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_HILIFE_Collection_fee; ?></label>
					<div class="col-sm-10">
					  <input type="text" name="ecpaylogistic_hilife_collection_fee" value="<?php echo $ecpaylogistic_hilife_collection_fee; ?>" placeholder="<?php echo $entry_HILIFE_Collection_fee; ?>" id="input-name" class="form-control" />
					  <?php if (!empty($error_HILIFE_Collection_fee)) { ?>
					  <div class="text-danger"><?php echo $error_HILIFE_Collection_fee; ?></div>
					  <?php } ?>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-2 control-label" for="input-ecpaylogistic-hilife-collection-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
					  <select name="ecpaylogistic_hilife_collection_status" id="ecpaylogistic-hilife-collection-status" class="form-control">
						<?php foreach ($ecpaylogistic_statuses as $ecpayl_status) { ?>
							<?php if ($ecpayl_status['value'] == $ecpaylogistic_fami_collection_status) { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>" selected="selected"><?php echo $ecpayl_status['text']; ?></option>
							<?php } else { ?>
								<option value="<?php echo $ecpayl_status['value']; ?>"><?php echo $ecpayl_status['text']; ?></option>
							<?php } ?>
						<?php } ?>
					  </select>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>
		 </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>