@extends(config('laravelmessages.laravelmessagesBladeExtended'))

@section('template_title')
    {!! trans('laravelmessages::laravelmessages.showing-message', ['content_id' => $message->content_id]) !!}
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
                            {!! trans('laravelmessages::laravelmessages.showing-message-title', ['name' => $message->firstname . ' ' . $message->lastname]) !!}
                            <div class="float-right">
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
{{--                        <h4 class="text-muted text-center">--}}
{{--                            {{ $message->firstname }} {{ $message->lastname }}--}}
{{--                        </h4>--}}
                        @if($message->account_id)
                            <p class="text-center" data-toggle="tooltip" data-placement="top" title="{!! trans('laravelmessages::laravelmessages.tooltips.account_id-message', ['message' => $message->account_id]) !!}">
                                {{ Html::mailto($message->account_id, $message->account_id) }}
                            </p>
                        @endif
                        <div class="row mb-4">
                            <div class="col-3 offset-3 col-sm-4 offset-sm-2 col-md-4 offset-md-2 col-lg-3 offset-lg-3">
                                <a href="/messages/{{$message->id}}/edit" class="btn btn-block btn-md btn-warning">
                                    {!! trans('laravelmessages::laravelmessages.buttons.edit-message') !!}
                                </a>
                            </div>
                            <div class="col-3 col-sm-4 col-md-4 col-lg-3">
                                {!! Form::open(array('url' => 'messages/' . $message->id, 'class' => 'form-inline')) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button(trans('laravelmessages::laravelmessages.buttons.delete-message'), array('class' => 'btn btn-danger btn-md btn-block','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete message', 'data-message' => 'Are you sure you want to delete this message?')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-4 col-sm-3">
                                        <strong>
                                            {!! trans('laravelmessages::laravelmessages.show-message.id') !!}
                                        </strong>
                                    </div>
                                    <div class="col-8 col-sm-9">
                                        {{ $message->id }}
                                    </div>
                                </div>
                            </li>
                            @if ($message->content_id )
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 col-sm-3">
                                            <strong>
                                                content_id
                                            </strong>
                                        </div>
                                        <div class="col-8 col-sm-9">
                                            {{ $message->content_id  }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if ($message->direction)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 col-sm-3">
                                            <strong>
                                                direction
                                            </strong>
                                        </div>
                                        <div class="col-8 col-sm-9">
                                            {{ $message->direction }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if ($message->account_id)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-12 col-sm-3">
                                            <strong>
                                                {!! trans('laravelmessages::laravelmessages.show-message.email') !!}
                                            </strong>
                                        </div>
                                        <div class="col-12 col-sm-9">
                                            {{ $message->account_id }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if(config('laravelmessages.rolesEnabled'))
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 col-sm-3">
                                            <strong>
                                                {{ trans('laravelmessages::laravelmessages.show-message.labelRole') }}
                                            </strong>
                                        </div>
{{--                                        <div class="col-8 col-sm-9">--}}
{{--                                            @foreach ($message->roles as $message_role)--}}
{{--                                                @if ($message_role->name == 'message')--}}
{{--                                                    @php $labelClass = 'primary' @endphp--}}
{{--                                                @elseif ($message_role->name == 'Admin')--}}
{{--                                                    @php $labelClass = 'warning' @endphp--}}
{{--                                                @elseif ($message_role->name == 'Unverified')--}}
{{--                                                    @php $labelClass = 'danger' @endphp--}}
{{--                                                @else--}}
{{--                                                    @php $labelClass = 'default' @endphp--}}
{{--                                                @endif--}}
{{--                                                <span class="badge badge-{{$labelClass}}">{{ $message_role->name }}</span>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-12 col-sm-3">
                                            <strong>
                                                {!! trans_choice('laravelmessages::laravelmessages.show-message.labelAccessLevel', 1) !!}
                                            </strong>
                                        </div>
                                        <div class="col-12 col-sm-9">
                                            @if($message->level() >= 5)
                                                <span class="badge badge-primary margin-half margin-left-0">5</span>
                                            @endif
                                            @if($message->level() >= 4)
                                                <span class="badge badge-info margin-half margin-left-0">4</span>
                                            @endif
                                            @if($message->level() >= 3)
                                                <span class="badge badge-success margin-half margin-left-0">3</span>
                                            @endif
                                            @if($message->level() >= 2)
                                                <span class="badge badge-warning margin-half margin-left-0">2</span>
                                            @endif
                                            @if($message->level() >= 1)
                                                <span class="badge badge-default margin-half margin-left-0">1</span>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if ($message->created_at)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 col-sm-3">
                                            <strong>
                                                {!! trans('laravelmessages::laravelmessages.show-message.created') !!}
                                            </strong>
                                        </div>
                                        <div class="col-8 col-sm-9">
                                            {{ $message->created_at }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if ($message->updated_at)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 col-sm-3">
                                            <strong>
                                                {!! trans('laravelmessages::laravelmessages.show-message.updated') !!}
                                            </strong>
                                        </div>
                                        <div class="col-8 col-sm-9">
                                            {{ $message->updated_at }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('laravelmessages::modals.modal-delete')
@endsection

@section('template_scripts')
    @include('laravelmessages::scripts.delete-modal-script')
    @if(config('laravelmessages.tooltipsEnabled'))
        @include('laravelmessages::scripts.tooltips')
    @endif
@endsection
