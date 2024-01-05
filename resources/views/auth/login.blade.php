@extends("layouts.app")
@section("content")
    <div class="container" style="width: 50%">
        <div class="row">
            <div class="card d-flex justify-content-center mt-lg-8 ">
                <div class="card-header bg-gradient-dark d-flex justify-content-center">
                    Login
                </div>
                <div class="card-body d-flex justify-content-center ">
                    <form action="{{route('login.store')}}" method="post">
                        @csrf
                        <div class="mb-3 mt-3 input-group-outline input-group">
                            <span class="input-group-text"></span>
                            <input type="email" class="form-control border" id="email" name="email" placeholder="email">
                        </div>

                        <div class=" input-group  mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"></span>
                            </div>
                            <input type="password" class="form-control border" id="password" name="password" placeholder="password">

                        </div>
                        <button type="submit" class="btn bg-gradient-dark">login</button>
                    </form>
                </div>
                <div class="card-footer bg-gradient-dark">
                    <!-- Additional content in the card footer if needed -->
                </div>
            </div>
        </div>
    </div>

@endsection
