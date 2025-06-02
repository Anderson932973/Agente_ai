<?php

defined('BASEPATH') or exit('No direct script access allowed');

define('AGENTE_IA_VERSIONING', get_instance()->app_scripts->core_version());

hooks()->add_action('app_admin_footer', 'agente_ia_add_head_components');
hooks()->add_action('app_admin_footer', 'agente_ia_add_chat_html');

function agente_ia_add_head_components(){
    echo '<link rel="stylesheet" href="' . base_url('modules/agente_ia/assets/css/chat.css') . '" />';
    echo '<script type="text/javascript" src="' . base_url('modules/agente_ia/assets/js/chat.js') . '"></script>';
}

function agente_ia_add_chat_html(){
    echo '
    <div id="agente_ia-chat-button" class="chat-button">
        <div class="chat-bubble">
            Posso te ajudar?
            <div class="chat-dots">
                <div class="dot dot1"></div>
                <div class="dot dot2"></div>
                <div class="dot dot3"></div>
            </div>
        </div>
        <img  class="avatar" src="' . base_url('modules/agente_ia/assets/images/avatar.png') . '" alt="Chat GPT" onclick="toggleChat()">
    </div>
    <div id="agente_ia-chat-box" class="chat-box">
        <div class="chat-header">
            <span>Agente de I.A.s</span>
            <button onclick="toggleChat()">X</button>
        </div>
        <div class="chat-body">
            <div id="chat-messages" class="chat-messages"></div>
            <textarea id="chat-input" placeholder="Digite sua mensagem..." onkeypress="sendMessage(event)"></textarea>
        </div>
    </div>
    ';
}