<!-- File: application/views/paketour/detail_paket.php -->
<div class="card" id="paketDetailContent">
    <div class="gambar">
        <img src="<?=base_url('assets/images/apartement')."/".$paket->foto?>" class="card-img-top">
    </div>
    <div class="card-body">
        <h5 class="card-title text-purple"><?=$paket->nama_paket?></h5>
        <p class="card-text">Harga Pendek: <?=rupiah($paket->harga_short)?></p>
        <p class="card-text">Harga Sedang: <?=rupiah($paket->harga_medium)?></p>
        <p class="card-text">Harga Panjang: <?=rupiah($paket->harga_long)?></p>
        <p class="card-text">Destinasi: <?=$paket->destinasi?></p>
    </div>
</div>