@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>{{ $setupStep->name }}</x-theme-h1>
	<p class="mb-2 italic">{{ $setupStep->description }}</p>
	<div class='content-panel'>
		@hasrole('super-admin')
		<x-theme-form-validation-errors></x-theme-form-validation-errors>
		<div class="columns-2">
			<form id="setup-step-update-frm" action="{{route('setup.laravel-setup-steps.update', $setupStep)}}"
				  method="POST">
				@csrf
				@method('PUT')
				@foreach(\Eutranet\Setup\Models\SetupStep::getFields() as $columnName => $specs)
					<div class="col-span-1 break-inside-avoid-column">
						<x-dynamic-component :component="'theme::forms.'.$specs[0].'-'.$specs[1]"
											 :specs="$specs"
											 :old="$setupStep->$columnName"
											 columnName="{{ $columnName }}"
											 model="{{ $specs[5] ?? '' }}"></x-dynamic-component>
					</div>
				@endforeach
				<div class="mt-6 block">
					<x-theme-form-update-buttons
							form="{{ 'laravel-setup-step-update-frm' }}"></x-theme-form-update-buttons>
				</div>
			</form>
		</div>
		@endhasrole
	</div>
@endsection