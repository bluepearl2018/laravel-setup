@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>{{ $role['description'] }}
		({{ \Eutranet\Setup\Models\Guard::where('slug', $role->guard_name)->get()->first()?->name }})
	</x-theme-h1>
	<p class="mb-2 italic">{{__('About this role and associated permissions.')}}</p>
	<x-theme-h2>{!! __('Permissions of the <strong>'. $role->description . '</strong>.')  !!}</x-theme-h2>
	<p class="mb-2 italic">{{__('Permissions can be modified after initial installations... However, this will more than likely involve development tasks.')}}</p>
	<form id="sync-role-permissions-frm" action="{{route('setup.roles.sync-permission', [$role])}}"
		  method="post">
		@csrf
		@method('PUT')
		<x-theme-form-update-buttons form="sync-role-permissions-frm">{{__('labels.Update')}}</x-theme-form-update-buttons>
		<input type="hidden" value="{{ $role->guard_name }}" name="guard_name"/>
		<table>
			<tr>
				<td>{{__('Model')}}</td>
				<td>{{__('C')}}</td>
				<td>{{__('R')}}</td>
				<td>{{__('U')}}</td>
				<td>{{__('D')}}</td>
				<td><i class="fa fa-language"></i></td>
			</tr>
			@forelse($modelDocs as $modelDoc)
				<tr class="">
					<td>{{$modelDoc->name}}</td>
					<td>
						<input type="hidden" value="{{'create-'.$modelDoc->slug}}"/>
						<label>
							<input {!! $role->hasPermissionTo('create-'.$modelDoc->slug, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
								   type="checkbox"
								   value="{{'create-'.$modelDoc->slug}}" readonly/>
						</label>
					</td>
					<td>
						<input type="hidden" value="{{'read-'.$modelDoc->slug}}"/>
						<label>
							<input {!! $role->hasPermissionTo('read-'.$modelDoc->slug, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
								   type="checkbox"
								   value="{{'read-'.$modelDoc->slug}}" readonly/>
						</label>
					</td>
					<td>
						<input type="hidden" value="{{'update-'.$modelDoc->slug}}"/>
						<label>
							<input {!! $role->hasPermissionTo('update-'.$modelDoc->slug, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
								   type="checkbox"
								   value="{{'update-'.$modelDoc->slug}}" readonly/>
						</label>
					</td>
					<td>
						<input type="hidden" value="{{'delete-'.$modelDoc->slug}}"/>
						<label>
							<input {!! $role->hasPermissionTo('delete-'.$modelDoc->slug, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
								   type="checkbox"
								   value="{{'delete-'.$modelDoc->slug}}" readonly/>
						</label>
					</td>
					<td>
						<input type="hidden" value="{{'translate-'.$modelDoc->slug}}"/>
						<label>
							<input {!! $role->hasPermissionTo('translate-'.$modelDoc->slug, $role->guard_name) ? 'checked' : '' !!} name="permission[]"
								   type="checkbox"
								   value="{{'translate-'.$modelDoc->slug}}" readonly/>
						</label>
					</td>
				</tr>
			@empty
				{{$permissions ?? __('NOTHING_TO_SHOW') }}
			@endforelse
		</table>
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