(function () {
  /* ========= Preloader ======== */
  const preloader = document.querySelectorAll('#preloader')

  window.addEventListener('load', function () {
    if (preloader.length) {
      this.document.getElementById('preloader').style.display = 'none'
    }
  })

  /* ========= Add Box Shadow in Header on Scroll ======== */
  window.addEventListener('scroll', function () {
    const header = document.querySelector('.header')
    if (window.scrollY > 0) {
      header.style.boxShadow = '0px 0px 30px 0px rgba(200, 208, 216, 0.30)'
    } else {
      header.style.boxShadow = 'none'
    }
  })

  /* ========= sidebar toggle ======== */
  const sidebarNavWrapper = document.querySelector(".sidebar-nav-wrapper");
  const mainWrapper = document.querySelector(".main-wrapper");
  const menuToggleButton = document.querySelector("#menu-toggle");
  const menuToggleButtonIcon = document.querySelector("#menu-toggle i");
  const overlay = document.querySelector(".overlay");

  menuToggleButton.addEventListener("click", () => {
    sidebarNavWrapper.classList.toggle("active");
    overlay.classList.add("active");
    mainWrapper.classList.toggle("active");

    if (document.body.clientWidth > 1200) {
      if (menuToggleButtonIcon.classList.contains("lni-chevron-left")) {
        menuToggleButtonIcon.classList.remove("lni-chevron-left");
        menuToggleButtonIcon.classList.add("lni-menu");
      } else {
        menuToggleButtonIcon.classList.remove("lni-menu");
        menuToggleButtonIcon.classList.add("lni-chevron-left");
      }
    } else {
      if (menuToggleButtonIcon.classList.contains("lni-chevron-left")) {
        menuToggleButtonIcon.classList.remove("lni-chevron-left");
        menuToggleButtonIcon.classList.add("lni-menu");
      }
    }
  });
  overlay.addEventListener("click", () => {
    sidebarNavWrapper.classList.remove("active");
    overlay.classList.remove("active");
    mainWrapper.classList.remove("active");
  });
})();

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