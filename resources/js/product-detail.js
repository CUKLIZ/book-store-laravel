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
    addToCart(productId) {
        const quantity = document.getElementById('quantity').value;
        
        // Call your existing addToCart function
        if (typeof addToCart === 'function') {
            addToCart(productId, quantity);
        } else {
            console.error('addToCart function not found');
            alert('Fungsi keranjang belum tersedia');
        }
    },

    /**
     * Switch between tabs
     * @param {string} tabName - Tab name (description, specifications, reviews)
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
            // Fallback: copy to clipboard
            this.copyToClipboard(window.location.href);
            alert('Link produk telah disalin!');
        }
    },

    /**
     * Share to WhatsApp
     * @param {string} productName - Product name
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
     * @param {string} productName - Product name
     */
    shareToTwitter(productName) {
        const text = encodeURIComponent(`Lihat produk ini: ${productName}`);
        const url = encodeURIComponent(window.location.href);
        window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
    },

    /**
     * Copy text to clipboard
     * @param {string} text - Text to copy
     */
    copyToClipboard(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text);
        } else {
            // Fallback for older browsers
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
            
            // Show sticky bar when scrolling down and past 400px
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

        // Set default tab
        this.switchTab('description');

        console.log('Product Detail initialized');
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    ProductDetail.init();
});

// Expose to global scope
window.ProductDetail = ProductDetail;