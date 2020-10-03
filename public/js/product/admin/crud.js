+function ($, window, document) {

	var Plugin = {

		SELECTOR_EDIT: '.js_edit',
		SELECTOR_EDIT_COLLAPSE: '.js_edit .collapse',
		SELECTOR_EDIT_BUTTON_SAVE: '.js_edit form button.js_save',
		SELECTOR_CREATE_BUTTON_SAVE: '.js_create form button.js_save',
		SELECTOR_PRODUCT_IMAGE: 'img.js_picture',
		SELECTOR_DELETE_CONFIRMATION: '#js_delete_confirmation',
		SELECTOR_DELETE_BUTTON: '.js_delete',
		SELECTOR_DELETE_ITEM_NAME: '.js_item_name',

		init: function() {
			$(this.SELECTOR_EDIT).hide();
			$(this.SELECTOR_EDIT_COLLAPSE).on('show.bs.collapse', function (e) { $(e.target).closest(this.SELECTOR_EDIT).show(); }.bindToContext(this));
			$(this.SELECTOR_EDIT_COLLAPSE).on('hidden.bs.collapse', function (e) { $(e.target).closest(this.SELECTOR_EDIT).hide(); }.bindToContext(this));
			$(document).on('click', this.SELECTOR_EDIT_BUTTON_SAVE, this.save.bindToContext(this));
			$(document).on('click', this.SELECTOR_CREATE_BUTTON_SAVE, this.save.bindToContext(this));
			$(document).on('click', this.SELECTOR_DELETE_BUTTON, this.deleteProduct.bindToContext(this));

			// Set event handler: update file name after user selects file.
			$('.js_upload input[type=file]').on('change', null, function (e) {
				var fileName = $(this).val().split(/[\\|/]/).pop();
				$(this).parent().find('label').text(fileName);
			});

			// Set event handler: connect product table row with the modal dialog when modal is shown.
			$(this.SELECTOR_DELETE_CONFIRMATION).on('show.bs.modal', function (event) {
				// Find a button that triggered the modal.
				var $triggeredButton = $(event.relatedTarget);
				// Get modal window.
				var $modal = $(event.target);
				// Insert item name into the confirmation dialog.
				$modal.find(this.SELECTOR_DELETE_ITEM_NAME).text($triggeredButton.data('itemName'));
				// Save request URL into the confirmation button's data.
				$modal.find(this.SELECTOR_DELETE_BUTTON).data('url', $triggeredButton.data('url'));
				// Connect modal window with table row.
				$modal.data('tableRow', $triggeredButton.closest('tr'));
			}.bindToContext(this));
		},

		save: function(event) {
			event.preventDefault();
			var $button = $(event.target);
			var $form = $button.closest('form');
			$button.prop('disabled', true).css({ opacity: 0.25 });
			$.ajax({
				url: $form.attr('action'),
				method: 'post',
				dataType: 'json',
				data: new FormData($form[0]),

				// Tell jQuery not to process data or worry about content-type.
				cache: false,
				contentType: false,
				processData: false,

				success: function (data) {
					// Product is created or updated.
					NotifyJsAlert.successWithTimeout('saved', 2, $button, 'right middle');
					// Update product picture.
					if (typeof data === 'object' && typeof data.pictureUrl === 'string') {
						$form.find(this.SELECTOR_PRODUCT_IMAGE).attr('src', data.pictureUrl);
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

		deleteProduct: function(event) {
			event.preventDefault();
			var $button = $(event.target);
			var url = $button.data('url');
			var $confirmationModal = $button.closest(this.SELECTOR_DELETE_CONFIRMATION);
			var $tableRow = $confirmationModal.data('tableRow');
			$button.prop('disabled', true);
			$.ajax({
				url: url,
				method: 'post',
				dataType: 'json',
				data: {},
				success: function (data) {
					// Product is deleted.
					$confirmationModal.modal('hide');
					$tableRow.animate({ opacity: 0 }, 500, function () { $tableRow.remove(); });
				}.bindToContext(this),
				error: function (jqXHR, textStatus, errorThrown) {
					// Show error alert.
					var message = "Ошибка: {0} {1}".format(jqXHR.status, errorThrown);
					NotifyJsAlert.error(message, $button);
				}.bindToContext(this),
				complete: function (jqXHR, textStatus) {
					$button.prop('disabled', false);
				}.bindToContext(this),
			});
		},

	};

	$(document).ready(Plugin.init.bindToContext(Plugin));

}(jQuery, window, document);
