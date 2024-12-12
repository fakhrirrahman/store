<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const profileButton = document.querySelector('.profile-button');
            const dropdown = document.querySelector('.dropdown');

            profileButton.addEventListener('click', function () {
                dropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', function (event) {
                if (!profileButton.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    </script>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-8">
        <header class="flex justify-between items-center bg-white p-4 border-b border-gray-300 rounded-lg mb-8 shadow">
            <h1 class="text-xl text-indigo-900">Our Products</h1>
            <div class="relative">
                <button
                    class="profile-button flex items-center bg-white border border-gray-300 rounded-full p-2 cursor-pointer transition duration-300 ease-in-out hover:bg-gray-200 hover:border-gray-400">
                    <img src="https://via.placeholder.com/32" alt="Profile Picture" class="w-8 h-8 rounded-full mr-2">
                    <span>John Doe</span>
                </button>
                <div
                    class="dropdown absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                    <a href="/profile" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profile</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Logout</a>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($product as $product)
            <div
                class="bg-white border border-gray-300 rounded-lg overflow-hidden shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-xl">
                <img class="w-full h-48 object-cover"
                    src="{{ $product->mediaUrls ? $product->mediaUrls[0] : 'https://via.placeholder.com/150' }}"
                    alt="{{ $product->name }}">
                <div class="p-4 text-center">
                    <h2 class="text-lg text-gray-900 mb-2">{{ $product->name }}</h2>
                    <p class="text-sm text-gray-600 mb-3">{{ $product->description }}</p>
                    <div class="text-lg font-bold text-green-600 mb-3">Rp {{ number_format($product->price, 0, ',', '.')
                        }}</div>
                    <div class="mb-4">
                        <span class="inline-block px-2 py-1 bg-gray-200 text-gray-700 rounded text-sm">Stock: {{
                            $product->stock }}</span>
                    </div>
                    <a href="{{ route('orders') }}"
                        class="inline-block px-4 py-2 bg-blue-500 text-white rounded font-bold transition duration-300 ease-in-out hover:bg-blue-600">Add
                        to Cart</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>