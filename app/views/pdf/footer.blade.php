<div class="visible-print text-center">
    {{ QrCode::size(100)->generate(Request::url()); }}
    {{ QrCode::format('png')->generate('Make me into a QrCode!', 'qrcode.png'); }}
    <p>Scan me to return to the original page.</p>
</div>