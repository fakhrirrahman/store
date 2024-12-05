<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, sans-serif;
        }

        body {
            background: #f3f4f6;
            color: #1f2937;
            line-height: 1.5;
        }

        .container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
        }

        .form-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #1e40af;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        input, select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .submit-btn {
            width: 100%;
            padding: 0.75rem;
            background: #1e40af;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .submit-btn:hover {
            background: #1e3a8a;
        }

        .calculated-total {
            font-size: 1.25rem;
            font-weight: 600;
            text-align: right;
            margin-top: 1rem;
            color: #1e40af;
        }

        @media (max-width: 640px) {
            .container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <form class="form-card" action="{{ route('orders.store') }}" method="POST">
            @csrf
            <h2 class="form-title">Create New Order</h2>

            <div class="form-group">
                <label for="name">Customer Name</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="product_id">Product</label>
                <select name="product_id" id="product_id" required>
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                            {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" min="1" required>
            </div>
            <div class="calculated-total">
                Total: Rp <span id="total">0</span>
            </div>

            <input type="hidden" name="price" id="price">
            <input type="hidden" name="total" id="total_input">
            <input type="hidden" name="created_by" value="{{ auth()->user()->name }}">
            <input type="hidden" name="updated_by" value="{{ auth()->user()->name }}">

            <button type="submit" class="submit-btn">Create Order</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productSelect = document.getElementById('product_id');
            const quantityInput = document.getElementById('quantity');
            const totalSpan = document.getElementById('total');
            const priceInput = document.getElementById('price');
            const totalInput = document.getElementById('total_input');

            function updateTotal() {
                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const price = selectedOption ? parseFloat(selectedOption.dataset.price) : 0;
                const quantity = parseInt(quantityInput.value) || 0;
                const total = price * quantity;

                priceInput.value = price;
                totalInput.value = total;
                totalSpan.textContent = total.toLocaleString('id-ID');
            }

            productSelect.addEventListener('change', updateTotal);
            quantityInput.addEventListener('input', updateTotal);
        });
    </script>
</body>
</html>