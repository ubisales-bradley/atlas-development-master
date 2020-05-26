## Atlas

#### Table of contents

- [Installation Instructions](#installation-instructions)
    - [Build the Front End Assets with Mix](#build-the-front-end-assets-with-mix)
    - [Optionally Build Cache](#optionally-build-cache)
- [Seeds](#seeds)
    - [Seeded Roles](#seeded-roles)
    - [Seeded Permissions](#seeded-permissions)
- [Routes](#routes)

### Installation Instructions
1. Run `git clone https://github.com/jeremykenedy/atlas-development.git atlas-development`
2. Create a MySQL database for the project
    * ```mysql -u root -p```, if using Vagrant: ```mysql -u homestead -psecret```
    * ```create database atlas;```
    * ```\q```
3. From the projects root run `cp .env.example .env`
4. Configure your `.env` file
5. Run `composer update` from the projects root folder
6. From the projects root folder run `php artisan key:generate`
7. From the projects root folder run `php artisan migrate`
8. From the projects root folder run `composer dump-autoload`
9. From the projects root folder run `php artisan db:seed`
10. Compile the front end assets with [npm steps](#using-npm) or [yarn steps](#using-yarn). (optional)

#### Build the Front End Assets with Mix
##### Using Yarn:
1. From the projects root folder run `yarn install`
2. From the projects root folder run `yarn run dev` or `yarn run production`
  * You can watch assets with `yarn run watch`

##### Using NPM:
1. From the projects root folder run `npm install`
2. From the projects root folder run `npm run dev` or `npm run production`
  * You can watch assets with `npm run watch`

#### Optionally Build Cache
1. From the projects root folder run `php artisan config:cache`
    * recommended on production only.

### Seeds
##### Seeded Roles
  * Unverified - Level 0
  * User  - Level 1
  * Administrator - Level 5

##### Seeded Permissions
  * view.users
  * create.users
  * edit.users
  * delete.users

### Routes
```
+--------+-----------+---------------------------------+-----------------------------------------------+-----------------------------------------------------------------------------------------------------------------+---------------------+
| Domain | Method    | URI                             | Name                                          | Action                                                                                                          | Middleware          |
+--------+-----------+---------------------------------+-----------------------------------------------+-----------------------------------------------------------------------------------------------------------------+---------------------+
|        | GET|HEAD  | /                               |                                               | App\Http\Controllers\HomeController@index                                                                       | web,auth            |
|        | GET|HEAD  | accounts                        | accounts.index                                | App\Http\Controllers\AccountsController@index                                                                   | web,auth            |
|        | POST      | accounts                        | accounts.store                                | App\Http\Controllers\AccountsController@store                                                                   | web,auth            |
|        | GET|HEAD  | accounts/create                 | accounts.create                               | App\Http\Controllers\AccountsController@create                                                                  | web,auth            |
|        | PUT|PATCH | accounts/{account}              | accounts.update                               | App\Http\Controllers\AccountsController@update                                                                  | web,auth            |
|        | GET|HEAD  | accounts/{account}              | accounts.show                                 | App\Http\Controllers\AccountsController@show                                                                    | web,auth            |
|        | DELETE    | accounts/{account}              | accounts.destroy                              | App\Http\Controllers\AccountsController@destroy                                                                 | web,auth            |
|        | GET|HEAD  | accounts/{account}/edit         | accounts.edit                                 | App\Http\Controllers\AccountsController@edit                                                                    | web,auth            |
|        | GET|HEAD  | api/user                        |                                               | Closure                                                                                                         | api,auth:api        |
|        | GET|HEAD  | gateways                        | gateways.index                                | App\Http\Controllers\GatewaysController@index                                                                   | web,auth            |
|        | POST      | gateways                        | gateways.store                                | App\Http\Controllers\GatewaysController@store                                                                   | web,auth            |
|        | GET|HEAD  | gateways/create                 | gateways.create                               | App\Http\Controllers\GatewaysController@create                                                                  | web,auth            |
|        | DELETE    | gateways/{gateway}              | gateways.destroy                              | App\Http\Controllers\GatewaysController@destroy                                                                 | web,auth            |
|        | PUT|PATCH | gateways/{gateway}              | gateways.update                               | App\Http\Controllers\GatewaysController@update                                                                  | web,auth            |
|        | GET|HEAD  | gateways/{gateway}              | gateways.show                                 | App\Http\Controllers\GatewaysController@show                                                                    | web,auth            |
|        | GET|HEAD  | gateways/{gateway}/edit         | gateways.edit                                 | App\Http\Controllers\GatewaysController@edit                                                                    | web,auth            |
|        | GET|HEAD  | home                            | home                                          | App\Http\Controllers\HomeController@index                                                                       | web,auth            |
|        | GET|HEAD  | login                           | login                                         | App\Http\Controllers\Auth\LoginController@showLoginForm                                                         | web,guest           |
|        | POST      | login                           |                                               | App\Http\Controllers\Auth\LoginController@login                                                                 | web,guest           |
|        | GET|HEAD  | logout                          | logout                                        | App\Http\Controllers\Auth\LoginController@logout                                                                | web,auth            |
|        | POST      | logout                          | logout                                        | App\Http\Controllers\Auth\LoginController@logout                                                                | web                 |
|        | POST      | messages                        | messages.store                                | App\Http\Controllers\MessagesController@store                                                                   | web,auth            |
|        | GET|HEAD  | messages                        | messages.index                                | App\Http\Controllers\MessagesController@index                                                                   | web,auth            |
|        | GET|HEAD  | messages/create                 | messages.create                               | App\Http\Controllers\MessagesController@create                                                                  | web,auth            |
|        | DELETE    | messages/{message}              | messages.destroy                              | App\Http\Controllers\MessagesController@destroy                                                                 | web,auth            |
|        | PUT|PATCH | messages/{message}              | messages.update                               | App\Http\Controllers\MessagesController@update                                                                  | web,auth            |
|        | GET|HEAD  | messages/{message}              | messages.show                                 | App\Http\Controllers\MessagesController@show                                                                    | web,auth            |
|        | GET|HEAD  | messages/{message}/edit         | messages.edit                                 | App\Http\Controllers\MessagesController@edit                                                                    | web,auth            |
|        | GET|HEAD  | password/confirm                | password.confirm                              | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm                                             | web,auth            |
|        | POST      | password/confirm                |                                               | App\Http\Controllers\Auth\ConfirmPasswordController@confirm                                                     | web,auth            |
|        | POST      | password/email                  | password.email                                | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail                                           | web                 |
|        | GET|HEAD  | password/reset                  | password.request                              | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm                                          | web                 |
|        | POST      | password/reset                  | password.update                               | App\Http\Controllers\Auth\ResetPasswordController@reset                                                         | web                 |
|        | GET|HEAD  | password/reset/{token}          | password.reset                                | App\Http\Controllers\Auth\ResetPasswordController@showResetForm                                                 | web                 |
|        | GET|HEAD  | permission-deleted/{id}         | laravelroles::permission-show-deleted         | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelpermissionsDeletedController@show                         | web,auth,role:admin |
|        | DELETE    | permission-destroy/{id}         | laravelroles::permission-item-destroy         | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelpermissionsDeletedController@destroy                      | web,auth,role:admin |
|        | PUT       | permission-restore/{id}         | laravelroles::permission-restore              | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelpermissionsDeletedController@restorePermission            | web,auth,role:admin |
|        | GET|HEAD  | permissions                     | laravelroles::permissions.index               | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelPermissionsController@index                               | web,auth,role:admin |
|        | POST      | permissions                     | laravelroles::permissions.store               | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelPermissionsController@store                               | web,auth,role:admin |
|        | GET|HEAD  | permissions-deleted             | laravelroles::permissions-deleted             | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelpermissionsDeletedController@index                        | web,auth,role:admin |
|        | DELETE    | permissions-deleted-destroy-all | laravelroles::destroy-all-deleted-permissions | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelpermissionsDeletedController@destroyAllDeletedPermissions | web,auth,role:admin |
|        | POST      | permissions-deleted-restore-all | laravelroles::permissions-deleted-restore-all | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelpermissionsDeletedController@restoreAllDeletedPermissions | web,auth,role:admin |
|        | GET|HEAD  | permissions/create              | laravelroles::permissions.create              | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelPermissionsController@create                              | web,auth,role:admin |
|        | DELETE    | permissions/{permission}        | laravelroles::permissions.destroy             | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelPermissionsController@destroy                             | web,auth,role:admin |
|        | GET|HEAD  | permissions/{permission}        | laravelroles::permissions.show                | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelPermissionsController@show                                | web,auth,role:admin |
|        | PUT|PATCH | permissions/{permission}        | laravelroles::permissions.update              | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelPermissionsController@update                              | web,auth,role:admin |
|        | GET|HEAD  | permissions/{permission}/edit   | laravelroles::permissions.edit                | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelPermissionsController@edit                                | web,auth,role:admin |
|        | POST      | recipients                      | recipients.store                              | App\Http\Controllers\RecipientsController@store                                                                 | web,auth            |
|        | GET|HEAD  | recipients                      | recipients.index                              | App\Http\Controllers\RecipientsController@index                                                                 | web,auth            |
|        | GET|HEAD  | recipients/create               | recipients.create                             | App\Http\Controllers\RecipientsController@create                                                                | web,auth            |
|        | GET|HEAD  | recipients/{recipient}          | recipients.show                               | App\Http\Controllers\RecipientsController@show                                                                  | web,auth            |
|        | PUT|PATCH | recipients/{recipient}          | recipients.update                             | App\Http\Controllers\RecipientsController@update                                                                | web,auth            |
|        | DELETE    | recipients/{recipient}          | recipients.destroy                            | App\Http\Controllers\RecipientsController@destroy                                                               | web,auth            |
|        | GET|HEAD  | recipients/{recipient}/edit     | recipients.edit                               | App\Http\Controllers\RecipientsController@edit                                                                  | web,auth            |
|        | POST      | register                        |                                               | App\Http\Controllers\Auth\RegisterController@register                                                           | web,guest           |
|        | GET|HEAD  | register                        | register                                      | App\Http\Controllers\Auth\RegisterController@showRegistrationForm                                               | web,guest           |
|        | GET|HEAD  | role-deleted/{id}               | laravelroles::role-show-deleted               | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelRolesDeletedController@show                               | web,auth,role:admin |
|        | DELETE    | role-destroy/{id}               | laravelroles::role-item-destroy               | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelRolesDeletedController@destroy                            | web,auth,role:admin |
|        | PUT       | role-restore/{id}               | laravelroles::role-restore                    | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelRolesDeletedController@restoreRole                        | web,auth,role:admin |
|        | GET|HEAD  | roles                           | laravelroles::roles.index                     | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelRolesController@index                                     | web,auth,role:admin |
|        | POST      | roles                           | laravelroles::roles.store                     | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelRolesController@store                                     | web,auth,role:admin |
|        | GET|HEAD  | roles-deleted                   | laravelroles::roles-deleted                   | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelRolesDeletedController@index                              | web,auth,role:admin |
|        | DELETE    | roles-deleted-destroy-all       | laravelroles::destroy-all-deleted-roles       | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelRolesDeletedController@destroyAllDeletedRoles             | web,auth,role:admin |
|        | POST      | roles-deleted-restore-all       | laravelroles::roles-deleted-restore-all       | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelRolesDeletedController@restoreAllDeletedRoles             | web,auth,role:admin |
|        | GET|HEAD  | roles/create                    | laravelroles::roles.create                    | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelRolesController@create                                    | web,auth,role:admin |
|        | DELETE    | roles/{role}                    | laravelroles::roles.destroy                   | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelRolesController@destroy                                   | web,auth,role:admin |
|        | PUT|PATCH | roles/{role}                    | laravelroles::roles.update                    | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelRolesController@update                                    | web,auth,role:admin |
|        | GET|HEAD  | roles/{role}                    | laravelroles::roles.show                      | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelRolesController@show                                      | web,auth,role:admin |
|        | GET|HEAD  | roles/{role}/edit               | laravelroles::roles.edit                      | jeremykenedy\LaravelRoles\App\Http\Controllers\LaravelRolesController@edit                                      | web,auth,role:admin |
|        | GET|HEAD  | routers                         | routers.index                                 | App\Http\Controllers\RoutersController@index                                                                    | web,auth            |
|        | POST      | routers                         | routers.store                                 | App\Http\Controllers\RoutersController@store                                                                    | web,auth            |
|        | GET|HEAD  | routers/create                  | routers.create                                | App\Http\Controllers\RoutersController@create                                                                   | web,auth            |
|        | DELETE    | routers/{router}                | routers.destroy                               | App\Http\Controllers\RoutersController@destroy                                                                  | web,auth            |
|        | PUT|PATCH | routers/{router}                | routers.update                                | App\Http\Controllers\RoutersController@update                                                                   | web,auth            |
|        | GET|HEAD  | routers/{router}                | routers.show                                  | App\Http\Controllers\RoutersController@show                                                                     | web,auth            |
|        | GET|HEAD  | routers/{router}/edit           | routers.edit                                  | App\Http\Controllers\RoutersController@edit                                                                     | web,auth            |
|        | POST      | search-users                    | search-users                                  | App\Http\Controllers\UsersManagementController@search                                                           | web,auth,role:admin |
|        | POST      | sources                         | sources.store                                 | App\Http\Controllers\SourcesController@store                                                                    | web,auth            |
|        | GET|HEAD  | sources                         | sources.index                                 | App\Http\Controllers\SourcesController@index                                                                    | web,auth            |
|        | GET|HEAD  | sources/create                  | sources.create                                | App\Http\Controllers\SourcesController@create                                                                   | web,auth            |
|        | GET|HEAD  | sources/{source}                | sources.show                                  | App\Http\Controllers\SourcesController@show                                                                     | web,auth            |
|        | PUT|PATCH | sources/{source}                | sources.update                                | App\Http\Controllers\SourcesController@update                                                                   | web,auth            |
|        | DELETE    | sources/{source}                | sources.destroy                               | App\Http\Controllers\SourcesController@destroy                                                                  | web,auth            |
|        | GET|HEAD  | sources/{source}/edit           | sources.edit                                  | App\Http\Controllers\SourcesController@edit                                                                     | web,auth            |
|        | POST      | users                           | users.store                                   | App\Http\Controllers\UsersManagementController@store                                                            | web,auth,role:admin |
|        | GET|HEAD  | users                           | users                                         | App\Http\Controllers\UsersManagementController@index                                                            | web,auth,role:admin |
|        | GET|HEAD  | users/create                    | users.create                                  | App\Http\Controllers\UsersManagementController@create                                                           | web,auth,role:admin |
|        | DELETE    | users/{user}                    | user.destroy                                  | App\Http\Controllers\UsersManagementController@destroy                                                          | web,auth,role:admin |
|        | GET|HEAD  | users/{user}                    | users.show                                    | App\Http\Controllers\UsersManagementController@show                                                             | web,auth,role:admin |
|        | PUT|PATCH | users/{user}                    | users.update                                  | App\Http\Controllers\UsersManagementController@update                                                           | web,auth,role:admin |
|        | GET|HEAD  | users/{user}/edit               | users.edit                                    | App\Http\Controllers\UsersManagementController@edit                                                             | web,auth,role:admin |
+--------+-----------+---------------------------------+-----------------------------------------------+-----------------------------------------------------------------------------------------------------------------+---------------------+

```
* List routes with `php artisan route:list`
