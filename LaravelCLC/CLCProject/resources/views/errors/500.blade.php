@extends('layouts.appmaster')
@section('title','Error')
<!--
Brady Berner & Pengyu Yin
CST-256
3-17-19
This assignment was completed in collaboration with Brady Berner, Pengyu Yin
-->
@section('content')
    <div class="alert alert-danger" role="alert" style="width:20%;">
        {{$exception}}
    </div>
@endsection