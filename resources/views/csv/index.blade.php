@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background: gray; color:#f1f7fa; font-weight:bold;">
                    Laravel 10 Import Large CSV File Using Queue- Laravelia
                </div>
                 <div class="card-body">                    
                    <form class="w-px-500 p-3 p-md-3" action="{{ route('store') }}" method="post" enctype="multipart/form-data"> Queue
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">CSV</label>
                            <div class="col-sm-9">
                              <input type="file" class="form-control" name="csv">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success btn-block">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection