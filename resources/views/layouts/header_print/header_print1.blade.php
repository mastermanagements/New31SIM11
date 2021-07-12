<table style="width: 100%">
    <thead>
    <tr>
	{{-- <td style="width: 100px"><img src="{{ asset('logoUsaha/'. $data['perusahaan']->logo) }}"></td> --}}
		<td style="border-color: transparent; width: 70px; height: 75px"  ><img src="{{ asset('logoUsaha/'. $data['perusahaan']->logo) }}" style="width: 75px; height:75px;"></td>
		
        <td>
            <h2 style="text-align: center">{{ $data['perusahaan']->nm_usaha }}</h2>
            <p style="text-align: center">
                @if(!empty($data['perusahaan']->alamat))
                    {{ $data['perusahaan']->alamat }},
                @endif
                @if(!empty($data['perusahaan']->telp))
                    Telp: {{ $data['perusahaan']->telp }}
                @endif
                @if(!empty($data['perusahaan']->hp))
                    Hp {{ $data['perusahaan']->hp }}
                @endif
            </p>
            <h4 style="text-align: center">{{ $data['title'] }}</h4>
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