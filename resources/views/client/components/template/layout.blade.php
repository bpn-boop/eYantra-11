<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Eyantra — Genuine Bike Parts & Accessories. Fast delivery, authentic parts, expert support.">
    <title>{{ $title }} | Eyantra Bike Parts</title>

    {{-- Fonts: Barlow Condensed (headings) + DM Sans (body) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap (grid only) --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">

    {{-- Eyantra Design System --}}
    <link rel="stylesheet" href="{{ asset('client/eyantra.css') }}">

    {{-- Per-page / per-component CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/toastify/toastify.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.svg') }}">

    @stack('css')

    <style>
        /* Toastify dark override */
        .toastify {
            font-family: 'DM Sans', sans-serif !important;
            border-radius: 6px !important;
        }
    </style>
</head>
<body>

{{ $slot }}

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/vendors/toastify/toastify.js') }}"></script>

@if(session('success'))
    <script>
        Toastify({
            text: "{{session('success')}}",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#4CAF50",
            stopOnFocus: true,
        }).showToast();
    </script>
@endif

@if(session('failed'))
    <script>
        Toastify({
            text: "{{session('failed')}}",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#F44336",
            stopOnFocus: true,
        }).showToast();
    </script>
@endif

@stack('js')
</body>
</html>