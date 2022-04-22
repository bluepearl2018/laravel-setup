@extends('theme::setup.master')
@section('content')
    <div class="lg:columns-2">
        @forelse($admins as $admin)
            <div class="break-inside-avoid-column">
                <x-theme::h2>
                    <div class="block w-full flex flex-row justify-between">
                        <span>
                            {{$admin->name}}
                        </span>
                        @if($admin->is_super < 1)
                            <span>
                                <a href="{{ route('setup.admins.permissions.index', $admin) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </span>
                        @endif
                    </div>
                </x-theme::h2>
                <div>
                    @forelse($admin->getRoleNames() as $role)
                        {{ $role }}
                        @if(!$loop->last) , @endif
                    @empty
                        {{__('NO ROLE ASSIGNED')}}
                    @endforelse
                </div>
            </div>
        @empty

        @endforelse
    </div>
@endsection
