@extends('setup::layouts.master')
@section('content')
	{{\Eutranet\Commons\Facades\EditFacade::display('setup', 'agreement', $agreement->id, 'admin')}}
@endsection