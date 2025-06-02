.chat-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}

.chat-box {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 300px;
    height: 400px;
    background: white;
    border: 1px solid #ccc;
    display: none;
    flex-direction: column;
    z-index: 1000;
}

.chat-header {
    background: #007bff;
    color: white;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-body {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.chat-messages {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}

#chat-input {
    padding: 10px;
    border: none;
    border-top: 1px solid #ccc;
}