
@extends('admin.common.layout')
 
 @section('content')

   
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-10 grid-margin stretch-card flex-column">
                <h5 class="mb-2 text-titlecase mb-4">Payment Detils</h5>
            </div>
            <div class="col-xl-2 grid-margin stretch-card flex-column">
                <!-- <button class="mb-2 text-titlecase mb-4"></button> -->
            </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="table-responsive pt-3">
                <table class="table table-striped project-orders-table">
                <thead>
                    <tr>
                    <th class="ml-5">ID</th>
                    <th>Name</th>
                    <th>translation Id</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Payment Type</th>
                    <th>brand</th>
                    <th></th>
                    <th></th>
                    
                    </tr>
                </thead>
                <tbody>
                    @php
                     $id =1;
                    @endphp
                    @foreach($data as $iteam)
                    <tr>
                    @php
                     $userDetails=App\Models\User::where('id',$iteam->user_id)->first();
                    @endphp
                    <td>{{$id}}</td>
                    <td>{{$userDetails->name ?? ''}}</td>
                    <td>{{$iteam->translation_id ?? ''}}</td>
                    <td>{{$iteam->amount ?? ''}}</td>
                    <td>{{$iteam->currency ?? ''}}</td>
                    <td>{{$iteam->payment_type ?? ''}}</td>
                    <td>{{$iteam->brand ?? ''}}</td>


                    </tr>
                    @php $id++; @endphp

                    @endforeach
                </tbody>
                </table>
            </div>
            {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
  
  @endsection
