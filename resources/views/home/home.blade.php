@extends("layouts.app")
@section("content")
    @include("layouts.nav")
    <main class="main-content">
        @if(session()->has('message'))
            <div class="alert @if(session('messageStatus')) alert-success @else alert-danger  @endif">
                {{session('message')}}
            </div>
        @endif
    </main>

@endsection
