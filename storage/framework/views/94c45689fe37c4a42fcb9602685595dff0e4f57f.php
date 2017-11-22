<?php $__env->startSection("content"); ?>

<div class="container">
	<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Por favor atualize seus dados</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post">
             <?php echo e(csrf_field()); ?>

              <div class="box-body">
                <div class="form-group">
                  <label>Marca</label>
                  <input type="text" class="form-control" id="marca" name="marca" placeholder="Qual a sua marca?" value="<?php echo e($colaber->marca); ?>">
                </div>
                <div class="form-group">
                  <label>Responsavel</label>
                  <input type="text" class="form-control" id="responsavel" name="responsavel" placeholder="Qual a sua marca?" value="<?php echo e($colaber->responsavel); ?>">
                </div>
                
                <div class="form-group">
                  <label>CNPJ</label>
                  <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Você possui CNPJ?" value="<?php echo e($colaber->cnpj); ?>">
                </div>
                <div class="form-group">
                  <label>CPF</label>
                  <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Você possui cpf?" value="<?php echo e($colaber->cpf); ?>">
                </div>
                
                <div class="form-group">
                  <label>Telefone</label>
                  <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Você possui telefone?" value="<?php echo e($colaber->telefone); ?>">
                </div>
                <div class="form-group">
                  <label>Celular</label>
                  <input type="text" class="form-control" id="celular" name="celular" placeholder="Você possui celular?" value="<?php echo e($colaber->celular); ?>">
                </div>
                <div class="form-group">
                  <label>Dados Bancários</label>
                  <input type="text" class="form-control" id="dadosBancarios" name="dadosBancarios" placeholder="Você possui dadosBancarios?" value="<?php echo e($colaber->dadosBancarios); ?>">
                </div>


                
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Atualizar Dados</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
	
</div>




    

<?php $__env->stopSection(); ?>
<?php echo $__env->make("crudbooster::admin_template", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>