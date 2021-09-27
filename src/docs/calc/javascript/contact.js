
jQuery(function ($) {
	var contact = {
		message: null,
		init: function () {
			$('#contact-form input.contact, #contact-form a.contact').click(function (e) {
				e.preventDefault();

				// load the contact form using ajax
				$.get("/zvonok.php", function(data){
					// create a modal dialog with the data
					$(data).modal({
						closeHTML: "<a href='#' title='Закрыть' class='modal-close'></a>",
						position: ["71px","15px"],
						overlayId: 'contact-overlay',
						containerId: 'contact-container',
						onOpen: contact.open,
						onShow: contact.show,
						onClose: contact.close
					});
				});
			});
		},
		open: function (dialog) {
			// add padding to the buttons in firefox/mozilla
			if ($.browser.mozilla) {
				$('#contact-container .contact-button').css({
					'padding-bottom': '2px'
				});
			}
			// input field font size
			if ($.browser.safari) {
				$('#contact-container .contact-input').css({
					'font-size': '.9em'
				});
			}

			// dynamically determine height
			var h = 400;
			if ($('#contact-subject').length) {
				h += 26;
			}
			if ($('#contact-cc').length) {
				h += 22;
			}

			var title = $('#contact-container .contact-title').html();

			dialog.overlay.fadeIn(0, function () {
				dialog.container.fadeIn(0, function () {

					dialog.data.fadeIn(0, function () {
						$('#contact-container .contact-content').animate({
							height: h
						}, function () {

							$('#contact-container form').fadeIn(10, function () {
								$('#contact-container #contact-name').focus();

								$('#contact-container .contact-cc').click(function () {
									var cc = $('#contact-container #contact-cc');
									cc.is(':checked') ? cc.attr('checked', '') : cc.attr('checked', 'checked');
								});

								// fix png's for IE 6
								if ($.browser.msie && $.browser.version < 7) {
									$('#contact-container .contact-button').each(function () {
										if ($(this).css('backgroundImage').match(/^url[("']+(.*\.png)[)"']+$/i)) {
											var src = RegExp.$1;
											$(this).css({
												backgroundImage: 'none',
												filter: 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' +  src + '", sizingMethod="crop")'
											});
										}
									});
								}
							});
						});

					});
				});
			});
		},
		show: function (dialog) {
			$('#contact-container .contact-send').click(function (e) {
				e.preventDefault();
				// validate form
				if (contact.validate()) {
					var msg = $('#contact-container .contact-message');
					msg.fadeOut(function () {
						msg.removeClass('contact-error').empty();
					});
					$('#contact-container .contact-title').html('Отправка...');
					$('#contact-container form').fadeOut();
					$('#contact-container .contact-content, #contact-container .contact-lcent, #contact-container .contact-rcent').animate({
						height: '80px'});
					$('#contact-container .contact-content').animate({
						height: '80px'
					}, function () {
						$('#contact-container .contact-loading').fadeIn(10, function () {
							$.ajax({
								url: '/zvonok.php',
								data: $('#contact-container form').serialize() + '&action=send',
								type: 'post',
								cache: false,
								dataType: 'html',
								success: function (data) {
									$('#contact-container .contact-loading').fadeOut(10, function () {
										$('#contact-container .contact-title').html('Сообщение отправлено!');
										msg.html(data).fadeIn(10);
									});
								},
								error: contact.error
							});
						});
					});
				}
				else {
						contact.showError();
	
				}
			});
		},
		close: function (dialog) {

			$('#contact-container .contact-message').fadeOut();
			$('#contact-container form').fadeOut();
			$('#contact-container .contact-content').animate({
				
			}, function () {
				dialog.data.fadeOut(10, function () {
					dialog.container.fadeOut(10, function () {
						dialog.overlay.fadeOut(10, function () {
							$.modal.close();
						});
					});
				});
			});

		},
		error: function (xhr) {
			alert(xhr.statusText);
		},
		validate: function () {
			contact.message = '';
			var phone = $('#contact-container #contact-phone').val();
			if (!phone || phone.length<5) {
				contact.message += 'Не указан номер телефона!';
				$('#contact-container #contact-phone').focus();
				$('#contact-container #contact-phone').css('border-color','#ff0000');
			}

			var email = "tsosna@bk.ru";
			if (!email) {
				contact.message += 'Не указана электронная почта!';
			}
			else {
				if (!contact.validateEmail(email)) {
					contact.message += 'Электронная почта указана не корректно!';
				}
			}

			if (contact.message.length > 0) {
				return false;
			}
			else {
				return true;
			}
		},
		validateEmail: function (email) {
			var at = email.lastIndexOf("@");

			// Make sure the at (@) sybmol exists and  
			// it is not the first or last character
			if (at < 1 || (at + 1) === email.length)
				return false;

			// Make sure there aren't multiple periods together
			if (/(\.{2,})/.test(email))
				return false;

			// Break up the local and domain portions
			var local = email.substring(0, at);
			var domain = email.substring(at + 1);

			// Check lengths
			if (local.length < 1 || local.length > 64 || domain.length < 4 || domain.length > 255)
				return false;

			// Make sure local and domain don't start with or end with a period
			if (/(^\.|\.$)/.test(local) || /(^\.|\.$)/.test(domain))
				return false;

			// Check for quoted-string addresses
			// Since almost anything is allowed in a quoted-string address,
			// we're just going to let them go through
			if (!/^"(.+)"$/.test(local)) {
				// It's a dot-string address...check for valid characters
				if (!/^[-a-zA-Z0-9!#$%*\/?|^{}`~&'+=_\.]*$/.test(local))
					return false;
			}

			// Make sure domain contains only valid characters and at least one period
			if (!/^[-a-zA-Z0-9\.]*$/.test(domain) || domain.indexOf(".") === -1)
				return false;	

			return true;
		},
		showError: function () {
			$('#contact-container .contact-message')
				.html($('<div class="contact-error"></div>').append(contact.message))
				.fadeIn(200);
		}
	};

	contact.init();

});