<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="/">Product</a>
            </div>
        </nav>
        <h1>Product Details</h1>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">User Id:{{ $product->id }}</h5>
                <h5 class="card-title">Product Title:{{ $product->title }}</h5>
                <p class="card-text">Product Description:{{ $product->description }}</p>
                @if($product->image)
                    <img style="width: 200px;height:200px;border:2px solid red;" src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-fluid">
                @else
                    <p>No Image Available</p>
                @endif
               
            </div>
            <div class="button d-flex justify-content-center mb-3">
                <a href="/" class="btn btn-primary btn-sm mt-3">Back to Products</a>
            </div>
          
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
