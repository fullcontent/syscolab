<div class="form-group <?php echo e($header_group_class); ?> <?php echo e(($errors->first($name))?'has-error': ''); ?>" id="form-group-<?php echo e($name); ?>" style="<?php echo e(@$form['style']); ?>">
	<label class="control-label col-sm-2"><?php echo e($form['label']); ?> <?php echo ($required)? '<span class="text-danger" title="This field is required">*</span>': ''; ?></label>

	<div class="<?php echo e($col_width?:'col-sm-10'); ?>">
		<input type="text" title="<?php echo e($form['label']); ?>" <?php echo e($required); ?> <?php echo e($readonly); ?> <?php echo $placeholder; ?> <?php echo e($disabled); ?> class="form-control inputMoney" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" value="<?php echo e($value); ?>">
		<div class="text-danger"><?php echo $errors->first($name)?'<i class="fa fa-info-circle"></i> '.$errors->first($name):''; ?></div>
		<p class="help-block"><?php echo e(@$form['help']); ?></p>
	</div>
</div>
