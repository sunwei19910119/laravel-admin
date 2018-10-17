@section('title', '后台首页')
@section('content_title', '后台首页')
@section('content_title_small', 'index')
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

@endsection