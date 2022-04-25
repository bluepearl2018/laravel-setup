@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>{{__('Edit Permission')}}</x-theme-h1>
	<div class="container mt-4">
		<form method="POST" action="{{ route('setup.permissions.update', $permission->id) }}">
			@method('patch')
			@csrf
			<div class="mb-3">
				<label for="name" class="form-label">Name</label>
				<input value="{{ $permission->name }}"
					   type="text"
					   class="form-control"
					   name="name"
					   placeholder="Name" required>

				@if ($errors->has('name'))
					<span class="text-danger text-left">{{ $errors->first('name') }}</span>
				@endif
			</div>

			<button type="submit" class="btn btn-primary">Save permission</button>
			<a href="{{ route('setup.permissions.index') }}" class="btn btn-default">Back</a>
		</form>
	</div>
@endsection