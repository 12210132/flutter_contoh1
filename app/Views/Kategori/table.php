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
<link herf="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stlyesheet">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<div class="container">
    <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
</div>
<table id='table-Kategori' class="datatable table table-bordered">
    <thead>
    <tr>
            <th>id</th>
            <th>nama</th>
         </tr>
    </thead>
</table>  
<script>
    $(document).ready(function(){
        $('table#table-Kategori').dataTable({
            processig: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('Kategori/all')?>",
                method: 'GET'
            },
            colums: [
                { data: 'id', sortable:false, searchtable:false,
                render: (data,type,row,meta)=>{
                    return meta,settings._iDisplayStart + meta.row + 1;
                    }
                },
                { data: 'nama' },
                { data: 'id',
                    render: (data, type, meta, row)=>{
                        var btnEdit = `<button class='btn-edit' data-id='${data}'>Edit </button>`;
                        var btnHapus = `<button class='btn-hapus' data-id='${data}'>Hapus </button>`;
                        return btnEdit + btnHapus;
                        }
                    }
            ]
        });
    });

</script> 