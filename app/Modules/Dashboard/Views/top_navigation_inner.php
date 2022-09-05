<?php $uRights = session()->get('user_rights'); ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src="<?=base_url("images/final_tbssp.gif");?>" width="120px" /></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?=site_url('dashboard');?>">Home</a></li>
      <?php if ($uRights == ENUM_SUPER_ADMIN) : ?>
        <li><a href="<?=site_url('user/user_management');?>"> User Management</a></li>
      <?php endif; ?>
      <li><a class="nav-link" href="<?=site_url("databank/list");?>"> Bridge Report</a></li>
    </ul>
    <?php if (session()->getFlashdata("message")) : ?>
            <div class="flash_message-dashboard col-5">
                <?php echo session()->getFlashdata("message"); ?>
            </div>
        <?php endif; ?>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?=session()->get('name');?></a></li>
      <li><a href="<?= site_url('logout') ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>