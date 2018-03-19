$(function () {


	var baseUrl = $("#ug-urls").data('baseurl');	// 基础url


	$('#upgrade-10').on('click', function () {
		$.post(baseUrl + '/levelUp', {"to_level" : 2}, function (response) {
			if (response.status == 1) {
				swal('Success', '升级成功', 'success');
			} else {
				swal('Error', response.errmsg, 'error');
				return false;
			}

		});
	});


	$('#upgrade-100').on('click', function () {
		$.post(baseUrl + '/levelUp', {"to_level" : 3}, function (response) {
			if (response.status == 1) {
				swal('Success', '升级成功', 'success');
			} else {
				swal('Error', response.errmsg, 'error');
				return false;
			}

		});
	});


	$('#upgrade-1000').on('click', function () {
		$.post(baseUrl + '/levelUp', {"to_level" : 4}, function (response) {
			if (response.status == 1) {
				swal('Success', '升级成功', 'success');
			} else {
				swal('Error', response.errmsg, 'error');
				return false;
			}

		});
	});


});