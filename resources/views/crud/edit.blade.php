@extends('setup::layouts.master')
@section('content')
	<div class="sm:flex sm:items-center">
		<div class="sm:flex-auto">
			<x-theme-h1>
				{{ __('Edit ') . __(Str::replace('_', ' ', Str::title(Str::snake($class)))) }} ({{ __('Details') }})
			</x-theme-h1>
			<p class="mt-2 text-md text-gray-700">{{ $lead }}</p>
		</div>
		<div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
			<a href="{{ route($routePrefix . Str::plural(Str::slug($class)) . '.index', [$class => $entry]) }}"
			   class="inline-flex items-center justify-center rounded-md border border-transparent bg-yellow-600 px-4 py-2 text-md font-medium text-white shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 sm:w-auto">
				{{ __('List '. Str::replace('_', ' ', Str::title(Str::snake(Str::Studly(\Str::plural($class)))))) }}
			</a>
		</div>
	</div>
	<div class="content-panel mt-6">
		<div class="columns-1">
			<form id="{{$class}}-update-frm" method="POST"
				  action="{{ route($routePrefix . Str::plural(Str::slug($class)) . '.update', [Str::snake(Str::Studly($class)) => $entry]) }}">
				@csrf
				@method('PUT')
				@foreach($fields as $columnName => $specs)
					<div class="col-span-1 break-inside-avoid">
						<x-dynamic-component
								:component="'theme-form-'.$specs[0] . '-' . $specs[1]"
								:columnName="$columnName"
								:specs="$specs"
								:old="old($columnName, $entry->$columnName)"
						></x-dynamic-component>
					</div>
				@endforeach
				<x-theme-form-update-buttons form="{{$class}}-update-frm"></x-theme-form-update-buttons>
			</form>
		</div>
	</div>
@endsection