@extends('theme::setup.master')
@section('content')
	<div class="col-span-full">
		<h1 class="text-3xl mb-2 border-l-4 pl-2 border-yellow-500">Staff / Collaborateurs / Personnel</h1>
		<table class="table w-full">
			@foreach(Eutranet\Setup\Models\Staff::all() as $staff)
				<tr>
					<td><strong>{{$staff->name}}</strong></td>
					<td>{{ $staff->login }}</td>
					<td>{{ $staff->phone ?? 'NO PHONE ASSIGNED' }}</td>
					<td>{{ $staff->agency->name ?? 'NO AGENCY ASSIGNED' }}</td>
					<td>
						<a href="{{route('setup.staffs.show', $staff)}}">
							<i class="fa fa-user-cog"></i>
						</a>
					</td>
				</tr>
			@endforeach
		</table>
	</div>
@endsection
