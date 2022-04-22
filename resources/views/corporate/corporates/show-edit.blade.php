@extends('theme::setup.master')
@role('admin')
@section('content')
	<x-theme::h1>{{ __('Edit') }} - {{$corporate->name}}</x-theme::h1>
	<p class="mb-2 italic">{{__('The modification of company data is reserved for administrators, and more specifically, the "laravel-corporate" user.')}}</p>
	<div class='content-panel'>
		@hasrole('admin')
		@if(\Eutranet\Setup\Models\Admin::find(3))
			<x-theme::errors.validation-errors></x-theme::errors.validation-errors>
			<div class="columns-2">
				<form id="corporate-update-frm" action="{{route('setup.corporates.update', $corporate)}}"
					  method="POST">
					@csrf
					@method('PUT')
					@foreach(\Eutranet\Be\Models\Corporate::getFields() as $columnName => $specs)
						<div class="col-span-1 break-inside-avoid-column">
							<x-dynamic-component :component="'forms.'.$specs[0].'-'.$specs[1]"
												 :specs="$specs"
												 :old="$corporate->$columnName"
												 columnName="{{ $columnName }}"
												 model="{{ $specs[5] ?? '' }}"></x-dynamic-component>
						</div>
					@endforeach
					<div class="mt-6 block">
						<x-theme::forms.update-buttons
								form="{{ 'laravel-corporate-update-frm' }}"></x-theme::forms.update-buttons>
					</div>
				</form>
			</div>
		@else
			{{__('This should only be edited by the laravel-corporate administrator') }}
		@endif
		@endhasrole
	</div>
@endsection
@endrole
