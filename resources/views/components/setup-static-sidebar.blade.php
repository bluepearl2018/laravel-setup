<!-- Static sidebar for desktop -->
<div class="hidden lg:flex lg:w-64 lg:flex-col lg:fixed lg:inset-y-0">
	<!-- Sidebar component, swap this element with another sidebar if you like -->
	<div class="flex flex-col flex-grow theme-bg overflow-y-auto">
		<div class="flex items-center flex-shrink-0 bg-gray-100">
			<x-setup-logo></x-setup-logo>
		</div>
		<nav class="mt-5 flex-1 flex flex-col overflow-y-auto" aria-label="Sidebar">
			<div class="px-2 space-y-1">
				@component('setup::layouts.navigation-items')@endcomponent
			</div>
			<div class="mt-6 pt-6">
				<div class="px-2 space-y-1">
					<a href="{{ route('setup.log') }}" class="group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-gray-300 hover:text-white hover:bg-gray-600">
						<i class="fa fa-cogs text-gray-300 text-xl mr-2 w-8"></i>
						{{ __('Settings')}}
					</a>
					<a href="{{ route('setup.mailer') }}" class="group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-gray-300 hover:text-white hover:bg-gray-600">
						<i class="fa fa-envelope text-gray-300 text-xl mr-2 w-8"></i>
						{{ __('Mailer')}}
					</a>
					<a href="{{ route('setup.new-users') }}" class="group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-gray-300 hover:text-white hover:bg-gray-600">
						<i class="fa fa-users-cog text-gray-300 text-xl mr-2 w-8"></i>
						{{ __('New users')}}
					</a>
				</div>
			</div>
		</nav>
	</div>
</div>