@extends('layouts.app')

@section('title',__('public.welcome title'))

@section('links')
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
@endsection

@section('content')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md h1 ">
            @lang('public.Title')
        </div>
        <div>

        </div>
    </div>
</div>
@endsection
