<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f9fafb;
            color: #374151;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 1.5rem;
            color: #1a237e;
        }

        .profile-menu {
            position: relative;
        }

        .profile-button {
            display: flex;
            align-items: center;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 9999px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .profile-button:hover {
            background-color: #f3f4f6;
            border-color: #d1d5db;
        }

        .profile-button img {
            width: 32px;
            height: 32px;
            border-radius: 9999px;
            margin-right: 0.5rem;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 0.5rem);
            right: 0;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .profile-menu:hover .dropdown {
            display: block;
        }

        .dropdown a {
            display: block;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: #374151;
            transition: background-color 0.3s ease;
        }

        .dropdown a:hover {
            background-color: #f3f4f6;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .product-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .product-info {
            padding: 1rem;
            text-align: center;
        }

        .product-title {
            font-size: 1.25rem;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .product-description {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.75rem;
        }

        .product-price {
            font-size: 1rem;
            font-weight: bold;
            color: #059669;
            margin-bottom: 0.75rem;
        }

        .product-stock {
            margin-bottom: 1rem;
        }

        .badge-stock {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            background-color: #f3f4f6;
            color: #4b5563;
            border-radius: 0.25rem;
            font-size: 0.875rem;
        }

        .add-to-cart {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #3b82f6;
            color: #ffffff;
            border-radius: 0.25rem;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .add-to-cart:hover {
            background-color: #2563eb;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Our Products</h1>
            <div class="profile-menu">
                <button class="profile-button">
                    <img src="https://via.placeholder.com/32" alt="Profile Picture">
                    <span>John Doe</span>
                </button>
                <div class="dropdown">
                    <a href="/profile">Profile</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </div>
        </header>

        <div class="product-grid">
            @foreach($product as $product)
            <div class="product-card">
                <img class="product-image" src="{{ $product->mediaUrls ? $product->mediaUrls[0] : 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}">
                <div class="product-info">
                    <h2 class="product-title">{{ $product->name }}</h2>
                    <p class="product-description">{{ $product->description }}</p>
                    <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    <div class="product-stock">
                        <span class="badge-stock">Stock: {{ $product->stock }}</span>
                    </div>
                    <a href="{{ route('orders') }}" class="add-to-cart">Add to Cart</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>