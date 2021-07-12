<table style="width: 100%">
    <thead>
    <tr>
	{{-- <td style="width: 100px"><img src="{{ asset('logoUsaha/'. $data['perusahaan']->logo) }}"></td> --}}
		<td style="border-color: transparent; width: 70px; height: 75px"  ><img src="{{ asset('logoUsaha/'. $data['perusahaan']->logo) }}" style="width: 75px; height:75px;"></td>
		
        <td>
            <h2 style="text-align: center">{{ $data['perusahaan']->nm_usaha }}</h2>
            
            <h2 style="text-align: center">{{ $data['title'] }}</h2>
			<p style="font-weight: bold; text-align: center">Periode : {{ $data['tgl_awal'] }} sd {{ $data['tgl_akhir'] }}</p>
        </td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="2">

        </td>
    </tr>
    </tbody>
</table>

<p style="margin-top: 50px">

</p>