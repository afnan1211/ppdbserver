@extends('layouts.main')

@section('content')
    <!-- Main Content -->
    <main id="main" class="container mt-5">
       @include('main.hero')
       @include('main.about')
    </main>

    <!-- Footer -->
    @include('main.footer')
@endsection
