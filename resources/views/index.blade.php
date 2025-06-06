<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-amber-50">
    <nav class="fixed top-0 left-0 w-full bg-amber-200 shadow-md z-50">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex justify-center items-center gap-6 py-4">
                <li>
                    <a href="/" class="hover:bg-amber-500 px-4 py-2 rounded hover:text-white transition">Home</a>
                </li>
                <li>
                    <a href="/brand"
                        class="hover:bg-amber-500 px-4 py-2 rounded hover:text-white transition">Brands</a>
                </li>
                <li>
                    <a href="/category"
                        class="hover:bg-amber-500 px-4 py-2 rounded hover:text-white transition">Category</a>
                </li>
                <li>
                    <a href="/product"
                        class="hover:bg-amber-500 px-4 py-2 rounded hover:text-white transition">Product</a>
                </li>
            </ul>
        </div>
    </nav>

</body>

</html>
