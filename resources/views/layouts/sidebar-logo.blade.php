{{--Logo--}}
<div class="flex items-center flex-shrink-0 px-6">
	@if(Route::has('setup.dashboard'))
		<a href="{{ route('setup.dashboard') }}">
			<img class="h-16 w-auto" src="{{ asset('images/logo.svg') }}"
				 alt="{{ config('eutranet-setup.name') }}"/>
		</a>
	@endif
</div>