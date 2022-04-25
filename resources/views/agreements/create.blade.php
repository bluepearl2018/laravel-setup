@extends('setup::layouts.master')
@section('content')
	{{\Eutranet\Commons\Facades\CreateFacade::display('setup', 'agreement', 'admin')}}
@endsection