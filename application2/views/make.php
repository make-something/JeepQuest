<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <span class="text-purple text-bold">Kota</span><br>
              <?=$detail->nama_kota?>
            </div>
            <div class="col-md-3">
              <span class="text-purple text-bold">Nama Jeep Tour</span><br>
              <?=$detail->nama_paket?>
            </div>
            
            <div class="col-md-6">
              <span class="text-purple text-bold">Harga Paket Short / Medium / Long</span><br>
              <?=rupiah($detail->harga_short)?> /
              <?=rupiah($detail->harga_medium)?> /
              <?=rupiah($detail->harga_long)?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Form Pemesanan Jeep Tour
        </div>
        <div class="card-body">
  <?=form_open('order/processOrder/'.$detail->id_paket)?>
    <?=$this->session->flashdata('message')?>
    <div class="form-group">
      <label for="exampleInputEmail1">Paket</label>
      <select name="paket" id="sPaket" onchange="tJumlah()" class="form-control" required>
        <option value="">Pilih Paket</option>
        <?php
        $paket = array('Short','Medium','Long');
        foreach($paket as $p){
          echo '<option value="'.$p.'">'.ucwords($p).'</option>';
        }
        ?>
      </select>
    </div>
    <div class="form-group" id="divJumlah">
      <label for="exampleInputPassword1" id="lJumlah">Jumlah Paket</label>
      <input type="number" name="jumlah_paket" class="form-control" onchange="countCheckOut()" id="iJumlah" placeholder="Jumlah Paket" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Tanggal Keberangkatan</label>
      <input type="date" name="checkin" onchange="countCheckOut()" class="form-control" id="iCheckIn" placeholder="Pilih Tanggal Check In" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Total Bayar</label><br>
      <p class="badge badge-primary" id="pHarga" style="font-size: 30px;font-weight: 300">Rp. 0,-</p>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Jenis Pembayaran</label>
      <select name="jenis_pembayaran" class="form-control" required>
        <option value="">Pilih Jenis Pembayaran</option>
        <?php
        $jenis_pembayaran = array('cash','transfer');
        foreach($jenis_pembayaran as $p){
          echo '<option value="'.$p.'">'.ucwords($p).'</option>';
        }
        ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Bayar</button>
  </form>
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
  function tJumlah() {
    var paket = $('#sPaket').val();
    if (paket !== '') {
      $('#lJumlah').html('Jumlah ' + paket);
      $('#iJumlah').prop('placeholder', 'Masukan Jumlah ' + paket);
      $('#divJumlah').show();
    } else {
      $('#divJumlah').hide();
    }
    countCheckOut();
  }

  function countCheckOut() {
    var paket = $('#sPaket').val();
    var jumlah_penumpang = parseInt($('#iJumlah').val() || 0); // Use parseInt for numeric values
    var checkin = $('#iCheckIn').val();

    if (paket !== '' && jumlah_penumpang > 0) {
      var harga;
      if (paket == 'Short') {
        harga = <?= $detail->harga_short ?>;
      } else if (paket == 'Medium') {
        harga = <?= $detail->harga_medium ?>;
      } else if (paket == 'Long') {
        harga = <?= $detail->harga_long ?>;
      }

      var total = jumlah_penumpang * harga;
      $('#pHarga').html(rupiah(total));
    }
  }

  function rupiah(angka) {
    var rupiah = '';
    var angkakoma = 0;
    var number = angka.toString().split('').reverse().join('');
    for (var i = 0; i < number.length; i++) {
      if (angkakoma > 0) {
        rupiah += ',' + number[i];
      } else {
        rupiah += number[i];
      }
      angkakoma++;
      if (angkakoma == 3 && i < number.length - 1) {
        angkakoma = 0;
      }
    }
    return 'Rp. ' + rupiah.split('').reverse().join('');
  }

  // Panggil tJumlah saat halaman pertama dimuat untuk menetapkan nilai awal
  $(document).ready(function() {
    tJumlah();
  });
</script>
