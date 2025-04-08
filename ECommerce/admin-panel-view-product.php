<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickKart - Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/admin-styles.css" rel="stylesheet">
    <link href="css/product-admin.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar (20%) -->
            <?php
            include 'sidebar.php';
            ?>

            <!-- Right Content Area (80%) -->
            <div class="col-10 main-content">
            <?php
                include 'header.php'
                ?>

                <div class="products-table">
                    <div class="card">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-1"><i class="fas fa-box-open me-2"></i>Product Management</h3>
                                <p class="text-muted mb-0">View and manage all products in your inventory</p>
                            </div>
                            <a href="addproduct.php" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-1"></i> Add New Product
                            </a>
                        </div>
                        <div class="card-body">
                            <!-- Search and Filter Controls -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search products...">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" id="categoryFilter">
                                        <option value="">All Categories</option>
                                        <option value="1">Electronics</option>
                                        <option value="2">Fashion</option>
                                        <option value="3">Home & Kitchen</option>
                                        <option value="4">Books</option>
                                        <option value="5">Sports & Outdoors</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" id="stockFilter">
                                        <option value="">All Stock Status</option>
                                        <option value="instock">In Stock</option>
                                        <option value="lowstock">Low Stock</option>
                                        <option value="outofstock">Out of Stock</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Products Table -->
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" width="60">ID</th>
                                            <th scope="col" width="80">Image</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col" width="150">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Sample Product Rows -->
                                        <tr>
                                            <td>1001</td>
                                            <td>
                                                <img src="img/products/product1.jpg" alt="Product 1" class="img-thumbnail" width="50">
                                            </td>
                                            <td>
                                                <strong>Smart Watch Pro</strong>
                                                <div class="small text-muted">SKU: SW-1001</div>
                                            </td>
                                            <td>Electronics</td>
                                            <td>$199.99</td>
                                            <td>
                                                <span class="badge bg-success">In Stock (45)</span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="#" class="btn btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-outline-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-outline-danger" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1002</td>
                                            <td>
                                                <img src="img/products/product2.jpg" alt="Product 2" class="img-thumbnail" width="50">
                                            </td>
                                            <td>
                                                <strong>Wireless Earbuds</strong>
                                                <div class="small text-muted">SKU: WE-1002</div>
                                            </td>
                                            <td>Electronics</td>
                                            <td>$89.99</td>
                                            <td>
                                                <span class="badge bg-warning text-dark">Low Stock (8)</span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="#" class="btn btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-outline-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-outline-danger" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1003</td>
                                            <td>
                                                <img src="img/products/product3.jpg" alt="Product 3" class="img-thumbnail" width="50">
                                            </td>
                                            <td>
                                                <strong>Cotton T-Shirt</strong>
                                                <div class="small text-muted">SKU: CTS-1003</div>
                                            </td>
                                            <td>Fashion</td>
                                            <td>$24.99</td>
                                            <td>
                                                <span class="badge bg-success">In Stock (120)</span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="#" class="btn btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-outline-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-outline-danger" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1004</td>
                                            <td>
                                                <img src="img/products/product4.jpg" alt="Product 4" class="img-thumbnail" width="50">
                                            </td>
                                            <td>
                                                <strong>Non-Stick Cookware Set</strong>
                                                <div class="small text-muted">SKU: NCS-1004</div>
                                            </td>
                                            <td>Home & Kitchen</td>
                                            <td>$129.99</td>
                                            <td>
                                                <span class="badge bg-danger">Out of Stock (0)</span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="#" class="btn btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-outline-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-outline-danger" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1005</td>
                                            <td>
                                                <img src="img/products/product5.jpg" alt="Product 5" class="img-thumbnail" width="50">
                                            </td>
                                            <td>
                                                <strong>Bestselling Novel</strong>
                                                <div class="small text-muted">SKU: BN-1005</div>
                                            </td>
                                            <td>Books</td>
                                            <td>$15.99</td>
                                            <td>
                                                <span class="badge bg-success">In Stock (67)</span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="#" class="btn btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-outline-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-outline-danger" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <nav aria-label="Product pagination" class="mt-4">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                            
                            <!-- Bulk Actions -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="bulk-actions">
                                    <div class="input-group" style="width: 300px;">
                                        <select class="form-select" id="bulkAction">
                                            <option value="">Bulk Actions</option>
                                            <option value="delete">Delete Selected</option>
                                            <option value="updateStock">Update Stock</option>
                                            <option value="changeCategory">Change Category</option>
                                        </select>
                                        <button class="btn btn-outline-secondary" type="button">Apply</button>
                                    </div>
                                </div>
                                <div class="showing-entries">
                                    <span class="text-muted">Showing 1 to 5 of 24 entries</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('.mobile-sidebar-toggle');
            const sidebar = document.querySelector('.sidebar');

            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
        });
    </script>
</body>

</html>