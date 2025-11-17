<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title . ' | ' . config('app.name') ?? config('app.name') }}</title>

    @stack('styles')
    
</head>
<body>
    
    {{ $slot }}
    
    @stack('scripts')

    <!-- Validator JS -->
    <script src="https://unpkg.com/validator@latest/validator.min.js"></script>
</body>
</html>