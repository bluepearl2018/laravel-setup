@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>{{ __('Corporate configuration') }}</x-theme-h1>
	<p class="mb-2 italic">{{__('Compare and adapt data so that everything be fine. Please
		note the corporate.php config file should be filled with customer data.')}}</p>
	<div class="content-panel">
		<x-theme-h2>{{__('Fallback corporate config data')}}</x-theme-h2>
		<div class="mb-4">
			@foreach($corporate as $key => $item)
				<div class="flex flex-row">
					<div class="w-1/3">
						{{ Str::title(Str::replace('_', ' ', $key)) }}
					</div>
					<div>
						{{ $item }}
					</div>
				</div>
			@endforeach
		</div>
		@if(class_exists('Eutranet\Corporate\Models\Corporate') && Eutranet\Corporate\Models\Corporate::find(1))
			<x-theme-h2>{{__('Advanced DB Corporate data')}}</x-theme-h2>
			<div class="mb-4">
				@foreach(\Eutranet\Corporate\Models\Corporate::find(1)->getAttributes() as $key => $item)
					<div class="flex flex-row">
						<div class="w-1/3">
							{{ Str::title(Str::replace('_', ' ', $key)) }}
						</div>
						<div>
							{{ $item }}
						</div>
					</div>
				@endforeach
			</div>
		@else
			<p><i class="fa fa-exclamation-triangle text-red-500 mr-2"></i>{{__('Eutranet\'s Backend package is not installed.')}}</p>
		@endif
	</div>

@endsection