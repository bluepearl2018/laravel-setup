@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>Permissions</x-theme-h1>
	<p class="mb-2 italic">CRUD permissions are granted to admins and super admins.
		They apply as soon as the application is booted. However, ad hoc permissions
		have to be created according the customer's needs.</p>
	<x-theme-h2>Check, enter & submit</x-theme-h2>
	<form id="create-permissions-frm" action="{{ route('setup.permissions.store') }}" method="POST">
		@csrf
		<div class="mb-2 flex-row flex space-x-2 items-center">
			@foreach($permissionPrefixes as $prefix)
				<div class="flex flex-row space-x-2 mb-1 items-center">
					<x-theme-form-label :value="\Str::ucfirst($prefix)" :for="$prefix"></x-theme-form-label>
					<x-theme-form-input name="permissions[]" type="checkbox" :value="$prefix"></x-theme-form-input>
				</div>
			@endforeach
			<x-theme-form-input class="form-input" name="class" placeholder="slugified-singular-class"></x-theme-form-input>
		</div>
		<x-theme-button type="submit" form="create-permissions-frm">Submit</x-theme-button>
	</form>
@endsection