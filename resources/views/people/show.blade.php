@extends('layouts.app')


@section('content')
    @include('people.breadcrumbs', ['local' => 'Visualização'])

    <div class="container container-fluid row">
        <div class="col s12">
            <div class="card">
                <div class="card-image">
                    <span class="card-title">Informações gerais</span>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="input-field col s8 m3">
                                <img class="materialboxed responsive-img tooltipped" data-position="top" data-tooltip="Foto cadastrada referente a {{$person->name}}" width="150" src="{{url("{$person->file_path_to_show}")}}">
                        </div><!-- /.col -->
                    </div><!-- /.row-->
    
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input readonly value="{{$person->name}}" id="" type="text" >
                            <label>Nome</label>
                        </div><!-- /.col -->
                        <div class="input-field col s12 m6">
                            <input readonly value="{{$person->cityName()}}" id="" type="text" >
                            <label>Localidade</label>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.card-content -->
            </div><!-- /.card -->
        </div>
        <div class="col s6">
            <div class="card">
                <div class="card-image">
                    <span class="card-title">Pessoas que possuem mesmo interesse</span>
                </div>
                <div class="card-content">
                    <div class="row">
                        @if(count($person->peopleWithTheSameInterest()) > 0)
                            @foreach($person->peopleWithTheSameInterest() as $p)
                                <div class="input-field col s12 m6">
                                    <input readonly value="{{$p}}" id="" type="text" >
                                    <label>Nome</label>
                                </div><!-- /.col -->
                            @endforeach
                        @else
                            Não há pessoas com o mesmo interesse!
                        @endif
                    </div><!-- /.row -->
                </div><!-- /.card-content -->
            </div>
        </div>
        <div class="col s6">
            <div class="card">
                <div class="card-image">
                    <span class="card-title">Pessoas da mesma localidade</span>
                </div>
                <div class="card-content">
                    <div class="row">
                        @if(count($person->peopleFromTheSameLocality()) > 0)
                            @foreach($person->peopleFromTheSameLocality() as $p)
                                <div class="input-field col s12 m6">
                                    <input readonly value="{{$p}}" id="" type="text" >
                                    <label>Nome</label>
                                </div><!-- /.col -->
                            @endforeach
                        @else
                            Não há pessoas da mesma localidade!
                        @endif
                    </div><!-- /.row -->
                </div><!-- /.card-content -->
            </div>
        </div>
    </div>
@endsection