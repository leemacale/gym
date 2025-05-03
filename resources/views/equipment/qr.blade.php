<div id="qrcode"></div>

<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>

<script type="text/javascript">
    new QRCode(document.getElementById("qrcode"), "http://gym.werbest.xyz/equipment/{{ $equipments->id }}/views");


    window.print();
</script>
