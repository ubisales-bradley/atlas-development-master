<script>
    $(function() {
        var cardTitle = $('#card_title');
        var usersTable = $('#users_table');
        var resultsContainer = $('#search_results');
        var usersCount = $('#user_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_users');
        var searchformInput = $('#user_search_box');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html('');
            usersTable.hide();
            clearSearchTrigger.show();
            let noResulsHtml = '<tr>' +
                                '<td>{!! trans("laravelusers::laravelusers.search.no-results") !!}</td>' +
                                '<td></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-sm hidden-xs"></td>' +
                                '<td class="hidden-sm hidden-xs hidden-md"></td>' +
                                '<td class="hidden-sm hidden-xs hidden-md"></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "{{ route('search-users') }}",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length != 0) {
                        $.each(jsonData, function(index, val) {
                            let rolesHtml = '';
                            let roleClass = '';
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="users/' + val.id + '" data-toggle="tooltip" title="{{ trans("laravelusers::laravelusers.tooltips.show") }}">{!! trans("laravelusers::laravelusers.buttons.show") !!}</a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="users/' + val.id + '/edit" data-toggle="tooltip" title="{{ trans("laravelusers::laravelusers.tooltips.edit") }}">{!! trans("laravelusers::laravelusers.buttons.edit") !!}</a>';
                            let deleteCellHtml = '<form method="POST" action="http://laravel.local/users/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete">' +
                                    '{!! Form::hidden("_method", "DELETE") !!}' +
                                    '{!! csrf_field() !!}' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="{{ trans("laravelusers::modals.delete_user_message", ["user" => "'+val.firstname+'"]) }}">' +
                                        '{!! trans("laravelusers::laravelusers.buttons.delete") !!}' +
                                    '</button>' +
                                '</form>';

                            $.each(val.roles, function(roleIndex, role) {
                                if (role.name == "User") {
                                    roleClass = 'primary';
                                } else if (role.name == "Admin") {
                                    roleClass = 'warning';
                                } else if (role.name == "Unverified") {
                                    roleClass = 'danger';
                                } else {
                                    roleClass = 'dark';
                                };
                                rolesHtml = '<span class="badge badge-' + roleClass + '">' + role.name + '</span> ';
                            });
                            resultsContainer.append('<tr>' +
                                '<td>' + val.id + '</td>' +
                                '<td>' + val.firstname + '</td>' +
                                '<td>' + val.lastname + '</td>' +
                                '<td class="hidden-xs">' + val.email + '</td>' +
                                '@if(config("laravelusers.rolesEnabled"))<td class="hidden-sm hidden-xs"> ' + rolesHtml  +'</td>@endif' +
                                '<td class="hidden-sm hidden-xs hidden-md">' + val.created_at + '</td>' +
                                '<td class="hidden-sm hidden-xs hidden-md">' + val.updated_at + '</td>' +
                                '<td>' + deleteCellHtml + '</td>' +
                                '<td>' + showCellHtml + '</td>' +
                                '<td>' + editCellHtml + '</td>' +
                            '</tr>');
                        });
                    } else {
                        resultsContainer.append(noResulsHtml);
                    };
                    usersCount.html(jsonData.length + " {!! trans('laravelusers::laravelusers.search.found-footer') !!}");
                    cardTitle.html("{!! trans('laravelusers::laravelusers.search.title') !!}");
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.append(noResulsHtml);
                        usersCount.html(0 + " {!! trans('laravelusers::laravelusers.search.found-footer') !!}");
                        cardTitle.html("{!! trans('laravelusers::laravelusers.search.title') !!}");
                    };
                },
            });
        });
        searchformInput.keyup(function(event) {
            if ($('#user_search_box').val() != '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                usersTable.show();
                cardTitle.html("{!! trans('laravelusers::laravelusers.showing-all-users') !!}");
                usersCount.html("{!! trans_choice('laravelusers::laravelusers.users-table.caption', 1, ['userscount' => $users->count()]) !!}");
            };
        });
        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            usersTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("{!! trans('laravelusers::laravelusers.showing-all-users') !!}");
            usersCount.html("{!! trans_choice('laravelusers::laravelusers.users-table.caption', 1, ['userscount' => $users->count()]) !!}");
        });
    });
</script>
