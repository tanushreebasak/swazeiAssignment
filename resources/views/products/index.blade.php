@extends('layout')

@section('content')

<div class="row text-center">
    <div class="col-md-12">
        <h1>Product List</h1>

        <div class="row">
            <div class="col-md-4">
                <form id="searchForm">
                    <input type="text" id="search" placeholder="Search products">
                    <button type="button" id="searchBtn">Search</button>
                </form>
            </div>
        </div>

        @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
        @endif
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="productTable">
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>${{ $product->price }}</td>
            <td>
                <a href="{{route('product.destroy', $product->id)}}"><button class="deleteBtn" data-id="{{ $product->id }}">Delete</button></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    $('#searchBtn').click(function() {

        var data = $('#search').val();

        $.ajax({
            url: "/search",
            type: "POST",
            data: {data: data},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {

                    const products = response.data;
                    console.log(products);
                    let rows = '';

                    products.forEach(product => {
                        rows += `
                        <tr>
                            <td>${product.id}</td>
                            <td>${product.name}</td>
                            <td>${product.description}</td>
                            <td>${product.price}</td>
                            <td>
                                <button class="deleteBtn" data-id="${product.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                    });

                    $('#productTable').html(rows);

            },
            
        })
    })

    $(document).on('click', '.deleteBtn', function() {
        const id = $(this).data('id');
        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                url: `/products/${id}`,
                type: "GET",
                success: function(response) {
                        alert('Product deleted successfully!');
                        fetchProducts();
                    
                },
            });
        }
    });
    // });
</script>

@endsection