</main>

<footer class="footer-custom">
    <div class="container-fluid px-4 px-lg-5">
        <div class="row align-items-center">
            <div class="col-12 text-center text-md-start">
                <span class="fw-semibold text-dark">Portal O2SN</span> &bull; Sistem Informasi Pendataan Lomba Sekolah
                <div class="small text-muted mt-1">&copy; <?php echo date('Y'); ?> Rusi Adristi. All rights reserved.</div>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap 5.3.3 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom Global Scripts -->
<script>
    // Live Table Search Filter
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("tableSearch");
        if (searchInput) {
            searchInput.addEventListener("keyup", function () {
                const filter = this.value.toLowerCase().trim();
                const table = document.querySelector(".table-custom tbody");
                if (!table) return;
                
                const rows = table.getElementsByTagName("tr");
                let visibleCount = 0;

                for (let i = 0; i < rows.length; i++) {
                    const rowText = rows[i].textContent.toLowerCase();
                    if (rowText.indexOf(filter) > -1) {
                        rows[i].style.display = "";
                        visibleCount++;
                    } else {
                        rows[i].style.display = "none";
                    }
                }

                // Empty state handler
                let emptyRow = document.getElementById("searchEmptyRow");
                if (visibleCount === 0) {
                    if (!emptyRow) {
                        const colCount = rows[0] ? rows[0].cells.length : 8;
                        emptyRow = document.createElement("tr");
                        emptyRow.id = "searchEmptyRow";
                        emptyRow.innerHTML = `<td colspan="${colCount}" class="text-center py-4 text-muted"><i class="fa-solid fa-search me-2"></i>Tidak ada data yang cocok dengan pencarian "<strong>${filter}</strong>"</td>`;
                        table.appendChild(emptyRow);
                    }
                } else if (emptyRow) {
                    emptyRow.remove();
                }
            });
        }

        // Delete Confirmation with SweetAlert2
        const deleteButtons = document.querySelectorAll(".btn-delete-confirm");
        deleteButtons.forEach(btn => {
            btn.addEventListener("click", function (e) {
                e.preventDefault();
                const href = this.getAttribute("href");
                const itemName = this.getAttribute("data-name") || "data ini";

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: `Apakah Anda yakin ingin menghapus ${itemName}? Tindakan ini tidak dapat dibatalkan.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-4 shadow-lg'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });

        // Auto fadeout bootstrap alerts after 4 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-auto-dismiss');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 4000);
    });
</script>
</body>
</html>

