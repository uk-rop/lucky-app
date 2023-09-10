@extends('layouts.app')

@php
    $username = Auth::user()->username;
    $baseUrl = url('/');
@endphp

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="mb-3 col-sm-10">
                <div class="card">
                    <div class="card-header">{{ __("Hello {$username}!") }}</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="mb-3 col-sm-3">
                                <a class="btn btn-primary" href="{{ url('/generateLink') }}">Get new unique link</a>
                            </div>
                            <form class="mb-3 col-sm-3" action="{{ url('/removeAll') }}" method="POST">
                                @csrf
                                <button class="btn btn-danger mr-2" type="submit">Remove all links</button>
                            </form>
                        </div>
                        @if (!empty($code))
                            <h4 id="url-for-user">{{ $baseUrl . '/' . $code }}</h4>
                            <div class="d-flex justify-content-start align-items-center">
                                <div class="mb-3 col-sm-3">
                                    <button class="copy-button btn btn-primary" data-clipboard-target="#url-for-user">Copy
                                        URL</button>
                                </div>
                                {{-- button to remove this link --}}
                                <form class="mb-3 col-sm-3" action="{{ url($code . '/remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="code" value="{{ $code }}">
                                    <button class="btn btn-danger mr-2" type="submit">Remove this link</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mb-3 col-sm-10">
                <div class="card">
                    <div class="card-header">{{ __('Actions') }}</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center">
                            <form class="col-sm-3" action="{{ url('/random') }}" method="POST">
                                @csrf
                                <button class="btn btn-primary mr-2" type="submit">Try Your Luck</button>
                            </form>
                            {{-- history button --}}
                            <div class="col-sm-1">
                                <a class="btn btn-primary" href="{{ url('/history') }}">History</a>
                            </div>
                        </div>

                        @if (!empty($spin))
                            @if ($spin['win'] == 1)
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="alert alert-success" role="alert">
                                            {{ 'Congratulations!' }}
                                        </div>
                                        <p class="card-text">
                                            {{ 'You won: ' . $spin['prize'] . "$" }} </p>
                                    </div>
                                </div>
                            @elseif ($spin['win'] == 0)
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <p class="card-text">
                                            {{ 'You are not lucky this time' }} </p>
                                    </div>
                                </div>
                            @endif
                        @endif

                        @if (!empty($spin_history))
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Win</th>
                                        <th scope="col">Prize</th>
                                        <th scope="col">Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($spin_history as $history)
                                        <tr>
                                            <th scope="row">{{ $history['id'] }}</th>
                                            <td>{{ $history['win'] }}</td>
                                            <td>{{ $history['prize'] }}</td>
                                            <td>{{ $history['result'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                </div>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
            <script>
                var clipboard = new ClipboardJS('.copy-button');
            </script>
        @endsection
