@extends('layouts.admin.telkom')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Product Table</h4>
                <p class="category">
                    <a href="{{route('admin.product.create')}}" class="btn btn-sm btn-primary btn-fill btn-wd">
                        <i class="ti-plus"></i> New Product
                    </a>
                </p>
            </div>

            <div class="card-content table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name (id)</th>
                            <th>Name (en)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $no=>$product)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            {{--<td>--}}{{-- <a href="{{ route('admin.product.show', $product) }}"> --}}{{--{{ $product->name }}--}}{{-- </a> --}}{{--</td>--}}
                            <td>{{ $product->translation('id')->first() ? $product->translation('id')->first()->name : '-' }}</td>
                            <td>{{ $product->translation('en')->first() ? $product->translation('en')->first()->name : '-' }}</td>
                            <td>
                                <form method="POST" action="{{route('admin.product.destroy', $product->id)}}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <a href="{!! route('admin.product.edit', [$product->id]) !!}" class='btn btn-default btn-xs' title="edit">
                                        <i class="ti-pencil"></i>
                                    </a>
                                    @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('idex'))
                                        <button type="submit" class="btn btn-danger btn-xs" title="delete" onclick="return confirm('Yakin ingin menghapus admin ini?')">
                                            <i class="ti-trash"></i>
                                        </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection