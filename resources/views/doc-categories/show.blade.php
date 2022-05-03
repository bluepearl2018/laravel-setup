@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>
		{{ __('Documentation by category') }}
	</x-theme-h1>
	<p class="mb-2">{{ __('We, at Eutranet, virtually document every aspect of our cms-like platform, so that everybody can use it.') }}</p>
	<div class="my-4">
		<div x-data="{ tab: 'create' }">
			<!-- nav -->
			<nav class="flex flex-row text-lg">
				<a class="" :class="{ 'bg-gray-200 px-2 mr-2 rounded-t': tab === 'create' }" class="px-2 mr-2" x-on:click.prevent="tab = 'create'" href="#">
					<i class="fa fa-plus mr-2"></i>
					{{__('About this category')}}
				</a>
			</nav>
			<!-- content -->
			<div x-show="tab === 'create'" class="p-4 bg-gray-200">
				<div class="flex flex-row items-center justify-between">
					<div>
						<x-theme-h2>{{$docCategory->title}}</x-theme-h2>
					</div>
					<div>
						<a href="{{ route('setup.doc-categories.edit', $docCategory->slug) }}" class="btn-primary"><i class="fa fa-edit"></i></a>
					</div>
				</div>
				<div class="flex flex-col divide-y divide-gray-300">
					@forelse(collect(\Eutranet\Setup\Models\DocCategory::getFields()) as $key => $field)
						<div class="align-text-top flex flex-row items-center gap-4">
							<div class="w-1/3 table-cell font-semibold bg-gray-300 px-4">
								{{ $field[3] }}
							</div>
							@if($field[0] === 'select')
								<div>{!! $field[5]::where('id', $docCategory->$key)->get()->first() ? $field[5]::where('id', $docCategory->$key)->get()->first()->name : '<i class="fa fa-times text-red-500"></i>' !!} </div>
							@else
								<div>{!! $docCategory->$key ?: '<i class="fa fa-times text-red-500"></i>' !!} </div>
							@endif
						</div>
					@empty
					@endforelse
				</div>
			</div>
		</div>
	</div>
@endsection