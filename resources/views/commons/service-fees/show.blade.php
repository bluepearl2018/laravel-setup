@extends('theme::setup.master')
@section('content')
	<x-theme::h1>
		<div class="flex flex-row justify-between items-center">
            <span>
                {{ __($singularTitle) }} {{ __('- Details') }}
            </span>
			<span class="space-x-2">
                <a class="btn-primary" href="{{route('setup.'.Str::slug($tableName).'.index')}}">
                    <i class="fa fa-list"></i>
                </a>
                <a class="btn-primary" href="{{route('setup.'.Str::slug($tableName).'.create')}}">
                    <i class="fa fa-plus"></i>
                </a>
            </span>
		</div>
	</x-theme::h1>
	<p class="mb-2 italic">{{__('Please note you will have to switch the language in order to edit translations.')}}</p>
	<div class="grid grid-cols-2">
		<div class="col-span-full">
			<x-theme::h2>
				{{ Str::ucfirst($defaultLanguage) }}
			</x-theme::h2>
			<p class="mb-2 italic">{{ __("Default language is the one set in config / App / locale") }}</p>
			<form id="resource-update-form"
				  action="{{ route('setup.'.Str::slug($tableName).'.update', $resource) }}"
				  method="POST">
				@csrf
				@method('PUT')
				{{-- Todo Full form in order to filter list --}}
				@foreach($model::getFields() as $columnName => $specs)
					<div class="col-span-1 break-inside-avoid">
						<x-dynamic-component :component="'forms.'.$specs[0].'-'.$specs[1]"
											 :specs="$specs"
											 :old="$resource->$columnName"
											 :columnName="$columnName">
						</x-dynamic-component>
					</div>
				@endforeach
				<x-theme::forms.update-buttons form="{{'resource-update-form'}}"></x-theme::forms.update-buttons>
			</form>
		</div>
	</div>
@endsection
