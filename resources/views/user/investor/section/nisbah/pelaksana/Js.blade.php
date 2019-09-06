<script>
    table_divince_perBulanM= $('.table_dividen').DataTable({
        data:[],
        column:[
            {'data' :'0'},
            {'data' :'1'},
            {'data' :'2'},
            {'data' :'3'},
            {'data' :'4'},
            {'data' :'5'},
        ],
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
            url: '{{ url('data-pelaksana') }}/'+data,
            dataType : 'json',
            data :{
                '_token' : '{{ csrf_token() }}',
                'thn': year
            }
        }).done(function (result) {
            table_divince_perBulanM.clear().draw();
            table_divince_perBulanM.rows.add(result.data).draw();
            $('#title-table').text('Daftar Dividen Tahun :'+ result.tahun);
            $('#total_laba_rugi').text(result.total_laba_rugi);
            $('#total_alokasi_kas').text(result.total_alokasi_kas);
            $('#total_net_kas').text(result.total_net_kas);
            $('#total_nisbah_pelaku').text(result.total_nisbah_pelaku);
            $('#total_hasil_pelaku').text(result.total_bagi_hasil_pelaku);
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
            button += '<button class="btn btn-primary" onclick="lihat_data('+v.id_pelaksana+','+v.tahun+')" style="margin: 2px">'+v.tahun+'</button>';
        });
        $('#loading-button').hide();
        $('#button-container').html(button);
    }

    lihat_data = function (data, tahun) {
        lihat_data_dividen(data, tahun)
    }


</script>