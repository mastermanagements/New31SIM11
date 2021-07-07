<table style="width: 100%">
    <thead>
        <tr>
            <td style="width: 100px"><img src="{{ asset('logoUsaha/'. $data['perusahaan']->logo) }}"></td>
            <td>
                <h2 style="text-align: center">{{ $data['title'] }}</h2>
            </td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2">
                <p style="font-weight: bold">Nama Usaha : {{ $data['perusahaan']->nm_usaha }}</p>
                <p style="font-weight: bold">Tanggal : {{ $data['tgl_awal'] }} Sampai {{ $data['tgl_akhir'] }}</p>
            </td>
        </tr>
    </tbody>
</table>