@extends('layouts.app')
@section('title', __('equips.titulo.guia'))
@section('content')
<div class="equip-container mx-auto mt-6 p-4 bg-gray-100 rounded-lg">
    <x-equip :equip="$equip"
        :edadMedia="$edadMedia"
        :ultimosPartits="$ultimosPartits"
    />
</div>
@endsection
