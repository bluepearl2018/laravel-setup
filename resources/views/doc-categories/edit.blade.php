@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>
		{{ __('Documentation by category') }}
	</x-theme-h1>
	<p class="mb-2">{{ __('We, at Eutranet, virtually document every aspect of our cms-like platform, so that everybody can use it.') }}</p>
	<div class="my-4">
		<div x-data="{ tab: 'edit' }">
			<!-- nav -->
			<nav class="flex flex-row text-lg">
				<a class="" :class="{ 'bg-gray-200 px-2 mr-2 rounded-t': tab === 'edit' }" class="px-2 mr-2" x-on:click.prevent="tab = 'edit'" href="#">
					<i class="fa fa-plus mr-2"></i>
					{{__('Edit this category')}}
				</a>
			</nav>
			<!-- content -->
			<div x-show="tab === 'edit'" class="p-4 bg-gray-200">
				<x-theme-form-validation-errors></x-theme-form-validation-errors>
				<x-theme-h2>{{ __('Edit the document category') }}</x-theme-h2>
				<p class="mb-2 italic">
					{{__('Select a parent category if needed.')}}
				</p>
				<form id="doc-category-create-frm"
					  action="{{ route('setup.doc-categories.store')}}"
					  method="POST">
					@csrf
					@method('PUT')
					@foreach(\Eutranet\Setup\Models\DocCategory::getFields() as $columnName => $specs)
						<div class="break-inside-avoid-column">
							<x-dynamic-component
									:component="'theme-form-'.$specs[0].'-'.$specs[1]"
									:specs="$specs"
									:old="$docCategory->$columnName"
									:columnName="$columnName"
							></x-dynamic-component>
						</div>
					@endforeach
					<input type="hidden" name="staff_member_id" value="{{ Auth::id() }}" />
					<div class="mt-4">
						<x-theme-form-save-buttons form="doc-category-create-frm"></x-theme-form-save-buttons>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection