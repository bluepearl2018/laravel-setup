<div class="w-full grid grid-cols-3 mb-6 border-gray-500 border-dashed border bg-gray-100">
	<div class="items-center text-center">
		@isset($setupIsComplete)
			{!! $setupIsComplete ? '<i class="fa fa-cogs text-green-500"></i>':'<i class="fa fa-cogs text-red-500"></i>' !!}
		@endisset
	</div>
	<div class="items-center text-center">
		@isset($stepIsComplete)
			@if($stepIsComplete === false)
				<form id="set-step-complete-frm"
					  action="{{route('setup.laravel-setup-steps.set-complete', $setupStep) }}"
					  method="POST">
					@csrf
					<button class="btn-primary" form="set-step-complete-frm"
							type="submit">{{ __('Set complete') }}</button>
				</form>
			@elseif($stepIsComplete === true)
				<form id="reload-defaults-frm" action="{{route($restoreDefaultsRoute, $setupStep) }}"
					  method="POST">
					@csrf
					<button class="btn-primary" form="reload-defaults-frm"
							type="submit">{{ __('Reload defaults') }}</button>
				</form>
			@endif
		@endisset
	</div>
</div>