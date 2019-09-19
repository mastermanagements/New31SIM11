<script>



    $(document).ready(function() {
        var example_rincian=$('#example_rincian').DataTable({
            displayLength: 25,
            filter: false,
            pagging : true,
            searching: true,
            info : true,
            ordering : false,
            processing : true,
            retrieve: true,
        })
        var rows = example_rincian.rows('.body-table-buku-besar');

        // Event listener to the two range filtering inputs to redraw on input
        $('#tombol-tampilkan').click( function() {
            rows.rows( function ( idx, data, node ) {
                var from = $('[name="tgl_awal"]').val().split("-")
                var from2 = $('[name="tgl_akhir"]').val().split("-")
                var f = new Date(from[2], from[1], from[0]);
                var dateInput =convertNumber(f.getDate())+"-"+convertNumber(f.getMonth())+"-"+f.getFullYear();

                var f2 = new Date(from2[2], from2[1], from2[0]);
                var dateInput2 =convertNumber(f2.getDate())+"-"+convertNumber(f2.getMonth())+"-"+f2.getFullYear();
                console.log(dateInput+"========"+dateInput2);
                if(data[1] !=""){
                    if(dateInput < data[1] && dateInput2 < data[1]){
                        return true;
                    }
                }else{
                    return false;
                }
            }).remove().draw();
        } );
    });

    convertNumber  = function (input) {
        var newInput;
        if(input <=9){
            newInput ="0"+input;
        }else{
            newInput =input;
        }
        return newInput;
    }

</script>