@extends('setup::layouts.master')
@section('content')
	<div class="flex flex-row justify-between items-center">
		<div>
			<x-theme-h1>{{ $role->description }}</x-theme-h1>
			<p class="mb-2 italic">
				{{__('Most of the roles in this application are preconfigured. Do modify roles ONLY if you know what you are doing.') }}
			</p>
		</div>
		<div class="px-4">
			<a class="btn-primary" href="{{ route('setup.roles.index') }}">
				<i class="fa fa-list mr-2"></i>{{__('List')}}
			</a>
		</div>
	</div>
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
								@if(\Eutranet\Setup\Models\Permission::where('name', 'list-'.$tableName)->where('guard_name', $role->guard_name)->first() !== NULL)
									<label>
										<input {!! $role->hasPermissionTo('list-'.$tableName, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
											   type="checkbox"
											   value="{{'list-'.$tableName}}" readonly/>
									</label>
								@else
									<a href="{{route('setup.permissions.create-permission-from-action-name', 'list-'.$tableName)}}" class=""><i class="fa fa-bars text-gray-300"></i></a>
								@endif
							</div>
							<div class="table-cell w-1/12">
								<input type="hidden" value="{{'create-'.$tableName}}"/>
								@if(\Eutranet\Setup\Models\Permission::where('name', 'create-'.$tableName)->where('guard_name', $role->guard_name)->first() !== NULL)
									<label>
										<input {!! $role->hasPermissionTo('create-'.$tableName, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
											   type="checkbox"
											   value="{{'create-'.$tableName}}" readonly/>
									</label>
								@else
									<a href="{{route('setup.permissions.create-permission-from-action-name', 'create-'.$tableName)}}" class=""><i class="fa fa-bars text-gray-300"></i></a>
								@endif
							</div>
							<div class="table-cell w-1/12">
								<input type="hidden" value="{{'read-'.$tableName}}"/>
								@if(\Eutranet\Setup\Models\Permission::where('name', 'read-'.$tableName)->where('guard_name', $role->guard_name)->first() !== NULL)
									<label>
										<input {!! $role->hasPermissionTo('read-'.$tableName, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
											   type="checkbox"
											   value="{{'read-'.$tableName}}" readonly/>
									</label>
								@else
									<a href="{{route('setup.permissions.create-permission-from-action-name', 'read-'.$tableName)}}" class=""><i class="fa fa-bars text-gray-300"></i></a>
								@endif
							</div>
							<div class="table-cell w-1/12">
								<input type="hidden" value="{{'update-'.$tableName}}"/>
								@if(\Eutranet\Setup\Models\Permission::where('name', 'update-'.$tableName)->where('guard_name', $role->guard_name)->first() !== NULL)
									<label>
										<input {!! $role->hasPermissionTo('update-'.$tableName, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
											   type="checkbox"
											   value="{{'update-'.$tableName}}" readonly/>
									</label>
								@else
									<a href="{{route('setup.permissions.create-permission-from-action-name', 'update-'.$tableName)}}" class=""><i class="fa fa-bars text-gray-300"></i></a>
								@endif
							</div>
							<div class="table-cell w-1/12">
								<input type="hidden" value="{{'delete-'.$tableName}}"/>
								@if(\Eutranet\Setup\Models\Permission::where('name', 'delete-'.$tableName)->where('guard_name', $role->guard_name)->first() !== NULL)
									<label>
										<input {!! $role->hasPermissionTo('delete-'.$tableName, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
											   type="checkbox"
											   value="{{'delete-'.$tableName}}" readonly/>
									</label>
								@else
									<a href="{{route('setup.permissions.create-permission-from-action-name', 'delete-'.$tableName)}}" class=""><i class="fa fa-bars text-gray-300"></i></a>
								@endif
							</div>
							<div class="table-cell w-1/12">
								<input type="hidden" value="{{'translate-'.$tableName}}"/>
								@if(\Eutranet\Setup\Models\Permission::where('name', 'translate-'.$tableName)->where('guard_name', $role->guard_name)->first() !== NULL)
									<label>
										<input {!! $role->hasPermissionTo('translate-'.$tableName, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
											   type="checkbox"
											   value="{{'translate-'.$tableName}}" readonly/>
									</label>
								@else
									<a href="{{route('setup.permissions.create-permission-from-action-name', 'translate-'.$tableName)}}" class=""><i class="fa fa-bars text-gray-300"></i></a>
								@endif
							</div>
						</div>
					@empty
						{{$permissions ?? __('NOTHING_TO_SHOW') }}
					@endforelse
				</div>
			@endif
		@empty
		@endforelse
		<x-theme-form-update-buttons form="sync-role-permissions-frm">{{__('labels.Update')}}</x-theme-form-update-buttons>
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