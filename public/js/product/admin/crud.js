+function ($, window, document) {

	var Plugin = {

		SELECTOR_BUTTON_DELETE: '.js_delete',

		init: function() {
			$(document).on('click', this.SELECTOR_BUTTON_DELETE, this.deleteProduct.bindToContext(this));
		},

		deleteProduct: function(event) {
			event.preventDefault();
			var $button = $(event.target);
			var url = $button.attr('href');
			$.ajax({
				url: url,
				method: 'post',
				dataType: 'json',
				data: {},
				success: function (data) {
					// Product is deleted.
					$button.prop('disabled', true);
					var $tableRow = $button.closest('tr');
					$tableRow.animate({ opacity: 0 }, 500, function () { $tableRow.remove(); });
				}.bindToContext(this),
				error: function (jqXHR, textStatus, errorThrown) {
					// Show error alert.
					var message = "Ошибка: {0} {1}".format(jqXHR.status, errorThrown);
					NotifyJsAlert.error(message, $button);
				}.bindToContext(this),
			});
		},

	};

	$(document).ready(Plugin.init.bindToContext(Plugin));

}(jQuery, window, document);
