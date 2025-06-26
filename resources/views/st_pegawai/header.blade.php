<div class="header">
    @if($headerIconImage)
    <img src="{{ public_path('storage/header_icons/' . $headerIconImage->filename) }}" alt="Icon">
    @else
    <img src="{{ public_path('images/icon.png') }}" alt="Kop Surat">
    @endif
</div>