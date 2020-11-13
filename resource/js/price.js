$(function () {
    $("#price-button").click(function () {
        let harga = prompt("Masukan Harga Terbaru");

        // Redirect dengan data harga baru
        window.location = "/btc-pay/controller/price.php?harga="+harga;
    });
});
