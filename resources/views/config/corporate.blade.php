@extends('theme::setup.master')
@section('content')
	<x-theme::h1>
	{{ __('Corporate configuration') }}
	</x-theme::h1>
	@if(class_exists('Eutranet\Be\Models\Corporate') && Eutranet\Be\Models\Corporate::find(1))

		@else
		<p>INSTALL LARAVEL CORPORATE</p>
	@endif
@endsection