@extends('theme::setup.master')
@section('content')
	<x-theme::h1 class="text-3xl mb-2 border-l-4 pl-2 border-yellow-500">
		{{__('Staff account')}} : {{ $staff->name }}
	</x-theme::h1>
	<p class="mb-2 italic">
		{{__('This is where you manage the settings for YOUR user account on the platform, within the privileges granted by the super administrator.')}}
	</p>
	<x-theme::errors.validation-errors></x-theme::errors.validation-errors>
	<x-theme::h2 class="mt-4">{{__('My account data')}}</x-theme::h2>
	<div class="lg:columns-2">
		<form id="staff-account-fields-frm" action="{{route('setup.staffs.update', $staff)}}" method="POST">
			@csrf
			@method('PUT')
			@foreach(Eutranet\Setup\Models\Staff::getFields() as $columnName => $specs)
				<div class="col-span-1">
					<x-dynamic-component :component="'forms.'.$specs[0].'-'.$specs[1]"
										 :specs="$specs"
										 :old="$staff->$columnName"
										 columnName="{{ $columnName }}"
										 model="{{ $specs[5] ?? '' }}"></x-dynamic-component>
				</div>
			@endforeach
			<div class="mt-6 block">
				<x-theme::forms.update-buttons
						form="{{ 'staff-account-fields-frm' }}"></x-theme::forms.update-buttons>
			</div>
		</form>
	</div>
@endsection
