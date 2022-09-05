<?= $this->extend("\Modules\Template\Views\my_template") ?>
<?= $this->section("body") ?>

<div class="container">
    <div class="row">
    <div class="panel-heading">
    					<h1 class="">
    						User List
    					</h1>
    				</div>
        <div id="dataList">
            <form action="" method="post">
                <div class="btn-group padding-top">
                    <input type="button" value="Add" class="btn btn-primary" id="btnAdd" onclick="window.location='<?= site_url('user/register'); ?>'" />
                    <input type="submit" value="Delete" name="Delete" class="btn btn-danger" id="btnDelete" onclick="return askConfirm();" />
                </div>
                <?php /*if (session()->getFlashdata("message")) : ?>
                    <div class="flash_message">
                        <?php echo session()->getFlashdata("message"); ?>
                    </div>
                <?php endif;*/ ?>
                <table id="myForm2" class="table table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="40px">S.N.</th>
                            <th width="200px">Name </th>
                            <th width="200px">Email</th>
                            <th width="150px">Username</th>
                            <!-- <th width="100px">Status</th> -->
                            <th width="150px">Type</th>
                            <th width="80px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array($arrUser)) {
                            foreach ($arrUser as $dataRow) : ?>
                                <?php //echo "<pre>";var_dump($dataRow); exit; 
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="selId[]" value="<?php echo $dataRow['id']; ?>" /></td>
                                    <!-- <td align="center"><?php //echo $dataRow['created_at']; 
                                                            ?></td> -->
                                    <td><?php echo $dataRow['name']; ?></td>
                                    <td><?php echo $dataRow['email']; ?></td>
                                    <td><?php echo $dataRow['username']; ?></td>
                                    <!-- <td <?php //echo $dataRow['status']; ?>></td> -->
                                    <td><?php echo $arrRights[$dataRow['user_rights']]; ?></td>
                                    <td><a href="<?= site_url('user/register/'); ?><?= $dataRow['id']; ?>">Edit</a></td>
                                </tr>
                        <?php endforeach;
                        } ?>

                    </tbody>
                </table>
            </form>
            <style>
                div.dataTables_wrapper {
                    width: 1300px;
                    margin: 5px auto;
                }
            </style>
            <script>
                function askConfirm() {
                    return confirm('Are you sure you want to delete the selected users?');
                }

                // $(document).ready(function() {
                //     $('#myForm2').DataTable({
                //         "scrollY": 550,
                //         "scrollX": true
                //     });
                // });
            </script>

        </div>
    </div>
</div>
<?= $this->endSection() ?>