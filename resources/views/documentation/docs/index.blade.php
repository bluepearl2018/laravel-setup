@extends('theme::setup.master')
@section('content')
	@component('setup::components.documentation.install-status', [
		'setupIsComplete' => $setupIsComplete,
		'stepIsComplete' => $stepIsComplete,
		'setupStep' => $setupStep,
		'restoreDefaultsRoute' => $restoreDefaultsRoute
	])
	@endcomponent

	<x-theme::h1>{{__('Model documentation') }}</x-theme::h1>
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