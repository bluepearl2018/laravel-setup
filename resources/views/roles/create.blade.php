@extends('setup::layouts.master')
@section('content')
	<div class="flex flex-row justify-between items-center">
		<div>
			<x-theme-h1>{{__('Create role') }}</x-theme-h1>
			<p class="mb-2 italic"></p>
		</div>
		<div class="px-4">
			<a class="btn-primary" href="{{ route('setup.roles.index') }}">
				<i class="fa fa-list mr-2"></i>{{__('List')}}
			</a>
		</div>
	</div>
	<div>
		<form id="resource-create-role-form" action="{{ route('setup.'.Str::plural(Str::slug('roles')).'.store') }}" method="POST">
			@csrf
			@foreach(\Eutranet\Setup\Models\Role::getFields() as $columnName => $specs)
				<div class="col-span-1 break-inside-avoid">
					<x-dynamic-component
							:component="'theme-form-'.$specs[0] . '-' . $specs[1]"
							:columnName="$columnName"
							:specs="$specs"
							:old="old($columnName)"
					></x-dynamic-component>
				</div>
			@endforeach
			<x-theme-form-save-buttons form="resource-create-role-form"></x-theme-form-save-buttons>
		</form>
	</div>
@endsection