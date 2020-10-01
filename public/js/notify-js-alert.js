
var NotifyJsAlert = {
	successWithTimeout: function (text, duration, element, position) { return this.createAlert('success', text, duration || 5, element, position); },
	infoWithTimeout: function (text, duration, element, position) { return this.createAlert('info', text, duration || 15, element, position); },
	errorWithTimeout: function (text, duration, element, position) { return this.createAlert('error', text, duration || 15, element, position); },

	success: function (text, element) { return this.createAlert('success', text, 0, element); },
	info: function (text, element) { return this.createAlert('info', text, 0, element); },
	error: function (text, element) { return this.createAlert('error', text, 0, element); },

	createAlert: function (style, text, duration, element, position) {
		// Set default duration.
		if (typeof duration !== 'number') { duration = 0; }
		// Set default element.
		if (typeof element !== 'object') { element = null; }
		// Set default position.
		if (typeof position !== 'string') { position = 'top center'; }
		// Convert duration to milliseconds.
		duration = 1000 * parseFloat(Math.abs(duration));
		// Create alert message.
		if (typeof $.notify === 'function') {
			var options = {
				className: style,
				autoHide: duration > 0,
				autoHideDelay: duration,
			};
			// Check if element is inside document body.
			$element = $(element);
			if ($.contains(document.body, $element[0])) {
				$element.css({position:'relative'});
				$element.notify(text, $.extend(options, {elementPosition: position}));
			} else {
				$.notify(text, options);
			}
		}
	},
};
