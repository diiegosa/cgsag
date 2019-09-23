@extends('layouts.app')

@section('content')
    @include('people.breadcrumbs', ['local' => 'Editar'])
    
    {!! Form::model($person, ['method' => 'PATCH','url' => ['people', $person->id], 'enctype' => 'multipart/form-data']) !!}
        @include('people.fields', ['action' => 'Atualizar'])
    {!! Form::close() !!}

@endsection