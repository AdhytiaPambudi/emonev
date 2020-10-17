<!-- <div class="sidebar-scroll">
	<div class="userinfo">

		<div class="avatar"><img src="<?= base_url() ?>assets/img/favicon.png" alt="" style="width:30px;height:30px;" /></div>
		<div class="user"><?=$this->session->userdata('nama')?></div>

		<div class="position"><?=$this->session->userdata('siteDec')?></div>
	</div>	
	<nav>
		
		<?php
			
			
		?>
	</nav>
</div>  -->

<!-- NEW SIDEMENU -->

<div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="<?=base_url(); ?>"><img class="main-logo" src="<?= base_url() ?>assets/budistyle/img/logo/logo.png" alt="" /></a>
                <strong><a href="<?=base_url(); ?>"><img src="<?= base_url() ?>assets/budistyle/img/logo/logosn.png" alt="" /></a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                	<?php echo $menu;
						?>
                </nav>
            </div>
        </nav>
    </div>
    <!-- End Left menu area -->

