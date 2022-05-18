@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>
		{{ __('Documentation by category') }}
	</x-theme-h1>
	<p class="mb-2">{{ __('We, at Eutranet, virtually document every aspect of our cms-like platform, so that everybody can use it.') }}</p>
	<div class="my-4">
		<div x-data="{ tab: 'list' }">
			<!-- nav -->
			<nav class="flex flex-row text-lg">
				<a :class="{ 'bg-gray-200 rounded-t': tab === 'list' }" class="px-2 mr-2" x-on:click.prevent="tab = 'list'" href="#">
					<i class="fa fa-list mr-2"></i>
					{{__('List')}}
				</a>
				<a class="" :class="{ 'bg-gray-200 px-2 mr-2 rounded-t': tab === 'create' }" class="px-2 mr-2" x-on:click.prevent="tab = 'create'" href="#">
					<i class="fa fa-plus mr-2"></i>
					{{__('New')}}
				</a>
			</nav>
			<!-- content -->
			<div x-show="tab === 'list'" class="p-4 bg-gray-200">
				<div class="flex items-center">
					@forelse($docCategories as $docCategory)
						<div class="font-semibold text-lg w-1/3">{{ $docCategory->title }}</div>
						<div class="w-2/3">{!! $docCategory->lead !!}</div>
						<a href="{{route('setup.doc-categories.show', $docCategory->slug) }}" class="btn-primary"><i class="fa fa-eye"></i></a>
					@empty
						{{ __('warnings.NOTHING TO SHOW') }}
					@endforelse
				</div>
			</div>
			<div x-show="tab === 'create'" class="p-4 bg-gray-200">
				<x-theme-form-validation-errors></x-theme-form-validation-errors>
				<x-theme-h2>{{ __('Create a new document category') }}</x-theme-h2>
				<p class="mb-2 italic">
					{{__('Select a parent category if needed.')}}
				</p>
				<form id="doc-category-create-frm"
					  action="{{ route('setup.doc-categories.store')}}"
					  method="POST">
					@csrf
					@foreach(\Eutranet\Setup\Models\DocCategory::getFields() as $columnName => $specs)
						<div class="break-inside-avoid-column">
							<x-dynamic-component
									:component="'theme-form-'.$specs[0].'-'.$specs[1]"
									:specs="$specs"
									:old="old($columnName)"
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