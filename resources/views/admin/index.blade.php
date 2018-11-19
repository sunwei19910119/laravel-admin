@section('title', '首页')
@section('content_title', '首页')
@section('content_title_small', '')
@extends('admin.layouts.admin')
@section('content')
    @if (Session::has('msg'))
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('msg') }}
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('danger'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('danger') }}
        </div>
    @endif
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped">

                @foreach($envs as $env)
                    <tr>
                        <td width="120px">{{ $env['name'] }}</td>
                        <td>{{ $env['value'] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
@endsection