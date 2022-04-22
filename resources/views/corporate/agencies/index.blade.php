@extends('theme::setup.master')
@section('content')
	<x-theme::h1 class="text-3xl mb-2 border-l-4 pl-2 border-yellow-500">{{__('Agencies')}}</x-theme::h1>
	<p class="mb-2 italic">{{__('Here is the list of agencies affiliated to the main company as configured by the laravel-corporate administrator.')}}</p>
	<table class="content-panel">
		@forelse(\Eutranet\Be\Models\Agency::all() as $agency)
			<tr>
				<td>
					{!! $agency->is_active ? '<i class="fa fa-circle text-green-500 mr-2"></i>' : '<i class="fa fa-circle text-red-500 mr-2"></i>' !!}
				</td>
				<td>
					{{ $agency->code }}
				</td>
				<td>
					{{ $agency->zone }}
				</td>
				<td>
					{{ $agency->corporate ? $agency->corporate->name : __('NO CORPORATE SET') }}
				</td>
				<td>
					<a href="{{ route('setup.agencies.edit', $agency) }}"><i class="fa fa-edit"></i></a>
				</td>
			</tr>
		@empty
			{{__('NOTHING TO SHOW') }}
		@endforelse
	</table>
@endsection
