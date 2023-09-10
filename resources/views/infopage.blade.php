@extends('layouts.app')

@php
    $baseUrl = url('/');
@endphp

@section('content')
    {{-- show a page with url that comes and congratylation with registration --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Congratulations!</h1>
                <h2>You have successfully registered!</h2>
                <h3>Your unique url is:</h3>
                {{-- <h4>{{ $userCode }}</h4> --}}
                <h4 id="url-for-user">{{ $baseUrl . '/' . $userCode }}</h4>
                <button class="copy-button btn btn-primary" data-clipboard-target="#url-for-user">Copy URL</button>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
        <script>
            var clipboard = new ClipboardJS('.copy-button');
        </script>
    @endsection
