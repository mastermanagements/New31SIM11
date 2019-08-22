<script>

    table_divince_perBulanM= $('.table_dividen').DataTable({
        data:[],
        column:[
            {'data' :'0'},
            {'data' :'1'},
            {'data' :'2'},
            {'data' :'3'},
            {'data' :'4'}
        ],
        rowCallback : function(row, data){
        },
        {{--drawCallback: buttonBuild("{{ $thn_proses }}"),--}}
        filter: false,
        pagging : true,
        searching: true,
        info : true,
        ordering : true,
        processing : true,
        retrieve: true
    });

    call_data_dividen = function (data) {
        $.ajax({
            url: '{{ url('lihat-data-dividen-investor') }}/'+data,
            dataType : 'json',
            data :{
                '_token' : '{{ csrf_token() }}'
            }
        }).done(function (result) {
            table_divince_perBulanM.clear().draw();
            table_divince_perBulanM.rows.add(result.data).draw();
           // buttonBuild(data);
        }).fail(function(jqXHR, textStatus,errorThrown){

        })
    }

    lihat_dividen = function (id) {
        //alert('id :'+id);
        call_data_dividen(id);
    }
</script>