<div class="container mt-2">
    <!-- Navtabs Sections Start -->
    <ul class="nav nav-tabs nav-fills" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Products</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Orders</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Users</button>
        </li>
    </ul>
    <!-- Navtab section ends -->

    <!-- Page Contents Start -->
    <div class="tab-content" id="myTabContent">

        <!-- Products Section Start -->
        <div class="tab-pane fade show active mt-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <!-- Add Product Button -->
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
                + Add Product
            </button>

            <div class="row" id="product-list">
                <!-- Products will be dynamically added here -->
            </div>

            <!-- Add Product Modal -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addProductForm">
                                <div class="mb-3">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Company</label>
                                    <input type="text" class="form-control" id="company" name="company" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <input type="text" class="form-control" id="category" name="category" required>
                                </div>
                                <div class="row d-flex">
                                <div class="mb-3 col-6">
                                    <label class="form-label">Price</label>
                                    <input type="text" class="form-control" id="product_price" name="product_price" required>
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label">Discount (%)</label>
                                    <input type="text" class="form-control" id="product_discount" name="product_discount" required>
                                </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Final Price</label>
                                    <input type="text" class="form-control" id="product_final_price" name="product_final_price" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Image URL</label>
                                    <input type="File" class="form-control" id="product_image" name="product_image" required>
                                </div>
                                <button type="button" id="add_product" class="btn btn-success w-100">Add Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- Product sections ends  -->

        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">P</div>
        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">C</div>
        <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
    </div>
    <!-- Page Content Ends  -->

</div>

<!-- Script section starts -->
<script>
    $(document).ready(function(){

        // load products functions
        function load_products(){
            $.ajax({
                url: "<?php echo site_url('Admin/get_all_products')?>",
                method: "GET",
                contentType: false,
                processData: false,
                success:function(response){
                    var response = JSON.parse(response);
                    if(response.status === "success"){
                        console.log(response);
                        var products = response.data;
                        $("#product-list").empty();
                        if(products.length !== 0){
                            $.each(products, function (index, product) {
                                let productCard = `
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <img src="<?php echo base_url('/');?>${product.product_image}" class="card-img-top" alt="Product Image" width="100">
                                            <div class="card-body">
                                                <h5 class="card-title">${product.product_name}</h5>
                                                <p class="card-text">Price: $${product.product_price}</p>
                                                <button class="btn btn-warning btn-sm edit-product" data-index="${product.id}">Edit</button>
                                                <button class="btn btn-danger btn-sm delete-product" data-index="${product.id}">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                $("#product-list").append(productCard);
                            });
                        }
                    }else{
                        console.log("No records");
                        $("#product-list").empty();
                    }
                    
                },
                error:function(xhr,status,error){
                    console.log(error);
                }
            })
        }

        load_products();

        // Add Proudct form validation
        $("#addProductForm").validate({
            rules: {
                product_name: {
                    required: true
                },
                company: {
                    required: true
                },
                category: {
                    required: true
                },
                product_price: {
                    required: true,
                    number: true,  
                    min: 1  
                },
                product_discount: {
                    required: true,
                    number: true,  
                    min: 1  
                },
                product_final_price: {
                    required: true,
                    number: true,  
                    min: 1  
                },
                product_image: {
                    required: true,
                }
            },
            messages: {
                product_name: {
                    required: "Enter Product Name",
                },
                company: {
                    required: "Enter Company Name",
                },
                category: {
                    required: "Enter Category",
                },
                product_price: {
                    required: "Enter Product Price",
                    number: "Only numbers are allowed",
                    min: "Price must be greater than 0"
                },
                product_discount: {
                    required: "Enter Product Discount",
                    number: "Only numbers are allowed",
                    min: "Discount must be greater than 0"
                },
                product_final_price: {
                    required: "Enter Product Final Price",
                    number: "Only numbers are allowed",
                    min: "Final price must be greater than 0"
                },
                product_image: {
                    required: "Upload Product Image",
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
        });

        // Product discount Calculation
        $('#product_discount').on('keyup',function(){
            var product_price = $('#product_price').val();
            var discount = $(this).val();

            if (isNaN(product_price) || isNaN(discount)) {
                return;
            }
            var final_amount = product_price - (product_price * (discount / 100));
            $('#product_final_price').val(final_amount.toFixed(2)); 
            console.log(final_amount.toFixed(2));
        });

        // Add product form submission
        $('#add_product').on('click',function(){
            if($("#addProductForm").valid()){
                var formData = new FormData($('#addProductForm')[0]);
                console.log(formData);

                $.ajax({
                    url : "<?php echo site_url('Admin/add_product')?>",
                    type: "post",
                    data : formData,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        console.log(response);
                        var response = JSON.parse(response);
                        Swal.fire({
                            icon: response.status,
                            title: response.title,
                            text: response.message,
                            showConfirmButton: true,
                        }).then((result) => {
                            location.reload();
                        });
                    },
                    error:function(xhr,status,error){
                        console.log('Ajax error: '+status+' '+error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong',
                            showConfirmButton: true,
                        }).then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        });

        $(document).on('click','.delete-product',function(){
            var id = $(this).attr('data-index');
            Swal.fire({
                icon: 'info',
                title: 'Delete',
                text: 'Are you sure want to delete this product?',
                width: '350px',
                height: '350px',
                showConfirmButton: true,
                showCancelButton: true,
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({

                    });
                }
                console.log(result);
            });
            console.log(id);
        });

    });

</script>
<!-- Script Section ends -->