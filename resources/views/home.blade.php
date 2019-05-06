@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
        <div class="container">
            <form class="form-horizontal" method="post" action="{{ route('commander')}}" >
                @csrf
             
                <input type="hidden" name="client_id" value="1">
                <button class="btn btn-primary" type="submit">commander</button>
            </form>
        </div>
    </div>
</div>
@endsection
