<div class="container" style="margin-top: 30px;">
    <label for="validationDefaultUsername"><h4>Siapkah untuk menjelajahi Alam?</h4></label>
    <form class="form-inline">
        <div class="input-group" style="width: 100%">
            <!-- <select name="id_kota" class="form-control form-control-lg">
                <option value="">Pilih Penyedia ...</option>
                <?php 
                foreach($kota as $k){
                    echo '<option value="'.$k->id_kota.'">'.$k->nama_kota.'</option>';
                }
                ?>
            </select>
            <div class="input-group-prepend">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div> -->
        </div>
    </form>
    <hr>
    <div class="row">
    <?php 
    $i=1;
    if(empty($list)){
        echo "<div class='col-md-12'><center><h2>Data tidak ditemukan</h2></center></div>";
    }else{
    foreach($list as $l){
    ?>
    <div class="col-md-4" style="margin-bottom: 20px;">
        <div class="card">
            <div class="gambar">
                <img src="<?=base_url('assets/images/apartement')."/".$l->foto?>" class="card-img-top">
            </div>
            <div class="card-body">
                <h5 class="card-title text-purple"><?=$l->nama_paket?></h5>
                <p class="card-text"><small>Mulai dari</small><br><?=rupiah($l->harga_short)?> / Paket <span class="text-bold float-right">Kapasitas 4 Orang</span></p>
                <a href="<?=base_url('order/make/'.$l->id_paket)?>" class="btn btn-block btn-primary">Pesan</a>
                <a href="#" onclick="getDetailPaket(<?=$l->id_paket?>); return false;" class="btn btn-block btn-secondary">Detail</a>
            </div>
        </div>
    </div>
    <?php $i++; } 
    } ?>
</div>

<!-- Modal untuk menampilkan detail paket -->
<div class="modal fade" id="detailPaketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="paketDetailContent">
               <div class="card-body"> 
                <div class="gambar">
                    <img src="<?=base_url('assets/images/paket')."/".$paket->foto?>" class="card-img-top">
                </div>
                <div class="card-body">
                    <h5 class="card-title text-purple"><?=$paket->nama_paket?></h5>
                    <p class="card-text">Harga Pendek: <?=rupiah($paket->harga_short)?></p>
                    <p class="card-text">Harga Sedang: <?=rupiah($paket->harga_medium)?></p>
                    <p class="card-text">Harga Panjang: <?=rupiah($paket->harga_long)?></p>
                    <p class="card-text">Destinasi: <?=$paket->destinasi?></p>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Pastikan jQuery dan Bootstrap sudah dimuat sebelum script AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    function getDetailPaket(id_paket) {
        $.ajax({
            url: '<?=base_url("Paketour/get_detail_paket_api")?>',
            type: 'GET',
            data: {id_paket: id_paket},
            success: function(response) {
                console.log(response);
                $('#paketDetailContent').empty().html(response); // Isi konten detail paket ke dalam elemen dengan id 'paketDetailContent'
                $('#detailPaketModal').modal('show'); // Tampilkan modal dengan id 'detailPaketModal'
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    }
</script>

</div>

<!-- <script>
    function getDetailPaket(id_paket) {
        $.ajax({
            url: '<?=base_url("Paketour/get_detail_paket")?>', 
            type: 'POST',
            data: {id_paket: id_paket},
            success: function(response) {
                $('#paketDetailContent').html(response);
                $('#detailPaketModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
    }
</script>
 -->

<!-- Modal for displaying package details -->
<!-- <div class="modal fade" id="detailPaketModal" tabindex="-1" role="dialog" aria-labelledby="detailPaketModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailPaketModalLabel">Detail Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="paketDetailContent">
                 Details will be loaded here -->
       <!--      </div>
        </div>
    </div>
</div>  --> 
