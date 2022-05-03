@extends('setup::layouts.master')
@section('content')
	<x-theme-h1>Staff / Collaborateurs / Personnel</x-theme-h1>
	<p class="mb-2 text-xl">{{\Eutranet\Setup\Models\StaffMember::getClassLead()}}</p>

	<table class="table w-full">
		@foreach($staffMembers as $staffMember)
			<tr>
				<td><strong>{{$staffMember->name}}</strong></td>
				<td>{{ $staffMember->login }}</td>
				<td>{{ $staffMember->phone ?? 'NO PHONE ASSIGNED' }}</td>
				<td>
					<a href="{{route('setup.staff-members.show', $staffMember)}}">
						<i class="fa fa-user-cog"></i>
					</a>
				</td>
			</tr>
		@endforeach
		<tfoot>
			<tr>
				<td colspan="4">
					{{$staffMembers->links()}}
				</td>
			</tr>
		</tfoot>
	</table>
@endsection
