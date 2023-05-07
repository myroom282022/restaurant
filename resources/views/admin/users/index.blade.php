
@extends('admin.common.layout')
 
 @section('content')

   
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-10 grid-margin stretch-card flex-column">
                <h5 class="mb-2 text-titlecase mb-4">Users Details</h5>
            </div>
            <div class="col-xl-2 grid-margin stretch-card flex-column">
                <button class="mb-2 text-titlecase mb-4">Add Users</button>
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
                    <th>Email</th>
                    <th>Phone No.</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @php $id =1; @endphp
                    @foreach($data as $iteam)
                    <tr>
                    <td>{{$id}}</td>
                    <td>{{$iteam->name ?? ''}}</td>
                    <td>{{$iteam->email ?? ''}}</td>
                    <td>{{$iteam->phone_number ?? ''}}</td>
                    <td>
                        <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                            <i class="typcn typcn-edit btn-icon-append"></i>                          
                        </button>
                        <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                            <i class="typcn typcn-delete-outline btn-icon-append"></i>                          
                        </button>
                        </div>
                    </td>
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
