@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>Permissions</x-theme-h1>
	<p class="mb-2 italic">{{__('This form allows you to create 6 permissions for a resource used in the database. The slugified name of the table should be entered.')}}</p>

	<form id="create-permissions-frm" action="{{ route('setup.permissions.store') }}" method="POST">
		@csrf
		<div class="mb-2 grid grid-cols-3 space-x-2 items-center">
			<div class="col-span-2 columns-2">
				@foreach($permissionPrefixes as $prefix)
					<div class="flex flex-row space-x-2 mb-1 items-center">
						<x-theme-form-input name="permissions[]" type="checkbox" :value="$prefix" checked disabled="true" tabindex="-1"></x-theme-form-input>
						<x-theme-form-label :value="\Str::ucfirst($prefix)" :for="$prefix"></x-theme-form-label>
					</div>
				@endforeach
			</div>
			<div class="col-span-1">
				<x-theme-form-label class="mb-2" value="{{__('Slugified plural resource name')}}" :for="$prefix"></x-theme-form-label>
				<x-theme-form-input class="form-input" name="class" placeholder="slugified-singular-class"></x-theme-form-input>
			</div>
		</div>
		<x-theme-button type="submit" form="create-permissions-frm">Submit</x-theme-button>
	</form>
@endsection