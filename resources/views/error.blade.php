<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-md rounded p-6 mt-8">
            <h1 class="text-2xl font-bold text-red-500">An Error Occurred</h1>
            <p class="mt-4 text-gray-700">
                {{ $exception }}
            </p>
            <a href="{{ url()->previous() }}" class="mt-6 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Go Back
            </a>
        </div>
    </div>
</body>
</html>
