<a href="{{route('setup.installation')}}"
   class="group flex items-center px-2 py-2 text-sm leading-6 font-medium @if(!Route::is('setup.installation')) text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md @else text-gray-100 hover:text-white hover:bg-gray-600 px-2 py-2 text-sm leading-6 font-medium rounded-md @endif" aria-current="page">
	<i class="fa fa-home text-xl mr-4 @if(Route::is('setup.installation')) text-yellow-100 @else text-white-50 @endif"></i>
	{{__('Installation') }}
</a>
<a href="{{route('setup.dashboard')}}"
   class="group flex items-center px-2 py-2 text-sm leading-6 font-medium @if(!Route::is('setup.dashboard')) text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md @else text-gray-100 hover:text-white hover:bg-gray-600 px-2 py-2 text-sm leading-6 font-medium rounded-md @endif" aria-current="page">
	<i class="fa fa-cube text-xl mr-4 @if(Route::is('setup.dashboard')) text-yellow-100 @else text-white-50 @endif"></i>
	{{__('Packages') }}
</a>
<a href="{{route('setup.config-corporate')}}"
   class="group flex items-center px-2 py-2 text-sm leading-6 font-medium @if(!Route::is('setup.config-corporate')) text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md @else text-gray-100 hover:text-white hover:bg-gray-600 px-2 py-2 text-sm leading-6 font-medium rounded-md @endif" aria-current="page">
	<i class="fa fa-coffee text-xl mr-4 @if(Route::is('setup.config-corporate')) text-yellow-100 @else text-white-50 @endif"></i>
	{{__('Config corporate') }}
</a>
<a href="{{route('setup.admins.index')}}"
   class="group flex items-center px-2 py-2 text-sm leading-6 font-medium @if(!Route::is('setup.admins*')) text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md @else text-gray-100 hover:text-white hover:bg-gray-600 px-2 py-2 text-sm leading-6 font-medium rounded-md @endif" aria-current="page">
	<i class="fa fa-users-cog text-xl mr-4 @if(Route::is('setup.admins*')) text-yellow-100 @else text-white-50 @endif"></i>
	{{__('Administrators') }}
</a>
@if(Schema::hasTable('staff_members'))
	<a href="{{route('setup.staff-members.index')}}"
	   class="group flex items-center px-2 py-2 text-sm leading-6 font-medium @if(!Route::is('setup.staff-members.*')) text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md @else text-gray-100 hover:text-white hover:bg-gray-600 px-2 py-2 text-sm leading-6 font-medium rounded-md @endif" aria-current="page">
		<i class="fa fa-users-cog text-xl mr-4 @if(Route::is('setup.staff-members.*')) text-yellow-100 @else text-white-50 @endif"></i>
		{{__('Staff members') }}
	</a>
@endif
@if(Schema::hasTable('users'))
	<a href="{{route('setup.users.index')}}"
	   class="group flex items-center px-2 py-2 text-sm leading-6 font-medium @if(!Route::is('setup.users.*')) text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md @else text-gray-100 hover:text-white hover:bg-gray-600 px-2 py-2 text-sm leading-6 font-medium rounded-md @endif" aria-current="page">
		<i class="fa fa-users-cog text-xl mr-4 @if(Route::is('setup.users.*')) text-yellow-100 @else text-white-50 @endif"></i>
		{{__('Users') }}
	</a>
@endif
<div class="divide-yellow-100 h-4"></div>
<a href="{{route('setup.roles.index')}}"
   class="group flex items-center px-2 py-2 text-sm leading-6 font-medium @if(!Route::is('setup.roles*')) text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md @else text-gray-100 hover:text-white hover:bg-gray-600 px-2 py-2 text-sm leading-6 font-medium rounded-md @endif" aria-current="page">
	<i class="fa fa-users-cog text-xl mr-4 @if(Route::is('setup.roles*')) text-yellow-100 @else text-white-50 @endif"></i>
	{{__('Roles') }}
</a>
<a href="{{route('setup.permissions.index')}}"
   class="group flex items-center px-2 py-2 text-sm leading-6 font-medium @if(!Route::is('setup.permissions*')) text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md @else text-gray-100 hover:text-white hover:bg-gray-600 px-2 py-2 text-sm leading-6 font-medium rounded-md @endif" aria-current="page">
	<i class="fa fa-users-cog text-xl mr-4 @if(Route::is('setup.permissions*')) text-yellow-100 @else text-white-50 @endif"></i>
	{{__('Permissions') }}
</a>
<div class="divide-yellow-100 h-4"></div>
<a href="{{route('setup.doc-categories.index')}}"
   class="group flex items-center px-2 py-2 text-sm leading-6 font-medium @if(!Route::is('setup.doc-categories*')) text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md @else text-gray-100 hover:text-white hover:bg-gray-600 px-2 py-2 text-sm leading-6 font-medium rounded-md @endif" aria-current="page">
	<i class="fa fa-file-code text-xl mr-4 @if(Route::is('setup.doc-categories*')) text-yellow-100 @else text-white-50 @endif"></i>
	{{__('Doc Categories') }}
</a>
<div class="divide-yellow-100 h-4"></div>

<a href="{{route('setup.model-docs.index')}}"
   class="group flex items-center px-2 py-2 text-sm leading-6 font-medium @if(!Route::is('setup.model-docs*')) text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md @else text-gray-100 hover:text-white hover:bg-gray-600 px-2 py-2 text-sm leading-6 font-medium rounded-md @endif" aria-current="page">
	<i class="fa fa-table text-xl mr-4 @if(Route::is('setup.model-docs*')) text-yellow-100 @else text-white-50 @endif"></i>
	{{__('Tables') }}
</a>