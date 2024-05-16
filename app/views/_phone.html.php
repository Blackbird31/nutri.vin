<?php if ($iframe): ?>
    <div class="border border-light-subtle border-4 py-5 px-2 bg-light rounded-5 shadow-sm bg-gradient position-relative">
<?php else:?>
    <div class="border border-light-subtle border-4 py-5 px-2 bg-light rounded-5 shadow-sm bg-gradient position-fixed" style="margin-top: -2.5rem;">
<?php endif; ?>
    <div class="rounded-5 border border-2 bg-white border-light-subtle position-absolute top-0 start-50 translate-middle-x" style="width: 100px; height: 20px; margin-top: 15px;"></div>
    <div class="rounded-5 border border-2 bg-white border-light-subtle position-absolute top-0 end-0 mt-3 me-5" style="width: 20px; height: 20px;"></div>
    <div class="border border-light-subtle overflow-auto rounded-3" style="height: 70vh; width: 400px;" data-liveform-container>
        <?php if ($iframe): ?>
            <iframe src="/<?php echo $qrcode->id ?>?notpublicview=1" style="height: 100%; width: 398px;"></iframe>
        <?php else: ?>
            <?php include('qrcode_show.html.php'); ?>
        <?php endif; ?>
    </div>
    <div class="rounded-3 border border-2 bg-white border-light-subtle position-absolute bottom-0 start-50 translate-middle-x mb-1" style="width: 40px; height: 40px;"></div>
</div>
