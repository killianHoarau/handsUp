var qrcode = new QRCode("qrcode");

$("#valid").on("click", function () {
    qrcode.makeCode($(this).val());
}).keyup().focus();