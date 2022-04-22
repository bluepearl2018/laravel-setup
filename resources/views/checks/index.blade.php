@extends('theme::setup.master')
@section('content')
    <x-theme::h1>
        {{__('Configuration check points')}}
    </x-theme::h1>
    <p class="mb-2 italic">{{__('A list of verification check points for a fresh installation')}}</p>
    <x-theme::h2>
        // Application
    </x-theme::h2>
    <ul>
        <li>{{__('Application - Name')}} => {{config('app.name')}}</li>
        <li>{{__('Application - Environment')}} => <strong> {{config('app.env')}}</strong></li>
        <li>{{__('Application - Debug mode is active')}} => {!! config('app.debug') === false ?: '<i class="fa fa-exclamation-triangle text-yellow-500"></i>' !!}</li>
        <li>{{__('Application - Url')}} => {!! config('app.url') !!}</li>
    </ul>
    <x-theme::h2>
        // Authentication
    </x-theme::h2>
    <ul>
        <li>
            <span>{{__('Authentication - Guards')}}</span>
            <ul class="list-decimal">
                @if(is_array(config('auth.guards')) && !empty(config('auth.guards')))
                    @foreach(config('auth.guards') as $key => $guard)
                        <li>{{$key}}</li>
                    @endforeach
                @endif
            </ul>
        </li>
    </ul>
    <x-theme::h2>
        // Cache
    </x-theme::h2>
    <ul>
        <li>{{__('Cache is provided by...')}} {{ config('cache.default') }}</li>
    </ul>
    <x-theme::h2>
        // Corporate fallback config
    </x-theme::h2>
    <ul>
        <li>{{__('Corporate - Name')}} {{ config('corporate.name') ?: 'MISSING CORPORATE NAME' }}</li>
        <li>{{__('Corporate - Full address')}} {{ config('corporate.full_address') ?: 'MISSING FULL ADRESSE' }}</li>
        <li>{{__('Corporate - Zip')}} {{ config('corporate.postal_code') ?: 'MISSING ZIP' }}</li>
        <li>{{-- Todo add more params --}} ....</li>
    </ul>
    <x-theme::h2>
        // Mailer
    </x-theme::h2>
    <ul>
        <li>'Mailer - The default mailer protocol is...' => {{config('mail.default')}}</li>
    </ul>
    <x-theme::h2>
        // Session management
    </x-theme::h2>
    <ul>
        <li>
            'Session - The session is driven by...' => {{config('session.driver')}},
        </li>
        <li>
            'Session - The session should expires on browser close' => {{config('session.expire_on_close')}},
        </li>
        <li>
            'Session - The session lifetime in minutes' => {{config('session.lifetime')}},
        </li>
    </ul>
    <x-theme::h2>
        // Media library
    </x-theme::h2>
    <ul>
        <li>
            'Media library - The maximum file size accepted by the media libray ' => {{config('media-library.max_file_size')}},
        </li>
    </ul>
    <x-theme::h2>
        // Roles and permissions
    </x-theme::h2>
    <ul>
        <li>
            'Roles and permissions - The permission model is' => {{config('permission.models.permission')}},
        </li>
        <li>
            'Roles and permissions - The role model is' => {{ config('permission.models.role')}},
        </li>
    </ul>
    <x-theme::h2>
        // Translations<br>
        // Localization retrieves translation from
    </x-theme::h2>
    <ul>
        <li>
            'Translations - The original application locale is' => <strong>{{config('app.locale')}}</strong>
        </li>
        <li>
            'Translations - The localizator retrieves special strings from following directories' => <strong>@dump(config('localizator.search.dirs'))</strong>
        </li>
        <li>
            'Translations - If a translation has not been set for a given locale, following locale will be used instead' => @dump(config('translatable.fallback')),
        </li>
        <li>
            'Translations - If a translation has not been set for a given locale and the fallback locale any other locale will be chosen instead' => @dump(config('translatable.fallback_any'))
        </li>
    </ul>
@endsection
