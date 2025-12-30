
@extends('layouts.admin')

@push('title')
    My Dashboard
@endpush

@section('content')
<main class="page-content">

    @push('breadcumb')
        Dashboard
    @endpush
    @include('components.admin.breadcumb')



</main>
@endsection
