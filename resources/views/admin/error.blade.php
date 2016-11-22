@extends('admin.layouts.app')

@section('title', '')
@section('pageHeader', '')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        </div>
    </div>

@endsection