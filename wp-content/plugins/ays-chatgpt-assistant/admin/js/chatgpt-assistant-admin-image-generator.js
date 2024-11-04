(function($) {
    'use strict';
    function AysChatGPTImageGenerator(element, options){
        this.el = element;
        this.$el = $(element);
        this.ajaxAction = 'ays_chatgpt_admin_ajax';

		// DEFINE PREFIXES
        this.CHATGPT_ASSISTANT_CLASS_PREFIX   = 'ays-chatgpt-assistant';
        this.CHATGPT_ASSISTANT_ID_PREFIX      = 'ays-chatgpt-assistant';
        this.CHATGPT_ASSISTANT_NAME_PREFIX    = 'ays_chatgpt_assistant';
        this.CHATGPT_ASSISTANT_OPTIONS_PREFIX = 'chatgpt_assistant_';
        this.dbOptions = undefined;
		// OpenAI settings
		this.OPENAI_API_KEY = '';
		this.REQUEST_URL = "";
		this.API_MAIN_URL = "https://api.openai.com/v1/images";
		this.API_GENERATIONS_URL = "/generations";

        this.init();

        return this;
    }

    AysChatGPTImageGenerator.prototype.init = function() {
        var _this = this;
		_this.setEvents();
    };

    AysChatGPTImageGenerator.prototype.setEvents = function(e){
		var _this = this;

		_this.OPENAI_API_KEY = _this.$el.find('.'+_this.CHATGPT_ASSISTANT_CLASS_PREFIX+'-openai-api-key').val();

		_this.$el.find('#'+_this.CHATGPT_ASSISTANT_CLASS_PREFIX+'-ig-generate').on('click', function () {
			_this.generateImgContent($(this));
		});
		
		_this.$el.on('click', '.'+_this.CHATGPT_ASSISTANT_CLASS_PREFIX+'-ig-save-media', function(e) {
			var url = $(this).attr('data-url');
			var loader = $(this).find('i');
			$.ajax({
				url: aysChatGptAssistantGeneral.ajaxUrl,
				method: 'post',
				dataType: 'json',
				data: {
					image_url: url,
					action: _this.ajaxAction,
					function: 'ays_chatgpt_save_wp_media',
				},
				beforeSend: function () {
					loader.removeClass('display_none');
				},
				success: function (response) {
					if (typeof response != undefined && response.status) {
						swal({
							type: 'success',
							text: response.message,
							showCloseButton: true,
							allowOutsideClick: true,
							allowEscapeKey: true,
							allowEnterKey: true,
						});
					}
				},
				error: function (error) {
					swal({
						type: 'error',
						text: error,
						showCloseButton: true,
						allowOutsideClick: true,
						allowEscapeKey: true,
						allowEnterKey: true,
					});
				},
				complete: function () {
					loader.addClass('display_none');
				}
			});
		});
		
    }

	AysChatGPTImageGenerator.prototype.generateImgContent = function (button) {
		var _this = this;
		var loader = button.find('i');

		var requestBody = _this.generateRequestBody();
		if (Object.keys(requestBody).length === 0 || _this.OPENAI_API_KEY === '') return false;

		button.prop('disabled', true);
		loader.removeClass('display_none');
		_this.imageGeneration(requestBody)
		.then(data => {
			if (!(typeof data.error === "object")) {
				if (typeof data.data[0] != undefined && typeof data.data[0].url != undefined) {
					var template = _this.$el.find('.ays-chatgpt-assistant-image-box-template').eq(0).clone();
					var container = _this.$el.find('.ays-chatgpt-assistant-image-generator-img');
	
					template.removeClass('ays-chatgpt-assistant-image-box-template');
					template.css('background-image', 'url(' + data.data[0].url + ')');
					template.find('.ays-chatgpt-assistant-ig-download').attr('href', data.data[0].url);
					template.find('.ays-chatgpt-assistant-ig-save-media').attr('data-url', data.data[0].url);
	
					container.append(template);
				}
			} else {
				var errorMessage = data.error.message;
				if(data.error.type == "insufficient_quota"){
					errorMessage += " <a href='https://platform.openai.com/account/usage'> https://platform.openai.com/account/usage </a>";
				}
			}
			loader.addClass('display_none');
			button.prop('disabled', false);
		});
	}

	AysChatGPTImageGenerator.prototype.generateRequestBody = function () {
		var _this = this;

		var model = _this.$el.find('#ays-chatgpt-assistant-ig-select-model').val() ?? 'dall-e-2';
		var size = _this.$el.find('#ays-chatgpt-assistant-ig-select-size').val() ?? '1024x1024';
		var style = _this.$el.find('#ays-chatgpt-assistant-ig-select-style').val() ?? 'natural';
		var resolution = _this.$el.find('#ays-chatgpt-assistant-ig-select-resolution').val() ?? 'None';
		var photography = _this.$el.find('#ays-chatgpt-assistant-ig-select-photography').val() ?? 'None';
		var prompt = _this.$el.find('#ays-chatgpt-assistant-ig-prompt').val() ?? '';

		if (prompt === '') return {};
		
		var finalPrompt = 'Generate an image '+prompt+' with the following settings: Style:'+style+',Photography:'+photography+',Resolution:'+resolution+'.'
		
		var body = {
			model: model,
			prompt: finalPrompt,
			n: 1,
			size: size,
		}

		if (model == 'dall-e-3') {
			body['style'] = style;
		}

		return body;
	}

	AysChatGPTImageGenerator.prototype.imageGeneration = function (requestBody) {
		var _this = this;
		_this.REQUEST_URL = _this.API_MAIN_URL + _this.API_GENERATIONS_URL;

		return fetch(_this.REQUEST_URL, {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"Authorization": `Bearer ${_this.OPENAI_API_KEY}`,
			},
			body: JSON.stringify(requestBody),
		})
		
        .then(response => {
            return response.json();
        })
	}

	$.fn.AysChatGPTImageGeneratorMain = function(options) {       
		if (!$.data(this, 'AysChatGPTImageGeneratorMain')) {
			$.data(this, 'AysChatGPTImageGeneratorMain', new AysChatGPTImageGenerator(this, options));
		} else {
			try {
				$(this).data('AysChatGPTImageGeneratorMain').init();
			} catch (err) {
				console.error('AysChatGPTImageGeneratorMain has not initiated properly');
			}
		}        
    };

    $(document).find('#ays-image-generator-form').AysChatGPTImageGeneratorMain();

})(jQuery);