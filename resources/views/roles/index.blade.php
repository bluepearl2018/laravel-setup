@extends('theme::setup.master')
@section('content')
	<x-theme::h1>{{__('List of roles available in this application')}}</x-theme::h1>
	<p class="mb-2 italic">{{__('The roles in this table are injected at configuration. These are the default roles. The addition of other roles depends on the needs of the client. Plese note, authentication guards are associated with roles. Roles apply here to categories of users (administrators, staff members, laravel-frontend users...).') }}</p>
	<div class="content-panel">
		<table class="w-full">
			<thead>
			<tr>
				<td>{{__('Role')}}</td>
				<td>{{__('Guard')}}</td>
				<td class="sr-only">{{__('Select')}}</td>
			</tr>
			</thead>
			@forelse(\Eutranet\Setup\Models\Role::all() as $role)
				<tr>
					<td class="w-5/12">{{ $role->description }}</td>
					<td class="w-5/12">{{ \Eutranet\Setup\Models\Guard::where('slug', $role->guard_name)->first()->name }}</td>
					<td class="w-2/12">
						<a href="{{route('setup.roles.show', $role) }}">
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
		</table>
	</div>
@endsection
