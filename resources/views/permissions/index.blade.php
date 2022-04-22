@extends('theme::setup.master')
@section('content')
	<x-theme::h1>Permissions</x-theme::h1>
	<p class="mb-2 italic">CRUD permissions are granted to admins and super admins.
		They apply as soon as the application is booted. However, ad hoc permissions
		have to be created according the customer's needs.</p>
	@role('super-admin')
	<table class="w-full">
		<thead>
		<tr>
			<td>{{__('Permission name')}}</td>
			<td>{{__('Guard name')}}</td>
			<td class="sr-only">{{__('Select')}}</td>
		</tr>
		</thead>
		@forelse(\Eutranet\Setup\Models\Permission::all() as $permission)
			<tr>
				<td class="w-5/12">{{ $permission->name }}</td>
				<td class="w-5/12">{{ $permission->guard_name }}</td>
				<td class="w-2/12">
					<a href="{{route('setup.permissions.edit', $permission) }}">
						<i class="fa fa-edit"></i>
					</a>
				</td>
			</tr>
		@empty
			<tr>
				<td class="w-12/12">
					{{ __('EMPTY') }}
				</td>
			</tr>
		@endforelse
		@endrole
	</table>
	<x-theme::h2>Documentation</x-theme::h2>
	<p class="mb-2 italic">About roles. Roles are applicable to users and staffs. Define and manage new roles from this
		page.</p>
	<div class="p-4 bg-red-100">
		Please note default PERMISSIONS are directly seeded from the createDefaultPermissions function at
		"Permission.php" model.
	</div>
@endsection
