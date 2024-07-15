<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-header">
          Data Jeep Tour | Admin
        </div>
        <div class="card-body">
          <a href="<?= base_url('paketour/add') ?>" class="btn btn-primary">Tambah Data</a>
          <hr>
          <?php
          // Handle empty list scenario
          if (empty($list)) {
            echo '<div class="alert alert-info">Tidak ada data Jeep ditemukan.</div>';
          } else {
            $this->session->flashdata('message'); // Display flash messages
          }
          ?>
          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <!-- <th scope="col">#</th> -->
                <th scope="col">Id_Paket</th>
                <th scope="col">Nama Paket</th>
                <th scope="col">Harga Paket Short/ Medium/ Long</th>
                <!-- <?php
                // Display short price only if no medium/long prices exist
                if (!isset($l->harga_medium) || !isset($l->harga_long)) {
                  echo '<th scope="col">Harga</th>';
                } else {
                  echo '<th scope="col">Harga Short / Medium / Long</th>';
                }
                ?> -->
                <th scope="col">Foto</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($list as $l) {
                ?>
                <tr>
                  <th scope="row"><?= $i ?></th>
                  <td><?= $l->nama_paket ?></td>
                  <td><?=rupiah($l->harga_short)?> / <?=rupiah($l->harga_medium)?> / <?=rupiah($l->harga_long)?></td>
                  <td>
                    <img class="img-thumbnail" style="width: 200px;" src="<?= base_url('assets/images/apartement/') . $l->foto ?>">
                  </td>
                  <td>
                  <a href="<?=base_url('paketour/edit/'.$l->id_paket)?>" class="btn btn-info btn-sm">Edit</a>
                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" href="<?=base_url('paketour/delete/'.$l->id_paket)?>" class="btn btn-danger btn-sm">Hapus</a>
                  </div>
                  </td>
            
        
      </div>
    </div>
    <?php $i++;}
  ?>
      </tbody>
        </table>