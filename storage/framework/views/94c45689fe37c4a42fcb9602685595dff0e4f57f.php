<?php $__env->startSection("content"); ?>



<h1>Envios</h1>



<?php $__currentLoopData = $envios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $envio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	
	<h3><?php echo e($envio->created_at); ?></h3>

	
	<?php

			dd($envios);

			foreach ($itens as $item) {
				
				echo $item->qtde;
			}


			

	?>



<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      






    

<?php $__env->stopSection(); ?>
<?php echo $__env->make("crudbooster::admin_template", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>