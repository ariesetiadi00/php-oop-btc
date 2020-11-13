$(function () {
    $('.btnBayar').click(function () {
        // Ambil data bulan pada tunggakan
        let bulan = GetMonthName($(this).data('bulan'));

        // Set bulan ke detal informasi
        $("#month").html("Pembayaran " + bulan);
        $('#bulan').val($(this).data('bulan'));
    });
});


function GetMonthName(monthNumber) {
      let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      return months[monthNumber - 1];
}

