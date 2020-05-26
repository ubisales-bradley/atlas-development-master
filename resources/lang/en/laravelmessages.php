<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel messages Blades Language Lines
    |--------------------------------------------------------------------------
    */

    'showing-all-messages'     => 'Showing All messages',
    'messages-menu-alt'        => 'Show messages Management Menu',
    'create-new-message'       => 'Create New message',
    'show-deleted-messages'    => 'Show Deleted message',
    'editing-message'          => 'Editing message :name',
    'showing-message'          => 'Showing message :name',
    'showing-message-title'    => ':name\'s Information',

    'messages-table' => [
        'caption'   => '{1} :messagescount message total|[2,*] :messagescount total messages',
        'id'        => 'ID',
        'name'      => 'Name',
        'email'     => 'Email',
        'role'      => 'Role',
        'created'   => 'Created',
        'updated'   => 'Updated',
        'actions'   => 'Actions',
        'updated'   => 'Updated',
    ],

    'buttons' => [
        'create-new'    => '<span class="hidden-xs hidden-sm">New message</span>',
        'delete'        => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Delete</span><span class="hidden-xs hidden-sm hidden-md"> message</span>',
        'show'          => '<i class="fas fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Show</span><span class="hidden-xs hidden-sm hidden-md"> message</span>',
        'edit'          => '<i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Edit</span><span class="hidden-xs hidden-sm hidden-md"> message</span>',
        'back-to-messages' => '<span class="hidden-sm hidden-xs">Back to </span><span class="hidden-xs">messages</span>',
        'back-to-message'  => 'Back  <span class="hidden-xs">to message</span>',
        'delete-message'   => '<i class="far fa-trash-alt fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Delete</span><span class="hidden-xs"> message</span>',
        'edit-message'     => '<i class="fas fa-pencil-alt fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Edit</span><span class="hidden-xs"> message</span>',
    ],

    'tooltips' => [
        'delete'        => 'Delete',
        'show'          => 'Show',
        'edit'          => 'Edit',
        'create-new'    => 'Create New message',
        'back-message'     => 'Back to message',
        'back-messages'    => 'Back to messages',
        'email-message'    => 'Email :message',
        'submit-search' => 'Submit messages Search',
        'clear-search'  => 'Clear Search Results',
    ],

    'messages' => [
        'messageNameTaken'          => 'messagename is taken',
        'messageNameRequired'       => 'messagename is required',
        'fNameRequired'          => 'First Name is required',
        'lNameRequired'          => 'Last Name is required',
        'emailRequired'          => 'Email is required',
        'emailInvalid'           => 'Email is invalid',
        'passwordRequired'       => 'Password is required',
        'PasswordMin'            => 'Password needs to have at least 6 characters',
        'PasswordMax'            => 'Password maximum length is 20 characters',
        'captchaRequire'         => 'Captcha is required',
        'CaptchaWrong'           => 'Wrong captcha, please try again.',
        'roleRequired'           => 'message role is required.',
        'message-creation-success'  => 'Successfully created message!',
        'update-message-success'    => 'Successfully updated message!',
        'delete-success'         => 'Successfully deleted the message!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'show-message' => [
        'id'                => 'message ID',
        'name'              => 'messagename',
        'email'             => '<span class="hidden-xs">message </span>Email',
        'role'              => 'message Role',
        'created'           => 'Created <span class="hidden-xs">at</span>',
        'updated'           => 'Updated <span class="hidden-xs">at</span>',
        'labelRole'         => 'message Role',
        'labelAccessLevel'  => '<span class="hidden-xs">message</span> Access Level|<span class="hidden-xs">message</span> Access Levels',
    ],

    'search'  => [
        'title'         => 'Showing Search Results',
        'found-footer'  => ' Record(s) found',
        'no-results'    => 'No Results',
    ],
];
