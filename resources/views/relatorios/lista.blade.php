@extends("crudbooster::admin_template")
@section("content")


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


@endsection