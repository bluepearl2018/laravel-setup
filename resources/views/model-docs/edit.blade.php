@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>{{ __('labels.Edit') }} {{__($modelDoc->name . ' - Model documentation') }}</x-theme-h1>
	<p class="mb-2 italic">{{__('The model documentation is basically generated automatically when the solution is installed. The information is provided by the developer, the solution architect, for documentation purposes. It is strongly recommended not to modify the information in this table.')}}</p>
	<div class="content-panel">
		<x-theme-h2>{{ $modelDoc->namespace }}</x-theme-h2>
		<p>{{__('The model is acessible under namespace ' . $modelDoc->namespace . '.')}}</p>
		<x-theme-h2 class="mt-4">{{ __('Description') }}</x-theme-h2>
		<x-theme-form-validation-errors></x-theme-form-validation-errors>
		<form id="edit-model-doc-description-frm" action="{{route('setup.model-docs.update', $modelDoc)}}"
			  method="post">
			@method('PUT')
			@csrf
			<x-theme-form-input-textarea columnName="description"
									:old="$modelDoc->description"
									specs="array('input', 'textarea', 'required', 'Description', 'Description')"></x-theme-form-input-textarea>
			<x-theme-form-update-buttons form="edit-model-doc-description-frm"></x-theme-form-update-buttons>
		</form>
		<x-theme-h2 class="mt-4">{{ __('Comment') }}</x-theme-h2>
		<x-theme-form-validation-errors></x-theme-form-validation-errors>
		<form id="edit-model-doc-comment-frm" action="{{route('setup.model-docs.update', $modelDoc)}}" method="post">
			@method('PUT')
			@csrf
			<x-theme-form-input-textarea columnName="comment"
									:old="$modelDoc->comment"
									specs="array('input', 'textarea', 'required', 'Comment', 'Comment')"></x-theme-form-input-textarea>
			<x-theme-form-update-buttons form="edit-model-doc-comment-frm"></x-theme-form-update-buttons>
		</form>
	</div>
@endsection