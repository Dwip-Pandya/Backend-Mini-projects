<div class="col-2 sidebar">
    <div class="logo text-center mb-4">
        <a href="admin-panel.php" style="text-decoration: none;">
        <h2 class="text-white">QuickKart</h2>
        </a>
        
    </div>
    <nav class="nav flex-column">
        <!-- Users Dropdown -->
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="usersDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user me-2"></i>Users
            </a>
            <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                <li><a class="dropdown-item" href="admin-panel-add-user.php"><i class="fas fa-plus me-2"></i>Add User</a></li>
                <li><a class="dropdown-item" href="admin-panel-view-user.php"><i class="fas fa-eye me-2"></i>View Users</a></li>
            </ul>
        </div>

        <!-- Products Dropdown -->
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="productsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-box me-2"></i>Products
            </a>
            <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                <li><a class="dropdown-item" href="admin-panel-add-product.php"><i class="fas fa-plus me-2"></i>Add Product</a></li>
                <li><a class="dropdown-item" href="admin-panel-view-product.php"><i class="fas fa-eye me-2"></i>View Products</a></li>
            </ul>
        </div>

        <!-- Categories Dropdown -->
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="categoriesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-folder me-2"></i>Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                <li><a class="dropdown-item" href="#"><i class="fas fa-plus me-2"></i>Add Category</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>View Categories</a></li>
            </ul>
        </div>

        <!-- Subcategories Dropdown -->
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="subcategoriesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-tags me-2"></i>Subcategories
            </a>
            <ul class="dropdown-menu" aria-labelledby="subcategoriesDropdown">
                <li><a class="dropdown-item" href="#"><i class="fas fa-plus me-2"></i>Add Subcategory</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>View Subcategories</a></li>
            </ul>
        </div>
    </nav>
</div>