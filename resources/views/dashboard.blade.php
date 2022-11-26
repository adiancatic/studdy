@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $title }}</h1>
    {{ __('You are logged in!') }}
</div>
@endsection
