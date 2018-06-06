@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hi {{(Auth::user()->name)}}! Have a great day!<br/><br/>

                       <form action="{{ action('UsersController@setDept') }}" method="post">
                           My location is :
                           <select name="place" id="place">

                               @if(isEmptyOrNullString($myplace))
                               <option value="" selected>{{$myplace}}</option>
                               @endif

                               @foreach ($places as $p)
                                   <option value="{{$p->id}}">{{$p->Dname}}</option>
                               @endforeach

                           </select>

                           <input type="submit" value="Save">
                           {{csrf_field()}}
                       </form>
<br>
                        <p id="clock" class="alert-success animated flash" style="text-align: center; font-size: xx-large;"></p>

                        <script>

                            function updateClock (  ) {
                                document.getElementById("clock").innerHTML = Date();
                            }

                            setInterval(function () {
                                updateClock(  );
                            }, 1000);

                        </script>
                    <br>

                   <p style=" font-size: medium;"> Place your order below. Please note that you have to confirm your order <strong>before 10.00 a.m.</strong> Otherwise your order will not be counted.</p>
                        <br>


                        @if(!$ordered)
                    <form action="{{ action('UsersController@placeOrder') }}" method="post">
                        Today, I would like to have :
                        <select name="menu" id="menu">
                              <option value="NULL">Choose your preference</option>
                            @foreach ($menu as $m)
                                <option value="{{$m->id}}">{{$m->type}}</option>
                            @endforeach

                        </select>

                        <input type="submit" value="Place Order">
                        {{csrf_field()}}
                    </form>
                            @else

                            <div class="alert alert-success" style="text-align: center;">You have already ordered <strong>{{$selected}}</strong> today! </div>
                        <br>
                            <div class="alert alert-warning">If you change your mind, you can modify your order below <strong>before 10.00 a.m! </strong> Any changes after that time will not be reflected!</div>

                            <form action="{{ action('UsersController@changeOrder') }}" method="post">
                                I changed my mind. Let me have :
                                <select name="menu" id="menu">
                                    <option value="NULL">Choose your preference</option>
                                    @foreach ($menu as $m)
                                        <option value="{{$m->id}}">{{$m->type}}</option>
                                    @endforeach

                                </select>

                                <input type="submit" value="Edit Order">
                                {{csrf_field()}}
                            </form>

                            <div class="alert alert-danger">
                                <form action="{{ action('UsersController@cancelOrder') }}" method="post">
                                    <input type="submit" value="Cancel Order">
                                    {{csrf_field()}}
                                </form>
                            </div>


                        @endif

                        <div class="alert-warning">

                            {{$msg}}

                        </div>
                        <br>
                        <p class="alert-danger animated flash"> If you think that you have missed today's order, then please call <strong>011 544 5000</strong> immediately!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
