@extends('layouts.app')


@section('content')
    @include('people.breadcrumbs')
    
    <div class="container container-fluid row">
        <div id="admin" class="col s12">
            <a class="mb-3 waves-effect waves-light btn-small" href="/people/create" title="Clique aqui para iniciar um novo processo de credenciamento">Adicionar uma pessoa</a>
            <div class="card material-table">
                @if($people->isNotEmpty())
                    <table class="striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Foto</th>
                                <th>Email</th>
                                <th>Data de nascimento</th>
                                <th>Localidade</th>
                                <th></th>
                            </tr>
                        </thead>
                
                        <tbody>
                            @foreach($people as $person)
                                <tr>
                                    <td class="tooltipped" data-position="top" data-tooltip="{{ $person->name }}">{{ $person->name }}</td>
                                    <td class="tooltipped" data-position="top" data-tooltip="Foto de {{ $person->name }}">
                                        <a href="{{ url("{$person->file_path_to_show}") }}" target="_blank">
                                            <img src="{{url("{$person->file_path_to_show}")}}" class="circle responsive-img">
                                        </a>
                                    </td>
                                    <td class="tooltipped" data-position="top" data-tooltip="{{ $person->email }}">{{ $person->email }}</td>
                                    <td class="tooltipped" data-position="top" data-tooltip="{{ $person->date_of_birth }}">{{ $person->date_of_birth }}</td>
                                    <td class="tooltipped" data-position="top" data-tooltip="{{ $person->cityName() }}">{{ $person->cityName() }}</td>
                                    <td>
                                        <a href="/people/{{$person->id}}/edit" class="btn yellow darken-3 tooltipped" data-position="top" data-tooltip="Editar">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        
                                        <a href="{{ url('people', $person->id) }}" class="btn blue lighten-1 tooltipped" data-position="top" data-tooltip="Visualização">
                                            <i class="material-icons">format_align_justify</i>
                                        </a>
                                        
                                        <!-- Gatilho para o modal de exclusão do registro  -->
                                        <a class="btn red lighten-1 modal-trigger tooltipped" href="#modal-delete-{{$person->id}}" data-position="top" data-tooltip="Excluir"><i class="material-icons">delete</i></a>
                                        <!-- Modal para exclusão do registro -->
                                        <div id="modal-delete-{{$person->id}}" class="modal">
                                            <div class="modal-content">
                                            <h4>Atenção!</h4>
                                            <p>Tem certeza que deseja excluir {{$person->name}}?</p>
                                            </div>
                                            <div class="modal-footer">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['people.destroy',$person->id] ]) !!}
                                                    <a href="" class="modal-close waves-effect waves-red btn btn-flat left">Voltar</a>
                                                    <button type="submit" class="btn btn-flat">Excluir</button>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>  
                @else
                    <div class="col s12">
                        <p class="caption">Nenhum registro encontrado.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
    


    
