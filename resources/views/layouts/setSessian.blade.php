<script>
    setSession= function (url, main_menu,subMenu) {
        $.ajax({
            url:'{{ url('setting-session-menu') }}',
            type:'post',
            data: {
                'main_menu':main_menu,
                'sub_menu': subMenu,
                '_token': '{{ csrf_token() }}'
            },
            success: function(result){
                window.location.href=url;
            },
            error : function(xhr,status,error){
                var err = eval("(" + xhr.responseText + ")");
                alert('Klik ulang menu pilihan anda');
            }
        })
    }
</script>