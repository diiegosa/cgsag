@extends('layouts.app')

@section('content')
    @include('people.breadcrumbs', ['local' => 'Cadastrar'])
    
    {!! Form::open(['url' => 'people', 'enctype' => 'multipart/form-data']) !!}
        @include('people.fields', ['action' => 'Salvar'])
    {!! Form::close() !!}

@endsection