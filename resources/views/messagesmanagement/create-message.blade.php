@extends(config('laravelmessages.laravelmessagesBladeExtended'))

@section('template_title')
    {!! trans('laravelmessages::laravelmessages.create-new-message') !!}
@endsection

@section('template_linked_css')
    @if(config('laravelmessages.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelmessages.datatablesCssCDN') }}">
    @endif
    @if(config('laravelmessages.fontAwesomeEnabled'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelmessages.fontAwesomeCdn') }}">
    @endif
    @include('laravelmessages::partials.styles')
    @include('laravelmessages::partials.bs-visibility-css')
@endsection

@section('content')
    <div class="container">
        @if(config('laravelmessages.enablePackageBootstapAlerts'))
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    @include('laravelmessages::partials.form-status')
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('laravelmessages::laravelmessages.create-new-message') !!}
                            <div class="pull-right">
                                <a href="{{ route('messages') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{!! trans('laravelmessages::laravelmessages.tooltips.back-messages') !!}">
                                    @if(config('laravelmessages.fontAwesomeEnabled'))
                                        <i class="fas fa-fw fa-reply-all" aria-hidden="true"></i>
                                    @endif
                                    {!! trans('laravelmessages::laravelmessages.buttons.back-to-messages') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => 'messages.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                            {!! csrf_field() !!}
                            <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                                @if(config('laravelmessages.fontAwesomeEnabled'))
                                    {!! Form::label('email', trans('laravelmessages::forms.create_message_label_email'), array('class' => 'col-md-3 control-label')); !!}
                                @endif
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('laravelmessages::forms.create_message_ph_email'))) !!}
                                        <div class="input-group-append">
                                            <label for="email" class="input-group-text">
                                                @if(config('laravelmessages.fontAwesomeEnabled'))
                                                    <i class="fa fa-fw {!! trans('laravelmessages::forms.create_message_icon_email') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelmessages::forms.create_message_label_email') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('firstname') ? ' has-error ' : '' }}">
                                @if(config('laravelmessages.fontAwesomeEnabled'))
                                    {!! Form::label('firstname', 'Firstname', array('class' => 'col-md-3 control-label')); !!}
                                @endif
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('firstname', NULL, array('id' => 'firstname', 'class' => 'form-control', 'placeholder' => 'Firstname')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="firstname">
                                                @if(config('laravelmessages.fontAwesomeEnabled'))
                                                    <i class="fa fa-fw {!! trans('laravelmessages::forms.create_message_icon_messagename') !!}" aria-hidden="true"></i>
                                                @else
                                                    Firstname
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('firstname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('lastname') ? ' has-error ' : '' }}">
                                @if(config('laravelmessages.fontAwesomeEnabled'))
                                    {!! Form::label('lastname', 'Lastname', array('class' => 'col-md-3 control-label')); !!}
                                @endif
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('lastname', NULL, array('id' => 'lastname', 'class' => 'form-control', 'placeholder' => 'Lastname')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="lastname">
                                                @if(config('laravelmessages.fontAwesomeEnabled'))
                                                    <i class="fa fa-fw {!! trans('laravelmessages::forms.create_message_icon_messagename') !!}" aria-hidden="true"></i>
                                                @else
                                                    Lastname
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if($rolesEnabled)
                                <div class="form-group has-feedback row {{ $errors->has('role') ? ' has-error ' : '' }}">
                                    @if(config('laravelmessages.fontAwesomeEnabled'))
                                        {!! Form::label('role', trans('laravelmessages::forms.create_message_label_role'), array('class' => 'col-md-3 control-label')); !!}
                                    @endif
                                    <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="role" id="role">
                                            <option value="">{!! trans('laravelmessages::forms.create_message_ph_role') !!}</option>
                                            @if ($roles)
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="role">
                                                @if(config('laravelmessages.fontAwesomeEnabled'))
                                                    <i class="{!! trans('laravelmessages::forms.create_message_icon_role') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelmessages::forms.create_message_label_messagename') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            @endif
                            <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">
                                @if(config('laravelmessages.fontAwesomeEnabled'))
                                    {!! Form::label('password', trans('laravelmessages::forms.create_message_label_password'), array('class' => 'col-md-3 control-label')); !!}
                                @endif
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('laravelmessages::forms.create_message_ph_password'))) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="password">
                                                @if(config('laravelmessages.fontAwesomeEnabled'))
                                                    <i class="fa fa-fw {!! trans('laravelmessages::forms.create_message_icon_password') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelmessages::forms.create_message_label_password') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">
                                @if(config('laravelmessages.fontAwesomeEnabled'))
                                    {!! Form::label('password_confirmation', trans('laravelmessages::forms.create_message_label_pw_confirmation'), array('class' => 'col-md-3 control-label')); !!}
                                @endif
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('laravelmessages::forms.create_message_ph_pw_confirmation'))) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="password_confirmation">
                                                @if(config('laravelmessages.fontAwesomeEnabled'))
                                                    <i class="fa fa-fw {!! trans('laravelmessages::forms.create_message_icon_pw_confirmation') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelmessages::forms.create_message_label_pw_confirmation') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {!! Form::button(trans('laravelmessages::forms.create_message_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('template_scripts')
    @if(config('laravelmessages.tooltipsEnabled'))
        @include('laravelmessages::scripts.tooltips')
    @endif
@endsection
