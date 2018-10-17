@section('title', '403')
@section('content')
<div class="title">403.</div>
<div class="title">Forbidden to access.</div>
<div><a href='{{ url('/admin/auth/logout') }}' style="font-size: 30px;text-decoration: none;font-weight:bold;">退出</a></div>
@endsection
@extends('admin.layouts.error')