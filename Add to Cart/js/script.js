document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle functionality
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const nav = document.querySelector('nav');
    
    menuToggle.addEventListener('click', function() {
        nav.classList.toggle('active');
    });

    // Cart functionality
    const cartIcon = document.querySelector('.cart-icon');
    const cartCount = document.querySelector('.cart-count');
    
    let count = 0;
    
    cartIcon.addEventListener('click', function(e) {
        e.preventDefault();
        // Here you would typically show a cart dropdown or navigate to cart page
        // For demo purposes, we'll just increment the count
        count++;
        cartCount.textContent = count;
        
        // Animation effect
        cartCount.classList.add('pulse');
        setTimeout(() => {
            cartCount.classList.remove('pulse');
        }, 300);
        
        console.log('Cart clicked! Count is now: ' + count);
    });

    // Card hover effects enhancement
    const cards = document.querySelectorAll('.card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            const icon = this.querySelector('.card-icon i');
            icon.classList.add('fa-beat');
            setTimeout(() => {
                icon.classList.remove('fa-beat');
            }, 800);
        });
    });
});