@extends('setup::layouts.master')
@section('content')
    <x-theme-h1>
        <div class="flex flex-row justify-between items-center">
            <span>
                {{ __($pluralTitle) }} {{ __('- List') }}
            </span>
            <a class="btn-primary" href="{{route('setup.'.Str::slug($tableName).'.create')}}">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </x-theme-h1>
    <p class="mb-2 italic">{{__('Click on the edit icon to access the resource.')}}</p>
    <table class="w-full">
        <thead>
        <tr>
            @foreach(collect($fields)->take(2) as $field)
                <td>{{ $field[3] }}</td>
            @endforeach
            <td></td>
        </tr>
        </thead>
        @foreach($entries as $entry)
            <tr>
                @foreach(collect($fields)->take(2) as $key => $field)
                    <td>{{ $entry->$key }}</td>
                @endforeach
                <td>
                    <a href="{{ route('setup.'.Str::plural(Str::slug($tableName)).'.show', $entry) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $entries->links() }}
@endsection
