<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="description" content="SnapShare is the ultimate platform for capturing and sharing life's moments in an instant. Immerse yourself in a world of visual storytelling as you snap, share, and connect with friends and family. Whether it's the simple joys of everyday life or special milestones, SnapShare brings your photos to life, creating a vibrant community where memories are celebrated and cherished. Join us and turn your snapshots into unforgettable stories.">
    <meta property="og:title" content="SnapShare - Capture and Share Life's Moments">
    <meta property="og:description" content="Join SnapShare, the premier destination for capturing and sharing the beauty of life's moments. Immerse yourself in visual storytelling, connect with loved ones, and turn your snapshots into cherished memories. Snap, share, and celebrate life with SnapShare!">
    <meta property="og:image" content="{{ asset('images/logo.svg') }}">
    <meta property="og:url" content="">
    <meta property="og:type" content="website">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SnapShare')</title>
    <link rel="icon" href="{{ asset('images/logo.svg') }}">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <main class="min-h-screen">
        @yield('content')
    </main>
</body>
</html>
