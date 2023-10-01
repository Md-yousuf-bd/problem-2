@extends('layouts.frontend.master')
@section('content')
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="container mt-5">
                <h2 class="ms-3">Url Shortner</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <form action="{{ route('generate.shorten.link.post') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="link" class="form-control" placeholder="Enter your URL">
                                @if (auth()->check())
                                        <div class="input-group-addon">
                                            <button class="btn btn-success">Generate Shorten Link</button>
                                        </div>
                                    @else
                                        <div class="input-group-addon">
                                            <a href="{{ url('/login') }}" type="button"
                                                class=" btn  btn-danger  waves-effect waves-light mb-2 me-1"
                                                class="btn  btn-danger">You need to be logged in.</a>
                                        </div>
                                    @endif

                            </div>
                            @error('link')
                             <p class="m-0 p-0 text text-danger">{{ $message }}</p>
                            @enderror
                        </form>
                    </div>
                </div>

                <table class="table teble-border">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Short Link</th>
                            <th>Link</th>
                            <th>Counting</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shortLink as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td><a href="{{ route('shorten.link', ['code' => $row->code]) }}"
                                        target="_blank">{{ route('shorten.link', ['code' => $row->code]) }}</a></td>
                                <td>{{ $row->link }}</td>
                                <td>{{ $row->click_count }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
