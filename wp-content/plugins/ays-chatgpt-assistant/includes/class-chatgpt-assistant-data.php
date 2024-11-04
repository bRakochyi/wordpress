<?php

class ChatGPT_assistant_Data {

	
    public static function makeRequest($api_key, $method, $request_type, $options = []){
        $response_data = array(
            'openai_response_code' => 400,
            'openai_response_data' => array(),
        );

        $REQUEST_MAIN_URL = 'https://api.openai.com';
        $API_VERSION = 'v1';
        $COMPLETION_URL = '/completions';

        if ($api_key == '') {
            return  $response_data = array(
                'openai_response_code' => 400,
                'openai_response_data' => array(),
                'openai_response_message' => 'API KEY is not provided',
            );
        }

        if ($method == '' || $request_type == '') {
            return $response_data;
        }

        // Set options        
        if(isset($options) && !empty($options)){
            $model  = isset($options['model']) && $options['model'] != '' ? $options['model'] : 'gpt-3.5-turbo-16k';
            $prompt = isset($options['prompt']) && $options['prompt'] != '' ? sanitize_text_field(trim($options['prompt'])) : '';
            $prompt = 'Converse as if you were an AI assistant. Answer the question as truthfully as possible. '.$prompt. '.';
            $temperature = isset($options['temperature']) && $options['temperature'] != '' ? sanitize_text_field(($options['temperature'])) : 0.7;
            $max_tokens = isset($options['max_tokens']) && $options['max_tokens'] != '' ? sanitize_text_field(($options['max_tokens'])) : 1500;
            $frequency_penalty = isset($options['frequency_penalty']) && $options['frequency_penalty'] != '' ? sanitize_text_field(($options['frequency_penalty'])) : 0.01;
            $presence_penalty  = isset($options['presence_penalty ']) && $options['presence_penalty '] != '' ? sanitize_text_field(($options['presence_penaltypresence_penalty '])) : 0.01;
            $best_of  = isset($options['best_of ']) && $options['best_of '] != '' ? sanitize_text_field(($options['best_of '])) : 1;
        }
        
        // Build Url
        $request_type = '/'.$request_type;
        $url = $REQUEST_MAIN_URL . '/' . $API_VERSION . $request_type;
        $url = esc_url($url);
        // 
        
        // Create Headers
        $headers = array(
                "Content-Type"  => "application/json",
                "Authorization" => "Bearer ".$api_key
            );
        //


        // Create request
        $request_data = array(
            "headers" => $headers,          
            "method " => $method,
        );

        if($method != 'GET'){            
            // Create Body        
            $body = array(
                "model" => $model,
                "prompt" => $prompt,
                "temperature" => $temperature,
                "max_tokens" => $max_tokens,
                "frequency_penalty" => $frequency_penalty,
                "presence_penalty" => $presence_penalty,
                "best_of" => $best_of,
            );

            $body = json_encode($body);            
            $request_data['body'] = $body;
        }
        //

        // Send request
        $api_call = wp_remote_request( $url , $request_data);
        $response_code = wp_remote_retrieve_response_code( $api_call );
        $get_data = wp_remote_retrieve_body($api_call);
        $response = json_decode($get_data , true);
        if($response_code == 200){
            if(!array_key_exists('error', $response)){
                $response_data = array(
                    'openai_response_code' => $response_code,
                    'openai_response_data' => $response,
                    'openai_response_message' => 'success',
                );
            }            
        }
        else{
            $response_error_message = isset($response['error']['message']) && $response['error']['message'] != '' ? $response['error']['message'] : '';
            $response_data = array(
                'openai_response_code' => $response_code,
                'openai_response_data' => $response,
                'openai_response_message' => $response_error_message,
            );
        }
        return $response_data;
    }

	public static function get_chatbot_styles($options){
        $icon_size = isset($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chat_icon_size_front']) && $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chat_icon_size_front'] != '' ? $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chat_icon_size_front'] : $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chat_icon_size'];
        $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_bg'] = isset($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_bg']) && $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_bg'] != '' ? $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_bg'] : '#3b3b3b';
        $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_color'] = isset($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_color']) && $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_color'] != '' ? $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_color'] : '#f8f8f8';
        $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_letter_spacing'] = isset($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_letter_spacing']) && $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_letter_spacing'] != '' ? $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_letter_spacing'] : 0;
        $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_font_size'] = isset($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_font_size']) && $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_font_size'] != '' ? $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_font_size'] : 14;
        $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_color'] = isset($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_color']) && $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_color'] != '' ? $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_color'] : $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_bg'];
        $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_width'] = isset($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_width']) && $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_width'] != '' ? $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_width'] : 0;
        $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_radius'] = isset($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_radius']) && $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_radius'] != '' ? $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_radius'] : 10;
        $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_padding'] = isset($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_padding']) && $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_padding'] != '' ? $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_padding'] : 5;
        $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_open_on_click'] = isset($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_open_on_click']) && $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_open_on_click'] != '' ? $options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_open_on_click'] : true;

		$styles = '<style>';		
		if ($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'position'] == 'center'){
			$styles .= '
						div.ays-assistant-chatbox div.ays-assistant-chatbox-main-container {
							left: 50%;
							transform: translateX(-50%);
                            margin-left: 0px;
						}
			';
		}
		elseif($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'position'] == 'left'){
			$styles .= '
						div.ays-assistant-chatbox div.ays-assistant-chatbox-main-container {
							left: 0;
							right: unset;
						}
			';
		}
		else{
			$styles .= '
						div.ays-assistant-chatbox div.ays-assistant-chatbox-main-container {
							right: 0;
						}
			';
		}

        if ($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'icon_position'] == 'bottom-center'){
			$styles .= '
						div.ays-assistant-chatbox div.ays-assistant-chatbox-closed-view {
							left: 50%;
                            transform: translateX(-50%);
						}

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view-text {
                            bottom: ' . ($icon_size + 13) . 'px;
                            left: -150%;
                            right: -150%;
                        }

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view-text::after {
                            top: 100%;
                            left: 50%;
                            transform: translateX(-50%);
                            border-color: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_color'].' transparent transparent transparent;
                            margin-top: '.($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_width'] - 1).'px;
                        }
			';
		}
		elseif($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'icon_position'] == 'bottom-left'){
			$styles .= '
						div.ays-assistant-chatbox div.ays-assistant-chatbox-closed-view {
							left: 20px;
							right: unset;
						}

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view-text {
                            top: 50%;
                            left: ' . ($icon_size + 13) . 'px;
                            right: -300%;
                            transform: translateY(-50%);
                        }

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view-text::after {
                            top: 50%;
                            transform: translateY(-50%);
                            right: 100%;
                            border-color: transparent '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_color'].' transparent transparent;
                            margin-right: '.($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_width'] - 1).'px;
                        }
			';
		}
        elseif($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'icon_position'] == 'top-right'){
			$styles .= '
						div.ays-assistant-chatbox div.ays-assistant-chatbox-closed-view {
							right: 20px;
                            top: 20px;
						}

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view-text {
                            top: 50%;
                            left: -300%;
                            right: ' . ($icon_size + 13) . 'px;
                            transform: translateY(-50%);
                        }

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view-text::after {
                            top: 50%;
                            transform: translateY(-50%);
                            left: 100%;
                            border-color: transparent transparent transparent '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_color'].';
                            margin-left: '.($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_width'] - 1).'px;
                        }
			';
		}
        elseif($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'icon_position'] == 'top-center'){
			$styles .= '
						div.ays-assistant-chatbox div.ays-assistant-chatbox-closed-view {
							left: 50%;
                            transform: translateX(-50%);
                            top: 20px;
						}

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view-text {
                            left: -150%;
                            right: -150%;
                            top: ' . ($icon_size + 13) . 'px;
                        }

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view-text::after {
                            bottom: 100%;
                            left: 50%;
                            transform: translateX(-50%);
                            border-color: transparent transparent '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_color'].' transparent;
                            margin-bottom: '.($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_width'] - 1).'px;
                        }
			';
		}
        elseif($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'icon_position'] == 'top-left'){
			$styles .= '
						div.ays-assistant-chatbox div.ays-assistant-chatbox-closed-view {
							left: 20px;
							right: unset;
                            top: 20px;
						}

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view-text {
                            top: 50%;
                            left: ' . ($icon_size + 13) . 'px;
                            right: -300%;
                            transform: translateY(-50%);
                        }

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view-text::after {
                            top: 50%;
                            transform: translateY(-50%);
                            right: 100%;
                            border-color: transparent '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_color'].' transparent transparent;
                            margin-right: '.($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_width'] - 1).'px;
                        }
			';
		}
		else{
			$styles .= '
						div.ays-assistant-chatbox div.ays-assistant-chatbox-closed-view {
							right: 20px;
						}

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view-text {
                            top: 50%;
                            left: -300%;
                            right: ' . ($icon_size + 13) . 'px;
                            transform: translateY(-50%);
                        }

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view-text::after {
                            top: 50%;
                            transform: translateY(-50%);
                            left: 100%;
                            border-color: transparent transparent transparent '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_color'].';
                            margin-left: '.($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_width'] - 1).'px;
                        }
			';
		}

			$styles .= '
						div.ays-assistant-chatbox-main-container div.ays-assistant-chatbox-header-row,
						div.ays-assistant-chatbox-main-container button.ays-assistant-chatbox-send-button,
						div.ays-assistant-chatbox-main-container button.ays-assistant-chatbox-regenerate-response-button {
							background-color: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbox_color'].';
						}
						div.ays-assistant-chatbox-main-container button.ays-assistant-chatbox-send-button:disabled,
						div.ays-assistant-chatbox-main-container button.ays-assistant-chatbox-regenerate-response-button:disabled {
							background-color: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbox_color'].'2b;
						}
						.ays-assistant-chatbox[colmode] div.ays-assistant-chatbox-main-container div.ays-assistant-chatbox-main-chat-box,
                        .ays-assistant-chatbox-shortcode[colmode] div.ays-assistant-chatbox-main-container div.ays-assistant-chatbox-main-chat-box {
							background-color: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbox_background_color'].';
							border-radius: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_border_radius'].'px;
						}
						.ays-assistant-chatbox[colmode] div.ays-assistant-chatbox-main-container div.ays-assistant-chatbox-input-box,
                        .ays-assistant-chatbox-shortcode[colmode] div.ays-assistant-chatbox-main-container div.ays-assistant-chatbox-input-box {
							border-radius: 0 0 '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_border_radius'].'px '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_border_radius'].'px;
						}
                        .ays-assistant-chatbox-shortcode div.ays-assistant-chatbox-main-container p.ays-assistant-chatbox-header-text,
                        .ays-assistant-chatbox-shortcode div.ays-assistant-chatbox-main-container button.ays-assistant-chatbox-send-button,
                        .ays-assistant-chatbox div.ays-assistant-chatbox-main-container button.ays-assistant-chatbox-send-button,
                        .ays-assistant-chatbox div.ays-assistant-chatbox-main-container p.ays-assistant-chatbox-header-text {
							color: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbox_header_text_color'].' !important;
						}
                        .ays-assistant-chatbox div.ays-assistant-chatbox-main-container button.ays-assistant-chatbox-send-button,
                        .ays-assistant-chatbox-shortcode div.ays-assistant-chatbox-main-container button.ays-assistant-chatbox-send-button {
                            font-size: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'send_button_font_size'].'px;
                        }
                        div.ays-assistant-chatbox-main-container button.ays-assistant-chatbox-regenerate-response-button,
                        div.ays-assistant-chatbox-main-container button.ays-assistant-chatbox-send-button,
                        div.ays-assistant-chatbox-main-container button.ays-assistant-chatbox-speech-to-text-button {
                            padding: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'send_button_padding'].'px !important;
                        }
						div.ays-assistant-chatbox-main-container div.ays-assistant-chatbox-messages-box div.ays-assistant-chatbox-ai-message-box,
						div.ays-assistant-chatbox-main-container div.ays-assistant-chatbox-messages-box div.ays-assistant-chatbox-loading-box {
							background-color: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'response_bg_color'].';
							color: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'response_text_color'].';
						}
                        div.ays-assistant-chatbox-main-container .ays-assistant-chatbox-ai-message-buttons svg {
							fill: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'response_icons_color'].' !important;
						}
                        div.ays-assistant-chatbox-main-container div.ays-assistant-chatbox-messages-box div.ays-assistant-chatbox-ai-message-box,
						div.ays-assistant-chatbox-main-container div.ays-assistant-chatbox-messages-box .ays-assistant-chatbox-ai-response-message {
							border-radius: 0 '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'message_border_radius'].'px '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'message_border_radius'].'px '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'message_border_radius'].'px;
						}
						div.ays-assistant-chatbox-main-container div.ays-assistant-chatbox-messages-box div.ays-assistant-chatbox-user-message-box {
							background-color: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'message_bg_color'].';
							color: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'message_text_color'].';
							border-radius: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'message_border_radius'].'px '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'message_border_radius'].'px 0 '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'message_border_radius'].'px;
						}
                        
						div.ays-assistant-chatbox-main-container div.ays-assistant-chatbox-messages-box div.ays-assistant-chatbox-user-message-box,
						div.ays-assistant-chatbox-main-container div.ays-assistant-chatbox-messages-box div.ays-assistant-chatbox-ai-message-box,
						div.ays-assistant-chatbox-main-container div.ays-assistant-chatbox-messages-box .ays-assistant-chatbox-ai-response-message{
							font-size: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'message_font_size'].'px;
							margin-bottom: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'message_spacing'].'px;
						}

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view .ays-assistant-chatbox-closed-view-text {
                            background: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_bg'].';
                            border-radius: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_radius'].'px;
                        }

                        div.ays-assistant-chatbox .ays-assistant-chatbox-closed-view {
                            width: '.$icon_size.'px !important;
                            height: '.$icon_size.'px !important;
                        }

                        .ays-assistant-chatbox .ays-assistant-chatbox-main-container {
                            width: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chat_width'].$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chat_width_format'].';
                            height: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chat_height'].$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chat_height_format'].';
                        }

                        .ays-assistant-chatbox .ays-assistant-chatbox-closed-view .ays-assistant-chatbox-closed-view-text {
                            color: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_color'].';
                            letter-spacing: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_letter_spacing'].'px;
                            font-size: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_font_size'].'px;
                            border: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_width'].'px solid '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_border_color'].';
                            padding: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_padding'].'px;
                        }

                        .ays-assistant-chatbox .ays-assistant-chatbox-main-chat-modal .ays-assistant-chatbox-main-chat-modal-footer-button button[data-modal-action="confirm"],
                        .ays-assistant-chatbox-shortcode .ays-assistant-chatbox-main-chat-modal .ays-assistant-chatbox-main-chat-modal-footer-button button[data-modal-action="confirm"] {
							background: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'end_chat_button_bg_color'].' !important;
							color: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'end_chat_button_text_color'].' !important;
							font-size: '.$options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'end_chat_button_text_font_size'].'px !important;
						}
			';

        if ($options[CHATGPT_ASSISTANT_OPTIONS_PREFIX.'chatbot_icon_text_open_on_click']) {
            $styles .= '
                        .ays-assistant-chatbox-closed-view-text {
                            cursor: pointer;
                        }
            ';
        }

		$styles .= '</style>';
						
		return $styles;
	}

    // Get chatbox themes
	public static function get_chatbox_all_themes(){
		$themes = array(
			'chatgpt' => array(
				'class' => 'ays-assistant-chatbox-chatgpt-theme',
				'css_path' => CHATGPT_ASSISTANT_ADMIN_URL . '/css/themes/chatgpt-assistant-admin-chatgpt-theme.css',
			)
		);

		return $themes;
	}

	public static function get_chatbot_main_box( $chatbox_mode = 'light', $api_key = '', $options = []){
        $chatgpt_assistant_message_placeholder = isset($options['chatgpt_assistant_message_placeholder']) && $options['chatgpt_assistant_message_placeholder'] != '' ? stripslashes(sanitize_text_field($options['chatgpt_assistant_message_placeholder'])) : __('Enter your message', 'chatgpt-assistant');
        $chatgpt_assistant_chatbot_name = isset($options['chatgpt_assistant_chatbot_name']) && $options['chatgpt_assistant_chatbot_name'] != '' ? stripslashes(sanitize_text_field($options['chatgpt_assistant_chatbot_name'])) : __('AI Assistant', 'chatgpt-assistant');
        $chatgpt_assistant_compliance_text = isset($options['chatgpt_assistant_compliance_text']) && $options['chatgpt_assistant_compliance_text'] != '' ? stripslashes(sanitize_text_field($options['chatgpt_assistant_compliance_text'])) : '';
        $chatgpt_assistant_compliance_text_padding = $chatgpt_assistant_compliance_text === '' ? '' : 'style="padding:4px 20px"';
        $chatgpt_assistant_send_message_icon = (isset($options['chatgpt_assistant_send_message_icon']) && $options['chatgpt_assistant_send_message_icon'] != '') ? stripslashes ( esc_attr( $options['chatgpt_assistant_send_message_icon'] ) ) : esc_attr(CHATGPT_ASSISTANT_ADMIN_URL) . "/images/icons/send-button-icon.svg";
        $chatgpt_assistant_send_message_text = (isset($options['chatgpt_assistant_send_message_text']) && $options['chatgpt_assistant_send_message_text'] != '') ? stripslashes ( esc_attr( $options['chatgpt_assistant_send_message_text'] ) ) : "";
        
        $chatgpt_assistant_theme = isset($options['chatgpt_assistant_chatbox_theme']) && $options['chatgpt_assistant_chatbox_theme'] != '' ? sanitize_text_field($options['chatgpt_assistant_chatbox_theme']) : 'default' ;
        $chatbox_theme_class = '';

        if ($chatgpt_assistant_theme != 'default') {
            $all_themes = self::get_chatbox_all_themes();
            $current_theme = $all_themes[$chatgpt_assistant_theme];
            $chatbox_theme_class = $current_theme['class'];
            wp_enqueue_style( CHATGPT_ASSISTANT_NAME . '-theme-' . $chatgpt_assistant_theme, $current_theme['css_path'], array(), CHATGPT_ASSISTANT_VERSION, 'all' );
        }

		$contnent = '<div class="ays-assistant-chatbox" style="display: none;" colmode="'.esc_attr($chatbox_mode).'">
            <div class="ays-assistant-chatbox-closed-view"> <!-- closed logo -->
                <div class="ays-assistant-closed-icon-container">
                    <img class="ays-assistant-chatbox-logo-image" src="'.esc_attr(CHATGPT_ASSISTANT_ADMIN_URL).'/images/icons/chatgpt-icon.png" alt="ChatGPT icon">
                </div>
            </div>
            <div class="ays-assistant-chatbox-maximized-bg" style="display: none;"></div>
            <div class="ays-assistant-chatbox-main-container ' . $chatbox_theme_class . '" style="display: none;">
                <div class="ays-assistant-chatbox-main-chat-modal" style="display: none;">
                    <div class="ays-assistant-chatbox-main-chat-modal-container">
                        <div class="ays-assistant-chatbox-main-chat-modal-header">
                            <div class="ays-assistant-chatbox-main-chat-modal-header-close">
                                <svg data-modal-action="close" xmlns="http://www.w3.org/2000/svg" fill="#000000" width="25" height="25" viewBox="0 0 320 512">
                                    <path data-modal-action="close" d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z" />
                                </svg>
                            </div>
                            <div class="ays-assistant-chatbox-main-chat-modal-header-text"></div>
                        </div>
                        <div class="ays-assistant-chatbox-main-chat-modal-body">
                            <div class="ays-assistant-chatbox-main-chat-modal-body-image"></div>
                            <div class="ays-assistant-chatbox-main-chat-modal-body-text"></div>
                        </div>
                        <div class="ays-assistant-chatbox-main-chat-modal-footer">
                            <div class="ays-assistant-chatbox-main-chat-modal-footer-button"></div>
                            <div class="ays-assistant-chatbox-main-chat-modal-footer-text"></div>
                        </div>
                    </div>
                </div>
                <div class="ays-assistant-chatbox-main-chat-box">
                    <div class="ays-assistant-chatbox-header-row"> <!-- header row -->
                        <div class="ays-assistant-header-row-logo-box-row">
                            <div class="ays-assistant-header-row-logo-row">
                                <div class="ays-assistant-header-row-logo">
                                    <img class="ays-assistant-header-row-logo-image" src="'. esc_attr(CHATGPT_ASSISTANT_ADMIN_URL).'/images/icons/chatgpt-icon.png" alt="ChatGPT icon">
                                </div>
                                <p class="ays-assistant-chatbox-header-text">'. $chatgpt_assistant_chatbot_name .'</p>
                            </div>
                        </div>
                        <div class="ays-assistant-chatbox-logo">
                            <img src="'. esc_attr(CHATGPT_ASSISTANT_ADMIN_URL).'/images/icons/close-button.svg" alt="Close" class="ays-assistant-chatbox-close-bttn">
                            <img src="'. esc_attr(CHATGPT_ASSISTANT_ADMIN_URL).'/images/icons/end-button.svg" alt="End" class="ays-assistant-chatbox-end-bttn">
                        </div>
                    </div>
                    <div class="ays-assistant-chatbox-messages-box"> <!-- messages container -->
                        <div class="ays-assistant-chatbox-loading-box" style="display: none;"> <!-- loader -->
                            <div class="ays-assistant-chatbox-loader-ball-2">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div class="ays-assistant-chatbox-input-box"> <!-- prompt part -->
                        <textarea style="overflow:auto" rows="1" class="ays-assistant-chatbox-prompt-input" name="ays_assistant_chatbox_prompt" id="ays-assistant-chatbox-prompt" placeholder="' . $chatgpt_assistant_message_placeholder . '"></textarea>';

        if (isset($options['chatgpt_assistant_regenerate_response']) && $options['chatgpt_assistant_regenerate_response']) {
            $contnent .='<button class="ays-assistant-chatbox-regenerate-response-button" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#f8f8f8" width="18" height="18">
                                <path d="M142.9 142.9c62.2-62.2 162.7-62.5 225.3-1L327 183c-6.9 6.9-8.9 17.2-5.2 26.2s12.5 14.8 22.2 14.8H463.5c0 0 0 0 0 0H472c13.3 0 24-10.7 24-24V72c0-9.7-5.8-18.5-14.8-22.2s-19.3-1.7-26.2 5.2L413.4 96.6c-87.6-86.5-228.7-86.2-315.8 1C73.2 122 55.6 150.7 44.8 181.4c-5.9 16.7 2.9 34.9 19.5 40.8s34.9-2.9 40.8-19.5c7.7-21.8 20.2-42.3 37.8-59.8zM16 312v7.6 .7V440c0 9.7 5.8 18.5 14.8 22.2s19.3 1.7 26.2-5.2l41.6-41.6c87.6 86.5 228.7 86.2 315.8-1c24.4-24.4 42.1-53.1 52.9-83.7c5.9-16.7-2.9-34.9-19.5-40.8s-34.9 2.9-40.8 19.5c-7.7 21.8-20.2 42.3-37.8 59.8c-62.2 62.2-162.7 62.5-225.3 1L185 329c6.9-6.9 8.9-17.2 5.2-26.2s-12.5-14.8-22.2-14.8H48.4h-.7H40c-13.3 0-24 10.7-24 24z" />
                            </svg>
                        </button>';
        }

        $contnent .= '<button class="ays-assistant-chatbox-send-button" disabled style="'. ($chatgpt_assistant_send_message_text !== "" ? '' : 'line-height:0').'">';

            if ($chatgpt_assistant_send_message_text !== "") {
                $contnent .= esc_attr($chatgpt_assistant_send_message_text);
            } else {
                $contnent .= '<img src="'. esc_attr($chatgpt_assistant_send_message_icon).'" />';
            }
            
        $contnent .= '</button>
                    </div>
                    <div class="ays-assistant-chatbox-notice-box" ' . $chatgpt_assistant_compliance_text_padding . '>
                        <span>' . $chatgpt_assistant_compliance_text . '</span>
                    </div>
                </div>
            </div>
        </div>';
						
		return $contnent;
	}

    public static function get_supported_coutries(){
        $countries = [
            'sq' => 'Albanian',
            'ar' => 'Arabic',
            'hy' => 'Armenian',
            'awa' => 'Awadhi',
            'az' => 'Azerbaijani',
            'ba' => 'Bashkir',
            'eu' => 'Basque',
            'be' => 'Belarusian',
            'bn' => 'Bengali',
            'bho' => 'Bhojpuri',
            'bs' => 'Bosnian',
            'pt-BR' => 'Brazilian Portuguese',
            'bg' => 'Bulgarian',
            'yue' => 'Cantonese (Yue)',
            'ca' => 'Catalan',
            'hne' => 'Chhattisgarhi',
            'zh' => 'Chinese',
            'hr' => 'Croatian',
            'cs' => 'Czech',
            'da' => 'Danish',
            'doi' => 'Dogri',
            'nl' => 'Dutch',
            'en' => 'English',
            'et' => 'Estonian',
            'fo' => 'Faroese',
            'fi' => 'Finnish',
            'fr' => 'French',
            'gl' => 'Galician',
            'ka' => 'Georgian',
            'de' => 'German',
            'el' => 'Greek',
            'gu' => 'Gujarati',
            'bgc' => 'Haryanvi',
            'he' => 'Hebrew',
            'hi' => 'Hindi',
            'hu' => 'Hungarian',
            'id' => 'Indonesian',
            'ga' => 'Irish',
            'it' => 'Italian',
            'ja' => 'Japanese',
            'jv' => 'Javanese',
            'kn' => 'Kannada',
            'ks' => 'Kashmiri',
            'kk' => 'Kazakh',
            'kok' => 'Konkani',
            'ko' => 'Korean',
            'ky' => 'Kyrgyz',
            'lv' => 'Latvian',
            'lt' => 'Lithuanian',
            'mk' => 'Macedonian',
            'mai' => 'Maithili',
            'ms' => 'Malay',
            'mt' => 'Maltese',
            'zh' => 'Mandarin',
            'zh' => 'Mandarin Chinese',
            'mr' => 'Marathi',
            'mwr' => 'Marwari',
            'nan' => 'Min Nan',
            'ro' => 'Moldovan',
            'mn' => 'Mongolian',
            'sr-ME' => 'Montenegrin',
            'ne' => 'Nepali',
            'no' => 'Norwegian',
            'or' => 'Oriya',
            'ps' => 'Pashto',
            'fa' => 'Persian (Farsi)',
            'pl' => 'Polish',
            'pt' => 'Portuguese',
            'pa' => 'Punjabi',
            'raj' => 'Rajasthani',
            'ro' => 'Romanian',
            'ru' => 'Russian',
            'sa' => 'Sanskrit',
            'sat' => 'Santali',
            'sr' => 'Serbian',
            'sd' => 'Sindhi',
            'si' => 'Sinhala',
            'sk' => 'Slovak',
            'sl' => 'Slovene',
            'sl' => 'Slovenian',
            'es' => 'Spanish',
            'sw' => 'Swahili',
            'sv' => 'Swedish',
            'tg' => 'Tajik',
            'ta' => 'Tamil',
            'tt' => 'Tatar',
            'te' => 'Telugu',
            'th' => 'Thai',
            'tr' => 'Turkish',
            'tk' => 'Turkmen',
            'uk' => 'Ukrainian',
            'ur' => 'Urdu',
            'uz' => 'Uzbek',
            'vi' => 'Vietnamese',
            'cy' => 'Welsh',
            'wu' => 'Wu',
          ];

        return $countries;
    }

    public static function check_is_elementor(){
        if( isset( $_GET['action'] ) && $_GET['action'] == 'elementor' ){
            $is_elementor = true;
        }elseif( isset( $_REQUEST['elementor-preview'] ) && $_REQUEST['elementor-preview'] != '' ){
            $is_elementor = true;
        }else{
            $is_elementor = false;
        }

        if ( ! $is_elementor ) {
            $is_elementor = ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'elementor_ajax' ) ? true : false;
        }

        return $is_elementor;
    }

}

?>