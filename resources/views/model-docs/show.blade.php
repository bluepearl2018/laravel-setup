@extends('theme::setup.master')
@section('content')
	@component('setup.model-docs.install-status', [
		'setupIsComplete' => $setupIsComplete,
		'stepIsComplete' => $stepIsComplete,
		'setupStep' => $setupStep,
		'restoreDefaultsRoute' => $restoreDefaultsRoute
	])
	@endcomponent
	<x-theme::h1>{{__($modelDoc->name . ' - Model documentation') }}</x-theme::h1>
	<p class="mb-2 italic">{{__('The model documentation is basically generated automatically when the solution is installed. The information is provided by the developer, the solution architect, for documentation purposes. It is strongly recommended not to modify the information in this table.')}}</p>
	<div class="content-panel">
		<x-theme::h2>{{ $modelDoc->namespace }}</x-theme::h2>
		<p>{{__('The model is acessible under namespace ' . $modelDoc->namespace . '.')}}</p>
		<x-theme::h2 class="mt-4">{{ __('Description') }}</x-theme::h2>
		<p>{{ $modelDoc->description }}</p>
		<x-theme::h2 class="mt-4">{{ __('Development comments') }}</x-theme::h2>
		<p>{{ $modelDoc->comment }}</p>
	</div>
@endsection