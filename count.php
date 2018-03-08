 <h1 align="center"><div id="pesan"></div></h1>
       
        <script>
            var url = "media.php?page=manage_finger"; // url tujuan
            var count = 45; // dalam detik
            function countDown() {
                if (count > 0) {
                    count--;
                    var waktu = count + 1;
                    $('#pesan').html('Silahkan Menunggu Proses Download Data dalam ' + waktu + ' detik.');
                    setTimeout("countDown()", 1000);
                } else {
                    window.location.href = url;
                }
            }
            countDown();
        </script>