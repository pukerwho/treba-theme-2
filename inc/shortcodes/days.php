<?php 
function newYearCountdown($atts) {
	$params_new_year_countdown = shortcode_atts( array(
		'id' => 1,
		'text' => 'Hello',
	), $atts );
	ob_start();
?>
<div class="text-2xl text-center mb-4"><?php _e("До Нового року залишилося", "treba-wp"); ?>:</div>
<div class="flex justify-center mb-4">
  <div id="shortcode-countdown" class="inline-flex ">
    <div class="flex justify-center -mx-4">
      <div class="px-4"><div id="days" class="text-3xl text-center font-bold"></div><div class="text-lg font-light"><?php _e("Днів", "treba-wp"); ?></div></div>
      <div class="px-4"><div id="hours" class="text-3xl text-center font-bold"></div><div class="text-lg font-light"><?php _e("Годин", "treba-wp"); ?></div></div>
      <div class="px-4"><div id="minutes" class="text-3xl text-center font-bold"></div><div class="text-lg font-light"><?php _e("Хвилин", "treba-wp"); ?></div></div>
      <div class="px-4"><div id="seconds" class="text-3xl text-center font-bold"></div><div class="text-lg font-light"><?php _e("Секунд", "treba-wp"); ?></div></div>
    </div>
  </div>
</div>

<script>
  function updateCountdown() {
    var newYearDate = new Date("January 1, 2024 00:00:00 GMT+00:00");
    var currentDate = new Date();
    var timeDiff = newYearDate - currentDate;
    var days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
    var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
    document.getElementById("days").innerHTML = days;
    document.getElementById("hours").innerHTML = hours;
    document.getElementById("minutes").innerHTML = minutes;
    document.getElementById("seconds").innerHTML = seconds;
  }
  setInterval(updateCountdown, 1000);
  updateCountdown();
</script>
<?php
	$out = ob_get_clean();
	wp_reset_postdata();
	return $out;
}
add_shortcode( 'new_year_countdown', 'newYearCountdown' );