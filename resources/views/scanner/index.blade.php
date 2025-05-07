<x-app-layout>

    <div id="qr-reader"></div>


</x-app-layout>


<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // Handle the scanned code
        window.open(decodedText);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", {
            fps: 1,
            qrbox: {
                width: 250,
                height: 250
            }
        },
        false
    );
    html5QrcodeScanner.render(onScanSuccess);
</script>
