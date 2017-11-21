<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">


<table style="border: 1px solid #ccc">
 	


<?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	

  
<tr align="center">
    <td style="padding: 20px; border-bottom: 1px solid #ccc;"><?php echo DNS1D::getBarcodeSVG($p->barcode, "CODE11", 1,50); ?><br><?php echo e($p->nome); ?></td>
</tr>
 
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


  
</table>