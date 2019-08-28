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

    call_data_dividen = function (data, year) {
        $('#loading_s').show();
        $.ajax({
            url: '{{ url('lihat-data-dividen-investor') }}/'+data,
            dataType : 'json',
            data :{
                '_token' : '{{ csrf_token() }}',
                'thn': year
            }
        }).done(function (result) {
            table_divince_perBulanM.clear().draw();
            table_divince_perBulanM.rows.add(result.data).draw();
            buttonBuilder(result.button);
            $('#title-table').text('Daftar Dividen Tahun :'+ result.thn);
            $('#total_laba_rugi').text(result.total_laba_rugi);
            $('#total_alokasi_kas').text(result.total_alokasi_kas);
            $('#total_net_kas').text(result.total_net_laba);
            $('#total_bagi_hasil').text(result.total_bagi_hasil);
            $('#loading_s').hide();
            buttonBuild(data);
        }).fail(function(jqXHR, textStatus,errorThrown){

        })
    }

    lihat_dividen = function (id) {
        //alert('id :'+id);
        call_data_dividen(id);
    }

    buttonBuilder = function (data) {
        var button = "";
        $('#loading-button').show();
        $.each(data, function (i,v) {
            console.log(v);
            button += '<button class="btn btn-primary" onclick="lihat_data('+v.id_investor+','+v.tahun+')" style="margin: 2px">'+v.tahun+'</button>';
        });
        $('#loading-button').hide();
        $('#button-container').html(button);
    }

    lihat_data = function (id, year) {
        //alert('id :'+id);
        call_data_dividen(id, year);
    }

</script>