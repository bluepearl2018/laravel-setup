<div class="hidden z-40 lg:flex lg:flex-col lg:w-96 lg:fixed lg:inset-y-0
lg:border-r lg:border-gray-200 lg:pt-5 lg:pb-4 lg:bg-gray-100">
	{{--Logo--}}
	@component('theme::setup.sidebar-logo')@endcomponent
	{{-- Sidebar component, swap this element with another sidebar if you like --}}
	<div class="h-0 flex-1 flex flex-col overflow-y-auto">
		<!-- Navigation -->
		<nav class="mx-6 sm:px-0 mt-6">
			<div class="xl:order-2 relative">
				@hasSection('sidebar')
					<div class="border">
						@yield('sidebar')
					</div>
				@endif
			</div>
			<div class="px-6 space-y-4">
				@if(Route::has('setup.admins.index'))
					<div>
						<x-theme-h2>Administrators</x-theme-h2>
						<ul class="block">
							@forelse(\Eutranet\Setup\Models\Admin::whereNot('id', '1')->get() as $admin)
								<li><a href="{{ route('setup.admins.show', $admin) }}">{{$admin->name}}</a></li>
							@empty
								{{__('No administrators')}}
							@endforelse
						</ul>
					</div>
				@endif
				@if(\Eutranet\Setup\Models\StaffMember::where('is_super', TRUE)->get()->first())
					<div>
						<x-theme-h2>{{__('Human resources')}}</x-theme-h2>
						<ul class="block">
							@forelse(\Eutranet\Setup\Models\StaffMember::take(1) as $staffMember)
								<li><a href="{{ route('setup.staff-members.show', $staffMember) }}">{{$staffMember->name}}</a></li>
							@empty
								<li><i class="fa fa-info-circle text-blue-600"></i>
									{{__('Install Eutranet\'s corporate package')}}
								</li>
							@endforelse
						</ul>
					</div>
				@endif
				@if(Route::has('setup.roles.index') && Route::has('setup.permissions.index'))
					<div>
						<x-theme-h2>Roles and permissions</x-theme-h2>
						<ul class="block">
							<li><a href="{{ route('setup.roles.index') }}">{{ __('Roles') }}</li>
							<li><a href="{{ route('setup.permissions.index') }}">{{ __('Permissions') }}</li>
						</ul>
					</div>
				@endif
				@isset($setupIsComplete)
					@if($setupIsComplete)
						<div class="bg-green-50 p-4">
							{{ __('The setup process is complete') }}
						</div>
					@else
						<div class="bg-red-50 p-4">
							{{ __('The setup process is in progress') }}
						</div>
						@if(Route::has('setup.setup-steps.show'))
							@isset($setupSteps)
								@forelse($setupSteps as $setupStep)
									<a class="w-full inline-block"
									   href="{{route('setup.setup-steps.show', $setupStep)}}">{{$setupStep->name}}</a>
								@empty
								@endforelse
							@endisset
						@endif
					@endif
				@endisset
			</div>
		</nav>
	</div>
</div>