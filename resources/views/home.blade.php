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

                    <form method="POST" action="{{ url('status') }}">

                        @csrf

                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        @If(auth()->user()->status == 'I')
                            <input type="hidden" name="status" value="A">
                            <div class="form-group row mb-0">
                                                                
                                <span>This user is active. To inactive click below </span>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Activate') }}
                                </button>
                            </div>
                        @else
                            <div class="form-group row mb-0">
                                <input type="hidden" name="status" value="I">
                                
                                <span>This user is inactive. To active click below </span>

                                <button type="submit" class="btn btn-danger">
                                    {{ __('Deactivate') }}
                                </button>
                            </div>
                        @endIf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
