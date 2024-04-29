@extends('template.main')

@section('content')
    <div class="container mt-5">
        <h3 class="text-dark"><strong>Customer Profile</strong></h3>
    </div>

    <div class="container">
        <div class="card mt-3 p-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1">
                        <img src="../assets/img/avatars/5.png" class="w-px-100 h-px-100 rounded-circle" />
                    </div>

                    <div class="col-md-4 float-start" style="margin-left: 50px;">
                        <div class="mb-1">
                            <h3>Muhammad Sumbul</h3>
                        </div>

                        <div class="mb-0">
                            <label>LAST PURCHASE</label>
                            &nbsp;
                            <label class="text-success">10 days ago</label>
                        </div>

                        <div class="mt-3">
                            <label>Last Updated 10 h by Iqbal</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h5><strong>Customer Details</strong></h5>
            </div>
            <div class="card-body">
                <form action="">
                    
                </form>
            </div>
        </div>
    </div>
@endsection
