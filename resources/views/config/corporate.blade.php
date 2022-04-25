@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>{{ __('Corporate configuration') }}</x-theme-h1>
	<p class="mb-2 italic">{{__('Compare and adapt data so that everything be fine. Please
		note the corporate.php config file should be filled with customer data.')}}</p>
	<div class="content-panel">
		@if(class_exists('Eutranet\Be\Models\Corporate') && Eutranet\Be\Models\Corporate::find(1))

		@else
			<p><i class="fa fa-exclamation-triangle text-red-500 mr-2"></i>{{__('Eutranet\'s Backend package is not installed.')}}</p>
		@endif
	</div>

@endsection