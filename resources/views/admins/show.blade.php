@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>{{ $admin->name.'\'s'}} {{ __('account')}}</x-theme-h1>
	<p class="mb-4 text-lg max-w-3xl">Administration accounts are managed by a user with super-administrator privileges, which is,
		by default, the very first administrator from "admins" table.</p>
	<div class="flex flex-col space-y-4">
		<div class="col-span-1 break-inside-avoid">
			<x-theme-h2>{{__('Roles')}}</x-theme-h2>
			<div class="flex flex-col">
				@forelse($admin->roles as $role)
					<a>{{$role->description}}</a>
					@empty
				@endforelse
			</div>
			<x-theme-h2 class="mt-4">{{__('Permissions')}}</x-theme-h2>
			<p>Coming soon</p>
		</div>
	</div>
@endsection
