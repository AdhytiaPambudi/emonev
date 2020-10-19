<link rel="stylesheet" href="<?= base_url() ?>assets/budistyle/css/form/all-type-forms.css">

<!-- Single pro tab review Start-->
<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-payment-inner-st">
                    <ul id="myTabedu1" class="tab-review-design">
                        <li class="active"><a href="#backup_tab">Backup Database</a></li>
                        <li><a href="#restore_tab">Restore Database</a></li>
                        <li><a href="#transfer_tab">Transfer Data Keuangan</a></li>
                        <li><a href="#xml_tab">Transfer Data Keuangan (XML)</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <div class="product-tab-list tab-pane fade active in" id="backup_tab">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section" style="height:450px;">
                                        <div id="dropzone1" class="pro-ad">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div id="loading-icon" style="text-align:center"></div>
                                                    <div class="payment-adress">
                                                        <button type="button" class="btn btn-primary waves-effect waves-light" id="backup">Backup</button>
                                                        <button type="button" class="btn btn-primary waves-effect waves-light" id="download">Download</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade" id="restore_tab">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section" style="height:450px;">
                                        
                                            <form id="form-restore" enctype="multipart/form-data" method="post">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                                        <label class="login2">Pilih File</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="file-upload-inner file-upload-inner-right ts-forms">
                                                            <div class="input append-small-btn">
                                                                <div class="file-button">
                                                                    Browse
                                                                    <input type="file" id="file_restore" onchange="validateFormat(this)" name="file_restore">
                                                                </div>
                                                                <input type="text" id="nm_file_restore" name="nm_file_restore" placeholder="File Restore (.sql)" readonly="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><hr>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div id="loading-icon-restore" style="text-align:center"></div>
                                                        <div class="payment-adress">
                                                            <input type="submit"  value="Restore" id="restore_db" class="btn btn-success waves-effect waves-light">
                                                            <!-- <button type="button" class="btn btn-primary waves-effect waves-light" id="restore">Restore</button> -->
                                                            <!-- <button type="button" class="btn btn-success waves-effect waves-light" id="restore">Download</button> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade " id="transfer_tab">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section" style="height:450px;">
                                        <div id="dropzone1" class="pro-ad">
                                        <div class="widget-program-bg">
                                                    <div class="container-fluid">
                                                        <div class="row">

                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Anggaran</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="anggaran">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="anggaran">Import</button>
                                                                            </p>

                                                                            <small id ="lastUpdateAnggaran">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data RKA (Keu)</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="rka">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="rka">Import</button>
                                                                            </p>
                                                                            <small id ="lastUpdateRKA">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Rincian</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="rincian">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="rincian">Import</button>
                                                                            </p>

                                                                            <small id ="lastUpdateRincian">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data SKPD</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="skpd">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="skpd">Import</button>
                                                                            </p>

                                                                            <small id ="lastUpdateSKPD">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>



                                                
                                                <div class="widget-program-bg">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Fungsi</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="fungsi">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="fungsi">Import</button>
                                                                            </p>
                                                                            <small id ="lastUpdateFungsi">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Urusan</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="urusan">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="urusan">Import</button>
                                                                            </p>

                                                                            <small id ="lastUpdateUrusan">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data TAPD</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="tapd">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="tapd">Import</button>
                                                                            </p>

                                                                            <small id ="lastUpdateTAPD">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data TTD</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="ttd">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="ttd">Import</button>
                                                                            </p>

                                                                            <small id ="lastUpdateTTD">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="widget-program-bg">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <!-- <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data - </h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="-">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="-">Import</button>
                                                                            </p>

                                                                            <small id ="lastUpdate-">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Sumber Dana</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="sumberdana">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="sumberdana">Import</button>
                                                                            </p>
                                                                            <small id ="lastUpdateSumberDana">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Rek. Anggaran</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="rekAnggaran">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="rekAnggaran">Import</button>
                                                                            </p>

                                                                            <small id ="lastUpdateRekAnggaran">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Rek. Laporan</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="rekLaporan">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="rekLaporan">Import</button>
                                                                            </p>

                                                                            <small id ="lastUpdateRekLaporan">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row" hidden>
                                                    <div class="col-lg-12">
                                                        <div id="loading-icon" style="text-align:center">
                                                            
                                                        </div>
                                                        <div class="payment-adress">
                                                            <button type="button" class="btn btn-primary waves-effect waves-light" id="backup">Transfer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-tab-list tab-pane fade " id="xml_tab">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section" style="height:450px;">
                                        <div id="dropzone1" class="pro-ad">
                                        <div class="widget-program-bg">
                                                    <div class="container-fluid">
                                                        <div class="row">

                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbgyellow bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <form id="form-anggaran" enctype="multipart/form-data" method="post">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Anggaran</h3>
                                                                            <div class="file-upload-inner file-upload-inner-right ts-forms">
                                                                                <div class="input append-small-btn">
                                                                                    <div class="file-button">
                                                                                        Browse
                                                                                        <input type="file" id="file_anggaran" onchange="validateFormatXML(this,'nm_file_anggaran')" name="file_anggaran">
                                                                                    </div>
                                                                                    <input type="text" id="nm_file_anggaran" name="nm_file_anggaran" placeholder="File (.xml)" readonly="">
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <input type="submit"  value="Import" id="tf_anggaran" class="btn btn-success waves-effect waves-light">
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbgyellow bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <form id="form-rka" enctype="multipart/form-data" method="post">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data RKA (Keu)</h3>
                                                                            <div class="file-upload-inner file-upload-inner-right ts-forms">
                                                                                <div class="input append-small-btn">
                                                                                    <div class="file-button">
                                                                                        Browse
                                                                                        <input type="file" id="file_rka" onchange="validateFormatXML(this,'nm_file_rka')" name="file_rka">
                                                                                    </div>
                                                                                    <input type="text" id="nm_file_rka" name="nm_file_rka" placeholder="File (.xml)" readonly="">
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <input type="submit"  value="Import" id="tf_rka" class="btn btn-success waves-effect waves-light">
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbgyellow bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <form id="form-rincian" enctype="multipart/form-data" method="post">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Rincian</h3>
                                                                            <div class="file-upload-inner file-upload-inner-right ts-forms">
                                                                                <div class="input append-small-btn">
                                                                                    <div class="file-button">
                                                                                        Browse
                                                                                        <input type="file" id="file_rincian" onchange="validateFormatXML(this,'nm_file_rincian')" name="file_rincian">
                                                                                    </div>
                                                                                    <input type="text" id="nm_file_rincian" name="nm_file_rincian" placeholder="File (.xml)" readonly="">
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <input type="submit"  value="Import" id="tf_rincian" class="btn btn-success waves-effect waves-light">
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbgyellow bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <form id="form-skpd" enctype="multipart/form-data" method="post">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data SKPD</h3>
                                                                            <div class="file-upload-inner file-upload-inner-right ts-forms">
                                                                                <div class="input append-small-btn">
                                                                                    <div class="file-button">
                                                                                        Browse
                                                                                        <input type="file" id="file_skpd" onchange="validateFormatXML(this,'nm_file_skpd')" name="file_skpd">
                                                                                    </div>
                                                                                    <input type="text" id="nm_file_skpd" name="nm_file_skpd" placeholder="File (.xml)" readonly="">
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <input type="submit"  value="Import" id="tf_skpd" class="btn btn-success waves-effect waves-light">
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>



                                                
                                                <div class="widget-program-bg">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbgyellow bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <form id="form-fungsi" enctype="multipart/form-data" method="post">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Fungsi</h3>
                                                                            <div class="file-upload-inner file-upload-inner-right ts-forms">
                                                                                <div class="input append-small-btn">
                                                                                    <div class="file-button">
                                                                                        Browse
                                                                                        <input type="file" id="file_fungsi" onchange="validateFormatXML(this,'nm_file_fungsi')" name="file_fungsi">
                                                                                    </div>
                                                                                    <input type="text" id="nm_file_fungsi" name="nm_file_fungsi" placeholder="File (.xml)" readonly="">
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <input type="submit"  value="Import" id="tf_fungsi" class="btn btn-success waves-effect waves-light">
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbgyellow bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <form id="form-urusan" enctype="multipart/form-data" method="post">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Urusan</h3>
                                                                            <div class="file-upload-inner file-upload-inner-right ts-forms">
                                                                                <div class="input append-small-btn">
                                                                                    <div class="file-button">
                                                                                        Browse
                                                                                        <input type="file" id="file_urusan" onchange="validateFormatXML(this,'nm_file_urusan')" name="file_urusan">
                                                                                    </div>
                                                                                    <input type="text" id="nm_file_urusan" name="nm_file_urusan" placeholder="File (.xml)" readonly="">
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <input type="submit"  value="Import" id="tf_urusan" class="btn btn-success waves-effect waves-light">
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbgyellow bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <form id="form-tapd" enctype="multipart/form-data" method="post">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data TAPD</h3>
                                                                            <div class="file-upload-inner file-upload-inner-right ts-forms">
                                                                                <div class="input append-small-btn">
                                                                                    <div class="file-button">
                                                                                        Browse
                                                                                        <input type="file" id="file_tapd" onchange="validateFormatXML(this,'nm_file_tapd')" name="file_tapd">
                                                                                    </div>
                                                                                    <input type="text" id="nm_file_tapd" name="nm_file_tapd" placeholder="File (.xml)" readonly="">
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <input type="submit"  value="Import" id="tf_tapd" class="btn btn-success waves-effect waves-light">
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbgyellow bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <form id="form-ttd" enctype="multipart/form-data" method="post">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data TTD</h3>
                                                                            <div class="file-upload-inner file-upload-inner-right ts-forms">
                                                                                <div class="input append-small-btn">
                                                                                    <div class="file-button">
                                                                                        Browse
                                                                                        <input type="file" id="file_ttd" onchange="validateFormatXML(this,'nm_file_ttd')" name="file_ttd">
                                                                                    </div>
                                                                                    <input type="text" id="nm_file_ttd" name="nm_file_ttd" placeholder="File (.xml)" readonly="">
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <input type="submit"  value="Import" id="tf_ttd" class="btn btn-success waves-effect waves-light">
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="widget-program-bg" hidden>
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <!-- <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data - </h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="-">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="-">Import</button>
                                                                            </p>

                                                                            <small id ="lastUpdate-">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Sumber Dana</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="sumberdana">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="sumberdana">Import</button>
                                                                            </p>
                                                                            <small id ="lastUpdateSumberDana">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Rek. Anggaran</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="rekAnggaran">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="rekAnggaran">Import</button>
                                                                            </p>

                                                                            <small id ="lastUpdateRekAnggaran">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="hpanel shadow-inner hbggreen bg-1 responsive-mg-b-30">
                                                                    <div class="panel-body">
                                                                        <div class="text-center content-bg-pro">
                                                                            <h3>Data Rek. Laporan</h3>
                                                                            <p class="text-big font-light">
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="bpddata" data-tbl="rekLaporan">My Data</button>
                                                                                <button class="btn btn-warning widget-btn-4 btn-sm check-data" data-db="keudata" data-tbl="rekLaporan">Import</button>
                                                                            </p>

                                                                            <small id ="lastUpdateRekLaporan">Terakhir Update : - </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row" hidden>
                                                    <div class="col-lg-12">
                                                        <div id="loading-icon" style="text-align:center">
                                                            
                                                        </div>
                                                        <div class="payment-adress">
                                                            <button type="button" class="btn btn-primary waves-effect waves-light" id="backup">Transfer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="fullwidth" class="modal modal-edu-general fullwidth default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="namaTable">NAMA TABEL
                </h4>
            </div>
            <div class="modal-body" id="isiModalDatabase">
                
            </div>
            <div class="modal-footer">
                
                <a id="import-data" href="#" class="hidden">Import</a>
                <a data-dismiss="modal" href="#">Tutup</a>
                                    
            </div>
        </div>
    </div>
</div> 


 


<script type="text/javascript">

    $(window).on('load', function () {
        
        $.ajax({
            url: '<?php echo base_url('get-last-update-database'); ?>',
            type: 'POST',
            success: function(data){
                var res = jQuery.parseJSON(data);
                $("#lastUpdateAnggaran").html(res.anggaran);
                $("#lastUpdateRKA").html(res.rka);
                $("#lastUpdateRincian").html(res.rincian);
                $("#lastUpdateSKPD").html(res.skpd);
                $("#lastUpdateFungsi").html(res.fungsi);
                $("#lastUpdateUrusan").html(res.urusan);
                $("#lastUpdateTAPD").html(res.tapd);
                $("#lastUpdateTTD").html(res.ttd);
                $("#lastUpdateSumberDana").html(res.sumberdana);
                $("#lastUpdateRekAnggaran").html(res.rekening);
            }
          });
    });

    function validateFormat(fileInput){
    // var selectedFile = objFileControl.value;
    // console.log(objFileControl.files[0].type); 
                
                var filePath = fileInput.value; 
                const fileSize = fileInput.files[0].size;
                const size = Math.round((fileSize / 1024)); 

                
                // Allowing file type 

                var allowedExtensions =  
                        /(\.sql)$/i; 
                
                if (!allowedExtensions.exec(filePath)) { 
                    Swal.fire({
                        position: 'top-end',
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Tipe File Tidak Diperbolehkan!',
                        showConfirmButton: false,
                        timer: 2000
                        });
                    fileInput.value = ''; 
                    return false; 
                }  else{
                    var nmfile = filePath.replace("C:\\fakepath\\", "")
                     $('#nm_file_restore').val(nmfile);
                }

                // if (size > 1024) { 
                //     Swal.fire({
                //     position: 'top-end',
                //         icon: 'error',
                //         title: 'Oops...',
                //         text: 'Ukuran File Terlalu Besar! Maksimal Ukuran File : 1 MB',
                //     showConfirmButton: false,
                //     timer: 2000
                //     });
                //     fileInput.value = ''; 
                //     return false; 
                // }
            
    }

    function validateFormatXML(fileInput,nm){
    // var selectedFile = objFileControl.value;
    // console.log(objFileControl.files[0].type); 
                
                var filePath = fileInput.value; 
                const fileSize = fileInput.files[0].size;
                const size = Math.round((fileSize / 1024)); 

                
                // Allowing file type 

                var allowedExtensions =  
                        /(\.xml)$/i; 
                
                if (!allowedExtensions.exec(filePath)) { 
                    Swal.fire({
                        position: 'top-end',
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Tipe File Tidak Diperbolehkan!',
                        showConfirmButton: false,
                        timer: 2000
                        });
                    fileInput.value = ''; 
                    return false; 
                }  else{
                    var nmfile = filePath.replace("C:\\fakepath\\", "")
                     $('#'+nm).val(nmfile);
                }

                // if (size > 1024) { 
                //     Swal.fire({
                //     position: 'top-end',
                //         icon: 'error',
                //         title: 'Oops...',
                //         text: 'Ukuran File Terlalu Besar! Maksimal Ukuran File : 1 MB',
                //     showConfirmButton: false,
                //     timer: 2000
                //     });
                //     fileInput.value = ''; 
                //     return false; 
                // }
            
    }


    // $(document).on("click", "#restore", function() {
        

    //     $("#loading-icon-restore").html('<center><img src="<?php echo base_url('assets/img/loading.gif'); ?>" alt="Loading" height="42" width="42"><br>Dalam Proses, Harap Tunggu ...<br></center>');
    //     $.ajax({
    //         url: '<?php echo base_url('restore-database'); ?>',
    //         type: 'POST',
    //         success: function(data){

    //             if (data == 1) {
    //                 Lobibox.notify('info', {
    //                     size: 'mini',
    //                     msg: 'Database Berhasil di Restore'
    //                 });
    //             }else{
    //                 Lobibox.notify('danger', {
    //                     size: 'mini',
    //                     msg: 'Database Gagal di Restore'
    //                 });
    //             }
    //             $("#loading-icon-restore").html('');
    //         }
    //       });
    //   });

    $('#form-restore').submit(function(e) {
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url('restore-database'); ?>',
            data: new FormData(this),
            contentType:false,
            cache : false,
            processData:false,
          })
          .done(function(data) {
            var out = jQuery.parseJSON(data);
            
            //  if (out.msg == 1) {
            //     Lobibox.notify('info', {
            //         size: 'mini',
            //         msg: 'Database Berhasil di Restore'
            //     });
            // }else{
            //     Lobibox.notify('danger', {
            //         size: 'mini',
            //         msg: 'Database Gagal di Restore'
            //     });
            // }
            $("#loading-icon-restore").html(out.html);
            var inputFile = $("#file_restore");
            inputFile.replaceWith(inputFile.val('').clone(true));
            $("#nm_file_restore").val('');
          })
          e.preventDefault();
            
    
    });

    $('#form-anggaran').submit(function(e) {
        var text = $('#nm_file_anggaran').val();
        if (text == '') {
            alert('HARAP PILIH FILE');
            e.preventDefault();
            exit();
        
        }else{

            $('#tf_anggaran').val('Sedang Diporses...');
            $('#tf_anggaran').attr('disabled',true);

            $.ajax({
            method: 'POST',
            url: '<?php echo base_url('transfer-anggaran'); ?>',
            data: new FormData(this),
            contentType:false,
            cache : false,
            processData:false,
          })
          .done(function(data) {
            var out = jQuery.parseJSON(data);
            alert(out.pesan);
            var inputFile = $("#file_anggaran");
            inputFile.replaceWith(inputFile.val('').clone(true));
            $("#nm_file_anggaran").val('');
            $('#tf_anggaran').val('Import');
            $('#tf_anggaran').removeAttr('disabled');
          })
          e.preventDefault();
        }
         e.preventDefault();
    });



    $('#form-tapd').submit(function(e) {
        var text = $('#nm_file_tapd').val();
        if (text == '') {
            alert('HARAP PILIH FILE');
            e.preventDefault();
            exit();
        
        }else{

            $('#tf_tapd').val('Sedang Diporses...');
            $('#tf_tapd').attr('disabled',true);

            $.ajax({
            method: 'POST',
            url: '<?php echo base_url('transfer-tapd'); ?>',
            data: new FormData(this),
            contentType:false,
            cache : false,
            processData:false,
          })
          .done(function(data) {
            var out = jQuery.parseJSON(data);
            alert(out.pesan);
            var inputFile = $("#file_tapd");
            inputFile.replaceWith(inputFile.val('').clone(true));
            $("#nm_file_tapd").val('');
            $('#tf_tapd').val('Import');
            $('#tf_tapd').removeAttr('disabled');
          })
          e.preventDefault();
        }
         e.preventDefault();
    });


    $('#form-ttd').submit(function(e) {

        var text = $('#nm_file_ttd').val();
        if (text == '') {
            alert('HARAP PILIH FILE');
            e.preventDefault();
            exit();
        
        }else{
            $('#tf_ttd').val('Sedang Diporses...');
            $('#tf_ttd').attr('disabled',true);
            $.ajax({
            method: 'POST',
            url: '<?php echo base_url('transfer-ttd'); ?>',
            data: new FormData(this),
            contentType:false,
            cache : false,
            processData:false,
          })
          .done(function(data) {
            var out = jQuery.parseJSON(data);
            
            alert(out.pesan);
            var inputFile = $("#file_ttd");
            inputFile.replaceWith(inputFile.val('').clone(true));
            $("#nm_file_ttd").val('');
            $('#tf_ttd').val('Import');
            $('#tf_ttd').removeAttr('disabled');
          })
          e.preventDefault();
        }
         e.preventDefault();
    });

    $('#form-urusan').submit(function(e) {
        var text = $('#nm_file_urusan').val();
        if (text == '') {
            alert('HARAP PILIH FILE');
            e.preventDefault();
            exit();
        
        }else{

            $('#tf_urusan').val('Sedang Diporses...');
            $('#tf_urusan').attr('disabled',true);

            $.ajax({
            method: 'POST',
            url: '<?php echo base_url('transfer-urusan'); ?>',
            data: new FormData(this),
            contentType:false,
            cache : false,
            processData:false,
          })
          .done(function(data) {
            var out = jQuery.parseJSON(data);
            alert(out.pesan);
            var inputFile = $("#file_urusan");
            inputFile.replaceWith(inputFile.val('').clone(true));
            $("#nm_file_urusan").val('');
            $('#tf_urusan').val('Import');
            $('#tf_urusan').removeAttr('disabled');
          })
          e.preventDefault();
        }
         e.preventDefault();
    });

   $('#form-fungsi').submit(function(e) {
        var text = $('#nm_file_fungsi').val();
        if (text == '') {
            alert('HARAP PILIH FILE');
            e.preventDefault();
            exit();
        
        }else{

            $('#tf_fungsi').val('Sedang Diporses...');
            $('#tf_fungsi').attr('disabled',true);

            $.ajax({
            method: 'POST',
            url: '<?php echo base_url('transfer-fungsi'); ?>',
            data: new FormData(this),
            contentType:false,
            cache : false,
            processData:false,
          })
          .done(function(data) {
            var out = jQuery.parseJSON(data);
            alert(out.pesan);
            var inputFile = $("#file_fungsi");
            inputFile.replaceWith(inputFile.val('').clone(true));
            $("#nm_file_fungsi").val('');
            $('#tf_fungsi').val('Import');
            $('#tf_fungsi').removeAttr('disabled');
          })
          e.preventDefault();
        }
         e.preventDefault();
    });




    $(document).on("click", "#backup", function() {
        $("#loading-icon").html('<center><img src="<?php echo base_url('assets/budistyle/img/load.gif'); ?>" alt="Loading" height="60" width="60" style="padding-top:50px;"><br>Harap Tunggu...</center>');
        $.ajax({
            url: '<?php echo base_url('backup-database'); ?>',
            type: 'POST',
            success: function(data){
              // $("#menu-pengawasan").html(data);

                if (data == 1) {
                    Lobibox.notify('info', {
                        size: 'mini',
                        msg: 'Database Berhasil di Backup'
                    });
                }else{
                    Lobibox.notify('danger', {
                        size: 'mini',
                        msg: 'Database Gagal di Backup'
                    });
                }
                $("#loading-icon").html('');
            }
          });
      });

      $(document).on("click", "#download", function() {
            window.open('<?php echo base_url('download-database'); ?>', '_blank');	
      });

    $(document).on("click", ".check-data", function() {
        var tbl      = $(this).attr("data-tbl");
        var db      = $(this).attr("data-db");
         $('body').prelodr({
          prefixClass: 'prelodr',
          show: function(){
            console.log('Show callback')
          },
          hide: function(){
            console.log('Hide callback')
          }
        })
        $('body').prelodr('in', 'Sedang diproses...');
        $.ajax({
            url: '<?php echo base_url('check-data-database'); ?>',
            type: 'POST',
            data:{db:db,tbl:tbl},
            success: function(data){
                $('body').prelodr('out');
                var res = jQuery.parseJSON(data);
                $('#isiModalDatabase').html(res.preview);
                $('#namaTable').html(res.judul);
                $('#fullwidth').modal('show');
                
                $('#import-data').attr('data-db',db);
                $('#import-data').attr('data-tbl',tbl);
                if (db == 'bpddata') {
                    $('#import-data').attr('class','hidden');   
                }else{
                    $('#import-data').removeAttr('class');   
                }
            },
            error: function(data){
                $('body').prelodr('out');
                $('#isiModalDatabase').html(data.statusText);
                $('#namaTable').html('Error '+data.status);
                $('#fullwidth').modal('show');
            }
        });
        
    });

     $(document).on("click", "#import-data", function() {
        var tbl      = $(this).attr("data-tbl");
        var db      = $(this).attr("data-db");

         $('body').prelodr({
          prefixClass: 'prelodr',
          show: function(){
            console.log('Show callback')
          },
          hide: function(){
            console.log('Hide callback')
          }
        })
        $('body').prelodr('in', 'Sedang diproses...');

        $.ajax({
            url: '<?php echo base_url('importdata-database'); ?>',
            type: 'POST',
            data:{db:db,tbl:tbl},
            success: function(data){
                $('body').prelodr('out');
                
                Lobibox.notify('info', {
                    size: 'mini',
                    msg: 'Tabel Berhasil di Transfer'
                });

                var res = jQuery.parseJSON(data);
                $('#isiModalDatabase').html(res.preview);
                $('#namaTable').html(res.judul);
                $('#modalDatabase').modal('hide');
            }
          });
        
      });



</script>

<script src="<?= base_url() ?>assets/budistyle/js/dropzone/dropzone.js"></script>