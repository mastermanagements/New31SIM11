<script>
    edit_pelaksana = function (id) {
        $.ajax({
            url: "{{ url('edit-pelaksana') }}/"+id,
            dataType: "json",
            success: function (result) {
                console.log(result);
                $('[name="id_ky"]').val(result.id_ky).trigger('change');
                $('[name="id_periode_invest"] option:selected').siblings().removeAttr('disabled');;
                $('[name="id_periode_invest"]').val(result.id_periode_invest).trigger('change');
                $('[name="id_bentuk_invest"]').val(result.id_bentuk_invest).trigger('change');
                $('[name="persen_saham"]').val(result.persen_saham);
                $('[name="id"]').val(result.id);
                $('#formulir').attr('action','update-pelaksana');
                $('#modal-pelaksana').modal('show');
            }
        })
    }
    edit_pemodal = function (id) {
        $.ajax({
            url: "{{ url('edit-pemodal') }}/"+id,
            dataType: "json",
            success: function (result) {
                console.log(result);
                $('[name="tgl_invest"]').val(result.tgl_invest);
                $('[name="id_periode_invest"] option:selected').siblings().removeAttr('disabled');;
                $('[name="id_periode_invest"]').val(result.id_periode_invest).trigger('change');
                $('[name="id_investor"]').val(result.id_investor).trigger('change');
                $('[name="id_bentuk_invest"]').val(result.id_bentuk_invest).trigger('change');
                $('[name="persen_saham"]').val(result.persen_saham);
                $('[name="id"]').val(result.id);
                $('#formulirs').attr('action','update-pemodal');
                $('#modal-pemodal').modal('show');
            }
        })
    }

    $('#datepicker3').change(function () {
        call_data($(this).val());
    })



    buttonBuild = function (data) {
        $('#loading').show();
        $.ajax({
            url:'{{ url('besar-nisbah') }}/'+data,
            dataType : "json",
            success: function (result) {
                var button="";
                $.each(result.button, function (i,v) {
                    button += v
                })
                $('#btn-container').html(button)
                $('#loading').hide();
            }
        })
    }



    table_divince_perBulanM= $('.tbdividenBulanan').DataTable({
        "ajax": '{{ url('besar-nisbah') }}/'+"{{ $thn_proses }}",
        column:[
            {'data' :'0'},
            {'data' :'1'},
            {'data' :'2'},
            {'data' :'3'},
            {'data' :'4'},
            {'data' :'5'},
            {'data' :'6'},
            {'data' :'7'},
            {'data' :'8'},
        ],
        rowCallback : function(row, data){
        },
        drawCallback: buttonBuild("{{ $thn_proses }}"),
        filter: false,
        pagging : true,
        searching: true,
        info : true,
        ordering : true,
        processing : true,
        retrieve: true
    });




    call_data = function (data) {
        $.ajax({
            url: '{{ url('besar-nisbah') }}/'+data,
            dataType : 'json',
            data :{
                '_token' : '{{ csrf_token() }}'
            }
        }).done(function (result) {
            table_divince_perBulanM.clear().draw();
            table_divince_perBulanM.rows.add(result.data).draw();
            buttonBuild(data);
        }).fail(function(jqXHR, textStatus,errorThrown){

        })
    }

    lihatPriode = function(id){
        $.ajax({
            url: '{{ url('besar-nisbah-periode') }}/'+id,
            type : "post",
            data :{
                '_token' : '{{ csrf_token() }}',
                '_method':'put',
                'year': $('#datepicker3').val()
            }
        }).done(function (result) {
            console.log(result.data);
            table_divince_perBulanM.clear().draw();
            table_divince_perBulanM.rows.add(result.data).draw();
            buttonBuild($('#datepicker3').val());
        }).fail(function(jqXHR, textStatus,errorThrown){

        })
    }


    edit_divide_per_bulanM = function (id) {
        $.ajax({
            url: "{{ url('edit-besar-nisbah') }}/"+id,
            dataType : 'json',
            success: function (result) {
                $('[name="thn"]').val(result.thn_dividen);
                $('[name="bln_dividen"]').val(result.bln_dividen);
                $('[name="id_periode_invest"]').val(result.id_periode_invest).trigger('change');
                $('[name="laba_rugi"]').val(result.laba_rugi);
                $('[name="id"]').val(result.id);
                $('#formulir_m').attr('action','update-besar-nisbah');
                $('#modal-besar-nisbah').modal('show');
            }
        })
    }
</script>