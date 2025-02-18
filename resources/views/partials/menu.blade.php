<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('zones.index')" :active="request()->routeIs('dashboard')">
        {{ __('zones.title') }}
    </x-nav-link>
</div>

<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('users.index')" :active="request()->routeIs('dashboard')">
        {{ __('users.title') }}
    </x-nav-link>
</div>

<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('patients.index')" :active="request()->routeIs('dashboard')">
        {{ __('patients.title') }}
    </x-nav-link>
</div>