@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>
		{{ $permission->name }}
	</x-theme-h1>
	<div class="container mt-4">
		{{$permission->description}}
	</div>
	<x-theme-h2>Roles that have permission to... <strong>{{Str::replace('-', ' ', Str::ucfirst($permission->name))}}</strong></x-theme-h2>
	<p class="mb-4">{{__('Each permission can be assigned to a specific role associated with a specific guard.') }}</p>

	{{-- Admins--}}
	<x-theme-h2 class="mt-4">"Admin" roles</x-theme-h2>
	<table class="w-full">
		@forelse(\Eutranet\Setup\Models\Role::where('guard_name', 'admin')->get() as $role)
			<tr>
				<td class="flex flex-row items-center space-x-1">
					<strong>{{$role->name}} </strong>
					<span>{{__('has permission to ') }}</span>
					<span>{{ Str::replace('-', ' ', $permission->name)}}</span>
				</td>
				<td class="text-right">
					@if(\Spatie\Permission\Models\Permission::where('name', $permission->name)->where('guard_name', 'admin')->first())
						@if($role->hasPermissionTo($permission->name, \Eutranet\Setup\Models\Guard::find(1)->slug))
							<div class="flex flex-row items-center space-x-2 text-right float-right">
								<div class="rounded-full bg-green-500 w-2.5 h-2.5"></div>
								<form action="{{route('setup.roles.revoke-permission-to', $role)}}" method="post">
									@csrf
									<input type="hidden" name="role_id" value="{{$role->id}}" />
									<input type="hidden" name="permission_id" value="{{\Spatie\Permission\Models\Permission::where('name', $permission->name)->where('guard_name', 'admin')->first()->id}}" />
									<button class="hover:underline">{{__('Remove')}}</button>
								</form>
							</div>
						@else
							<div class="flex flex-row items-center space-x-2 text-right float-right">
								<div class="rounded-full bg-red-500 w-2.5 h-2.5"></div>
								<form action="{{route('setup.roles.give-permission-to', $role)}}" method="post">
									@csrf
									<input type="hidden" name="role_id" value="{{$role->id}}" />
									<input type="hidden" name="permission_id" value="{{\Spatie\Permission\Models\Permission::where('name', $permission->name)->where('guard_name', 'admin')->first()->id}}" />
									<button class="hover:underline">{{__('Assign')}}</button>
								</form>
							</div>
						@endif
					@else
						<form id="create-permission-for-{{$role->guard_name}}-form" action="{{route('setup.permissions.store')}}" method="post">
							@csrf
							<input type="hidden" name="name" value="{{$permission->name}}">
							<input type="hidden" name="guard_name" value="{{$role->guard_name}}">
							<button form="create-permission-for-{{$role->guard_name}}-form" type="submit"><i class="fa fa-plus"></i></button>
						</form>
					@endif
				</td>
			</tr>
		@empty
			{{ __('NO ADMIN ROLE SET') }}
		@endforelse
	</table>

	{{-- Staffs--}}
	<x-theme-h2 class="mt-4">"Staff" roles</x-theme-h2>
	<table class="w-full">
		@forelse(\Eutranet\Setup\Models\Role::where('guard_name', 'staff')->get() as $role)
			<tr>
				<td class="flex flex-row items-center space-x-1">
					<strong>{{$role->name}} </strong>
					<span>{{__('has permission to ') }}</span>
					<span>{{ Str::replace('-', ' ', $permission->name)}}</span>
				</td>
				<td class="text-right">
					@if(\Spatie\Permission\Models\Permission::where('name', $permission->name)->where('guard_name', 'staff')->first())
						@if($role->hasPermissionTo($permission->name, \Eutranet\Setup\Models\Guard::find(2)->slug))
							<div class="flex flex-row items-center space-x-2 text-right float-right">
								<div class="rounded-full bg-green-500 w-2.5 h-2.5"></div>
								<form action="{{route('setup.roles.revoke-permission-to', $role)}}" method="post">
									@csrf
									<input type="hidden" name="role_id" value="{{$role->id}}" />
									<input type="hidden" name="permission_id" value="{{\Spatie\Permission\Models\Permission::where('name', $permission->name)->where('guard_name', 'staff')->first()->id}}" />
									<button class="hover:underline">{{__('Remove')}}</button>
								</form>
							</div>
						@else
							<div class="flex flex-row items-center space-x-2 text-right float-right">
								<div class="rounded-full bg-red-500 w-2.5 h-2.5"></div>
								<form action="{{route('setup.roles.give-permission-to', $role)}}" method="post">
									@csrf
									<input type="hidden" name="role_id" value="{{$role->id}}" />
									<input type="hidden" name="permission_id" value="{{\Spatie\Permission\Models\Permission::where('name', $permission->name)->where('guard_name', 'staff')->first()->id}}" />
									<button class="hover:underline">{{__('Assign')}}</button>
								</form>
							</div>
						@endif
					@else
						<form id="create-permission-for-{{$role->guard_name}}-form" action="{{route('setup.permissions.store')}}" method="post">
							@csrf
							<input type="hidden" name="name" value="{{$permission->name}}">
							<input type="hidden" name="guard_name" value="{{$role->guard_name}}">
							<button form="create-permission-for-{{$role->guard_name}}-form" type="submit"><i class="fa fa-plus"></i></button>
						</form>
					@endif
				</td>
			</tr>
		@empty
			{{ __('NO STAFF ROLE SET') }}
		@endforelse
	</table>

	{{-- Web--}}
	<x-theme-h2 class="mt-4">"Web" roles</x-theme-h2>
	<table class="w-full">
		@forelse(\Eutranet\Setup\Models\Role::where('guard_name', 'web')->get() as $role)
			<tr>
				<td class="flex flex-row items-center space-x-1">
					<strong>{{$role->name}} </strong>
					<span>{{__('has permission to ') }}</span>
					<span>{{ Str::replace('-', ' ', $permission->name)}}</span>
				</td>
				<td class="text-right">
					@if(\Spatie\Permission\Models\Permission::where('name', $permission->name)->where('guard_name', 'web')->first())
						@if($role->hasPermissionTo($permission->name, \Eutranet\Setup\Models\Guard::find(3)->slug))
							<div class="flex flex-row items-center space-x-2 text-right float-right">
								<div class="rounded-full bg-green-500 w-2.5 h-2.5"></div>
								<form action="{{route('setup.roles.revoke-permission-to', $role)}}" method="post">
									@csrf
									<input type="hidden" name="role_id" value="{{$role->id}}" />
									<input type="hidden" name="permission_id" value="{{\Spatie\Permission\Models\Permission::where('name', $permission->name)->where('guard_name', 'web')->first()->id}}" />
									<button class="hover:underline">{{__('Remove')}}</button>
								</form>
							</div>
						@else
							<div class="flex flex-row items-center space-x-2 text-right float-right">
								<div class="rounded-full bg-red-500 w-2.5 h-2.5"></div>
								<form action="{{route('setup.roles.give-permission-to', $role)}}" method="post">
									@csrf
									<input type="hidden" name="role_id" value="{{$role->id}}" />
									<input type="hidden" name="permission_id" value="{{\Spatie\Permission\Models\Permission::where('name', $permission->name)->where('guard_name', 'web')->first()->id}}" />
									<button class="hover:underline">{{__('Assign')}}</button>
								</form>
							</div>
						@endif
					@else
						<form id="create-permission-for-{{$role->guard_name}}-form" action="{{route('setup.permissions.store')}}" method="post">
							@csrf
							<input type="hidden" name="name" value="{{$permission->name}}">
							<input type="hidden" name="guard_name" value="{{$role->guard_name}}">
							<button form="create-permission-for-{{$role->guard_name}}-form" type="submit"><i class="fa fa-plus"></i></button>
						</form>
					@endif
				</td>
			</tr>
		@empty
			{{ __('NO WEB ROLE SET') }}
		@endforelse
	</table>

@endsection