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
    <label for="colaberList">Selecione o Periodo</label>
    <input type="text" id="fromDT" name="fromDT">
    ate
    <input type="text" id="toDT" name="toDT">

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
              <h3 class="box-title">Relatórios completos</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

             <form role="form" method="post" action="{{route('relatorioCompleto')}}">
                
                <div class="form-group">
    <label for="colaberList">Selecione o Periodo</label>
    <input type="text" name="daterange" id="relatorioCompleto" value="01/01/2018 - 01/15/2018" />

  </div>

                <button type="submit" class="btn btn-primary mb-2">Visualizar</button>

             </form>
               
  
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
                  <th>Periodo</th>
                  <th>Porcentagem</th>
                  <th>Disponível</th>
                  <th>Ações</th>
                </tr>
              @foreach($relatorios as $r)
                <tr>
                 
                  <td>{{$r->colaber->marca}}</td>
                  <td>{{date('d/m/Y',strtotime($r->fromDT)).' a '.date('d/m/Y',strtotime($r->toDT))}}</td>
                  <td>{{$r->porcentagem}}%</td>
                  <td>
                    @if($r->active == 1)
                    <a href="relatorio/desativar/{{$r->id}}"><button type="button" class="btn btn-flat btn-success btn-xs">Disponível</button></a>
                    @endif
                    @if($r->active == 0)
                    <a href="relatorio/ativar/{{$r->id}}"><button type="button" class="btn btn-flat btn-warning btn-xs" title="Clique aqui para disponibilizar esse relatório para {{$r->colaber->marca}}">Diponibilizar</button></a>
                    @endif
                  </td>
                  <td>
                    <form action="{{route('verRelatorio')}}" role="form" method="post">

                    <input type="hidden" name="id" value="{{$r->id}}">
                     <input type="hidden" name="fromDT" value="{{date('m/d/Y', strtotime($r->fromDT))}}">
                     <input type="hidden" name="toDT" value="{{date('m/d/Y', strtotime($r->toDT))}}">
                     <input type="hidden" name="colaber" value="{{$r->colaber_id}}">
                     <input type="hidden" name="porcentagem" value="{{$r->porcentagem}}">

                      <button type="submit" class="btn btn-xs btn-primary btn-detail"><i class="fa fa-eye"></i></button>
                      <a class="btn btn-xs btn-danger btn-delete" title="Excluir" href="relatorio/delete/{{$r->id}}" onclick="return confirm('Tem certeza que deseja excluir o relatorio?')"><i class="fa fa-trash"></i></a>
                    </form>
                  
                  </td>
                </tr>
              @endforeach
                
              </tbody></table>
              
            {{$relatorios->links()}}
            </div>
            <!-- /.box-body -->
          </div>
</div>
</div>


</div>


@endsection






