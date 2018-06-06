@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Administration Panel</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Today's Summary<br/><br/>

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

                        <br>

                        <div class="panel panel-default" id="tb">
                            <!-- Default panel contents -->
                            <div class="panel-heading">Placed Orders</div>


                            <!-- Table -->
                            <table class="table" border = 1px id="tbb">
                               <tr><th>Name</th><th>Location</th><th>Total</th></tr>
                                @foreach($summary as $s)
                                    <tr><td>{{$s->Dname}}</td><td>{{$s->type}}</td><td>{{$s->Total}}</td></tr>
                                    @endforeach
                            </table>

                        </div>
                        <button onclick="myFunction()">Print Summary</button>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function printData()
    {
        var divToPrint=document.getElementById("tbb");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }

    function myFunction() {
        window.print();
    }
</script>
@endsection
