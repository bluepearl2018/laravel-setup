@extends('theme::setup.master')
@section('content')
	<x-theme::h1>{{__('Super administration accounts')}}</x-theme::h1>
	<p class="mb-2 italic">The super admin account should be configured from the config folder. There is NO OTHER
		WAY.</p>
	<div class="lg:grid lg:grid-cols-3 gap-4">
		<div class="col-span-1 bg-gray-100 p-4">
			<x-theme::h2>{{ __('Common resources') }}</x-theme::h2>
			<p class="mb-2 italic">{{__('Most of the resources common to the application are used in drop-down lists or other types of combos useful in forms.')}}</p>
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
		@auth('admin')
			@role('admin')
			<div class="col-span-1 bg-gray-100 p-4">
				<x-theme::h2>{{ __('Admin tables') }}</x-theme::h2>
				<ul>
					<li><a href="{{route('setup.corporates.edit', 1)}}">{{__('Corporate')}}</a></li>
				</ul>
			</div>
			@endrole
		@endauth
		<div class="col-span-1 bg-gray-100 p-4">
			<x-theme::h2>{{ __('Navigation') }}</x-theme::h2>
		</div>
	</div>
@endsection
