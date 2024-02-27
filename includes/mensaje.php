<?php if (isset($_SESSION['msg']) && isset($_SESSION['color'])) { ?>
            <script>
                Swal.fire({icon:"<?= $_SESSION['color']; ?>",title:"<?= $_SESSION['msg']; ?>"});
            </script>
            <?php
            unset($_SESSION['color']);
            unset($_SESSION['msg']);
        } ?>