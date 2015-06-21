window.onAjaxError = function (xhr, desc, err) {
	// jQuery('.saving').fadeOut();
	console.log("-- ajax error --");
	console.log(xhr);
	console.log(desc);
	console.log(err);
};

// フッタ
jQuery(function(){
	return;
	window.footerFixed();
	jQuery(window).scroll(function(){
		window.footerFixed();
		console.log("scroll");
	});
	jQuery(window).resize(function(){
		window.footerFixed();
	});
});

// Ctrl-Enter で submit 押下扱いにする
jQuery(function(){
	jQuery('textarea').keydown(function (e) {
		if (e.ctrlKey && e.keyCode == 13) {
			// var button = jQuery(this).parents('form').find('input[type="submit"]');
			// button.click();

			jQuery(this).parents('form').submit();
		}
	});
});

// Ctrl+S
jQuery(function(){
	// 更新ボタンショートカット
	jQuery(window).keypress(function(e) {
		if (!(e.which == 115 && e.ctrlKey) && !(e.which == 19)) return true;
		if(jQuery('#SaveSubmit').attr('disabled') !== 'disabled') {
			saveContent();
		}
		e.preventDefault();
		return false;
	});
	jQuery('#ProcessEdit2Form input').keydown(function(e) {
		if (e.ctrlKey && e.which === 83){
			if(jQuery('#SaveSubmit').attr('disabled') !== 'disabled'){
				saveContent();
			}
			event.preventDefault();
			return false;
		}
	});
	jQuery('#ProcessEdit2Form textarea').keydown(function(e) {
		if (e.ctrlKey && e.which === 83){
			if(jQuery('#SaveSubmit').attr('disabled') !== 'disabled') {
				saveContent();
			}
			event.preventDefault();
			return false;
		}
	});
	jQuery(window).keydown(function(e) {
		if (e.ctrlKey && e.which === 83){
			if(jQuery('#SaveSubmit').attr('disabled') !== 'disabled') {
				saveContent();
			}
			event.preventDefault();
			return false;
		}
	});

	// 更新ボタン
	jQuery('#SaveSubmit').click(function(){
		saveContent();
		return false;
	});

	// 編集フォーム内自動補完オフ
	jQuery('.edit-area form input').attr('autocomplete', 'off');
});

function formChanged(changed){
	window.g_changed = changed;
	jQuery('#SaveSubmit').attr('disabled', !changed);
}

String.prototype.lf2br = function(){
	var ret = this.trim();
	return ret.replace(/\n/g, "<br/>");
}

