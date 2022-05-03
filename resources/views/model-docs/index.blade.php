@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>{{__('Model documentation') }}</x-theme-h1>
	@foreach(\Eutranet\Init\Models\InstallStatus::all() as $is)
		<div class="flex flex-col">
			@if(! Str::startsWith($is->package_name, 'fb-'))
				@if(config('eutranet-'.$is->package_name.'.tables'))
					<x-theme-h2 class="mt-4">{{ Str::studly($is->package_name) }} package</x-theme-h2>
					@forelse(config('eutranet-'.$is->package_name.'.tables') as $table)
						<a href="{{route('setup.'. Str::slug($table) .'.index')}}">{{ Str::slug($table)}}</a>
						@empty
					@endforelse
					@else
					<x-theme-h2 class="mt-4">{{ Str::studly($is->package_name) }} package</x-theme-h2>
					<div class="flex flex-row items-center">
						<i class="fa fa-exclamation-triangle text-red-500 mr-2"></i>
						{{ __('Missing tables in config file') }}
					</div>
				@endif
			@elseif(Str::startsWith($is->package_name, 'fb-'))
				@if(config($is->package_name.'.tables'))
					<x-theme-h2 class="mt-4">{{ Str::studly($is->package_name) }} package</x-theme-h2>
					@forelse(config($is->package_name.'.tables') as $table)
						<a href="{{route('setup.'. Str::slug($table) .'.index')}}">{{ Str::slug($table)}}</a>
					@empty
					@endforelse
				@else
					<x-theme-h2 class="mt-4">{{ Str::studly($is->package_name) }} package</x-theme-h2>
					<div class="flex flex-row items-center">
						<i class="fa fa-exclamation-triangle text-red-500 mr-2"></i>
						{{ __('Missing tables in config file') }}
					</div>
				@endif
			@endif
		</div>
	@endforeach
@endsection