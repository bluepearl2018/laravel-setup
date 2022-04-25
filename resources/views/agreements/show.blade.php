@extends('setup::layouts.master')
@section('content')
	{{\Eutranet\Commons\Facades\ShowFacade::display('setup', 'agreement', $agreement->id)}}
@endsection