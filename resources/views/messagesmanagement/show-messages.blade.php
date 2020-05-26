@extends(config('laravelmessages.laravelmessagesBladeExtended'))

@section('template_title')
    {!! trans('laravelmessages::laravelmessages.showing-all-messages') !!}
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
                <div class="col-sm-12">
                    @include('laravelmessages::partials.form-status')
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {!! trans('laravelmessages::laravelmessages.showing-all-messages') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                @if(config('laravelmessages.softDeletedEnabled'))
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">
                                            {!! trans('laravelmessages::laravelmessages.messages-menu-alt') !!}
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('messages.create') }}">
                                                @if(config('laravelmessages.fontAwesomeEnabled'))
                                                    <i class="fa fa-fw fa-message-plus" aria-hidden="true"></i>
                                                @endif
                                                {!! trans('laravelmessages::laravelmessages.buttons.create-new') !!}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/messages/deleted">
                                                @if(config('laravelmessages.fontAwesomeEnabled'))
                                                    <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                                @endif
                                                {!! trans('laravelmessages::laravelmessages.show-deleted-messages') !!}
                                            </a>
                                        </li>
                                    </ul>
                                @else
                                    <a href="{{ route('messages.create') }}" class="btn btn-default btn-sm pull-right" data-toggle="tooltip" data-placement="left" title="{!! trans('laravelmessages::laravelmessages.tooltips.create-new') !!}">
                                        @if(config('laravelmessages.fontAwesomeEnabled'))
                                            <i class="fa fa-fw fa-message-plus" aria-hidden="true"></i>
                                        @endif
                                        {!! trans('laravelmessages::laravelmessages.buttons.create-new') !!}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        @if(config('laravelmessages.enableSearchmessages'))
                            @include('laravelmessages::partials.search-messages-form')
                        @endif

                        <div class="table-responsive messages-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="message_count">
                                    {!! trans_choice('laravelmessages::laravelmessages.messages-table.caption', 1, ['messagescount' => $messages->count()]) !!}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th>{!! trans('laravelmessages::laravelmessages.messages-table.id') !!}</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th class="hidden-xs">{!! trans('laravelmessages::laravelmessages.messages-table.email') !!}</th>
                                        @if(config('laravelmessages.rolesEnabled'))
                                            <th class="hidden-sm hidden-xs">{!! trans('laravelmessages::laravelmessages.messages-table.role') !!}</th>
                                        @endif
                                        <th class="hidden-sm hidden-xs hidden-md">{!! trans('laravelmessages::laravelmessages.messages-table.created') !!}</th>
                                        <th class="hidden-sm hidden-xs hidden-md">{!! trans('laravelmessages::laravelmessages.messages-table.updated') !!}</th>
                                        <th class="no-search no-sort">{!! trans('laravelmessages::laravelmessages.messages-table.actions') !!}</th>
                                        <th class="no-search no-sort"></th>
                                        <th class="no-search no-sort"></th>
                                    </tr>
                                </thead>
                                <tbody id="messages_table">
                                    @foreach($messages as $message)
                                        <tr>
                                            <td>{{$message->id}}</td>
                                            <td>{{$message->direction}}</td>
                                            <td>{{$message->account_id}}</td>
                                            <td class="hidden-xs">{{$message->recipient_id}}</td>
                                            <td class="hidden-xs">{{$message->content_id}}</td>
                                            <td>{{$message->source_id}}</td>
                                            <td>{{$message->status_id}}</td>
                                            <td class="hidden-xs">{{$message->send_at}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$message->created_at}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$message->updated_at}}</td>
                                            <td>
                                                {!! Form::open(array('url' => 'messages/' . $message->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => trans('laravelmessages::laravelmessages.tooltips.delete'))) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button(trans('laravelmessages::laravelmessages.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('laravelmessages::modals.delete_message_title'), 'data-message' => trans('laravelmessages::modals.delete_message_message', ['message' => $message->name]))) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('messages/' . $message->id) }}" data-toggle="tooltip" title="{!! trans('laravelmessages::laravelmessages.tooltips.show') !!}">
                                                    {!! trans('laravelmessages::laravelmessages.buttons.show') !!}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('messages/' . $message->id . '/edit') }}" data-toggle="tooltip" title="{!! trans('laravelmessages::laravelmessages.tooltips.edit') !!}">
                                                    {!! trans('laravelmessages::laravelmessages.buttons.edit') !!}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @if(config('laravelmessages.enableSearchmessages'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>

                            @if($pagintaionEnabled)
                                {{ $messages->links() }}
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('laravelmessages::modals.modal-delete')

@endsection

@section('template_scripts')
    @if ((count($messages) > config('laravelmessages.datatablesJsStartCount')) && config('laravelmessages.enabledDatatablesJs'))
        @include('laravelmessages::scripts.datatables')
    @endif
    @include('laravelmessages::scripts.delete-modal-script')
    @include('laravelmessages::scripts.save-modal-script')
    @if(config('laravelmessages.tooltipsEnabled'))
        @include('laravelmessages::scripts.tooltips')
    @endif
    @if(config('laravelmessages.enableSearchmessages'))
        @include('scripts.search-messages')
    @endif

@endsection
