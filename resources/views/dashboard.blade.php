@extends('setup::layouts.master')
@section('content')
	<x-theme-h1 class="mb-1">{{__('Administration dashboard')}}</x-theme-h1>
	<p class="mb-2 leading-relaxed text-lg max-w-2xl">
		{{ __('The administration dashboard is intended to perform specific setup and maintenance taskds. No staff member or user should access it.')  }}
	</p>
	<div class="columns-3 gap-4 my-4 space-y-8">
		{{--Laravel Init--}}
		<div class="col break-inside-avoid bg-gray-100">
			<x-theme-h2><i class="fa fa-cube text-gray-500 text-md mr-2"></i>{{ __('Laravel Init') }}</x-theme-h2>
			<p class="mb-2 italic">
				{{ config('eutranet-init.description') }}
			</p>
			<a href="{{ route('setup.init.config') }}" class="bg-red-500 text-gray-100 p-1 px-2 font-bold">Overview</a>
			@isset($modelDocs)
				@forelse($modelDocs->where('namespace', 'App\Models\Commons') as $modelDoc)
					<a href="{{ route('setup.model-docs.show', $modelDoc) }}">{{ $modelDoc->name }}</a>
					@if(!$loop->last) &middot; @endif
				@empty
				@endforelse
			@else
				{{__('No App classes') }}
			@endisset
		</div>
		{{--Laravel Theme--}}
		<div class="col break-inside-avoid bg-gray-100">
			<x-theme-h2><i class="fa fa-cube text-gray-500 text-md mr-2"></i>{{ __('Laravel Theme') }}</x-theme-h2>
			<p class="mb-2 italic">
				{{ config('eutranet-theme.description') }}
			</p>
			<a href="{{ route('setup.theme.config') }}" class="bg-red-500 text-gray-100 p-1 px-2 font-bold">Overview</a>
			@isset($modelDocs)
				@forelse($modelDocs->where('namespace', 'Eutranet\Theme\Models') as $modelDoc)
					<a href="{{ route('setup.model-docs.show', $modelDoc) }}">{{ $modelDoc->name }}</a>
					@if(!$loop->last) &middot; @endif
				@empty
				@endforelse
			@else
				{{__('No App classes') }}
			@endisset
		</div>
		{{--Laravel Commons--}}
		<div class="col break-inside-avoid bg-gray-100">
			<x-theme-h2><i class="fa fa-cube text-gray-500 text-md mr-2"></i>{{ __('Laravel Commons') }}</x-theme-h2>
			<p class="mb-2 italic">
				{{ config('eutranet-commons.description') }}
			</p>
			<a href="{{ route('setup.commons.config') }}" class="bg-red-500 text-gray-100 p-1 px-2 font-bold">Overview</a>
			@isset($modelDocs)
				@forelse($modelDocs->where('namespace', 'Eutranet\Commons\Models') as $modelDoc)
					<a href="{{ route('setup.model-docs.show', $modelDoc) }}">{{ $modelDoc->name }}</a>
					@if(!$loop->last) &middot; @endif
				@empty
				@endforelse
			@else
				{{__('No App classes') }}
			@endisset
		</div>
		{{--Laravel Setup--}}
		<div class="col break-inside-avoid bg-gray-100">
			<x-theme-h2><i class="fa fa-cube text-gray-500 text-md mr-2"></i>{{ __('Laravel Setup') }}</x-theme-h2>
			<p class="mb-2 italic">
				{{ config('eutranet-setup.description') }}
			</p>
			<a href="{{ route('setup.setup.config') }}" class="bg-red-500 text-gray-100 p-1 px-2 font-bold">Overview</a>
			@isset($modelDocs)
				@forelse($modelDocs->where('namespace', 'Eutranet\Setup\Models') as $modelDoc)
					<a href="{{ route('setup.model-docs.show', $modelDoc) }}">{{ $modelDoc->name }}</a>
					@if(!$loop->last) &middot; @endif
				@empty
				@endforelse
			@else
				{{__('No App classes') }}
			@endisset
		</div>
		{{--Laravel Backend--}}
		<div class="col break-inside-avoid bg-gray-100">
			<x-theme-h2><i class="fa fa-cube text-gray-500 text-md mr-2"></i>{{ __('Laravel Backend') }}</x-theme-h2>
			@if(config('eutranet-be'))
				<p class="mb-2 italic">
					{{ config('eutranet-be.description') }}
				</p>
				@if(Route::has('setup.be.config'))
					<a href="{{ route('setup.be.config') }}" class="bg-red-500 text-gray-100 p-1 px-2 font-bold">Overview</a>
				@endif
				@isset($modelDocs)
					@forelse($modelDocs->where('namespace', 'Eutranet\Corporate\Models') as $modelDoc)
						<a href="{{ route('setup.model-docs.show', $modelDoc) }}">{{ $modelDoc->name }}</a>
						@if(!$loop->last) &middot; @endif
					@empty
					@endforelse
				@else
					{{__('No App classes') }}
				@endisset
			@else
				{{__('Not installed yet')}}
			@endif
		</div>
		{{--Laravel Frontend--}}
		<div class="col break-inside-avoid bg-gray-100">
			<x-theme-h2><i class="fa fa-cube text-gray-500 text-md mr-2"></i>{{ __('Laravel Frontend') }}</x-theme-h2>
			@if(config('eutranet-frontend'))
				<p class="mb-2 italic">
					{{ config('eutranet-frontend.description') }}
				</p>
				@if(Route::has('setup.my-space.config'))
					<a href="{{ route('setup.frontend.config') }}" class="bg-red-500 text-gray-100 p-1 px-2 font-bold">Overview</a>
				@endif
				@isset($modelDocs)
					@forelse($modelDocs->where('namespace', 'Eutranet\Corporate\Models') as $modelDoc)
						<a href="{{ route('setup.model-docs.show', $modelDoc) }}">{{ $modelDoc->name }}</a>
						@if(!$loop->last) &middot; @endif
					@empty
					@endforelse
				@else
					{{__('No App classes') }}
				@endisset
			@else
				{{__('Not installed yet')}}
			@endif
		</div>
		{{--Laravel My Space--}}
		<div class="col break-inside-avoid bg-gray-100">
			<x-theme-h2><i class="fa fa-cube text-gray-500 text-md mr-2"></i>{{ __('Laravel My Space') }}</x-theme-h2>
			@if(config('eutranet-my-space'))
				<p class="mb-2 italic">
					{{ config('eutranet-my-space.description') }}
				</p>
				@if(Route::has('setup.my-space.config'))
					<a href="{{ route('setup.my-space.config') }}" class="bg-red-500 text-gray-100 p-1 px-2 font-bold">Overview</a>
				@endif
				@isset($modelDocs)
					@forelse($modelDocs->where('namespace', 'Eutranet\Corporate\Models') as $modelDoc)
						<a href="{{ route('setup.model-docs.show', $modelDoc) }}">{{ $modelDoc->name }}</a>
						@if(!$loop->last) &middot; @endif
					@empty
					@endforelse
				@else
					{{__('No App classes') }}
				@endisset
			@else
				{{__('Not installed yet')}}
			@endif
		</div>
	</div>
@endsection
