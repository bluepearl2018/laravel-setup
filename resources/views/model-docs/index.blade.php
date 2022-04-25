@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>{{__('Model documentation') }}</x-theme-h1>
	@foreach(\Eutranet\Init\Models\InstallStatus::all() as $is)
		<div class="flex flex-col">
			@if(config('eutranet-'.$is->package_name.'.tables'))
				<x-theme-h2>{{ Str::studly($is->package_name) }} package</x-theme-h2>
				@forelse(config('eutranet-'.$is->package_name.'.tables') as $table)
					<a href="{{route('setup.'. Str::slug($table) .'.index')}}">{{ Str::slug($table)}}</a>
					@empty
				@endforelse
				@else
				<x-theme-h2>{{ Str::studly($is->package_name) }} package</x-theme-h2>
				<div class="flex flex-row items-center">
					<i class="fa fa-exclamation-triangle text-red-500 mr-2"></i>
					{{ __('Missing tables in config file') }}
				</div>
			@endif
		</div>
	@endforeach
	<p class="mb-2 italic">{{__('The model documentation is basically generated automatically when the solution is installed. The information is provided by the developer, the solution architect, for documentation purposes. It is strongly recommended not to modify the information in this table.')}}</p>
	<table class="w-full">
		<tr class="bg-gray-100">
			<td>
				<strong>
					{{__('Name')}}
				</strong>
			</td>
			<td>
				<strong>
					{{__('Namespace') }}
				</strong>
			</td>
			<td>
				<span class="sr-only">{{__('View details')}}</span>
			</td>
		</tr>
		@forelse($modelDocs as $modelDoc)
			<tr>
				<td>
					{{$modelDoc->name}}
				</td>
				<td>
					{{$modelDoc->namespace}}
				</td>
				<td>
					<a href="{{route('setup.model-docs.show', $modelDoc)}}">
						<i class="fa fa-eye"></i>
					</a>
				</td>
			</tr>
		@empty
			<tr>
				<td>{{__('NOTHING TO SHOW') }}</td>
			</tr>
		@endforelse
	</table>
@endsection