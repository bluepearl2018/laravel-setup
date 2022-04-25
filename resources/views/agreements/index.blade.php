@extends('setup::layouts.master')
@section('content')
	{{\Eutranet\Commons\Facades\ListFacade::display('setup', 'agreement', 'admin')}}
@endsection
