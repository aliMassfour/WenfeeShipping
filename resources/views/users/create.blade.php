@extends('layouts.app')
@section("content")

    <div class="container ">
        <h1 class="text-dark">add new truck to system</h1>
        <form action="{{route("users.store")}}" method="POSt">
            @csrf
            <div class="mb-3 mt-3">
                <label for="name" class="form-label text-dark">Enter driver name</label>
                <div class="input-group">
                    <span class="input-group-text"></span>
                    <input type="text" class="form-control border-bottom text-dark" name="name"
                           id="name">
                    <br>
                    @error("name")
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label text-dark">enter driver email</label>
                <div class="input-group">
                    <span class="input-group-text"></span>
                    <input type="email" class="form-control border-bottom text-dark @error("type")  @enderror "
                           name="email" id="email">
                    <br>
                    @error("email")
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="password">enter password</label>
                <div class="input-group">
                    <span class="input-group-text"></span>
                    <input type="password" name="password" id="password" class="form-control border-bottom text-dark">
                </div>
            </div>
            <div class="mb-3">
                <label for="password-confirmation">confirm password</label>
                <div class="input-group">
                    <span class="input-group-text"></span>
                    <input type="password" name="password_confirmation" id="password-confirmation"
                           class="form-control border-bottom text-dark">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">submit</button>
        </form>
    </div>


    <script>
        $(document).ready(function () {
            console.log("ready");


            $('.form-control').click(function () {
                $(this).addClass("border-info");
            });
            $('.form-control').blur(function () {
                $(this).removeClass("border-info");
            });


        });
    </script>
@endsection
