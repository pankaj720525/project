<p></p>
 @php
	if(request()->getHost() == "localhost")
	{ 
	    $logo =  "http://legiitlead.aipxperts.com:8080/public/assets/img/small_logo.png";
	}else{
	    $logo =  Helper::assets('img/small_logo.png');
	}
@endphp
{{-- <table style="padding:20px; font-family: 'Inter', sans-serif;width: 528px;margin: 0 auto; padding:20px; background:#fff;"> --}}
<table style="font-family: 'Inter', sans-serif;width: 528px; margin: 0 auto; box-shadow: 0 0 29px 0 rgba(0,0,0,0.1); -webkit-box-shadow: 0 0 29px 0 rgba(0,0,0,0.1); -moz-box-shadow: 0 0 29px 0 rgba(0,0,0,0.1); -ms-box-shadow: 0 0 29px 0 rgba(0,0,0,0.1); -o-box-shadow: 0 0 29px 0 rgba(0,0,0,0.1); padding:20px; background:#fff;">
    <tr>
        <td style="width:100%;">
            <table style="width:100%;">
                <tr>
                    <td  style="width:100%;text-align:center; padding-top: 10px; ">
                        <img src="{{$logo}}" alt="" style="max-width: 200px; padding-bottom:20px">
                    </td>
                </tr>
            </table>
        </td>
	</tr>
	<tr>
        <td style="padding: 20px;">
			{!! $content !!}
		</td>
	</tr>
	</table>
	<table  style="width: 528px;margin: 0 auto;">
    <tr>
        <td>
			<img src="{{$logo}}" style="max-width: 80px; margin-top:5px" alt="Logo" width="120">
		<td>
		<td>
			<p style="text-align:right; text-transform: uppercase; margin-top:0; margin-bottom:0;">
			<a style="color: #3e3e3e!important;font-weight: 600; font-size:10px; text-decoration:none;" href="http://legiitlead.aipxperts.com:8080">Legiitleads.com/</a>
			</p>
			<p  style="text-align:right; margin-top:0; margin-bottom:0;">
				<label   style="color: #3e3e3e!important;font-weight: 600; font-size:10px; text-decoration:none; line-height:1;">&copy; {{date('Y')}} Legiit Leads Inc.</label>
			</p>
		</td>
    </tr>
</table>
<p></p>
<img src="https://www.google-analytics.com/collect?v=1&tid=UA-46324402-37&cid=555&aip=1&t=event&ec=email&ea=open&dp=email&dt=Email">