(function($) {
    'use strict';
    function AysChatGPTChatBox(element, options){
        this.el = element;
        this.$el = $(element);
        this.ajaxAction = 'ays_chatgpt_admin_ajax';

		this.globalSettings = JSON.parse(atob(window.AysChatGPTChatSettings));

		// DEFINE PREFIXES
        this.CHATGPT_ASSISTANT_CLASS_PREFIX   = 'ays-chatgpt-assistant';
        this.CHATGPT_ASSISTANT_ID_PREFIX      = 'ays-chatgpt-assistant';
        this.CHATGPT_ASSISTANT_NAME_PREFIX    = 'ays_chatgpt_assistant';
        this.CHATGPT_ASSISTANT_OPTIONS_PREFIX = 'chatgpt_assistant_';
        this.dbOptions = undefined;
		// Chat prompt defaults
		this.chatConversation = [];
		// Text For old models
		this.promptFirstM = 'Converse as if you are an AI assistant. ';
		this.promptSecondM = 'Answer the question as truthfully as possible. ';	
		// Text For new models
		this.messageFirstM = '';
		// OpenAI settings
		this.REQUEST_URL = "";
		this.API_MAIN_URL = "https://api.openai.com/v1";
		this.API_COMPLETIONS_URL = "/completions";
		this.API_CHAT_COMPLETIONS_URL = "/chat/completions";

		this.requestCount = 0;
		this.tokenCount = 0;

        this.init();

        return this;
    }

    AysChatGPTChatBox.prototype.init = function() {
        var _this = this;
		_this.$el.show();
        _this.setEvents();

    };

	// Set events
    AysChatGPTChatBox.prototype.setEvents = function(e){
		var _this = this;
		_this.setDbOptions();
		_this.setUpPromptParametrs();
		_this.setUpRequestParametrs();

		var promptEl = _this.$el.find('#ays-assistant-chatbox-prompt-shortcode');
		autosize(promptEl);

		_this.$el.find('.ays-assistant-chatbox-prompt-input').on('input', function () {
			var sendBttn = _this.$el.find('.ays-assistant-chatbox-send-button');
			if ($(this).val().trim() != "") {
				sendBttn.prop('disabled', false);
			} else {
				sendBttn.prop('disabled', true);
			}
		});

		_this.$el.on('click', '.ays-assistant-chatbox-ai-message-copy', function(){
			var thisButton = $(this);
			var text = thisButton.parents(".ays-assistant-chatbox-ai-message-box").find('span.ays-assistant-chatbox-ai-response-message').text();
			_this.copyResponse(text);
			$(this).attr('title', 'Copied!');

			var copyIcon = $(this).html();
			$(this).html('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#636a84"><path d="M470.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 338.7 425.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" /></svg>');
			setTimeout(function() {
				thisButton.html(copyIcon);
			}, 700);
		});

		_this.$el.on('click', '.ays-assistant-chatbox-end-bttn' ,function () {
			var modal = _this.$el.find('.ays-assistant-chatbox-main-chat-modal');
			modal.find('.ays-assistant-chatbox-main-chat-modal-body-image').append('<img src="'+_this.globalSettings.translations.endChat.modalIcon+'">');
			modal.find('.ays-assistant-chatbox-main-chat-modal-body-text').append(_this.globalSettings.translations.endChat.warningMsg);
			modal.find('.ays-assistant-chatbox-main-chat-modal-footer-button').append('<button data-modal-action="confirm">'+_this.globalSettings.translations.endChat.buttonMsg+'</button>');
			modal.css('display', 'flex');

			modal.on('click', function (e) {
				if ($(e.target).attr('data-modal-action') === 'confirm') {					
					_this.$el.find('.ays-assistant-chatbox-messages-box').find('.ays-assistant-chatbox-ai-message-box').remove();
					_this.$el.find('.ays-assistant-chatbox-messages-box').find('.ays-assistant-chatbox-user-message-box').remove();
					_this.$el.find('.ays-assistant-chatbox-rate-chat-row').css('display', 'flex');

					if (_this.dbOptions.chatGreetingMessage) {
						_this.setGreetingMessage();
					}
		
					_this.chatConversation = [];

					modal.hide('fast');
					modal.find('.ays-assistant-chatbox-main-chat-modal-body-image').empty();
					modal.find('.ays-assistant-chatbox-main-chat-modal-body-text').empty();
					modal.find('.ays-assistant-chatbox-main-chat-modal-footer-button').empty();

					_this.$el.removeClass('ays-assistant-chatbox-main-container-maximized-view');
					var resizeButton = _this.$el.find('.ays-assistant-chatbox-resize-bttn');
					var src = resizeButton.attr('src');
					resizeButton.attr('src', src.replace('minimize', 'maximize'));
					resizeButton.attr('alt', "Maximize");
				} else if ($(e.target).attr('data-modal-action') === 'close') {
					modal.hide('fast');
					modal.find('.ays-assistant-chatbox-main-chat-modal-body-image').empty();
					modal.find('.ays-assistant-chatbox-main-chat-modal-body-text').empty();
					modal.find('.ays-assistant-chatbox-main-chat-modal-footer-button').empty();
				}
			})
		});

		_this.$el.find('.ays-assistant-chatbox-regenerate-response-button').on('click', function () {
			var prompt = _this.$el.find('.ays-assistant-chatbox-user-message-box:last').text();
			_this.$el.find('.ays-assistant-chatbox-prompt-input').val(prompt);
			_this.$el.find('.ays-assistant-chatbox-send-button').trigger('click', true);
		});

		_this.$el.find('.ays-assistant-chatbox-send-button').on('click', function (event, noUserMessage) {
			// var key = _this.dbOptions.chatAK;
			var prompt = _this.$el.find('.ays-assistant-chatbox-prompt-input').val();

			var loader = _this.$el.find('.ays-assistant-chatbox-loading-box');
			var sendBttn = _this.$el.find('.ays-assistant-chatbox-send-button');

			if (noUserMessage === undefined) {
				var userProfilePicture = '';
				if (_this.dbOptions.chatboxTheme == 'chatgpt') {
					userProfilePicture = '<div class="ays-assistant-chatbox-chatgpt-theme-user-icon">' + _this.dbOptions.userProfilePicture + '</div>';
				}

				var userMessage = $("<div>", {"class": "ays-assistant-chatbox-user-message-box"}).html(userProfilePicture + wrapCodeAndHtmlTags(prompt));

				_this.$el.find('.ays-assistant-chatbox-messages-box').append(userMessage).scrollTop($('.ays-assistant-chatbox-messages-box')[0].scrollHeight);
				promptEl.css("height" , "54px");
			}
			
			_this.$el.find('.ays-assistant-chatbox-prompt-input').val('');
			var scrolledHeight = $('.ays-assistant-chatbox-messages-box')[0].scrollHeight;
			var elementHeight = Math.round($('.ays-assistant-chatbox-messages-box').outerHeight());
			loader.css('bottom', (10 + elementHeight - scrolledHeight));

			// var keyIndex = key.indexOf("chgafr");
			// if (keyIndex !== -1) {
			// 	var readyK = key.substring(0, keyIndex);
			// }

			if (_this.dbOptions.enableRequestLimitations) {
				_this.requestCount++;
			}
			// if (_this.checkSession()) {
				if (prompt.trim() != '') {
					loader.show();
					if (_this.dbOptions.chatboxTheme == 'chatgpt') {
						_this.$el.find('.ays-assistant-chatbox-messages-box').scrollTop(scrolledHeight + 50);
					}
	
					sendBttn.prop('disabled', true);

					var sendData = {
						requestUrl : _this.REQUEST_URL,
						// apiKey : readyK,
						prompt : prompt,
						chatConversation : _this.chatConversation,
						url: _this.globalSettings.ajaxUrl,
						nonce: _this.globalSettings.nonce,
					}

					makeRequest(sendData , _this.dbOptions)
					.then(results => {
						var data = results.data;
						loader.hide();

						if (_this.dbOptions.enableRequestLimitations && typeof data?.usage?.total_tokens === 'number') {
							_this.tokenCount += data.usage.total_tokens;
						}
						if (!_this.checkSession()) {
							return;
						}
						
						var checkError = (typeof data.error == "object" ) ? false : true;
						if(checkError){
							var sanitizedText = '';
							var chatBotIcon = '';
							if (_this.dbOptions.chatboxTheme == 'chatgpt') {
								chatBotIcon = '<div class="ays-assistant-chatbox-chatgpt-theme-ai-icon"><img src="' + _this.dbOptions.chatIcon + '"></div>';
							}

							switch(_this.dbOptions.chatModel){
								case 'gpt-3.5-turbo':
								case 'gpt-3.5-turbo-16k':
									sanitizedText = wrapCodeAndHtmlTags(data.choices[0].message.content);
									_this.chatConversation.push(data.choices[0].message);
									var response = "<span class='ays-assistant-chatbox-ai-response-message'>" + (sanitizedText.replace(/^\n+/, '')) + "</span>";
									break;
								default:
									sanitizedText = wrapCodeAndHtmlTags(data.choices[0].text);
									_this.chatConversation.push("Chatbot: " + data.choices[0].text.replace(/^[^:]+:\s*/, '').replace(/^\n+/, ''));
									var response = "<span class='ays-assistant-chatbox-ai-response-message'>" + (sanitizedText.replace(/^[^:]+:\s*/, '').replace(/^\n+/, '')) + "</span>";
									break;
							}
							var buttons = getAIButtons(_this.dbOptions);
							var aiMessage = $("<div>", {"class": "ays-assistant-chatbox-ai-message-box"}).html(chatBotIcon + response + buttons);
							
							_this.$el.find('.ays-assistant-chatbox-messages-box').append(aiMessage).scrollTop($('.ays-assistant-chatbox-messages-box')[0].scrollHeight);
							var scrolledHeight = $('.ays-assistant-chatbox-messages-box')[0].scrollHeight;
							var elementHeight = Math.round($('.ays-assistant-chatbox-messages-box').outerHeight());
							loader.css('bottom', (10 + elementHeight - scrolledHeight));

							_this.$el.find('.ays-assistant-chatbox-regenerate-response-button').prop('disabled', false);

							$('.ays-assistant-chatbox-ai-message-copy').on('mouseover', function () {
								$(this).attr('title', 'Click to Copy');
							});
						}
						else{
							var errorMessage = '';
							if(data.error.type == "insufficient_quota"){
								errorMessage = " <a href='https://platform.openai.com/account/usage'> https://platform.openai.com/account/usage </a>";
							}
							_this.$el.find('.ays-assistant-chatbox-messages-box').append($("<div>", {"class": "ays-assistant-chatbox-error-message-box"}).html(data.error.message + errorMessage));
						}
					})
				}
			// }
		});

		_this.$el.on('click', '.ays-assistant-chatbox-resize-bttn', function () {
			var src = $(this).attr('src');
			if (!_this.$el.hasClass('ays-assistant-chatbox-main-container-maximized-view')) {
				$(this).attr('src', src.replace('maximize', 'minimize'));
				$(this).attr('alt', "Minimize");
				_this.$el.addClass('ays-assistant-chatbox-main-container-maximized-view');
				_this.$el.find('.ays-assistant-chatbox-main-container').addClass('ays-assistant-chatbox-main-container-maximized-view-inner');
				_this.$el.find('.ays-assistant-chatbox-main-container .ays-assistant-chatbox-main-chat-box').addClass('ays-assistant-chatbox-main-chat-box-maximized');
				$('body').addClass('ays-assistant-chatbox-disabled-scroll-body');
			} else {
				$(this).attr('src', src.replace('minimize', 'maximize'));
				$(this).attr('alt', "Maximize");
				_this.$el.removeClass('ays-assistant-chatbox-main-container-maximized-view');
				_this.$el.find('.ays-assistant-chatbox-main-container').removeClass('ays-assistant-chatbox-main-container-maximized-view-inner');
				_this.$el.find('.ays-assistant-chatbox-main-container .ays-assistant-chatbox-main-chat-box').removeClass('ays-assistant-chatbox-main-chat-box-maximized');
				$('body').removeClass('ays-assistant-chatbox-disabled-scroll-body');
			}
		});

		_this.$el.on('click', '.ays-assistant-chatbox-rate-chat-like, .ays-assistant-chatbox-rate-chat-dislike', function (e) {
			_this.feedbackEvents($(this));
		});

		$(document).on('keypress', function (e) {
			if (e.which == 13 && !e.shiftKey) {
				var target = $(e.target);
				if (target.hasClass('ays-assistant-chatbox-prompt-input')) {
					var prompt = _this.$el.find('.ays-assistant-chatbox-prompt-input');
					if ($(prompt).val().trim() != '' &&  $(prompt).is(":focus")) {
						var button = _this.$el.find('.ays-assistant-chatbox-send-button');
						if ( !button.prop('disabled') ) {
							e.preventDefault();
							button.trigger("click");
						}
					}
				} else if (target.hasClass('ays-assistant-chatbox-rate-chat-comment')) {
					var button = _this.$el.find('.ays-assistant-chatbox-rate-chat-submit');
					if ( !button.prop('disabled') ) {
						e.preventDefault();
						button.trigger("click");
					}
				}
			}
		});
    }

	AysChatGPTChatBox.prototype.copyResponse = function (text) {
		var el = jQuery('<textarea>').appendTo('body').val(text).select();
		document.execCommand('copy');
		el.remove();
	}

	AysChatGPTChatBox.prototype.setDbOptions = function () {
		var _this = this;
		var chatTemperature = _this.globalSettings.chatTemprature ? +_this.globalSettings.chatTemprature : 0.7;		
		// var chatAK          = _this.globalSettings.translations.ka ? atob(_this.globalSettings.translations.ka) : '';
		var chatTopP        = _this.globalSettings.chatTopP ? +_this.globalSettings.chatTopP : 1;
		var chatMaxTokents  = _this.globalSettings.chatMaxTokents ? +_this.globalSettings.chatMaxTokents : 1500;

		var chatFrequencyPenalty = _this.globalSettings.chatFrequencyPenalty ? +_this.globalSettings.chatFrequencyPenalty : 0.01;
		var chatPresencePenalty  = _this.globalSettings.chatPresencePenalty ? +_this.globalSettings.chatPresencePenalty : 0.01;

		var chatBestOf = _this.globalSettings.chatBestOf ? +_this.globalSettings.chatBestOf : 1;

		var chatContext = _this.globalSettings.chatContext !== '' ? _this.globalSettings.chatContext : '';
		
		var chatProfession = _this.globalSettings.chatProfession ? _this.globalSettings.chatProfession : '';

		var chatTone = _this.globalSettings.chatTone ? _this.globalSettings.chatTone : '';

		var chatLanguage = _this.globalSettings.chatLanguage ? _this.globalSettings.chatLanguage : '';

		var chatName = _this.globalSettings.chatName ? _this.globalSettings.chatName : '';
			
		var chatModel = _this.globalSettings.chatModel ? _this.globalSettings.chatModel : 'gpt-3.5-turbo-16k';

		var chatGreetingMessage = _this.globalSettings.chatGreetingMessage;
		var chatRegenerateResponse = _this.globalSettings.chatRegenerateResponse ? true : false;

		var postId = _this.globalSettings.postId ? _this.globalSettings.postId : 0;

		var enableRequestLimitations = _this.globalSettings.enableRequestLimitations;
		var requestLimitationsLimit = _this.globalSettings.requestLimitationsLimit
		var requestLimitationsInterval = _this.globalSettings.requestLimitationsInterval;
		var tokenGuestLimitationsLimit = _this.globalSettings.tokenGuestLimitationsLimit
		var tokenGuestLimitationsInterval = _this.globalSettings.tokenGuestLimitationsInterval;
		var tokenLoginLimitationsLimit = _this.globalSettings.tokenLoginLimitationsLimit
		var tokenLoginLimitationsInterval = _this.globalSettings.tokenLoginLimitationsInterval;

		var rateChatLikeOptions = _this.globalSettings.rateChatOptions.like ? _this.globalSettings.rateChatOptions.like : [];
		var rateChatDislikeOptions = _this.globalSettings.rateChatOptions.dislike ? _this.globalSettings.rateChatOptions.dislike : [];
		var rateChatImages = _this.globalSettings.rateChatOptions.images ? _this.globalSettings.rateChatOptions.images : [];

		var chatboxTheme = _this.globalSettings.chatboxTheme ? _this.globalSettings.chatboxTheme : 'default';
		var chatIcon = _this.globalSettings.chatIcon;
		var userProfilePicture = atob(_this.globalSettings.userProfilePicture);
		var isUserLoggedIn = _this.globalSettings.isUserLoggedIn;

		if (enableRequestLimitations) {
			if (getCookie('wp-ays-cgpta-shcd-count') !== undefined) {
				_this.requestCount = +getCookie('wp-ays-cgpta-shcd-count');
			}
			if (getCookie('wp-ays-cgpta-shcd-tcount') !== undefined) {
				_this.tokenCount = +getCookie('wp-ays-cgpta-shcd-tcount');
			}
		}

		_this.dbOptions = {
			chatTemperature : chatTemperature,
			chatTopP : chatTopP,
			chatMaxTokents  : chatMaxTokents,
			chatFrequencyPenalty : chatFrequencyPenalty,
			chatPresencePenalty  : chatPresencePenalty,
			chatModel  : chatModel,
			chatBestOf : chatBestOf,
			chatContext : chatContext,
			chatProfession : chatProfession,
			chatTone : chatTone,
			chatLanguage : chatLanguage,
			chatName : chatName,
			chatGreetingMessage : chatGreetingMessage,
			chatRegenerateResponse : chatRegenerateResponse,
			// chatAK : chatAK,
			enableRequestLimitations : enableRequestLimitations,
			requestLimitationsLimit : requestLimitationsLimit,
			requestLimitationsInterval : requestLimitationsInterval,
			tokenGuestLimitationsLimit : tokenGuestLimitationsLimit,
			tokenGuestLimitationsInterval : tokenGuestLimitationsInterval,
			tokenLoginLimitationsLimit : tokenLoginLimitationsLimit,
			tokenLoginLimitationsInterval : tokenLoginLimitationsInterval,
			chatboxTheme : chatboxTheme,
			chatIcon : chatIcon,
			userProfilePicture : userProfilePicture,
			postId : postId,
			rateChat: {
				like : rateChatLikeOptions,
				dislike : rateChatDislikeOptions,
				images : rateChatImages,
			},
			isUserLoggedIn: isUserLoggedIn,
		}
	}

	AysChatGPTChatBox.prototype.setUpRequestParametrs = function () {
		var _this = this;
		switch(_this.dbOptions.chatModel){
			case 'gpt-3.5-turbo':
			case 'gpt-3.5-turbo-16k':
				_this.messageFirstM = {role: 'system', content: _this.promptFirstM + _this.promptSecondM};
				_this.chatConversation.push(_this.messageFirstM);
				_this.REQUEST_URL = _this.API_MAIN_URL + _this.API_CHAT_COMPLETIONS_URL;
				break;
			default:
				_this.chatConversation.push(_this.promptFirstM , _this.promptSecondM);
				_this.REQUEST_URL = _this.API_MAIN_URL + _this.API_COMPLETIONS_URL;
				break;
		}
	}

	AysChatGPTChatBox.prototype.setUpPromptParametrs = function () {
		var _this = this;
		var professionFirstText = 'Act as: ';
		var toneFirstText = 'Tone: ';
		var languageText = 'Language: ';
		var nameText = 'Name: ';
		var finalText = '';

		if (_this.dbOptions.chatContext != '') {
			_this.promptSecondM = _this.dbOptions.chatContext;
			_this.promptFirstM = '';
		}
		
		if(_this.dbOptions.chatProfession){
			professionFirstText += _this.dbOptions.chatProfession;
			finalText += professionFirstText;
		}

		if(_this.dbOptions.chatTone && _this.dbOptions.chatTone != 'none'){
			if(finalText){
				finalText += '. ';
			}
			var capitalizedTone = _this.dbOptions.chatTone.charAt(0).toUpperCase() + _this.dbOptions.chatTone.slice(1)
			toneFirstText += capitalizedTone;
			finalText += toneFirstText;
		}

		if(_this.dbOptions.chatLanguage){
			if(finalText){
				finalText += '. ';
			}
			var coutries = getCountries();
			languageText += coutries[_this.dbOptions.chatLanguage];
			finalText += languageText;
		}

		if(_this.dbOptions.chatName){
			nameText += _this.dbOptions.chatName;
			_this.promptFirstM = "Your name is " + _this.dbOptions.chatName + ". " + this.promptFirstM;
		}
		
		if(finalText){
			finalText += '. ';
			_this.promptSecondM += finalText;
		}
	}

	AysChatGPTChatBox.prototype.setGreetingMessage = function () {
		var _this = this;
		var buttons = getAIButtons(_this.dbOptions);
		var aIGMessage = "<span class='ays-assistant-chatbox-ai-response-message'>" + _this.globalSettings.translations.chatGreetingMessage + "</span>";
		var aiGreetingMessage = $("<div>", {"class": "ays-assistant-chatbox-ai-message-box"}).html(aIGMessage + buttons);
		_this.$el.find('.ays-assistant-chatbox-messages-box').append(aiGreetingMessage)
	}

	AysChatGPTChatBox.prototype.feedbackEvents = function ($this) {
		var _this = this;

		var action = $this.attr('data-action');
		var htmlOptions = _this.dbOptions.rateChat[action];
		
		var modal = _this.$el.find('.ays-assistant-chatbox-main-chat-modal');
		modal.find('.ays-assistant-chatbox-main-chat-modal-body').css('margin-top', '-20px')
		modal.find('.ays-assistant-chatbox-main-chat-modal-body-image').append('<img src="'+_this.dbOptions.rateChat.images[action]+'">').addClass('ays-assistant-chatbox-main-chat-modal-body-image-rate-chat');
		var readyContent = '<span class="ays-assistant-chatbox-rate-chat-text">'+htmlOptions.text+'</span>';
		if (htmlOptions.action == 'feedback') {
			readyContent += '<textarea class="ays-assistant-chatbox-rate-chat-comment"></textarea>';
			readyContent += '<button class="ays-assistant-chatbox-rate-chat-submit" data-modal-action="submit">'+_this.globalSettings.translations.leaveComment+'</button>';
		}
		modal.find('.ays-assistant-chatbox-main-chat-modal-body-text').append(readyContent);
		modal.css('display', 'flex');

		modal.on('click', function (e) {
			if ($(e.target).attr('data-modal-action') === 'submit') {
				var textarea = $(e.target).prev('textarea.ays-assistant-chatbox-rate-chat-comment');
				var feedback = textarea.length > 0 ? textarea.val() : '';
				
				if (feedback.trim() != '') {
					$.ajax({
						url: _this.globalSettings.ajaxUrl,
						method: 'post',
						dataType: 'json',
						data: {
							action: _this.ajaxAction,
							function: 'ays_chatgpt_save_feedback',
							feedback_data: JSON.stringify({
								post_id: _this.dbOptions.postId,
								user_name: '',
								user_email: '',
								source: 'public',
								type: 'shortcode',
								feedback: feedback,
								feedback_action: action,
							}),
						},
						success: function (response) {
							_this.$el.find('.ays-assistant-chatbox-rate-chat-row').hide();
						},
						error: function (error) {
							console.log(error);
						}
					});
				}

				modal.hide('fast');
				modal.find('.ays-assistant-chatbox-main-chat-modal-body-image').removeClass('ays-assistant-chatbox-main-chat-modal-body-image-rate-chat');
				modal.find('.ays-assistant-chatbox-main-chat-modal-body').css('margin-top', '');
				modal.find('.ays-assistant-chatbox-main-chat-modal-body-image').empty();
				modal.find('.ays-assistant-chatbox-main-chat-modal-body-text').empty();
			} else if ($(e.target).attr('data-modal-action') === 'close') {
				modal.hide('fast');
				modal.find('.ays-assistant-chatbox-main-chat-modal-body-image').removeClass('ays-assistant-chatbox-main-chat-modal-body-image-rate-chat');
				modal.find('.ays-assistant-chatbox-main-chat-modal-body').css('margin-top', '');
				modal.find('.ays-assistant-chatbox-main-chat-modal-body-image').empty();
				modal.find('.ays-assistant-chatbox-main-chat-modal-body-text').empty();
			}
		});
	}

	AysChatGPTChatBox.prototype.checkSession = function () {
		var _this = this;

		if (_this.dbOptions.enableRequestLimitations) {

			var limit = +_this.dbOptions.requestLimitationsLimit;
			var interval = _this.dbOptions.requestLimitationsInterval;
			var timeInSeconds = _this.calculateIntervalInSeconds(interval);

			var tokenLimit = !_this.dbOptions.isUserLoggedIn ? +_this.dbOptions.tokenGuestLimitationsLimit : +_this.dbOptions.tokenLoginLimitationsLimit;
			var tokenInterval = !_this.dbOptions.isUserLoggedIn ? _this.dbOptions.tokenGuestLimitationsInterval : _this.dbOptions.tokenLoginLimitationsInterval;
			var tokenTimeInSeconds = _this.calculateIntervalInSeconds(tokenInterval);

			if (limit > 0 && timeInSeconds > 1) {
				if (getCookie('wp-ays-cgpta-shcd-count') === undefined) {
					_this.requestCount = 1;
					var expiryDate = new Date();
					expiryDate.setSeconds(expiryDate.getSeconds() + timeInSeconds);
					setCookie('wp-ays-cgpta-shcd-count-start', expiryDate.toUTCString(), {'expires': expiryDate.toUTCString()});
					
					setCookie('wp-ays-cgpta-shcd-count', _this.requestCount, {'expires': expiryDate.toUTCString()});
				} else {
					if (+getCookie('wp-ays-cgpta-shcd-count') < limit) {
						var expires = getCookie('wp-ays-cgpta-shcd-count-start');

						setCookie('wp-ays-cgpta-shcd-count', _this.requestCount, {'expires': expires});
					} else {
						_this.$el.find('.ays-assistant-chatbox-messages-box').append($("<div>", {"class": "ays-assistant-chatbox-error-message-box"}).html(_this.globalSettings.translations.requestLimitReached[interval])).scrollTop(_this.$el.find('.ays-assistant-chatbox-messages-box')[0].scrollHeight);
						
						return false;
					}
				}
			}

			if (tokenLimit > 0 && tokenTimeInSeconds > 1) {
				if (getCookie('wp-ays-cgpta-shcd-tcount') === undefined) {
					// _this.tokenCount = 0;
					var expiryDate = new Date();
					expiryDate.setSeconds(expiryDate.getSeconds() + tokenTimeInSeconds);
					setCookie('wp-ays-cgpta-shcd-tcount-start', expiryDate.toUTCString(), {'expires': expiryDate.toUTCString()});
					
					setCookie('wp-ays-cgpta-shcd-tcount', _this.tokenCount, {'expires': expiryDate.toUTCString()});
				} else {
					if (+getCookie('wp-ays-cgpta-shcd-tcount') < tokenLimit) {
						var expires = getCookie('wp-ays-cgpta-shcd-tcount-start');

						setCookie('wp-ays-cgpta-shcd-tcount', _this.tokenCount, {'expires': expires});
					} else {
						_this.$el.find('.ays-assistant-chatbox-messages-box').append($("<div>", {"class": "ays-assistant-chatbox-error-message-box"}).html(_this.globalSettings.translations.tokenLimitReached[tokenInterval])).scrollTop(_this.$el.find('.ays-assistant-chatbox-messages-box')[0].scrollHeight);
						
						return false;
					}
				}
			}
		} else {
			if (getCookie('wp-ays-cgpta-shcd-count') !== undefined) {
				deleteCookie('wp-ays-cgpta-shcd-count');
			}
			if (getCookie('wp-ays-cgpta-shcd-count-start') !== undefined) {
				deleteCookie('wp-ays-cgpta-shcd-count-start');
			}
			if (getCookie('wp-ays-cgpta-shcd-tcount') !== undefined) {
				deleteCookie('wp-ays-cgpta-shcd-tcount');
			}
			if (getCookie('wp-ays-cgpta-shcd-tcount-start') !== undefined) {
				deleteCookie('wp-ays-cgpta-shcd-tcount-start');
			}
		}

		return true;
	}

	AysChatGPTChatBox.prototype.calculateIntervalInSeconds = function (interval) {
		var timeInSeconds = 1;
		
		switch (interval) {
			case 'hour':
				timeInSeconds = 60 * 60;
				break;
			case 'day':
				timeInSeconds = 24 * 60 * 60;
				break;
			case 'week':
				timeInSeconds = 7 * 24 * 60 * 60;
				break;
			case 'month':
				timeInSeconds = 30 * 7 * 24 * 60 * 60;
				break;
			default:
				break;
		}

		return timeInSeconds;
	}

	$.fn.AysChatGPTChatBoxMain = function(options) {
        return this.each(function() {
            if (!$.data(this, 'AysChatGPTChatBoxMain')) {
                $.data(this, 'AysChatGPTChatBoxMain', new AysChatGPTChatBox(this, options));
            } else {
                try {
                    $(this).data('AysChatGPTChatBoxMain').init();
                } catch (err) {
                    console.error('AysChatGPTChatBoxMain has not initiated properly');
                }
            }
        });
    };


    // $(document).find('.ays-assistant-chatbox').AysChatGPTChatBoxMain();

})(jQuery);