<div class="container container-fluid row">
    <div class="card z-depth-4" style="overflow: visible"}}>
        <div class="card-content">
            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        {!! Form::text('name', null, ['class' => $errors->has('name') ? 'validate invalid' : 'validate', 'id' => 'name', 'required' => true]) !!}
                        <label for="name">Nome</label>
                        <span class="helper-text" data-error="{{$errors->first('name')}}" data-success="Preenchido"></span>
                    </div>       
                </div>
                <div class="col s6">
                    <div class="input-field">
                        {!! Form::email('email', null, ['class' => $errors->has('email') ? 'validate invalid' : 'validate', 'id' => 'email']) !!}
                        <label for="email">Email</label>
                        <span class="helper-text" data-error="{{$errors->first('email')}}" data-success="Preenchido"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        {!! Form::text('date_of_birth', null, ['class' => $errors->has('date_of_birth') ? 'datepicker validate invalid' : 'datepicker validate', 'id' => 'date_of_birth']) !!}
                        <label for="date_of_birth">Data de nascimento (dd/mm/aaaa)</label>
                        <span class="helper-text" data-error="{{$errors->first('date_of_birth')}}" data-success="Preenchido"></span>
                    </div>
                </div>
                
                <div class="col s6">
                    <div class="input-field">
                        {!! Form::select('city_id', $cities, isset($person) ? $person->city_id : null, ['id' => 'city_id', 'placeholder' => 'Selecione...']) !!}
                        <label for="city_id">Cidade onde mora</label>
                        <span class="helper-text red-text">{{$errors->first('city_id')}}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <div class="file-field input-field">
                        <div class="btn yellow darken-3">
                            <span>Foto</span>
                            {!! Form::file('photo', null, ['id'=> 'photo']) !!}
                        </div>
                        <div class="file-path-wrapper">
                            {!! Form::text(null, null, ['class' => $errors->has('photo') ? 'file-path validate invalid' : 'file-path validate', 'required' => true]) !!}
                            <span class="helper-text" data-error="{{$errors->first('photo')}}" data-success="Preenchido"></span>
                        </div>
                    </div>
                </div>
                @isset($person)
                    <div class="col s6">
                        <div class="row valign-wrapper">
                            <div class="col s12 offset-s4">
                                <img class="materialboxed circle responsive-img" name="photo" data-caption="Foto cadastrada referente à {{$person->name}}" width="150" src="{{url("{$person->file_path_to_show}")}}">
                            </div>
                        </div>
                    </div>
                @endisset
                <div class="col {{isset($person) ? 's12' : 's6'}}">
                    <div class="input-field">
                        <!-- As duas linhas abaixo inserem um componente do React, passando parâmetros para ele -->
                        <div id="interest_select_id" interests="{{$interests}}" interestsSelected="{{empty($interestsSelected) ? json_encode([]) : $interestsSelected}}"></div>
                        <script src="{{ asset('js/InterestSelect.js') }}"></script>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="input-field">
                        <!-- As duas linhas abaixo inserem um componente do React -->
                        <div id="interest_dynamic_input_id"></div>
                        <script src="{{ asset('js/InterestDynamicInput.js') }}"></script>
                    </div>
                    <span class="helper-text red-text">{{$errors->first('interest_inputs.0')}}</span>
                    
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="input-field">
                        {!! link_to("people",'Voltar', $attributes = [ 'class' => 'btn', 'role'=> 'button']) !!}
                        {!! Form::submit($action, ['class' => 'btn right']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>