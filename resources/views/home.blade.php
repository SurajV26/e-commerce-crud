@extends('customer_names.layout')
<style>
    .box {
        background-color: #ffffff56;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 30px;
        text-align: center;
        width: 100%;
        max-width: 100%;
        position: relative;
        top: 100px;
    }
</style>

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 50vh;">
    <div class="row justify-content-center">
        <div>
            <div class="box-wrapper">
                <div class="box">
                    <div class="card-header" style="font-size: 24px; font-weight: bold; color:rgb(195, 6, 6)">Welcome</div><hr>

                    <div class="card-body" style="font-size: 26px;">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
