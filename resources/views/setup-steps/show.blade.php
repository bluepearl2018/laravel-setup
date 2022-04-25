@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>{{ $setupStep->name }}</x-theme-h1>
	<p class="mb-2 italic">{{ $setupStep->description }}</p>
	@if($setupStep->console_action !== NULL)
		<x-theme-h2>{{__('Console command') }}</x-theme-h2>
		<p>{{__('If a console action is available... you can use the console command or click the button to execute the action.')}}</p>
		<form method="post" action="{{route('setup.laravel-setup-steps.run', $setupStep)}}">
			@csrf
			@if($setupStep->is_complete !== true)
				<button type="submit"
						class="btn-primary">{{ __('Execute command ') . '"' . $setupStep->console_action . '"'  }}</button>
			@else
				{{ __('Complete') }}
				<i class="fa fa-check text-green-500"></i>
			@endif
		</form>
	@else
		<x-theme-h2>{{__('No console command available') }}</x-theme-h2>
	@endif
@endsection