
<!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
<div
		x-show="sidebarOpen"
		class="fixed inset-0 flex z-40 lg:hidden" role="dialog"
		aria-modal="true">

	<div
			x-show="sidebarOpen"
			x-transition:enter="transition-opacity ease-in duration-800"
			x-transition:enter-start="opacity-100"
			x-transition:enter-end="opacity-0"
			x-transition:leave="transition-opacity ease-out duration-800 transform"
			x-transition:leave-start="opacity-0"
			x-transition:leave-end="opacity-100"
			class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>

	<div
			x-show="sidebarOpen"
			x-transition:enter="transition ease-in duration-800"
			x-transition:enter-start="-translate-x-0"
			x-transition:enter-end="translate-x-full"
			x-transition:leave="transition ease-out duration-800"
			x-transition:leave-start="translate-x-full"
			x-transition:leave-end="-translate-x-0"
			class="relative flex-1 z-40 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white">

		<div
				x-show="sidebarOpen"
				x-transition:enter="transition ease-in duration-300 transform"
				x-transition:enter-start="opacity-100 scale-95"
				x-transition:enter-end="opacity-0 scale-100"
				x-transition:leave="transition ease-out duration-1000 transform"
				x-transition:leave-start="opacity-0 scale-100"
				x-transition:leave-end="opacity-100 scale-95"
				class="absolute z-auto top-0 right-0 -mr-12 pt-2">
			{{-- Close sidebar button --}}
			<button
					type="button"
					@click="sidebarOpen = !sidebarOpen"
					class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
				<span class="sr-only">{{__('Close sidebar')}}</span>
				<i class="fa fa-times-circle fa-2x mt-2 mr-2 text-gray-200"></i>
			</button>
		</div>

		<div class="flex-shrink-0 flex items-center px-4">
			{{-- Logo --}}
			<a href="{{ route('setup.dashboard') }}">
				<img class="h-8 w-auto" src="{{ asset('images/logo.svg') }}"
					 alt="{{ config('eutranet-corporate.name') }}"/>
			</a>
		</div>
		<div class="mt-5 flex-1 h-0 overflow-y-auto">
			<nav class="px-2">
				<div class="space-y-1">
					<a href="{{ route('setup.dashboard') }}"
					   class="@if(Route::is('setup.dashboard'))
							   bg-gray-100 text-gray-900 hover:text-gray-900 hover:bg-gray-50 bg-gray-100
							   text-gray-900 group flex items-center px-2 py-2 text-base leading-5
							   font-medium rounded-md
@else
							   text-gray-600 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-base leading-5
							   font-medium rounded-md
@endif" aria-current="page">
						<i class="fa fa-home mr-3 text-gray-400 text-xl"></i>
						<span>{{ __('Setup dashboard') }}</span>
					</a>

				</div>
			</nav>
		</div>
	</div>

	<div class="flex-shrink-0 w-14" aria-hidden="true">
		<!-- Dummy element to force sidebar to shrink to fit close icon -->
	</div>
</div>