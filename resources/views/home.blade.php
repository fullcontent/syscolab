@extends("crudbooster::admin_template")
@section("content")

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
             {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label>Marca</label>
                  <input type="text" class="form-control" id="marca" name="marca" placeholder="Qual a sua marca?" value="{{$colaber->marca}}">
                </div>
                <div class="form-group">
                  <label>Responsavel</label>
                  <input type="text" class="form-control" id="responsavel" name="responsavel" placeholder="Qual a sua marca?" value="{{$colaber->responsavel}}">
                </div>
                
                <div class="form-group">
                  <label>CNPJ</label>
                  <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Você possui CNPJ?" value="{{$colaber->cnpj}}">
                </div>
                <div class="form-group">
                  <label>CPF</label>
                  <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Você possui cpf?" value="{{$colaber->cpf}}">
                </div>
                
                <div class="form-group">
                  <label>Telefone</label>
                  <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Você possui telefone?" value="{{$colaber->telefone}}">
                </div>
                <div class="form-group">
                  <label>Celular</label>
                  <input type="text" class="form-control" id="celular" name="celular" placeholder="Você possui celular?" value="{{$colaber->celular}}">
                </div>
                <div class="form-group">
                  <label>Dados Bancários</label>
                  <input type="text" class="form-control" id="dadosBancarios" name="dadosBancarios" placeholder="Você possui dadosBancarios?" value="{{$colaber->dadosBancarios}}">
                </div>


                
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Atualizar Dados</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
	
</div>




    

@endsection