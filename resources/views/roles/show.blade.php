@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>
		{{ Str::title(Str::replace('-', ' ', $role->name)) }}
		({{ \Eutranet\Setup\Models\Guard::where('slug', $role->guard_name)->get()->first()?->name }})
	</x-theme-h1>
	<div class="mb-2 italic">
	{!! $role['description'] !!}
	</div>
	<x-theme-h2>{!! __('Permissions assigned to <strong>'. $role->name . '</strong>.')  !!}</x-theme-h2>
	<p class="italic">{{__('Permissions can be modified after installations... However, this is not recommended as it will involve development tasks. A better solution would be to create a new role. List, Create, Read, Update, Delete, Translate.')}}</p>

	<form id="sync-role-permissions-frm" action="{{route('setup.roles.sync-permission', [$role])}}"
		  method="post">
		@csrf
		@method('PUT')
		<input type="hidden" value="{{ $role->guard_name }}" name="guard_name"/>
			@forelse(\Eutranet\Init\Models\InstallStatus::all() as $is)
				@if(! empty(config('eutranet-' . $is->package_name . '.tables')))
					<div class="table w-full mt-4">
						<div class="table-row">
							<x-theme-h2 class="table-cell w-6/12">{{ Str::title($is->package_name)}}</x-theme-h2>
							<x-theme-h2 class="table-cell w-1/12">{{__('L')}}</x-theme-h2>
							<x-theme-h2 class="table-cell w-1/12">{{__('C')}}</x-theme-h2>
							<x-theme-h2 class="table-cell w-1/12">{{__('R')}}</x-theme-h2>
							<x-theme-h2 class="table-cell w-1/12">{{__('U')}}</x-theme-h2>
							<x-theme-h2 class="table-cell w-1/12">{{__('D')}}</x-theme-h2>
							<x-theme-h2 class="table-cell w-1/12"><i class="fa fa-language"></i></x-theme-h2>
						</div>
						@forelse(config('eutranet-' . $is->package_name . '.tables') as $table)
							@php($tableName = Str::slug($table))
							<div class="table-row border-gray-500 border-separate border-b-2">
								<div class="table-cell w-6/12">
									<a href="{{route('setup.'.Str::slug($table).'.index')}}">{{ Str::replace('-', ' ', Str::title($tableName)) }}</a>
								</div>
								<div class="table-cell w-1/12">
									<input type="hidden" value="{{'list-'.$tableName}}"/>
									<label>
										<input {!! $role->hasPermissionTo('list-'.$tableName, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
											   type="checkbox"
											   value="{{'list-'.$tableName}}" readonly/>
									</label>
								</div>
								<div class="table-cell w-1/12">
									<input type="hidden" value="{{'create-'.$tableName}}"/>
									<label>
										<input {!! $role->hasPermissionTo('create-'.$tableName, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
											   type="checkbox"
											   value="{{'create-'.$tableName}}" readonly/>
									</label>
								</div>
								<div class="table-cell w-1/12">
									<input type="hidden" value="{{'read-'.$tableName}}"/>
									<label>
										<input {!! $role->hasPermissionTo('read-'.$tableName, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
											   type="checkbox"
											   value="{{'read-'.$tableName}}" readonly/>
									</label>
								</div>
								<div class="table-cell w-1/12">
									<input type="hidden" value="{{'update-'.$tableName}}"/>
									<label>
										<input {!! $role->hasPermissionTo('update-'.$tableName, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
											   type="checkbox"
											   value="{{'update-'.$tableName}}" readonly/>
									</label>
								</div>
								<div class="table-cell w-1/12">
									<input type="hidden" value="{{'delete-'.$tableName}}"/>
									<label>
										<input {!! $role->hasPermissionTo('delete-'.$tableName, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
											   type="checkbox"
											   value="{{'delete-'.$tableName}}" readonly/>
									</label>
								</div>
								<div class="table-cell w-1/12">
									<input type="hidden" value="{{'translate-'.$tableName}}"/>
									<label>
										<input {!! $role->hasPermissionTo('translate-'.$tableName, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
											   type="checkbox"
											   value="{{'translate-'.$tableName}}" readonly/>
									</label>
								</div>
							</div>
						@empty
							{{$permissions ?? __('NOTHING_TO_SHOW') }}
						@endforelse
					</div>
				@endif
				@empty
			@endforelse
		<x-theme-form-update-buttons form="sync-role-permissions-frm">{{__('Update')}}</x-theme-form-update-buttons>
	</form>

@endsection
@push('bottom-scripts')
	<script>
        function submitForm(formId) {
            let theForm = document.getElementById(formId);
            if (theForm) {
                theForm.submit();
            } else {
                alert("DEBUG - could not find element " + formId);
            }
        }
	</script>
@endpush