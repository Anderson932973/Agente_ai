function toggleChat() {
    var chatBox = document.getElementById('agente_ia-chat-box');
    var chatBubble = document.querySelector('.chat-bubble');
    if (chatBox.style.display === 'none' || chatBox.style.display === '') {
        chatBox.style.display = 'flex';
        chatBubble.style.display = 'none';
    } else {
        chatBox.style.display = 'none';
        chatBubble.style.display = 'block';
    }
}

function sendMessage(event) {
    if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault(); // Impede a quebra de linha padrão
        var input = document.getElementById('chat-input');
        var message = input.value;
        if (message.trim() !== '') {
            var chatMessages = document.getElementById('chat-messages');
            var messageElement = document.createElement('div');
            messageElement.classList.add('chat-message', 'user');
            messageElement.innerHTML = message + '<span>você</span>';
            chatMessages.appendChild(messageElement);
            input.value = '';

            // Rolar para a última mensagem
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Adicionar animação de 3 pontinhos
            var typingIndicator = document.createElement('div');
            typingIndicator.classList.add('typing-indicator');
            typingIndicator.innerHTML = '<div class="dot"></div><div class="dot"></div><div class="dot"></div>';
            chatMessages.appendChild(typingIndicator);

            // Aqui você pode adicionar a lógica para enviar a mensagem para o GPT POST admin_url('agente_ia/agente_iachat/send')
            fetch('/agente_ia/agente_iachat/send', {
                method: 'POST',
                body: JSON.stringify({ message: message }),
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(function(response) {
                return response.json();
            }).then(function(data) {
                // Remover animação de 3 pontinhos
                chatMessages.removeChild(typingIndicator);

                var messageElement = document.createElement('div');
                messageElement.classList.add('chat-message', 'ia');
                messageElement.innerHTML = data.message + '<span>IA</span>';
                chatMessages.appendChild(messageElement);

                // Rolar para a última mensagem
                chatMessages.scrollTop = chatMessages.scrollHeight;
            });
        }
    }
}

let lastMessageId = null;

function monitorChat() {
    var chatBox = document.getElementById('agente_ia-chat-box');
    if (chatBox.style.display === 'flex') {
        fetch('/agente_ia/agente_iachat/mensagens')
            .then(response => response.json())
            .then(data => {
                if (data.length > 0 && data[data.length - 1].id !== lastMessageId) {
                    lastMessageId = data[data.length - 1].id;
                    var chatMessages = document.getElementById('chat-messages');
                    chatMessages.innerHTML = ''; // Limpa as mensagens atuais
                    data.forEach(message => {
                        var messageElement = document.createElement('div');
                        messageElement.classList.add('chat-message');

                        message.message = message.message.replace(/(?:\r\n|\r|\n)/g, '<br>');
                        /**bold em ** */
                        message.message = message.message.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');
                        /**italic em * */
                        message.message = message.message.replace(/\*(.*?)\*/g, '<i>$1</i>');
                        /**underline em __ */
                        message.message = message.message.replace(/__(.*?)__/g, '<u>$1</u>');
                        /**strikethrough em ~~ */
                        message.message = message.message.replace(/~~(.*?)~~/g, '<s>$1</s>');
                        /**link em [texto](url) */
                        message.message = message.message.replace(/\[(.*?)\]\((.*?)\)/g, '<a href="$2" target="_blank">$1</a>');

                        if (message.sender === 'staff') {
                            messageElement.classList.add('user');
                            messageElement.innerHTML = message.message + '<span>você</span>';
                        } else {
                            messageElement.classList.add('ia');
                            messageElement.innerHTML = message.message + '<span>IA</span>';
                        }
                        chatMessages.appendChild(messageElement);
                    });

                    // Rolar para a última mensagem
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            });
    }
}

// Chama a função monitorChat a cada 5 segundos
setInterval(monitorChat, 3000);

// Mostrar o balão de fala quando a página carregar
document.addEventListener('DOMContentLoaded', function() {
    var chatBubble = document.querySelector('.chat-bubble');
    chatBubble.style.display = 'block';

    var input = document.getElementById('chat-input');
    input.addEventListener('keydown', sendMessage);

    monitorChat();
});