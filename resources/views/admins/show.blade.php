@extends('theme::setup.master')
@section('content')
	@if($admin->is_super)
		<div class="p-4 bg-amber-100 mb-6">
			{{ __('You are logged in as the super administrator') }}
		</div>
	@endif
	<x-theme::h1>{{ __('Administration account of ') . Auth::user()->name }}</x-theme::h1>
	<p class="mb-2 italic">Administration accounts are managed by a user with super-administrator privileges, which is,
		by default, the very first administrator from "admins" table.</p>
	<div class="lg:columns-2">
		<div class="col-span-1 break-inside-avoid-column">
			<x-theme::h2>{{__('Manage roles and permissions')}}</x-theme::h2>
			<a class="w-full" href="{{route('setup.roles.index')}}">{{ __('Roles') }}</a>
			<a class="w-full" href="{{route('setup.permissions.index')}}">{{ __('Permissions') }}</a>
		</div>
		<div class="col-span-1 break-inside-avoid-column">
			<x-theme::h2>{{__('Manage common resources')}}</x-theme::h2>
		</div>
	</div>
@endsection
