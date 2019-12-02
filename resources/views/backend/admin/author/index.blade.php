@extends('backend.layout.app')

@section('title', 'Authors')

@push('css')

@endpush

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Author</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li>
                    <a>Authors</a>
                </li>
                <li class="active">
                    <strong>Index</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Authors <span class="badge badge-info">{{ $authors->count() }}</span></h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Posts</th>
                                    <th>Comments</th>
                                    <th>Favorite Posts</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{--@foreach($auhtors as $key => $auhtor)
                                        <tr class="gradeX">
                                            <td>{{ ++$key }}</td>
                                            <td>{{ ucfirst($auhtor->name) }}</td>
                                            <td>{{ $auhtor->slug }}</td>
                                            <td>{{ $auhtor->posts->count() }}</td>
                                            <td><img src="{{ Storage::disk('public')->url('category/'.$auhtor->image) }}" class="cus_thumbnail" alt="{{ $auhtor->name }}"></td>
                                            <td>{{ date("d-m-Y", strtotime($auhtor->created_at)) }}</td>
                                            <td>
                                                <a onclick="deleteRow({{ $auhtor->id }})" href="JavaScript:void(0)" title="Delete" class="btn btn-danger cus_btn">
                                                    <i class="fa fa-trash"></i> <strong>Delete</strong>
                                                </a>

                                                <form id="class-delete-form{{ $auhtor->id }}" method="POST" action="{{ route('admin.categories.destroy', $auhtor->id) }}" style="display: none" >
                                                    @method('DELETE')
                                                    @csrf()
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach--}}
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
