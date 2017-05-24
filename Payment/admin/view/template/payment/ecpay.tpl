<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form_ecpay" class="btn btn-primary">
					<i class="fa fa-save"></i>
				</button>
				<a href="<?php echo $ecpay_cancel; ?>" class="btn btn-default">
					<i class="fa fa-reply"></i>
				</a>
			</div>
			<ul class="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li>
					<a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
				</li>
			<?php } ?>
			</ul>
		</div>
	</div>
	<div class="container-fluid">
		<?php if ($error_warning) { ?>
		<div class="alert alert-danger">
			<i class="fa fa-exclamation-circle"></i>
			&nbsp;<?php echo $error_warning; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-pencil"></i>
					&nbsp;<?php echo $heading_title; ?>
				</h3>
			</div>
			<div class="panel-body">
				<form action="<?php echo $ecpay_action; ?>" method="post" enctype="multipart/form-data" id="form_ecpay" class="form-horizontal">
					<div class="form-group">
						<label class="col-sm-2 control-label">
							<?php echo $ecpay_text_status; ?>
						</label>
						<div class="col-sm-2">
							<?php $selected = ' selected="selected"'; ?>
							<select name="ecpay_status" class="form-control">
								<option value="0"<?php if (!$ecpay_status) { echo $selected; } ?>><?php echo $ecpay_text_disabled; ?></option>
								<option value="1"<?php if ($ecpay_status) { echo $selected; } ?>><?php echo $ecpay_text_enabled; ?></option>
							</select>
						</div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">
							<?php echo $ecpay_text_merchant_id; ?>
						</label>
						<div class="col-sm-2">
							<input type="text" name="ecpay_merchant_id" value="<?php echo $ecpay_merchant_id; ?>" class="form-control" />
						</div>
						<div class="text-danger"><?php echo $ecpay_error_merchant_id; ?></div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">
							<?php echo $ecpay_text_hash_key; ?>
						</label>
						<div class="col-sm-2">
							<input type="text" name="ecpay_hash_key" value="<?php echo $ecpay_hash_key; ?>" class="form-control" />
						</div>
						<div class="text-danger"><?php echo $ecpay_error_hash_key; ?></div>
					</div>
					<div class="form-group required">
						<label class="col-sm-2 control-label">
							<?php echo $ecpay_text_hash_iv; ?>
						</label>
						<div class="col-sm-2">
							<input type="text" name="ecpay_hash_iv" value="<?php echo $ecpay_hash_iv; ?>" class="form-control" />
						</div>
						<div class="text-danger"><?php echo $ecpay_error_hash_iv; ?></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">
							<?php echo $ecpay_text_payment_methods; ?>
						</label>
						<div class="col-sm-2">
							<?php $checked = ' checked="checked"'; ?>
							<input type="checkbox" name="ecpay_payment_methods[Credit]" value="credit"<?php if (isset($ecpay_payment_methods['Credit'])) { echo $checked; }	?> />
							<label class="control-label">
								&nbsp;<?php echo $ecpay_text_credit; ?>
							</label>
							<br />
							<input type="checkbox" name="ecpay_payment_methods[Credit_3]" value="credit_3"<?php if (isset($ecpay_payment_methods['Credit_3'])) { echo $checked; }	?> />
							<label class="control-label">
								&nbsp;<?php echo $ecpay_text_credit_3; ?>
							</label>
							<br />
							<input type="checkbox" name="ecpay_payment_methods[Credit_6]" value="credit_6"<?php if (isset($ecpay_payment_methods['Credit_6'])) { echo $checked; }	?> />
							<label class="control-label">
								&nbsp;<?php echo $ecpay_text_credit_6; ?>
							</label>
							<br />
							<input type="checkbox" name="ecpay_payment_methods[Credit_12]" value="credit_12"<?php if (isset($ecpay_payment_methods['Credit_12'])) { echo $checked; }	?> />
							<label class="control-label">
								&nbsp;<?php echo $ecpay_text_credit_12; ?>
							</label>
							<br />
							<input type="checkbox" name="ecpay_payment_methods[Credit_18]" value="credit_18"<?php if (isset($ecpay_payment_methods['Credit_18'])) { echo $checked; }	?> />
							<label class="control-label">
								&nbsp;<?php echo $ecpay_text_credit_18; ?>
							</label>
							<br />
							<input type="checkbox" name="ecpay_payment_methods[Credit_24]" value="credit_24"<?php if (isset($ecpay_payment_methods['Credit_24'])) { echo $checked; }	?> />
							<label class="control-label">
								&nbsp;<?php echo $ecpay_text_credit_24; ?>
							</label>
							<br />
							<input type="checkbox" name="ecpay_payment_methods[WebATM]" value="webatm"<?php if (isset($ecpay_payment_methods['WebATM'])) { echo $checked; }	?> />
							<label class="control-label">
								&nbsp;<?php echo $ecpay_text_webatm; ?>
							</label>
							<br />
							<input type="checkbox" name="ecpay_payment_methods[ATM]" value="atm"<?php if (isset($ecpay_payment_methods['ATM'])) { echo $checked; }	?> />
							<label class="control-label">
								&nbsp;<?php echo $ecpay_text_atm; ?>
							</label>
							<br />
							<input type="checkbox" name="ecpay_payment_methods[CVS]" value="cvs"<?php if (isset($ecpay_payment_methods['CVS'])) { echo $checked; }	?> />
							<label class="control-label">
								&nbsp;<?php echo $ecpay_text_cvs; ?>
							</label>
							<br />
							<input type="checkbox" name="ecpay_payment_methods[BARCODE]" value="barcode"<?php if (isset($ecpay_payment_methods['BARCODE'])) { echo $checked; }	?> />
							<label class="control-label">
								&nbsp;<?php echo $ecpay_text_barcode; ?>
							</label>
							<br />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">
							<?php echo $ecpay_text_geo_zone; ?>
						</label>
						<div class="col-sm-2">
							<select name="ecpay_geo_zone_id" class="form-control">
								<option value="0"><?php echo $ecpay_text_all_zones; ?></option>
								<?php
								foreach ($geo_zones as $geo_zone) {
									$selected = "";
									if ($geo_zone['geo_zone_id'] == $ecpay_geo_zone_id) {
										$selected = ' selected="selected"';
									}
									echo '<option value="' . $geo_zone['geo_zone_id'] . '"' . $selected . '>' . $geo_zone['name'] . '</option>' . $next_line;
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">
							<?php echo $ecpay_text_sort_order; ?>
						</label>
						<div class="col-sm-2">
							<input type="text" name="ecpay_sort_order" value="<?php echo $ecpay_sort_order; ?>" class="form-control" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php echo $footer; ?>