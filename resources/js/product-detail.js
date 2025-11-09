// File: public/js/product-detail.js

const ProductDetail = {
    /**
     * Decrease quantity
     */
    decreaseQuantity() {
        const input = document.getElementById('quantity');
        const currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
        }
    },

    /**
     * Increase quantity
     * @param {number} maxStock - Maximum stock available
     */
    increaseQuantity(maxStock) {
        const input = document.getElementById('quantity');
        const currentValue = parseInt(input.value);
        if (currentValue < maxStock) {
            input.value = currentValue + 1;
        }
    },

    /**
     * Add product to cart with quantity
     * @param {number} productId - Product ID
     */
    async addToCart(productId) {
        const quantity = document.getElementById('quantity') ? 
            parseInt(document.getElementById('quantity').value) : 1;
        
        try {
            const response = await fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            });

            const data = await response.json();

            if (response.status === 401) {
                // User not logged in - show login modal
                this.showLoginModal();
            } else if (data.success) {
                // Success - show success notification
                this.showNotification('success', data.message);
                
                // Update cart count in navbar if exists
                this.updateCartCount(data.cartCount);
                
                // Reset quantity to 1
                if (document.getElementById('quantity')) {
                    document.getElementById('quantity').value = 1;
                }
            } else {
                // Error - show error notification
                this.showNotification('error', data.message);
            }
        } catch (error) {
            console.error('Error adding to cart:', error);
            this.showNotification('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    },

    /**
     * Show login modal
     */
    showLoginModal() {
        const modal = document.getElementById('loginModal');
        const content = document.getElementById('loginModalContent');
        
        if (modal && content) {
            modal.classList.remove('hidden');
            
            // Trigger animation
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }
    },

    /**
     * Close login modal
     */
    closeLoginModal() {
        const modal = document.getElementById('loginModal');
        const content = document.getElementById('loginModalContent');
        
        if (content) {
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                if (modal) modal.classList.add('hidden');
            }, 300);
        }
    },

    /**
     * Show notification using template
     * @param {string} type - 'success' or 'error'
     * @param {string} message - Notification message
     */
    showNotification(type, message) {
        const container = document.getElementById('notificationContainer');
        const template = document.getElementById('notificationTemplate');
        
        if (!container || !template) return;

        // Clone template
        const notification = template.content.cloneNode(true).querySelector('.notification-item');
        
        // Set styles based on type
        const bgColor = type === 'success' ? 'bg-emerald-500' : 'bg-red-500';
        notification.classList.add(bgColor, 'text-white');
        
        // Set icon
        const icon = notification.querySelector('.notification-icon');
        if (type === 'success') {
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />';
        } else {
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
        }
        
        // Set message
        notification.querySelector('.notification-message').textContent = message;
        
        // Add to container
        container.appendChild(notification);
        
        // Trigger slide-in animation
        setTimeout(() => {
            notification.classList.remove('translate-x-full', 'opacity-0');
            notification.classList.add('translate-x-0', 'opacity-100');
        }, 10);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    },

    /**
     * Update cart count in navbar
     * @param {number} count - New cart count
     */
    updateCartCount(count) {
        const cartBadge = document.getElementById('cartCount');
        if (cartBadge) {
            cartBadge.textContent = count;
            
            // Add bounce animation
            cartBadge.classList.add('animate-bounce');
            setTimeout(() => cartBadge.classList.remove('animate-bounce'), 1000);
        }
    },

    /**
     * Switch between tabs
     */
    switchTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        // Remove active state from all buttons
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('border-emerald-500', 'bg-gray-700/30', 'text-white');
            button.classList.add('border-transparent', 'text-gray-400');
        });
        
        // Show selected tab content
        const selectedContent = document.getElementById('content-' + tabName);
        if (selectedContent) {
            selectedContent.classList.remove('hidden');
        }
        
        // Add active state to selected button
        const activeButton = document.getElementById('tab-' + tabName);
        if (activeButton) {
            activeButton.classList.remove('border-transparent', 'text-gray-400');
            activeButton.classList.add('border-emerald-500', 'bg-gray-700/30', 'text-white');
        }
    },

    /**
     * Generic share product
     */
    shareProduct() {
        if (navigator.share) {
            navigator.share({
                title: document.title,
                text: 'Lihat produk ini!',
                url: window.location.href
            }).catch(err => console.log('Error sharing:', err));
        } else {
            this.copyToClipboard(window.location.href);
            this.showNotification('success', 'Link produk telah disalin!');
        }
    },

    /**
     * Share to WhatsApp
     */
    shareToWhatsApp(productName) {
        const text = encodeURIComponent(`Lihat produk ini: ${productName} - ${window.location.href}`);
        window.open(`https://wa.me/?text=${text}`, '_blank');
    },

    /**
     * Share to Facebook
     */
    shareToFacebook() {
        const url = encodeURIComponent(window.location.href);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
    },

    /**
     * Share to Twitter
     */
    shareToTwitter(productName) {
        const text = encodeURIComponent(`Lihat produk ini: ${productName}`);
        const url = encodeURIComponent(window.location.href);
        window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
    },

    /**
     * Copy text to clipboard
     */
    copyToClipboard(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text);
        } else {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
        }
    },

    /**
     * Initialize sticky cart bar
     */
    initStickyCartBar() {
        const stickyBar = document.getElementById('stickyCartBar');
        if (!stickyBar) return;

        let lastScrollY = window.scrollY;
        
        window.addEventListener('scroll', () => {
            const currentScrollY = window.scrollY;
            
            if (currentScrollY > 400 && currentScrollY > lastScrollY) {
                stickyBar.classList.remove('translate-y-full');
            } else {
                stickyBar.classList.add('translate-y-full');
            }
            
            lastScrollY = currentScrollY;
        });
    },

    /**
     * Initialize scroll animations
     */
    initScrollAnimations() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { 
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        document.querySelectorAll('.animate-slide-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease-out';
            observer.observe(el);
        });
    },

    /**
     * Initialize all features
     */
    init() {
        this.initStickyCartBar();
        this.initScrollAnimations();
        this.switchTab('description');
        
        // Close modal when clicking outside
        const loginModal = document.getElementById('loginModal');
        if (loginModal) {
            loginModal.addEventListener('click', (e) => {
                if (e.target.id === 'loginModal') {
                    this.closeLoginModal();
                }
            });
        }
        
        console.log('Product Detail initialized');
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    ProductDetail.init();
});

// Expose to global scope
window.ProductDetail = ProductDetail;

// Global function for cart (if called from other places)
function addToCart(productId, quantity = 1) {
    ProductDetail.addToCart(productId);
}