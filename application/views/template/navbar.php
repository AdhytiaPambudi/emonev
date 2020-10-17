<div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="<?= base_url(); ?>"><img class="main-logo" src="<?= base_url() ?>assets/budistyle/img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
													<i class="educate-icon educate-nav"></i>
												</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                                  
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="nav-item dropdown">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span class="fa fa-calendar" aria-hidden="true"></span></a>
                                                    <div role="menu" class="author-message-top dropdown-menu animated zoomIn">
                                                        <div class="message-single-top">
                                                            <h1>Tahun Anggaran</h1>
                                                        </div>
                                                        <div class="message-view">
                                                            <a href="#" style="font-size:20pt;"><?= $this->session->userdata('thn_ang');?></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                            <?php 
                                                                if($this->session->userdata('is_admin') == 1){
                                                                    $linkImage = base_url()."assets/budistyle/img/profile/admin.jpg";
                                                                }else{
                                                                    $linkImage = base_url()."assets/budistyle/img/profile/skpd.jpg";
                                                                }
                                                            ?>
                                                            <img src="<?= $linkImage; ?>" alt="" />
															<span class="admin-name"><?=$this->session->userdata('nama')?></span>
															<i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
														</a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <!-- <li><a href="#"><span class="edu-icon edu-home-admin author-log-ic"></span>My Account</a>
                                                        </li>
                                                        <li><a href="#"><span class="edu-icon edu-user-rounded author-log-ic"></span>Change Password</a>
                                                        </li> -->
                                                        <li><a href="#" class="tombol-logout"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="nav-item nav-setting-open"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-menu" <?= $this->session->userdata('is_admin') == '1' ? '' : 'hidden'; ?>></i></a>

                                                    <div role="menu" class="admintab-wrap menu-setting-wrap menu-setting-wrap-bg dropdown-menu animated zoomIn">
                                                        <ul class="nav nav-tabs custon-set-tab">
                                                            <li class="active"><a data-toggle="tab" href="#Notes">History</a>
                                                            </li>
                                                            <li><a data-toggle="tab" href="#Settings">Settings</a>
                                                            </li>
                                                        </ul>

                                                        <div class="tab-content custom-bdr-nt">
                                                            <div id="Notes" class="tab-pane fade in active">
                                                                <div class="projects-settings-wrap">
                                                                    <div class="note-heading-indicate">
                                                                        <h2><i class="fa fa-comments-o"></i> Latest Notes</h2>
                                                                        <!-- <p>You have 10 new message.</p> -->
                                                                    </div>
                                                                    <div class="project-st-list-area project-st-menu-scrollbar">
                                                                        <?php $history =  $this->db->query('SELECT * FROM ms_database_history order by tgl_tr desc limit 3')->result();?>
                                                                        <ul class="projects-st-menu-list">
                                                                        
                                                                                
                                                                            <?php foreach ($history as $value) {
                                                                                
                                                                            ?>
                                                                            <li>
                                                                                <a href="#">
                                                                                    <div class="project-list-flow">
                                                                                        <div class="projects-st-heading">
                                                                                            <h2><?=$value->nm_admin_tr; ?> </h2>
                                                                                            <p><?= 'Melakukan Proses Transfer Tabel '.$value->table_tr.' Sebanyak '.$value->data.' Data.'  ;?></p>
                                                                                            <span class="project-st-time"><?= $this->PublicModel->tgl_indo_short($value->tgl_tr); ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                              
                                                                            </li>
                                                                            <?php }?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php  $thn_select=$this->session->userdata('thn_ang');
                                                                $config =  $this->db->query('SELECT * FROM ms_config where tahun_anggaran = '.$thn_select.' limit 1')->row();?>
                                                            <div id="Settings" class="tab-pane fade">
                                                                <div class="setting-panel-area">
                                                                    <div class="note-heading-indicate">
                                                                        <h2><i class="fa fa-gears"></i> Settings Administrator</h2>
                                                                        <p> Hanya Berlaku Untuk Admin</p>
                                                                    </div>
                                                                    <ul class="setting-panel-list">
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Anggaran Perubahan</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input type="checkbox" id="changeStsAnggaran" name="collapsemenu" <?= $config->sts_anggaran == 'Perubahan' ? 'checked' : ''; ?> class="onoffswitch-checkbox">
                                                                                            <label class="onoffswitch-label" for="changeStsAnggaran">
																									<span class="onoffswitch-inner"></span>
																									<span class="onoffswitch-switch"></span>
																							</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        
                                                                        <!-- <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Buka Pemantauan Triwulan 1</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input <?= $config->show_triwulan1 == 'Y' ? 'checked' : ''; ?> type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="bukaPantau1" >
                                                                                            <label class="onoffswitch-label" for="bukaPantau1">
																									<span class="onoffswitch-inner"></span>
																									<span class="onoffswitch-switch"></span>
																							</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Buka Pemantauan Triwulan 2</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input <?= $config->show_triwulan2 == 'Y' ? 'checked' : ''; ?> type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="bukaPantau2">
                                                                                            <label class="onoffswitch-label" for="bukaPantau2">
																									<span class="onoffswitch-inner"></span>
																									<span class="onoffswitch-switch"></span>
																							</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Buka Pemantauan Triwulan 3</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input <?= $config->show_triwulan3 == 'Y' ? 'checked' : ''; ?> type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="bukaPantau3">
                                                                                            <label class="onoffswitch-label" for="bukaPantau3">
																									<span class="onoffswitch-inner"></span>
																									<span class="onoffswitch-switch"></span>
																							</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="checkbox-setting-pro">
                                                                                <div class="checkbox-title-pro">
                                                                                    <h2>Buka Pemantauan Triwulan 4</h2>
                                                                                    <div class="ts-custom-check">
                                                                                        <div class="onoffswitch">
                                                                                            <input <?= $config->show_triwulan4 == 'Y' ? 'checked' : ''; ?> type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="bukaPantau4">
                                                                                            <label class="onoffswitch-label" for="bukaPantau4">
																									<span class="onoffswitch-inner"></span>
																									<span class="onoffswitch-switch"></span>
																							</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li> -->
                                                                    </ul>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                <?php
                                    echo $menu;
                                ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->
        </div>
        <br>


<?php
if ($this->session->userdata('is_admin_login') == FALSE) {
			redirect(base_url(''), 'refresh');
		}
?>
 

<script type="text/javascript">
    
	$(document).on("click", ".tombol-logout", function() {
        Swal.fire({
		  title: 'Konfirmasi Logout',
		  text: "Lanjutkan keluar aplikasi ?",
		  icon: 'info',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Batal',
		  confirmButtonText: 'Logout'
		}).then((result) => {
		  if (result.value) {
		    document.location.href = "<?=base_url('logout')?>";
		  }
		})

    });
    
    $("#changeStsAnggaran").change(function(){
        var stsAng = '<?php echo $config->sts_anggaran;?>';
        
        $.ajax({
            url: '<?php echo base_url('change-sts-anggaran'); ?>',
            data:{stsAng:stsAng},
            type: 'POST',
            success: function(data){
                var out = jQuery.parseJSON(data);
						      	
                
                Lobibox.notify('info', {
                        size: 'mini',
                        msg: out.pesan
                    }); 
            }
        })
    });

    $("#bukaPantau1").change(function(){
        var stsTw = '<?php echo $config->show_triwulan1;?>';
        
        $.ajax({
            url: '<?php echo base_url('change-sts-triwulan'); ?>',
            data:{stsTw:stsTw,tw:1},
            type: 'POST',
            success: function(data){
                var out = jQuery.parseJSON(data);
						      	
                
                Lobibox.notify('info', {
                        size: 'mini',
                        msg: out.pesan
                    }); 
            }
        })
    });
    $("#bukaPantau2").change(function(){
        var stsTw = '<?php echo $config->show_triwulan2;?>';
        
        $.ajax({
            url: '<?php echo base_url('change-sts-triwulan'); ?>',
            data:{stsTw:stsTw,tw:2},
            type: 'POST',
            success: function(data){
                var out = jQuery.parseJSON(data);
						      	
                
                Lobibox.notify('info', {
                        size: 'mini',
                        msg: out.pesan
                    }); 
            }
        })
    });
    $("#bukaPantau3").change(function(){
        var stsTw = '<?php echo $config->show_triwulan3;?>';
        
        $.ajax({
            url: '<?php echo base_url('change-sts-triwulan'); ?>',
            data:{stsTw:stsTw,tw:3},
            type: 'POST',
            success: function(data){
                var out = jQuery.parseJSON(data);
						      	
                
                Lobibox.notify('info', {
                        size: 'mini',
                        msg: out.pesan
                    }); 
            }
        })
    });
    $("#bukaPantau4").change(function(){
        var stsTw = '<?php echo $config->show_triwulan4;?>';
        
        $.ajax({
            url: '<?php echo base_url('change-sts-triwulan'); ?>',
            data:{stsTw:stsTw,tw:4},
            type: 'POST',
            success: function(data){
                var out = jQuery.parseJSON(data);
						      	
                
                Lobibox.notify('info', {
                        size: 'mini',
                        msg: out.pesan
                    }); 
            }
        })
    });

</script>

