$(document).ready(function() {
	// đồng hồ chọn giờ phút
	$('.clockpicker').clockpicker();
	
	// cài đặt datepicker cho input date
    $('.js-schedule-date .input-group.date').datepicker({
		format: 'yyyy-mm-dd',
		todayBtn: "linked",
		keyboardNavigation: false,
		forceParse: false,
		calendarWeeks: true,
        autoclose: true,
        // forceParse: true,
        today: "今日",
	});

	// validation date 
	$('.js-start-date, .js-end-date').on('keypress keydown keyup paste', function (e) {
		var charCode = (e.which) ? e.which : event.keyCode;
		if(charCode == 9)
		{
			return true;
		}

		return false;
	});

	// validation nếu chọn end date
	$('.js-end-date').on('change', function(e) {
		var start_date = new Date($('.js-start-date').val()).getTime();
		var end_date = new Date($('.js-end-date').val()).getTime();
		if (isNaN(start_date)) {
			$(this).val('');
			return false;
		}
		if (start_date > end_date) {
			$(this).val('');
			return false;
		}
	});

	// validation max leng là 20
	var val_put_search_before = '';
    $('input[name=search]').on('keydown keyup change paste', function () {
        if ( $(this).val().length > 20 ) {
            $(this).val(val_put_search_before);
        } else {
            val_put_search_before = $(this).val();
        }
    })

	// check radio end date có được chọn ko để enable/disable ngày end date khi mới vào màn hình edit
	var is_schedule_end_date = $('input[name=is_schedule_end_date]').is(':checked');

	if(is_schedule_end_date == false) {
		$('input[name=to_date]').attr('disabled', true);
		$('input[name=to_hour]').attr('disabled', true);
	}else{
		$('input[name=to_date]').attr('disabled', false);
		$('input[name=to_hour]').attr('disabled', false);
	}

	$('input[name=is_schedule_end_date]').on('change', function() {
		var is_checked_end_date = $(this).is(':checked');
		if ( is_checked_end_date ) {
			$('input[name=to_date]').attr('disabled', false);
			$('input[name=to_hour]').attr('disabled', false);
		} else {
			$('input[name=to_date]').val('');
			$('input[name=to_date]').attr('disabled', true);

			$('input[name=to_hour]').val('');
			$('input[name=to_hour]').attr('disabled', true);
		}
	});
});
// $('.js-only-number').keypress(function (event) {
//     return isNumber(event, this);
// });
$('.js-only-number').keypress(function (event) {
	if ( isNaN( String.fromCharCode(event.keyCode) )) return false;
});
$('.js-nokeyboard').bind("cut copy paste",function(e) {
    e.preventDefault();
});
$('.js-length').keypress(function (event) {
	var max = $(event.target).attr('max-length');
	if(event.target.value.length >= max) {
		return false;
	}
})
$('.js-length').bind('paste', function (e) {
	var val_origin = $(this).val();
	var val_add = e.originalEvent.clipboardData.getData('Text');
	var max = $(e.target).attr('max-length');
	if ( val_origin.length + val_add.length > max) {
		return false;
	}
})


