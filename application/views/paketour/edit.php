<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-header">
          Edit Jeep Tour | Admin
        </div>
        <div class="card-body">

          <?=form_open_multipart()?>
          <?=$this->session->flashdata('message')?>
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Paket</label>
            <input type="text" name="nama_paket" value="<?=$detail->nama_paket?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Nama Jeep" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Kota</label>
            <select name="id_kota" class="form-control" required>
              <option value="">Pilih Kota</option>
              <?php 
              foreach($kota as $k){
                if($k->id_kota==$detail->id_kota){
                  $selected = ' selected';
                }else{
                  $selected = '';
                }
                echo '<option value="'.$k->id_kota.'"'.$selected.'>'.$k->nama_kota.'</option>';
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Harga per Hari</label>
            <input type="number" name="harga_short" value="<?=$detail->harga_short?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Harga per Hari" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Harga per Bulan</label>
            <input type="number" name="harga_medium" value="<?=$detail->harga_medium?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Harga per Bulan" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Harga per Tahun</label>
            <input type="number" name="harga_long" value="<?=$detail->harga_long?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Harga per Tahun" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Foto</label>
            <small class="text-bold">*File yang diizinkan : jpg,png,jpeg</small>
            <br><img class="img-thumbnail" style="width: 200px" src="<?=base_url('assets/images/apartement')."/".$detail->foto?>"><br><br>
            <input type="file" name="foto">
          </div>

          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>