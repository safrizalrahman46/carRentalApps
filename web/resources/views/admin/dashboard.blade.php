@extends('admin.layouts.app')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@section('content')

<style>
    .blink {
        animation: blinker 2s linear infinite;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>

<h1>Dashboard</h1>

<!-- Existing HTML -->

{{-- <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">

</div>
<div class="row">

</div> --}}

<script>

</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection
