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
              <h3 class="box-title">Gerar relatorios</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
                <a href="#"><button type="button" class="btn btn-block btn-default btn-lg">Relatório completo até o dia 07/01</button></a>

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
                    <form action="relatorio" role="form" method="post">
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
            </div>
            <!-- /.box-body -->
          </div>
</div>
</div>


</div>

@endsection
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    var dateFormat = "dd-mm-yy",
      from = $( "#fromDT" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 3
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#toDT" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  </script>