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

    lihat_data_dividen = function (data, year) {
        $('#loading_s').show();
        $.ajax({
            url: '{{ url('data-pemodal') }}/'+data,
            dataType : 'json',
            data :{
                '_token' : '{{ csrf_token() }}',
                'thn': year
            }
        }).done(function (result) {
            table_divince_perBulanM.clear().draw();
            table_divince_perBulanM.rows.add(result.data).draw();
            $('#title-table').text('Daftar Dividen Tahun :'+ result.tahun);
            $('#loading_s').hide();
            buttonBuilder(result.button);
        }).fail(function(jqXHR, textStatus,errorThrown){

        })
    }

    buttonBuilder = function (data) {
        var button = "";
        $('#loading-button').show();
        $.each(data, function (i,v) {
            console.log(v);
            button += '<button class="btn btn-primary" onclick="lihat_data('+v.id_pemodal+','+v.tahun+')" style="margin: 2px">'+v.tahun+'</button>';
        });
        $('#loading-button').hide();
        $('#button-container').html(button);
    }

    lihat_data = function (data, tahun) {
        lihat_data_dividen(data, tahun)
    }


</script>