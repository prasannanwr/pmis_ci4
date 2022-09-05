<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>
    <div id="page-wrapper" class="largeRpt">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mainBoard">
                            <?php /*if (session()->getFlashdata("message")) : ?>
                        <div class="flash_message-dashboard col-5">
                            <?php echo session()->getFlashdata("message"); ?>
                        </div>
                    <?php endif;*/ ?>
                    <div style="font-size:36px; text-align:center; padding-top:100px;">Programme Monitoring Information System (PMIS)</div>
                </div>
            </div>
    </div>
</div>
<?= $this->endSection() ?>