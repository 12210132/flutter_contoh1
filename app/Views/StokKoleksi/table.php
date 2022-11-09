<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"
    ></script>
<link herf="//cdn.datatables.net/1.12.1/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<div class="col-md-12 col-sm-12 col-xs-12"></div>
<div class="container">
    <button class="float-end btn-sm btn-primary" id="btn-tambah">Tambah Stok Koleksi</button>

    <table id='table-stok_koleksi' class="datatable table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Koleksi id</th>
                <th>Nomor</th>
                <th>Status Tersedia</th>
                <th>anggota id</th>
                <th>Perpus id</th>
            </tr>
        </thead>
    </table>
</div>

<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Stok Koleksi</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formStokKoleksi" method="post" action="<?=base_url('stok_koleksi')?>" >
                <input type="hidden" name="id" />
                <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label class="form-label">Koleksi id</label>
                        <input type="text" name="koleksi_id" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor</label>
                        <input type="number" name="nomor" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status tersedia</label>
                        <input type="text" name="status_tersedia" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Anggota id</label>
                        <input type="text" name="anggota_id" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Perpus id</label>
                        <input type="text" name="perpus_id" class="form-control" />
                    </div>
                </form>
            </div>
            <div class="modal-foother">
                <button class="btn btn-success" id='btn-kirim'>kirim</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('form#formStokKoleksi').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();

            },
            pasca:()=>{
                $('button#btn-kirim').show();

            },
            success:(response, status)=>{
                $("#modalForm").modal('hide');
                $("table#table-stok_koleksi").DataTable().ajax.reload();

            },
            error: (xhr, status)=>{
                alert('Maaf, data stok koleksi gagal direkam');

            },
        });
        $('button#btn-kirim').on('click', function(){
            $('form#formStokKoleksi').submit();
        });
        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formStokKoleksi').trigger('reset');
            $('input[name=_method]').val('');
        });
        $('table#table-stok_koleksi').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/stok_koleksi/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=koleksi_id]').val(e.koleksi_id);
                $('input[name=nomor]').val(e.nomor);
                $('input[name=status_tersedia]').val(e.status_tersedia);
                $('input[name=anggota_id]').val(e.anggota_id);
                $('input[name=perpus_id]').val(e.perpus_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');
            });
        });

        $('table#table-stok_koleksi').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm('Data anggota akan dihapus, mau dilanjutkan?');

            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/stok_koleksi`, {id:_id, _method: 'delete'}).done(function(e){
                    $('table#table-stok_koleksi').DataTable().ajax.reload();
                });
            }
        });
        
        $('table#table-stok_koleksi').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "<?=base_url('stok_koleksi/all')?>",
            method: 'GET'
        },
        columns: [
            { data: 'id', sortable:false, searchable:false,
                render: (data, type, row, meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            },
            { data: 'koleksi_id'},
            { data: 'nomor'},
            { data: 'status_tersedia'},
            { data: 'anggota_id'},
            { data: 'perpus_id'},
            { data: 'id ',
                render: (data, type, meta, row)=>{
                    var btnEdit  = `<button class='btn-edit' data-id='${data}'> Edit </button>`;
                    var btnHapus = `<button class='btn-hapus' data-id='${data}'> Hapus </button>`;
                    return btnEdit + btnHapus;
                }
            }
        ]
    });
});
</script>