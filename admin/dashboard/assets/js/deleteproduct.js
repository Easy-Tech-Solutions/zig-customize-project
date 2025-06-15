$(document).ready(function() {
    // Delete product handler
    $(document).on('click', '.delete-product', function() {
        const button = $(this);
        const productId = button.data('product-id');
        const productName = button.data('product-name');
        
        if (confirm(`Are you sure you want to delete "${productName}"?`)) {
            button.prop('disabled', true).html('<i class="lni lni-spinner-arrow"></i> Deleting...');
            
            $.ajax({
                url: '../../deleteproduct.php',
                type: 'POST',
                data: { id: productId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#product-' + productId).fadeOut(300, function() {
                            $(this).remove();
                        });
                        alert('Product deleted successfully!');
                    } else {
                        alert('Error: ' + response.message);
                        button.prop('disabled', false).html('<i class="lni lni-trash-can"></i> Delete');
                    }
                },
                error: function() {
                    alert('Error deleting product. Please try again.');
                    button.prop('disabled', false).html('<i class="lni lni-trash-can"></i> Delete');
                }
            });
        }
    });
});