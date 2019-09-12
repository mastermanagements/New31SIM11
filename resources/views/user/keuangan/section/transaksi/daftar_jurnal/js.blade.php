<script>
    var groupColumn = 0;


  var table=  $('#example_rincian').DataTable( {
        order: [[0, 'asc'], [1, 'asc']],
        rowGroup: {
            dataSrc: [0, 1],

        },

         "columnDefs": [
            { "visible": false, "targets": 0 },
            { "visible": false, "targets": 1 },
        ],
  } );


</script>