@extends('theme::setup.master')
@section('content')
	@component('setup.model-docs.install-status', [
		'setupIsComplete' => $setupIsComplete,
		'stepIsComplete' => $stepIsComplete,
		'setupStep' => $setupStep,
		'restoreDefaultsRoute' => $restoreDefaultsRoute
	])
	@endcomponent
	<x-theme::h1>{{ __('Edit') }} {{__($modelDoc->name . ' - Model documentation') }}</x-theme::h1>
	<p class="mb-2 italic">{{__('The model documentation is basically generated automatically when the solution is installed. The information is provided by the developer, the solution architect, for documentation purposes. It is strongly recommended not to modify the information in this table.')}}</p>
	<div class="content-panel">
		<x-theme::h2>{{ $modelDoc->namespace }}</x-theme::h2>
		<p>{{__('The model is acessible under namespace ' . $modelDoc->namespace . '.')}}</p>
		<x-theme::h2 class="mt-4">{{ __('Description') }}</x-theme::h2>
		<x-theme::errors.validation-errors></x-theme::errors.validation-errors>
		<form id="edit-model-doc-description-frm" action="{{route('setup.model-docs.update', $modelDoc)}}"
			  method="post">
			@method('PUT')
			@csrf
			<x-forms.input-textarea columnName="description"
									:old="$modelDoc->description"
									specs="array('input', 'textarea', 'required', 'Description', 'Description')"></x-forms.input-textarea>
			<x-theme::forms.update-buttons form="edit-model-doc-description-frm"></x-theme::forms.update-buttons>
		</form>
		<x-theme::h2 class="mt-4">{{ __('Comment') }}</x-theme::h2>
		<x-theme::errors.validation-errors></x-theme::errors.validation-errors>
		<form id="edit-model-doc-comment-frm" action="{{route('setup.model-docs.update', $modelDoc)}}" method="post">
			@method('PUT')
			@csrf
			<x-forms.input-textarea columnName="comment"
									:old="$modelDoc->comment"
									specs="array('input', 'textarea', 'required', 'Comment', 'Comment')"></x-forms.input-textarea>
			<x-theme::forms.update-buttons form="edit-model-doc-comment-frm"></x-theme::forms.update-buttons>
		</form>
	</div>
@endsection