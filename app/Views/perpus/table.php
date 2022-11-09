<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
   rel="stylesheet" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" 
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"
 ></script>
<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<div class="col-sm-12 col-xs-12"></div>

<div class="container">
  <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>

  <table id="table-perpus" class="datatable table table-bordered">
    <thead>
        <tr>
          <th>No</th>
          <th>Nama Lengkap</th>
          <th>Gender</th>
          <th>Tgl lahir</th>
          <th>level</th>
          <th>Email</th>
          <th>Sandi</th>
          <th>Nohp</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
    </thead>
  </table>
</div>

<div id="modalForm" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Perpus</Form></h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formPerpus" method="post" action="<?=base_url('perpus')?>">
          <input type="hidden" name="id" />
          <input type="hidden" name="_method" />
          <div class="mb-3">
            <label class="form-label">nama lengkap</label>
            <input type="text" name="nama lengkap" class="form-control" />
          </div>
          <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="gender" class="form-control">
              <option>Pilih Jenis Kelamin</option>
              <option value="L">Laki-Laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">tgl lahir</label>
            <input type="date" name="tgl lahir" class="form-control" />
          </div>
          <div class="mb-3">
            <label class="form-label">level</label>
            <select name="level" class="form-control">
              <option>Pilih Jenis level</option>
              <option value="P">Platinum</option>
              <option value="K">King</option>
            </select> 
          </div>
          <div class="mb-3">
            <label class="form-label">Alamat Email</label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Sandi</label>
            <input type="password" name="sandi" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Nohp</label>
            <input type="text" name="nohp" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" id='btn-kirim'>kirim</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function(){
    $('form#formPerpus').submitAjax({
      pre:()=>{
        $('button#btn-kirim').hide();
      },
      pasca:()=>{
        $('button#btn-kirim').show();
      },
      success:(response, status)=>{
        $("#modalForm").modal('hide');
        $("table#table-perpus").DataTable().ajax.reload();
      },
      error:(xhr, status)=>{
        alert('Maaf, data pengguna gagal di rekam');
      }
    });
    $('button#btn-kirim').on('click', function(){
      $('form#formPerpus').submit();
    });

    $('button#btn-tambah').on('click', function(){
      $('#modalForm').modal('show');
      $('form#formPerpus').trigger('reset');
      $('input[name=_method]').val('');
    });

    $('table#table-perpus').on('click', '.btn-edit', function(){
      let id = $(this).data('id');
      let baseurl = "<?=base_url()?>";
      $.get('${baseurl}/perpus/${id}').done((e)=>{
        $('input[name=id]').val(e.id);
        $('input[name=nama_lengkap]').val(e.nama_lengkap);
        $('select[name=gender]').val(e.gender);
        $('input[name=tgl_lahir]').val(e.tgl_lahir);
        $('select[name=level]').val(e.level);
        $('input[name=email]').val(e.email);
        $('input[name=sandi').val(e.sandi);
        $('input[name=nohp]').val(e.nohp);
        $('input[name=alamat]').val(e.alamat);
        $('#modalForm').modal('show');
        $('input[name=_method]').val('patch');
      });
    });

    $('table#table-perpus').on('click', '.btn-hapus', function(){
      let konfirmasi = confirm('Data akan di hapus, apakah anda ingin melanjutkan');

      if(konfirmasi === true){
        let _id = $(this).data('id');
        let baseurl = "<?=base_url()?>";

        $.post('${baseurl}/perpus', {id:_id, _method:'delete'}).done(function(e){
          $('table#table-perpus').DataTable().ajax.reload();
        });
      }
    });

    $('table#table-perpus').DataTable({
      processing: true,
      serverSide: true,
      ajax:{
        url: "<?=base_url('perpus/all')?>",
        method: 'GET'
      },
      columns: [
        { data: 'id', sortable:false, searchable:false,
          render: (data,type,row,meta)=>{
            return meta.settings._IDisplayStart + meta.row + 1;
          } 
        },
        { data: 'nama_lengkap' },
        { data: 'gender',
          render: (data, type, meta, row)=>{
            if( data === 'L'){
              return 'Laki-Laki';
            }else if( data === 'P' ){
              return 'Perempuan';
            }
          }
        },
        { data: 'tgl_lahir' },
        { data: 'level',
          render: (data, type, meta, row)=>{
            if( data === 'P'){
              return 'Platinum';
            }else if( data === 'K' ){
              return 'King';
            }
          }
        },
        { data: 'email' },
        { data: 'sandi' },
        { data: 'nohp' },
        { data: 'alamat' },
        { data: 'id',
          render: (data, type, meta, row)=>{
            var btnEdit = `<button class='btn-edit' data-id='${data}'> Edit </button>`;
            var btnHapus = `<button class='btn-hapus' data-id='${data}'> hapus </button>`;
            return btnEdit + btnHapus;
          }
        }
      ]
    }); 
  });
</script>