@extends("crudbooster::admin_template")
@section("content")

<div class="container">

<div class="col-md-5">
  
<h1>Seja bem vindo!</h1>

<p>Agora você faz parte da nossa casa! Fique a vontade para utilizar nosso sistema de gerenciamento.</p>

<p>Aqui você vai ficar sabendo de tudo que acontecer com seus produtos!</p>


<div class="box">
        <div class="box-header">
            <h3 class="box-title">Primeiros Passos</h3>
        </div>

        <div class="box-body">

            <div class="btn-group-vertical btn-block">
                <a href="colaber"><button type="button" class="btn btn-default btn-block"><h4><i class="fa fa-list-alt"></i> Completar seus dados</h4></button></a>
                <a href="produtos/add"><button type="button" class="btn btn-default btn-block"><h4><i class="fa fa-plus"></i> Cadastrar seus produtos</h4></button></a>
                <a href="envios/add"><button type="button" class="btn btn-default btn-block"><h4><i class="fa  fa-th-large"></i> Nova Remessa de produtos</h4></button></a>
            </div>
        </div>
    </div>

</div>


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
                  <input type="text" class="form-control" id="marca" name="marca" placeholder="Qual a sua marca?" value="{{$colaber->marca}}" required>
                </div>
                <div class="form-group">
                  <label>Responsavel</label>
                  <input type="text" class="form-control" id="responsavel" name="responsavel" placeholder="Qual o nome da pessoa responsavel?" value="{{$colaber->responsavel}}" required>
                </div>
                
                <div class="form-group">
                  <label>CNPJ</label>
                  <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="Você possui CNPJ?" value="{{$colaber->cnpj}}">
                </div>
                <div class="form-group">
                  <label>CPF</label>
                  <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Você possui cpf?" value="{{$colaber->cpf}}" required>
                </div>
                
                <div class="form-group">
                  <label>Telefone</label>
                  <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Você possui telefone?" value="{{$colaber->telefone}}" required>
                </div>
                <div class="form-group">
                  <label>Celular</label>
                  <input type="text" class="form-control" id="celular" name="celular" placeholder="Você possui celular?" value="{{$colaber->celular}}">
                </div>
                <div class="form-group">
                  <label>Dados Bancários</label>
                  <input type="text" class="form-control" id="dadosBancarios" name="dadosBancarios" placeholder="Informe os dados para depósito." value="{{$colaber->dadosBancarios}}">
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