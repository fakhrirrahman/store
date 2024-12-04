<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, sans-serif;
        }

        body {
            background-color: #f5f7fb;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .header h1 {
            font-size: 2.5rem;
            color: #1a237e;
            margin-bottom: 1rem;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.75rem;
        }

        .product-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2563eb;
            margin-bottom: 0.5rem;
        }

        .product-stock {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .product-meta {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-bottom: 1rem;
        }

        .add-to-cart {
            width: 100%;
            background: #2563eb;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .add-to-cart:hover {
            background: #1d4ed8;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1rem;
            }

            .header h1 {
                font-size: 2rem;
            }
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-stock {
            background-color: #e0f2fe;
            color: #0369a1;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Our Products</h1>
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
                        <span class="badge badge-stock">Stock: {{ $product->stock }}</span>
                    </div>
                    <a href="{{ route('orders') }}" class="add-to-cart">Add to Cart</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>