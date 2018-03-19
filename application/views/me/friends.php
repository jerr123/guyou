<style type="text/css">
.friend-container {
    width: 100%;
    min-height: 100px;
    overflow: hidden;
    padding: 10px 0;
}  

	.list-con {
		/*background-color: red;*/
		float: left;
		width: 290px;
		padding: 0 30px
	}

	.list-con>.title {
		margin: 0 0 10px 0;
		/*background-color: red;*/
		font-size: 16px;
		font-weight: bold;
		color: rgba(118,204,53, 1);

	}

	.list-con>select {
		outline: none;
		box-sizing: border-box;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		width: 230px;
		border: 1px solid rgba(51,159,242,1);
		border-radius: 3px;
	}

	.list-con>select>option {
		box-sizing: border-box;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		font-size: 14px;
		line-height: 14px;
		padding: 5px 10px;
		white-space: nowrap;
		text-overflow: ellipsis;
		overflow: hidden;
	}

</style>

<div class="friend-container">
    <div class="list-con">
    	<div class="title">第1级层级</div>
    	<select id="layer-one" size="10">
    		<option value="1">ArronS</option>
    		<option value="2">ArronS</option>
    		<option value="3">ArronS</option>
    		<option value="4">ArronS</option>
    		<option value="5">ArronS</option>
    	</select>
    </div>

    <div class="list-con">
    	<div class="title">第2级层级</div>
    	<select id="layer-two" size="10">
    		<option value="1">sWITER</option>
    		<option value="2">sWITER</option>
    		<option value="3">sWITER</option>
    		<option value="4">sWITER</option>
    		<option value="5">sWITER</option>
    	</select>
    </div>
    <div class="list-con">
    	<div class="title">第3级层级</div>
    	<select id="layer-three" size="10">
    		<option value="1">Cooder</option>
    		<option value="2">Cooder</option>
    		<option value="3">Cooder</option>
    		<option value="4">Cooder</option>
    		<option value="5">Cooder</option>
    	</select>
    </div>
</div>

<span id="friendurls" data-baseurl="<?php echo site_url('Ajax') ?>" data-innerpage="<?php echo site_url('Innerpage') ?>" hidden="hidden"></span>

<script type="text/javascript">
$(function () {

	var baseUrl = $('#friendurls').data('baseurl');

	// 第一层加载
	$('#layer-one').on('click', 'option', function () {

		$.post(baseUrl + '/queryLayerOne', {
			"user_id" : $(this).attr('value')
		}, function (response) {
			if (response.status != 1) {
				swal("Error!", response.errmsg, 'error');
				return false;
			}

			var content = ''
			for (var c in response.data) {
				content += '<option value="' + response.data[c].id + '">' + response.data[c].name + '</option>';
			}

			$('#layer-two').html(content);
		});

	});

	// 第二城的加载
	$('#layer-two').on('click', 'option', function () {
		$.post(baseUrl + '/queryLayerTwo', {
			"user_id" : $(this).attr('value')
		}, function (response) {
			if (response.status != 1) {
				swal("Error!", response.errmsg, 'error');
				return false;
			}

			var content = ''
			for (var c in response.data) {
				content += '<option value="' + response.data[c].id + '">' + response.data[c].name + '</option>';
			}

			$('#layer-three').html(content);
		});
	});

});
</script>