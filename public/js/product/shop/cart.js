+function ($, window, document) {

	var Plugin = {

		SELECTOR_BUTTON_ADD: '.js_cart_add',
		SELECTOR_BUTTON_REMOVE: '.js_cart_remove',
		SELECTOR_ACTIONS: '.js_actions',
		SELECTOR_ACTIONS_ADD: '.js_actions_add',
		SELECTOR_ACTIONS_CHANGE: '.js_actions_change',
		SELECTOR_PRODUCT_COUNT: '.js_count',

		init: function() {
			$(document).on('click', this.SELECTOR_BUTTON_ADD, this.addOrRemove.bindToContext(this));
			$(document).on('click', this.SELECTOR_BUTTON_REMOVE, this.addOrRemove.bindToContext(this));
		},

		addOrRemove: function(event) {
			event.preventDefault();
			var $button = $(event.target);
			var $container = $button.closest(this.SELECTOR_ACTIONS);
			$button.prop('disabled', true).css({ opacity: 0.25 });
			$.ajax({
				url: $button.data('url'),
				method: 'post',
				dataType: 'json',
				data: {},
				success: function (data) {
					if (typeof data === 'object' && typeof data.count === 'number') {
						// Get product's count.
						var count = data.count;
						$container.find(this.SELECTOR_ACTIONS_ADD).toggleClass('d-none', count > 0);
						$container.find(this.SELECTOR_ACTIONS_CHANGE).toggleClass('d-none', count === 0);
						$container.find(this.SELECTOR_PRODUCT_COUNT).text(count);
					}
				}.bindToContext(this),
				error: function (jqXHR, textStatus, errorThrown) {
					// Show error alert.
					var message = "Ошибка: {0} {1}".format(jqXHR.status, errorThrown);
					NotifyJsAlert.errorWithTimeout(message, 5, $button, 'right middle');
				}.bindToContext(this),
				complete: function (jqXHR, textStatus) {
					$button.prop('disabled', false).css({ opacity: 1 });
				}.bindToContext(this),
			});
		},

	};

	$(document).ready(Plugin.init.bindToContext(Plugin));

}(jQuery, window, document);
