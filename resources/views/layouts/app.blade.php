<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'LaraMon') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
    @livewireStyles
</head>

<body class="min-h-screen flex bg-white dark:bg-zinc-800">

    <livewire:laramon.sidebar />

    <div class="flex-1 flex flex-col min-h-screen">

        <livewire:laramon.navbar />

        <main class="flex-1 p-6 lg:p-8">
            {{ $slot }}
        </main>
    </div>

    @fluxScripts
    @livewireScripts
</body>

</html>