// Modal Functions
function openAddProductModal() {
    const modal = document.getElementById('addProductModal');
    modal.classList.add('active');
}

function closeAddProductModal() {
    const modal = document.getElementById('addProductModal');
    modal.classList.remove('active');
}

// Close modal when clicking outside
window.addEventListener('click', function(event) {
    const modal = document.getElementById('addProductModal');
    if (event.target === modal) {
        closeAddProductModal();
    }
});

// Product Management
function editProduct(id) {
    // Fetch product details and open modal with pre-filled data
    fetch(`api/products.php?id=${id}`)
        .then(response => response.json())
        .then(product => {
            // Fill form with product data
            document.getElementById('name').value = product.name;
            document.getElementById('description').value = product.description;
            document.getElementById('category').value = product.category;
            document.getElementById('price').value = product.price;
            document.getElementById('stock').value = product.stock;
            document.getElementById('image_url').value = product.image_url;
            
            // Update form action
            const form = document.getElementById('addProductForm');
            form.action = 'products.php?action=edit&id=' + id;
            
            openAddProductModal();
        });
}

function deleteProduct(id) {
    if (confirm('Are you sure you want to delete this product?')) {
        fetch('api/products.php', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}

// Initialize DataTables if available
if (typeof $.fn.DataTable !== 'undefined') {
    $('table').DataTable({
        responsive: true,
        pageLength: 10,
        order: [[0, 'desc']],
    });
}

// Chart.js Integration for Dashboard
if (typeof Chart !== 'undefined' && document.getElementById('salesChart')) {
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Sales',
                data: [12, 19, 3, 5, 2, 3],
                borderColor: '#1a1a1a',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
}