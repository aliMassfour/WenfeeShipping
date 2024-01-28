@extends("layouts.app")
@section("content")
    @include("layouts.nav")
    <main class="main-content">
        @if(session()->has('message'))
            <div class="alert @if(session('messageStatus')) alert-success @else alert-danger  @endif">
                {{session('message')}}
            </div>
        @endif
        <div class="container ">
            <h1 class="text-dark">add new truck to system</h1>
            <form action="{{route("trucks.store")}}" method="POSt">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="serial_number" class="form-label text-dark">Enter serial number</label>
                    <div class="input-group">
                        <span class="input-group-text"></span>
                        <input type="text" class="form-control border-bottom text-dark" name="serial_number"
                               id="serial_number">
                        <br>
                        @error("serial_number")
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label text-dark">enter type of the truck</label>
                    <div class="input-group">
                        <span class="input-group-text"></span>
                        <input type="text" class="form-control border-bottom text-dark @error("type")  @enderror "
                               name="type">
                        <br>
                        @error("type")
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">submit</button>
            </form>
        </div>
    </main>

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
