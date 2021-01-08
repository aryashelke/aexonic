@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('User List') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Profile Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                            @php
                                $index = 0
                            @endphp
                            @forelse($user_list as $user)
                                @php
                                    $index = $index + 1
                                @endphp
                                <tr>
                                    <td scope="row">
                                        {{ $index }}
                                    </td>
                                    <td>
                                        <img class="img-thumbnail" width="120px" height="100px" src="{{ url('documents/' . $user->profile_image) }}">
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        @if($user->status == 'A')
                                            {{ 'Active' }}
                                        @else
                                            {{ 'Inactive' }}
                                        @endif
                                    </td>
                                    <td>
                                        @guest
                                            <form action="{{ url('direct-login') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <button type="submit" class="btn btn-success">Login</button>
                                            </form>
                                        @else
                                            No action
                                        @endguest
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td scope="row" colspan="6">1</td>
                                </tr>
                            @endforelse
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
