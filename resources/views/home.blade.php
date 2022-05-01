@extends('layout')

@section('content')
<div class="container">
    @can('Manager')
    <h1>Bạn là quản lý</h1>
    @endcan
    @can('Accountant')
    <h1>Bạn là kế toán</h1>
    @endcan
</div>
@endsection
