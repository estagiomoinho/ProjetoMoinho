@extends('voyager::masterbusca')

@section('css')
	<meta name="csrf-token content={{ csrf_token() }}">
	<style>
		#titulo{
                font-family: 'Nunito', sans-serif;
                font-size: 36px;
    			text-align: center;
		}
   
	</style>
@stop

@section('page_title','Busca-Avançada ')

@section('page_header')
	<div class="row">
	<h1 class="page-title">
	<i class="voyager-search"></i> Busca Avançada
	


	</h1>
    </div>

@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-primary panel-bordered">
                    <!-- form start -->
                    <form role="form"
                          class="form-busca-avancada"
                          id="form-busca-avancada"
                          action="#"
                          onsubmit="return false;"
                          method="GET" enctype="multipart/form-data">
                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-heading">
                            <h3 class="panel-title panel-icon" id="titulo"><i class="voyager-search"></i> Biblioteca Moinho</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row clearfix">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group col-md-6">
                                    <label for="name">Título:</label>
                                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Ex:Título do livro" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Autor::</label>
                                    <input type="text" class="form-control" name="autor" id="autor" placeholder="Ex:Autor do livro" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Editora:</label>
                                    <input type="text" class="form-control" name="editora" id="editora" placeholder="Ex:Nome da Editora" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Gênero:</label>
                                    <input type="text" class="form-control" name="genero" id="genero" placeholder="Ex:Romance" value="">
                                </div>
                                
                            </div>
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="text" class="btn btn-primary find buscar-arquivos">Buscar</button>
                        </div>
                    </form>

                </div>
                <div class="panel panel-primary panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title panel-icon"><i class="voyager-window-list"></i> Resultado</h3>
                        <div class="panel-actions">
                            <a class="panel-action voyager-angle-up" data-toggle="panel-collapse" aria-hidden="true"></a>
                        </div>
                    </div>

                    <div class="panel-body" id="resultado" >
                        <div class="table-responsive">
                            <table id="datoTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Capa</th>
                                        <th>Nome</th>
                                        <th>Autor</th>
                                        <th>Genero</th>
                                        <th>Editora</th>
                                        <th>Sinopse</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script >
	 $(document).ready(function () {
        var table = $('#datoTable').DataTable({!! json_encode(
                    array_merge([
                        "order" => [],
                        "bFilter"=> false,
                        "bLengthChange"=> false,
                        "language" => __('voyager::datatable'),
                        "columnDefs" => [['targets' => -1, 'searchable' =>  false, 'orderable' => false]],
                    ],
                    config('voyager.dashboard.data_tables', []))
                , true) !!});
	 	$('.buscar-arquivos').on('click', function (e) {
                 $.ajax({
                    url: "{{ url('busca-resultado-avancado') }}",
                    type: "get",
                    data: $( "#form-busca-avancada" ).serialize()
                }).done(function (result) {
                    $('#voyager-loader').fadeOut();
                    table.clear().draw();
                    table.rows.add(result).draw();
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    toastr.error("Erro: Não foi possível gerar dados!");
                    $('#voyager-loader').fadeOut();
                });
        });
      });

</script>
@endsection