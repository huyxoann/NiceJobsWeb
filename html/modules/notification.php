<?php if (isset($notification)) { ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="../images/Basic_red_dot.png" class="rounded me-2" alt="..." style="width: 20px;">
                <strong class="me-auto">NiceJob thông báo!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <div class="alert alert-warning" role="alert">
                    <?php echo $notification ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>