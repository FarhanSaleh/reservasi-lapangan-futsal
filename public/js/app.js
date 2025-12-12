// Navbar Mobile Toggle
document.addEventListener('DOMContentLoaded', function() {
    // Hide flash messages after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.3s';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 300);
        }, 5000);
    });

    // Initialize number inputs for filters
    const numberInputs = document.querySelectorAll('input[type="number"]');
    numberInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value < 0) this.value = 0;
        });
    });

    // Time slot selection
    const timeSlots = document.querySelectorAll('.time-slot.available');
    timeSlots.forEach(slot => {
        slot.addEventListener('click', function(e) {
            if (this.dataset.unavailable) {
                e.preventDefault();
                alert('Waktu ini tidak tersedia');
                return;
            }
            // Remove previous selection
            document.querySelectorAll('.time-slot.selected').forEach(s => {
                s.classList.remove('selected');
            });
            // Add current selection
            this.classList.add('selected');
            // Set hidden input value
            const timeInput = document.getElementById('selected_time');
            if (timeInput) {
                timeInput.value = this.dataset.time;
            }
        });
    });

    // Price calculation
    const priceInputs = document.querySelectorAll('[data-price]');
    if (priceInputs.length > 0) {
        priceInputs.forEach(input => {
            input.addEventListener('change', calculatePrice);
        });
    }

    // Notification mark as read
    const notificationLinks = document.querySelectorAll('[data-notification-id]');
    notificationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const notificationId = this.dataset.notificationId;
            const readUrl = this.dataset.readUrl;
            
            if (readUrl && !this.classList.contains('read')) {
                markNotificationAsRead(notificationId, readUrl);
            }
        });
    });

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#dc3545';
                } else {
                    field.style.borderColor = '#ddd';
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Mohon isi semua field yang diperlukan');
            }
        });
    });

    // Image preview for file inputs
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.querySelector(`img[data-preview="${input.name}"]`);
                    if (preview) {
                        preview.src = event.target.result;
                        preview.style.display = 'block';
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    });

    // Date picker minimum today
    const dateInputs = document.querySelectorAll('input[type="date"]');
    const today = new Date().toISOString().split('T')[0];
    dateInputs.forEach(input => {
        input.min = today;
    });

    // Copy to clipboard
    const copyButtons = document.querySelectorAll('[data-copy-text]');
    copyButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const text = this.dataset.copyText;
            navigator.clipboard.writeText(text).then(() => {
                const originalText = this.textContent;
                this.textContent = '✓ Disalin!';
                setTimeout(() => {
                    this.textContent = originalText;
                }, 2000);
            });
        });
    });

    // Table sorting
    const sortableHeaders = document.querySelectorAll('[data-sort]');
    sortableHeaders.forEach(header => {
        header.style.cursor = 'pointer';
        header.addEventListener('click', function() {
            // Sorting logic would go here
            console.log('Sorting by:', this.dataset.sort);
        });
    });
});

function calculatePrice() {
    // Logic untuk menghitung harga berdasarkan durasi booking
    const durationHours = document.getElementById('duration_hours')?.value || 1;
    const pricePerHour = document.getElementById('price_per_hour')?.dataset.price || 0;
    const totalPrice = durationHours * pricePerHour;
    
    const totalPriceElement = document.getElementById('total_price');
    if (totalPriceElement) {
        totalPriceElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);
    }
}

function markNotificationAsRead(notificationId, url) {
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({ id: notificationId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const notificationEl = document.querySelector(`[data-notification-id="${notificationId}"]`);
            if (notificationEl) {
                notificationEl.classList.add('read');
                notificationEl.style.opacity = '0.7';
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(amount);
}

// Format date
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
}

// Format time
function formatTime(timeString) {
    const [hours, minutes] = timeString.split(':');
    return `${hours}:${minutes}`;
}
