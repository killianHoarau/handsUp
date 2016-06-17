var qrcode = new QRCode("qrcode");

$("#valid").on("click", function () {
    qrcode.makeCode($('#text').val());
}).keyup().focus();