<link type="text/css" rel="stylesheet" href="css/gambar.css" />
<div class="text-center">
    <img src="images/peta.png"  alt="">
</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<style type="text/css">
     .backgroundRed{
        background: red;
    }
    </style>
    <script>
function blinker() {
$('.blink_me').fadeOut(500);
$('.blink_me').fadeIn(500);
}
setInterval(blinker, 2000);
</script>
