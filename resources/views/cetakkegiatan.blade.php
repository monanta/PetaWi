<!DOCTYPE html>
<html>
<head>
    <title>{{ $nmkeg }}</title>
</head>
<body>
@foreach ($listbs as $idbs)
<a style="float: right; padding-top: 585px; padding-right: 20px">{{ $nmkeg }}</a>
<img src="{{ asset("/assets/petawb/".$idbs."_WB-2020(1).jpg") }}" alt="" style="width: 100%; height: 100%;">
@endforeach

</body>

</html>
