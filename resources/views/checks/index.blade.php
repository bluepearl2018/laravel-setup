@extends('setup::layouts.master')
@section('content')
    <x-theme-h1>{{__('Configuration check points')}}</x-theme-h1>
    <p class="mb-2 italic">{{__('A list of verification check points for a fresh installation')}}</p>
    <x-theme-h2>Application</x-theme-h2>
    <ul>
        <li>{{__('Application - Name')}} => {{config('app.name')}}</li>
        <li>{{__('Application - Environment')}} => <strong> {{config('app.env')}}</strong></li>
        <li>{{__('Application - Debug mode is active')}} => {!! config('app.debug') === false ?: '<i class="fa fa-exclamation-triangle text-yellow-500"></i>' !!}</li>
        <li>{{__('Application - Url')}} => {!! config('app.url') !!}</li>
    </ul>
    <x-theme-h2 class="mt-4">{{__('Authentication')}}</x-theme-h2>
    <ul>
        <li>
            <span>{{__('Authentication - Guards')}}</span>
            <ul class="list-inside list-decimal">
                @if(is_array(config('auth.guards')) && !empty(config('auth.guards')))
                    @foreach(config('auth.guards') as $key => $guard)
                        <li>{{$key}}</li>
                    @endforeach
                @endif
            </ul>
        </li>
    </ul>
    <x-theme-h2 class="mt-4">{{__('Cache')}}</x-theme-h2>
    <ul>
        <li>{{__('Cache is provided by...')}} <strong>{{ config('cache.default') }}</strong></li>
    </ul>
    <x-theme-h2 class="mt-4">Corporate details</x-theme-h2>
    <ul>
        <li>{{__('Corporate - Name :')}} {{ config('corporate.name') ?: 'MISSING CORPORATE NAME' }}</li>
        <li>{{__('Corporate - Full address :')}} {{ config('corporate.full_address') ?: 'MISSING FULL ADRESSE' }}</li>
        <li>{{__('Corporate - Zip :')}} {{ config('corporate.postal_code') ?: 'MISSING ZIP' }}</li>
        <li>{{__('Corporate - City :')}} {{ config('corporate.city') ?: 'MISSING CITY' }}</li>
        <li>{{__('Corporate - Country :')}} {{ config('corporate.country') ?: 'MISSING COUNTRY' }}</li>
        <li>{{__('Corporate - Phone :')}} {{ config('corporate.phone') ?: 'MISSING PHONE' }}</li>
        <li>{{__('Corporate - Mobile :')}} {{ config('corporate.mobile') ?: 'MISSING MOBILE' }}</li>
        <li>{{__('Corporate - Info Email :')}} {{ config('corporate.info_email') ?: 'MISSING INFO EMAIL' }}</li>
    </ul>
    <x-theme-h2 class="mt-4">Corporate Mailer</x-theme-h2>
    <ul>
        <li>'Mailer - The default mailer protocol is...' => <strong>{{config('mail.default')}}</strong></li>
    </ul>
    <x-theme-h2 class="mt-4">Session management</x-theme-h2>
    <ul>
        <li>
            'Session - The session is driven by...' => <strong>{{config('session.driver')}}</strong>,
        </li>
        <li>
            'Session - The session should expires on browser close' => <strong>{{config('session.expire_on_close')}}</strong>,
        </li>
        <li>
            'Session - The session lifetime in minutes' => <strong>{{config('session.lifetime')}}</strong>,
        </li>
    </ul>
    <x-theme-h2 class="mt-4">Media library</x-theme-h2>
    <ul>
        <li>
            'Media library - The maximum file size accepted by the media libray ' => <strong>{{config('media-library.max_file_size')}}</strong>,
        </li>
    </ul>
    <x-theme-h2 class="mt-4">Roles and permissions</x-theme-h2>
    <ul>
        <li>
            'Roles and permissions - The permission model is' => <strong>{{config('permission.models.permission')}}</strong>,
        </li>
        <li>
            'Roles and permissions - The role model is' => <strong>{{ config('permission.models.role')}}</strong>,
        </li>
    </ul>
    <x-theme-h2 class="mt-4">Translations & Language Lines</x-theme-h2>
    <ul>
        <li>
            'Translations - The original application locale is' => <strong>{{config('app.locale')}}</strong>
        </li>
        <li>
            'Translations - The localizator retrieves special strings from following directories' => <strong> {{config('localizator.search.dirs')[0] }}</strong>
        </li>
        <li>
            'Translations - If a translation has not been set for a given locale, following locale will be used instead' => <strong>{{ config('translatable.fallback') !== NULL ? config('translatable.fallback') : 'NO TRANSLATABLE FALLBACK' }}</strong>,
        </li>
        <li>
            'Translations - If a translation has not been set for a given locale and the fallback locale any other locale will be chosen instead' => <strong>{{ config('translatable.fallback_any') !== false ? config('translatable.fallback_any') : "NO FALLBACK ANY" }}</strong>
        </li>
    </ul>
@endsection
