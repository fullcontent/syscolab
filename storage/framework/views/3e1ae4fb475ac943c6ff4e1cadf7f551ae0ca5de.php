<?php $__env->startPush('bottom'); ?>
<script>
	$(function() {
		<?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($form['type'] == $type): ?>				
				$('.inputMoney#<?php echo e($form['name']); ?>').priceFormat(<?php echo json_encode(array_merge(array(
				            'prefix' 				=> '',
				            'thousandsSeparator'    => $form['dec_point'] ? : ',',
				            'centsLimit'          	=> $form['decimals'] ? : '0',
				            'clearOnEmpty'         	=> false,
				        ), (array)$form['priceformat_parameters'] 
					)); ?>);
			<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	});
</script>
<?php $__env->stopPush(); ?>
