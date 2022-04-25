@extends('setup::layouts.master')
@section('content')
    <x-theme-h1>Administrators</x-theme-h1>
    <p class="text-lg leading-relaxed mb-4">{{ \Eutranet\Setup\Models\Admin::getClassLead() }}</p>
    <div class="flex flex-col space-y-2">
        @forelse($admins as $admin)
            <div class="break-inside-avoid-column">
                <x-theme-h2>
                    <div class="block w-full flex flex-row justify-between">
                        @if($admin->is_super)
                            <span>{{$admin->name}}</span>
                        @elseif(! $admin->is_super)
                            <span>
                                <a href="{{ route('setup.admins.show', $admin)}}">{{$admin->name}}</a>
                            </span>
                            <span>
                                <a href="{{ route('setup.admins.permissions.index', $admin) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </span>
                        @endif
                    </div>
                </x-theme-h2>
                <div class="mb-4">
                    @forelse($admin->roles as $key => $role)
                        {{ $role->description }}
                        @if(!$loop->last)<br>@endif
                    @empty
                        {{__('NO ROLE ASSIGNED')}}
                    @endforelse
                </div>
            </div>
        @empty

        @endforelse
    </div>
@endsection
