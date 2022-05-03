@extends('setup::layouts.master')
@section('content')
	<div class="flex flex-row w-full justify-between items-center">
		<div class="flex-col flex">
			<x-theme-h1 class="text-4xl mb-1">Permissions</x-theme-h1>
			<p class="mb-2 text-lg max-w-3xl">{{ \Eutranet\Setup\Models\Permission::getClassLead() }}</p>
		</div>
		<div class="items-center">
			<a href="{{ route('setup.permissions.create') }}" class="btn btn-primary btn-sm float-right">Add permissions</a>
		</div>
	</div>
	@role('super-admin')
	<div class="content-panel">
		<div class="mt-2">
			<x-theme-auth-validation-errors></x-theme-auth-validation-errors>
		</div>
		<table class="table w-full">
			<tbody class="space-y-2">
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
									@if(\Eutranet\Setup\Models\Permission::where('name', 'list-'.$tableName)->where('guard_name', 'admin')->first() !== NULL)
										<label>
											<input {!! \Spatie\Permission\Models\Permission::where('name', 'list-'.$tableName)->where('guard_name', 'admin') ? 'checked' : '' !!} name="permission[]"
												   type="checkbox"
												   value="{{'list-'.$tableName}}"
												   readonly
												   disabled
											/>
										</label>
									@else
										<a href="{{route('setup.permissions.create-permission-from-action-name', 'list-'.$tableName)}}" class=""><i class="fa fa-bars text-gray-300"></i></a>
									@endif
								</div>
								<div class="table-cell w-1/12">
									<input type="hidden" value="{{'create-'.$tableName}}"/>
									@if(\Eutranet\Setup\Models\Permission::where('name', 'create-'.$tableName)->where('guard_name', 'admin')->first() !== NULL)
										<label>
											<input {!! \Spatie\Permission\Models\Permission::where('name', 'create-'.$tableName)->where('guard_name', 'admin') ? 'checked' : '' !!} name="permission[]"
												   type="checkbox"
												   value="{{'create-'.$tableName}}"
												   readonly
												   disabled
											/>
										</label>
									@else
										<a href="{{route('setup.permissions.create-permission-from-action-name', 'create-'.$tableName)}}" class=""><i class="fa fa-bars text-gray-300"></i></a>
									@endif
								</div>
								<div class="table-cell w-1/12">
									<input type="hidden" value="{{'read-'.$tableName}}"/>
									@if(\Eutranet\Setup\Models\Permission::where('name', 'read-'.$tableName)->where('guard_name', 'admin')->first() !== NULL)
										<label>
											<input {!! \Spatie\Permission\Models\Permission::where('name', 'read-'.$tableName)->where('guard_name', 'admin') ? 'checked' : '' !!} name="permission[]"
												   type="checkbox"
												   value="{{'read-'.$tableName}}"
												   readonly
												   disabled
											/>
										</label>
									@else
										<a href="{{route('setup.permissions.create-permission-from-action-name', 'read-'.$tableName)}}" class=""><i class="fa fa-bars text-gray-300"></i></a>
									@endif
								</div>
								<div class="table-cell w-1/12">
									<input type="hidden" value="{{'update-'.$tableName}}"/>
									@if(\Eutranet\Setup\Models\Permission::where('name', 'update-'.$tableName)->where('guard_name', 'admin')->first() !== NULL)
										<label>
											<input {!! \Spatie\Permission\Models\Permission::where('name', 'update-'.$tableName)->where('guard_name', 'admin') ? 'checked' : '' !!} name="permission[]"
												   type="checkbox"
												   value="{{'update-'.$tableName}}"
												   readonly
												   disabled
											/>
										</label>
									@else
										<a href="{{route('setup.permissions.create-permission-from-action-name', 'update-'.$tableName)}}" class=""><i class="fa fa-bars text-gray-300"></i></a>
									@endif
								</div>
								<div class="table-cell w-1/12">
									<input type="hidden" value="{{'delete-'.$tableName}}"/>
									@if(\Eutranet\Setup\Models\Permission::where('name', 'delete-'.$tableName)->where('guard_name', 'admin')->first() !== NULL)
										<label>
											<input {!! \Spatie\Permission\Models\Permission::where('name', 'delete-'.$tableName)->where('guard_name', 'admin') ? 'checked' : '' !!} name="permission[]"
												   type="checkbox"
												   value="{{'delete-'.$tableName}}"
												   readonly
												   disabled
											/>
										</label>
									@else
										<a href="{{route('setup.permissions.create-permission-from-action-name', 'delete-'.$tableName)}}" class=""><i class="fa fa-bars text-gray-300"></i></a>
									@endif
								</div>
								<div class="table-cell w-1/12">
									<input type="hidden" value="{{'delete-'.$tableName}}"/>
									@if(\Eutranet\Setup\Models\Permission::where('name', 'translate-'.$tableName)->where('guard_name', 'admin')->first() !== NULL)
										<label>
											<input {!! \Spatie\Permission\Models\Permission::where('name', 'translate-'.$tableName)->where('guard_name', 'admin') ? 'checked' : '' !!}
												   name="permission[]"
												   type="checkbox"
												   value="{{'translate-'.$tableName}}"
												   readonly
												   disabled
											/>
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
			</tbody>
		</table>
	</div>
	@endrole
@endsection
