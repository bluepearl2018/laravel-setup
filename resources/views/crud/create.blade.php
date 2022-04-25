@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>
		<div class="flex flex-row justify-between items-center">
            <span>
                {{ __($singularTitle) }} {{ __('- Create') }}
            </span>
			<a class="btn-primary" href="{{route('setup.'.Str::plural(Str::slug($tableName)).'.index')}}">
				<i class="fa fa-list"></i>
			</a>
		</div>
	</x-theme-h1>
	<p class="mb-2 italic">{{__('Please make sure you are creating a new resource with the default language selected.')}}</p>
	<x-theme-form-validation-errors></x-theme-form-validation-errors>
	<div class="grid grid-cols-2">
		<div class="col-span-full">
			<x-theme-h2>
				{{ Str::ucfirst($defaultLanguage) }}
			</x-theme-h2>
			<p class="mb-2 italic">{{ __("Default language is the one set in config / App / locale") }}</p>
			<form id="resource-create-form" action="{{ route('setup.'.Str::plural(Str::slug($tableName)).'.store') }}" method="POST">
				@csrf
				@foreach($model::getFields() as $columnName => $specs)
					<div class="col-span-1 break-inside-avoid">
						<x-dynamic-component
								:component="'theme-form-'.$specs[0] . '-' . $specs[1]"
								:columnName="$columnName"
								:specs="$specs"
								:old="old($columnName)"
						></x-dynamic-component>
					</div>
				@endforeach
				<x-theme-form-save-buttons form="resource-create-form"></x-theme-form-save-buttons>
			</form>
		</div>
	</div>
@endsection
