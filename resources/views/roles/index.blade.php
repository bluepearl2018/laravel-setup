@extends('setup::layouts.master')
@section('content')
	<div class="flex flex-col sm:flex sm:flex-row justify-between items-center">
		<div class="max-w-6xl">
			<x-theme-h1>{{__('List of roles available in this application')}}</x-theme-h1>
			<p class="my-2 italic">{{__('The roles in this table are the default roles, the one injected at configuration stage. Roles added later can be trashed.') }}</p>
		</div>
		<a class="max-w-xl btn-primary" href="{{ route('setup.roles.create') }}">
			<i class="fa fa-plus mr-2"></i>{{__('Create')}}
		</a>
	</div>
	<div class="content-panel">
		<div class="table w-full flex-col flex">
			<div class="hidden lg:visible w-full">
				<div class="table-cell sm:w-5/12">
					<h2>{{__('Role')}}</h2>
				</div>
				<div class="table-cell sm:w-5/12">
					<h2>{{__('Intended to')}}</h2>
				</div>
				<div class="table-cell sm:w-5/12 sr-only">
					{{__('Select')}}
				</div>
			</div>
			@forelse(\Eutranet\Setup\Models\Role::all() as $key => $role)
				<div class="flex flex-col lg:table-row lg:flex-row w-full mb-4">
					<div class="table-cell sm:w-5/12">
						<h2 class="text-xl sm:text-base">
							{{ Str::title(Str::replace('-', ' ', $role->name)) }}
						</h2>
					</div>
					<div class="table-cell sm:w-5/12">
						{{ \Eutranet\Setup\Models\Guard::where('slug', $role->guard_name)->first()?->name }}
						{{__('Roles')}}
					</div>
					<div class="table-cell sm:w-5/12 flex flex-row justify-content-around">
						<a class="inline-flex" href="{{route('setup.roles.show', $role) }}">
							<i class="fa fa-eye"></i>
						</a>
						<a class="inline-flex" href="{{route('setup.roles.edit', $role) }}">
							<i class="fa fa-edit"></i>
						</a>
						@if($role->id > 11)
							<form class="inline-flex" action="{{route('setup.roles.destroy', $role)}}" method="post">
								@csrf
								@method('DELETE')
								<button class="btn-primary bg-red-500 m-0 px-1" type="submit" href="{{route('setup.roles.edit', $role) }}">
									<i class="fa fa-trash"></i>
								</button>
							</form>
						@endif
					</div>
				</div>
			@empty
				<tr>
					<td class="w-12/12">
						{{ __('EMPTY') }}
					</td>
				</tr>
			@endforelse
		</div>
	</div>
@endsection
