<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] 						= 'welcome';
// start emonev
// setting-backuprestore
$route['backup-restore'] 							= 'setting/DatabaseController/index';
$route['backup-database'] 							= 'setting/DatabaseController/backup';
$route['restore-database'] 							= 'setting/DatabaseController/restore';
$route['download-database'] 						= 'setting/DatabaseController/download';

$route['transfer-tapd'] 							= 'setting/DatabaseController/transfer_tapd';




$route['check-data-database'] 						= 'setting/DatabaseController/check_data_database';
$route['importdata-database'] 						= 'setting/DatabaseController/import_data_database';
$route['get-last-update-database'] 						= 'setting/DatabaseController/get_last_update_database';
$route['manual-book'] 	                			= 'admin/Dashboard/manual';


$route['top-real-dashboard'] 					    = 'admin/Dashboard/top_real_dashboard';
$route['get-chart-keu'] 					         = 'admin/Dashboard/get_chart_keu';
$route['get-chart-fisik'] 					         = 'admin/Dashboard/get_chart_fisik';
$route['get-chart-keu-front'] 					         = 'FrontController/get_chart_keu';
$route['get-chart-fisik-front'] 					         = 'FrontController/get_table_fisik';

// user
$route['change-sts-anggaran'] 								= 'setting/UserController/change_sts_anggaran';
$route['change-sts-triwulan'] 								= 'setting/UserController/change_sts_triwulan';

$route['master-penandatangan'] 								= 'master/PenandatanganController';
$route['get-master-penandatangan'] 								= 'master/PenandatanganController/get';
$route['insert-penandatangan'] 							= 'master/PenandatanganController/insert';
$route['update-penandatangan'] 							= 'master/PenandatanganController/update';
$route['hapus-penandatangan/(:any)'] 						= 'master/PenandatanganController/del/$1';
$route['aktif-penandatangan/(:any)/(:any)'] 						= 'master/PenandatanganController/aktif/$1/$2';

$route['bidang-bappeda'] 							= 'master/BidangController';
$route['get-bidang-bappeda'] 						= 'master/BidangController/get';
$route['get-modal-bidang'] 						= 'master/BidangController/modal';
$route['update-bidang'] 							= 'master/BidangController/update';	
$route['hapus-bidang/(:any)'] 						= 'master/BidangController/del/$1';
$route['aktif-bidang/(:any)/(:any)'] 				= 'master/BidangController/aktif/$1/$2';
$route['bidang-get-combo-skpd'] 	            	= 'master/BidangController/get_combo_skpd';


$route['setting-user'] 								= 'setting/UserController';
$route['setting-user/get'] 							= 'setting/UserController/get';
$route['setting-user/getmax'] 							= 'setting/UserController/getmax';
$route['setting-user/getkab'] 							= 'setting/UserController/get_combo_kab';
$route['setting-user/getprov'] 						= 'setting/UserController/get_combo_prov';
$route['setting-user/getinstansi'] 					= 'setting/UserController/get_combo_instansi';
$route['setting-user/add'] 							= 'setting/UserController/add';
$route['setting-user/insert'] 							= 'setting/UserController/insert';
$route['setting-user/update'] 							= 'setting/UserController/update';
$route['setting-user/edit/(:any)'] 					= 'setting/UserController/edit/$1';
$route['setting-user/del/(:any)'] 						= 'setting/UserController/del/$1';
$route['setting-user/cek-user'] 						= 'setting/UserController/cek_user';
$route['setting-user/get_jenis_user'] 				= 'setting/UserController/get_combo_jenis_user';
$route['setting-user/get_bidang'] 				= 'setting/UserController/get_combo_bidang';

// triwulan
$route['kunci-triwulan'] 								= 'setting/TriwulanController';
$route['get-setting-triwulan'] 							= 'setting/TriwulanController/get';
$route['update-triwulan'] 								= 'setting/TriwulanController/update';


// GROUP
$route['setting-group'] 								= 'setting/GroupController';
$route['setting-group/get'] 							= 'setting/GroupController/get';
$route['setting-group/getmax'] 							= 'setting/GroupController/getmax';
$route['setting-group/insert'] 							= 'setting/GroupController/insert';
$route['setting-group/update'] 							= 'setting/GroupController/update';
$route['setting-group/del/(:any)'] 						= 'setting/GroupController/del/$1';

$route['setting-akses-group'] 							= 'setting/GroupController/set_akses';

// END GROUP


//MASTER 
// MASTER FUNGSI
$route['master-skpd'] 								= 'master/MasterController/index_skpd';
$route['get-master-skpd'] 							= 'master/MasterController/get_skpd';
$route['get-master-urusan'] 						= 'master/MasterController/get_urusan';
$route['get-master-fungsi'] 						= 'master/MasterController/get_fungsi';

$route['sumber-dana'] 								= 'master/MasterController/index_sd';
$route['get-sumber-dana'] 						    = 'master/MasterController/get_sd';

$route['sumber-dana-perubahan'] 								= 'master/MasterController/index_sd_p';
$route['get-sumber-dana-perubahan'] 						    = 'master/MasterController/get_sd_p';

$route['get-group-sd'] 						    	= 'master/MasterController/get_group_sd';
$route['mapping-sd'] 		    					= 'master/MasterController/mapping_sd';

// program kegiatan
$route['program-kegiatan/skpd'] 					= 'master/MasterController/index_pk_skpd';
$route['get-pk-skpd'] 								= 'master/MasterController/get_pk_skpd';
$route['program-kegiatan/bidang'] 					= 'master/MasterController/index_pk_bidang';
$route['get-pk-bidang/(:any)'] 						= 'master/MasterController/get_pk_bidang/$1';
$route['program-kegiatan/program'] 					= 'master/MasterController/index_pk_program';
$route['get-pk-program/(:any)/(:any)'] 				= 'master/MasterController/get_pk_program/$1/$2';
$route['program-kegiatan/kegiatan'] 				= 'master/MasterController/index_pk_kegiatan';
$route['get-pk-kegiatan/(:any)/(:any)/(:any)'] 		= 'master/MasterController/get_pk_kegiatan/$1/$2/$3';

// rekening
$route['master-rekening-1'] 					    = 'master/MasterRekeningController/rekening1';
$route['get-rekening-1'] 					        = 'master/MasterRekeningController/get_rekening1';

$route['master-rekening-2'] 					    = 'master/MasterRekeningController/rekening2';
$route['get-rekening-2'] 					        = 'master/MasterRekeningController/get_rekening2';

$route['master-rekening-3'] 					    = 'master/MasterRekeningController/rekening3';
$route['get-rekening-3'] 					        = 'master/MasterRekeningController/get_rekening3';

$route['master-rekening-4'] 					    = 'master/MasterRekeningController/rekening4';
$route['get-rekening-4'] 					        = 'master/MasterRekeningController/get_rekening4';

$route['master-rekening-5'] 					    = 'master/MasterRekeningController/rekening5';
$route['get-rekening-5'] 					        = 'master/MasterRekeningController/get_rekening5';


// monitoring-data
$route['monitoring-data'] 						= 'pemantauan/MonitoringController/index';
$route['get-monitoring-skpd'] 					= 'pemantauan/MonitoringController/get_monitoring_skpd';
$route['get-monitoring-program'] 				= 'pemantauan/MonitoringController/get_monitoring_program';
$route['get-monitoring-kegiatan'] 				= 'pemantauan/MonitoringController/get_monitoring_kegiatan';
$route['get-monitoring-rekening-kegiatan'] 		= 'pemantauan/MonitoringController/get_monitoring_rekening_kegiatan';
$route['get-rinci-monitoring-kegiatan'] 		= 'pemantauan/MonitoringController/get_rinci_kegiatan';
$route['input-data-monitoring'] 		    	= 'pemantauan/MonitoringController/input_data_monitoring';
$route['input-data-monitoring-file'] 		    = 'pemantauan/MonitoringController/input_data_monitoring_file';
$route['del-data-monitoring-file'] 		    	= 'pemantauan/MonitoringController/del_data_monitoring_file';

$route['monitoring-detail'] 				= 'pemantauan/MonitoringController/detail';
$route['monitoring-detail-kegiatan'] 		= 'pemantauan/MonitoringController/detail_kegiatan';
$route['monitoring-rekening-kegiatan'] 		= 'pemantauan/MonitoringController/rekening_kegiatan';
$route['input-data-monitoring'] 		    = 'pemantauan/MonitoringController/input_data_monitoring';



// pemantauan
$route['data-pemantauan'] 					= 'pemantauan/PemantauanController/index';
$route['get-pantau-skpd'] 				= 'pemantauan/PemantauanController/get_pantau_skpd';
$route['get-pantau-program'] 				= 'pemantauan/PemantauanController/get_pantau_program';
$route['get-pantau-kegiatan'] 				= 'pemantauan/PemantauanController/get_pantau_kegiatan';
$route['get-pantau-rekening-kegiatan'] 		= 'pemantauan/PemantauanController/get_pantau_rekening_kegiatan';
$route['get-rinci-kegiatan'] 		        = 'pemantauan/PemantauanController/get_rinci_kegiatan';
$route['input-data-pemantauan'] 		    = 'pemantauan/PemantauanController/input_data_pemantauan';
$route['input-data-pemantauan-file'] 		 = 'pemantauan/PemantauanController/input_data_pemantauan_file';
$route['del-data-pemantauan-file'] 		    = 'pemantauan/PemantauanController/del_data_pemantauan_file';
$route['input-data-pemantauan-kontrak'] 		 = 'pemantauan/PemantauanController/input_data_pemantauan_kontrak';
$route['del-data-pemantauan-kontrak'] 		    = 'pemantauan/PemantauanController/del_data_pemantauan_kontrak';

$route['get-dokumentasi'] 		        = 'pemantauan/PemantauanController/get_rinci_dokumentasi';
$route['aktif-dokumentasi'] 		        = 'pemantauan/PemantauanController/aktif_dokumentasi';


$route['get-pemantauan-skpd'] 				= 'pemantauan/PemantauanController/get_pemantauan_skpd';
$route['pemantauan-detail'] 				= 'pemantauan/PemantauanController/detail';
$route['get-pemantauan-detail'] 			= 'pemantauan/PemantauanController/get_pemantauan_detail';
$route['pemantauan-detail-kegiatan'] 		= 'pemantauan/PemantauanController/detail_kegiatan';
$route['pemantauan-rekening-kegiatan'] 		= 'pemantauan/PemantauanController/rekening_kegiatan';
$route['get-pemantauan-detail-kegiatan'] 	= 'pemantauan/PemantauanController/get_pemantauan_detail_kegiatan';

$route['get-header-kegiatan'] 				= 'pemantauan/PemantauanController/get_header_kegiatan';
$route['get-target-kegiatan'] 				= 'pemantauan/PemantauanController/get_target_kegiatan';
$route['get-realisasi-kegiatan'] 				= 'pemantauan/PemantauanController/get_realisasi_kegiatan';


$route['rekapitulasi-capaian-kinerja-kab'] 		                = 'laporan/LaporanController/rekapitulasi_kab';
$route['rekapitulasi-capaian-kab-pdf/(:any)']            = 'laporan/LaporanController/rekapitulasi_kab_pdf/$1';
$route['rekapitulasi-capaian-kab-excel/(:any)']            = 'laporan/LaporanController/rekapitulasi_kab_excel/$1';

$route['rekapitulasi-capaian-kinerja-kab-perubahan']            = 'laporan/LaporanUbahController/rekapitulasi_kab';
$route['rekapitulasi-capaian-kab-perubahan-pdf/(:any)']  = 'laporan/LaporanUbahController/rekapitulasi_kab_pdf/$1';
$route['rekapitulasi-capaian-kab-perubahan-excel/(:any)']  = 'laporan/LaporanUbahController/rekapitulasi_kab_excel/$1';


$route['rekapitulasi-capaian-kinerja'] 		                = 'laporan/LaporanController/rekapitulasi';
$route['rekapitulasi-capaian-pdf/(:any)/(:any)']            = 'laporan/LaporanController/rekapitulasi_pdf/$1/$2';
$route['rekapitulasi-capaian-excel/(:any)/(:any)']            = 'laporan/LaporanController/rekapitulasi_excel/$1/$2';

$route['rekapitulasi-capaian-kinerja-perubahan']            = 'laporan/LaporanUbahController/rekapitulasi';
$route['rekapitulasi-capaian-perubahan-pdf/(:any)/(:any)']  = 'laporan/LaporanUbahController/rekapitulasi_pdf/$1/$2';
$route['rekapitulasi-capaian-perubahan-excel/(:any)/(:any)']  = 'laporan/LaporanUbahController/rekapitulasi_excel/$1/$2';


$route['realisasi-detail-kegiatan'] 		= 'laporan/LaporanController/realisasi_detail_kegiatan';
$route['realisasi-detail-kegiatan-pdf/(:any)/(:any)/(:any)']          = 'laporan/LaporanController/realisasi_detail_kegiatan_pdf/$1/$2/$3';
$route['realisasi-detail-kegiatan-excel/(:any)/(:any)/(:any)']          = 'laporan/LaporanController/realisasi_detail_kegiatan_excel/$1/$2/$3';

$route['realisasi-detail-kegiatan-perubahan'] = 'laporan/LaporanUbahController/realisasi_detail_kegiatan';
$route['realisasi-detail-kegiatan-perubahan-pdf/(:any)/(:any)/(:any)']          = 'laporan/LaporanUbahController/realisasi_detail_kegiatan_pdf/$1/$2/$3';
$route['realisasi-detail-kegiatan-perubahan-excel/(:any)/(:any)/(:any)']          = 'laporan/LaporanUbahController/realisasi_detail_kegiatan_excel/$1/$2/$3';

$route['dpa'] 	                			= 'pemantauan/DpaController/index';
$route['dppa'] 	                			= 'pemantauan/DppaController/index';
$route['dpa-get-combo-skpd'] 	            = 'pemantauan/DpaController/get_combo_skpd';
$route['dpa-get-combo-kegiatan'] 	        = 'pemantauan/DpaController/get_combo_kegiatan';
$route['dpa22-pdf/(:any)']         	        = 'pemantauan/DpaController/dpa22/$1';
$route['dpa221-pdf/(:any)/(:any)']         	= 'pemantauan/DpaController/dpa221/$1/$2';
$route['dppa22-pdf/(:any)']         	    = 'pemantauan/DppaController/dppa22/$1';
$route['dppa221-pdf/(:any)/(:any)']         = 'pemantauan/DppaController/dppa221/$1/$2';

$route['dpa22-excel/(:any)']         	        = 'pemantauan/DpaController/dpa22_excel/$1';
$route['dpa221-excel/(:any)/(:any)']         	= 'pemantauan/DpaController/dpa221_excel/$1/$2';
$route['dppa22-excel/(:any)']         	    = 'pemantauan/DppaController/dppa22_excel/$1';
$route['dppa221-excel/(:any)/(:any)']         = 'pemantauan/DppaController/dppa221_excel/$1/$2';


// profil
$route['data-umum-daerah'] 	                = 'profil/DataUmumController/index';
$route['add-data-umum'] 	                = 'profil/DataUmumController/add_data_umum';
$route['edit-data-umum'] 	                = 'profil/DataUmumController/edit_data_umum';
$route['insert-data-umum'] 	                = 'profil/DataUmumController/insert_data_umum';
$route['update-data-umum'] 	                = 'profil/DataUmumController/update_data_umum';
$route['hapus-data-umum'] 	                = 'profil/DataUmumController/hapus_data_umum';
$route['get-data-umum'] 	                = 'profil/DataUmumController/get_data_umum';

// end emonev









$route['admin'] 									= 'admin/auth';
$route['login'] 									= 'admin/auth/login';
$route['logout'] 									= 'admin/auth/logout';
$route['dashboard'] 								= 'admin/dashboard/index';

$route['pencarian-kegiatan'] 						= 'admin/dashboard/pencarian';
$route['search-kegiatan']    						= 'admin/dashboard/search_kegiatan';

$route['info-dashboard'] 							= 'FrontController';
$route['get-combo-skpd-all'] 	                    = 'FrontController/get_combo_skpd';
$route['get-rinci-dokumentasi'] 					= 'FrontController/get_rinci_kegiatan';


$route['dashboard/get_tree'] 						= 'admin/dashboard/get_tree';
$route['dashboard/mpdf'] 							= 'admin/dashboard/mpdf';






$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;