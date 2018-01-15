@extends("crudbooster::admin_template")
@section("content")


<div class="container-fluid">
  



<div class="row">
<div class="col-md-5">

<form role="form" method="post" action="relatorio">
  
  <div class="form-group">
    <label for="colaberList">Selecione o Colaber</label>
    <select class="form-control" id="colaber" name="colaber">
      @foreach($colabers as $c)
      <option value="{{$c->id}}">{{$c->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="colaberList">Selecione o Mês</label>
    <select class="form-control" id="mes" name="mes">
      @foreach($mes as $key => $m)
      <option value="{{$key}}" @if($key == date('m')) selected @endif)>{{$m}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="colaberList">Selecione a porcentagem</label>
    <select class="form-control" id="mes" name="porcentagem">
      @foreach($porcentagem as $key => $m)
      <option value="{{$key}}">{{$m}}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary mb-2">Gerar e Salvar</button>
</form>
</div>

<div class="col-md-6">
  
  <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Gerar relatorios</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
                <a href="relatorioCompleto/{{date('2017-11-01')}}/{{date('2018-01-07')}}"><button type="button" class="btn btn-block btn-default btn-lg">Relatório completo até o dia 07/01</button></a>

                <a href="relatorioCompleto/{{date('2018-01-15')}}/{{date('2018-02-10')}}"><button type="button" class="btn btn-block btn-default btn-lg">Entre 15/01 até 10/02</button></a>
  
            </div>
            <!-- /.box-body -->
          </div>
</div>



</div><!-- end Row -->


<div class="row">
<div class="col-md-12" style="margin-top: 30px;">
  <div class="box">
            <div class="box-header">
              <h3 class="box-title">Últimos relatórios gerados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tbody><tr>
                  
                  <th>Colaber</th>
                  <th>Mês</th>
                  <th>Porcentagem</th>
                  <th>Ações</th>
                </tr>
              @foreach($relatorios as $r)
                <tr>
                 
                  <td>{{$r->colaber->name}}</td>
                  <td>{{date('m',strtotime($r->created_at))}}</td>
                  <td>{{$r->porcentagem}}%</td>
                  <td>
                  <a class="btn btn-xs btn-primary btn-detail" title="Ver Relatorio" href="relatorio/view/{{$r->id}}"><i class="fa fa-eye"></i></a>
                  <a class="btn btn-xs btn-warning btn-delete" title="Excluir" href="relatorio/delete/{{$r->id}}" onclick="return confirm('Tem certeza que deseja excluir o relatorio?')"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              @endforeach
                
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
</div>
</div>


</div>

@endsection