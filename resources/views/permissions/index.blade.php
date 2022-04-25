@extends('setup::layouts.master')
@section('content')
	<x-theme-h1 class="text-4xl mb-1">Permissions</x-theme-h1>
	<p class="mb-2 text-lg max-w-3xl">CRUD permissions are granted to admins and super admins.
		They apply as soon as the application is booted. However, ad hoc permissions
		have to be created according the customer's needs.</p>
	@role('super-admin')
	<div class="bg-light p-4 rounded">
		<h2>Permissions</h2>
		<div class="lead">
			Manage your permissions here.
			<a href="{{ route('setup.permissions.create') }}" class="btn btn-primary btn-sm float-right">Add permissions</a>
		</div>
		<div class="mt-2">
			<x-theme-auth-validation-errors></x-theme-auth-validation-errors>
		</div>
		<table class="table w-full">
			<thead>
				<tr class="text-left">
					<th scope="col" style="width: 25%">Name</th>
					<th scope="col" style="width: 10%">Guard</th>
					<th scope="col" colspan="2"></th>
				</tr>
			</thead>
			<tbody class="space-y-2">
				@forelse($permissions as $permission)
					<tr>
						<td><a href="{{ route('setup.permissions.show', $permission) }}">{{ $permission->name }}</a></td>
						<td>{{ $permission->guard_name }}</td>
						<td style="width: 10%">
							<a href="{{ route('setup.permissions.edit', $permission) }}"
							   class="bg-blue-300 p-1 rounded-lg">
								<i class="fa fa-edit mr-2"></i>{{__('Edit')}}
							</a>
						</td>
						<td>
							<form id="permission-delete-frm-{{$loop->index}}" method="post" action="{{ route('setup.permissions.destroy', $permission->id) }}">
								@csrf
								@method('DELETE')
								<button type="submit" form="permission-delete-frm-{{$loop->index}}">
									{{__('Delete')}}
								</button>
							</form>
						</td>
					</tr>
				@empty
				@endforelse
			</tbody>
		</table>
	</div>
	@endrole
@endsection
