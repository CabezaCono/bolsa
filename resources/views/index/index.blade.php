@extends("layouts.layout")
@section("content")
        @include("index.partials." . str_replace('is_', '', Auth::user()->rol))
@endsection