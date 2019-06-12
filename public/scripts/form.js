$(document).ready (function() {
	$('form').submit(function(event) {
		if ($(this).attr('id') == 'no_ajax') {
			return;
		}
		var json;
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				json = jQuery.parseJSON(result);
				if (json.url) {
					window.location.href = '../' + json.url;
				} else {
					//lert(json.status + ' - ' + json.message);
          if (json.status == "error")
          {
            swal({
              icon: "error",
              title: json.status,
              text: json.message,
            });
          } else
          {
            swal({
              icon: "success",
              title: json.status,
              text: json.message,
            });
          }
				}
			},
		});
	});
});
$(function(){
  var progressBar = $('#progressbar');
  $('#my_form').on('submit', function(e){
    e.preventDefault();
    var $that = $(this),
        formData = new FormData($that.get(0));
    $.ajax({
      url: $that.attr('action'),
      type: $that.attr('method'),
      contentType: false,
      processData: false,
      data: formData,
      dataType: 'json',
      xhr: function(){
        var xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
        xhr.upload.addEventListener('progress', function(evt){ // добавляем обработчик события progress (onprogress)
          if(evt.lengthComputable) { // если известно количество байт
            // высчитываем процент загруженного
            var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
            // устанавливаем значение в атрибут value тега <progress>
            // и это же значение альтернативным текстом для браузеров, не поддерживающих <progress>
            progressBar.val(percentComplete).text('Загружено ' + percentComplete + '%');
          }
        }, false);
        return xhr;
      },
      success: function(json){
        if(json){
          $that.after(json);
        }
      }
    });
  });
});