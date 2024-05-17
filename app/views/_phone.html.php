<?php if ($iframe): ?>
    <div class="border border-light-subtle border-4 py-5 px-2 bg-light rounded-5 shadow-sm bg-gradient position-relative">
<?php else:?>
    <div class="border border-light-subtle border-4 py-5 px-2 bg-light rounded-5 shadow-sm bg-gradient position-sticky" style="top: 2rem">
<?php endif; ?>
    <div class="rounded-5 border border-2 bg-white border-light-subtle position-absolute top-0 start-50 translate-middle-x" style="width: 100px; height: 20px; margin-top: 15px;"></div>
    <div class="rounded-5 border border-2 bg-white border-light-subtle position-absolute top-0 end-0 mt-3 me-5" style="width: 20px; height: 20px;"></div>
    <div class="border border-light-subtle overflow-auto rounded-3" style="height: 70vh; width: 390px;" data-liveform-container>
        <?php if ($iframe): ?>
            <iframe src="/<?php echo $qrcode->id ?><?php if (!empty($notpublicview)): ?>?notpublicview=1<?php endif; ?>" style="height: 99%; width: 388px;"></iframe>
        <?php else: ?>
            <?php include('qrcode_show.html.php'); ?>
        <?php endif; ?>
    </div>
    <div class="rounded-3 border border-2 bg-white border-light-subtle position-absolute bottom-0 start-50 translate-middle-x mb-1" style="width: 40px; height: 40px;"></div>
</div>
