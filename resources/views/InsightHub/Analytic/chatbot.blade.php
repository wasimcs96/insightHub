@extends('insighthub.layout.app')

@section('title', $title ?? 'InsightHub Chatbot Analytics')

@section('styles')
    <style>
        :root {
            --sidebar-width: 349px;
            --sidebar-collapsed-width: 99px;
            --accent: #F7941C;
            --muted: #99A1B7;
            --bg: #FFFFFF;
            --border: #ECF0F3;
            --text: #2E2F38;
        }

        html,
        body {
            height: 100%;
        }

        #sidebar {
            width: var(--sidebar-width);
            background-color: var(--bg);
            transition: width 0.28s ease-in-out, padding 0.24s ease-in-out;
            display: flex;
            padding: 32px;
            flex-direction: column;
            align-items: flex-start;
            align-self: stretch;
            border-top: 1px solid var(--border);
            border-right: 1px solid var(--border);
            gap: 16px;
            color: var(--text);
            font-size: 16px;
            font-weight: 400;
            line-height: 21px;
            box-sizing: border-box;
            position: relative;
        }

        #sidebar.hidden {
            width: var(--sidebar-collapsed-width);
            overflow: hidden;
            display: flex;
            padding: 32px;
        }

        #sidebar.hidden>*:not(#toggleSidebar) {
            display: none;
        }

        #sidebar h3 {
            margin: 0;
        }

        #newChatBtn {
            padding: 8px;
            align-items: center;
            gap: 10px;
            border: none;
            cursor: pointer;
            background: none;
            display: flex;
        }

        .chat-history-item {
            cursor: pointer;
            position: relative;
            height: auto;
            padding: 8px;
            gap: 10px;
            display: flex;
            align-items: center;
            color: var(--text);
            font-size: 14px;
            font-weight: 400;
            line-height: 19px;
            justify-content: space-between;
            border-radius: 6px;
            transition: background 0.12s ease;
            word-break: break-word;
        }

        .chat-history-item:hover {
            background: #FFF8EB;
        }

        .chat-history-item.active {
            background: #FFF4E6;
        }

        .delete-btn {
            color: #E03322 !important;
        }

        #main-panel {
            flex: 1;
            padding: 32px;
            border-top: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            min-height: 0;
        }

        #toggleSidebar {
            cursor: pointer;
            font-size: 20px;
            height: 35px;
            background: transparent;
            padding: 8px;
            border: 0;
        }

        .topbar-title {
            color: var(--text);
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .chat-area {
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 100%;
            min-height: 0;
        }

        #chat-window {
            overflow-y: auto;
            max-height: calc(100vh - 380px);
            padding-right: 8px;
        }

        .message.user {
            text-align: right;
            margin-left: auto;
            margin-bottom: 32px;
        }

        .message.agent {
            color: var(--text);
            font-size: 16px;
            font-weight: 400;
            line-height: 21px;
            margin-bottom: 16px !important;
        }

        .message.user .bubble {
            display: inline-block;
            padding: 12px;
            border-radius: 8px;
            background: #F5F7F8;
            color: var(--text);
            font-size: 16px;
            font-weight: 400;
            line-height: 21px;
        }

        .message.agent .bubble {
            display: inline-block;
            color: var(--text);
        }

        .typing {
            width: 45px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .typing-bubble {
            display: inline-flex;
            padding: 8px;
            border-radius: 8px;
            align-items: center;
        }

        .dot {
            width: 8px;
            height: 8px;
            background: #DDE2E8;
            border-radius: 50%;
            animation: blink 1.4s infinite both;
            margin-right: 4px;
        }

        .dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes blink {
            0% {
                opacity: .2;
            }

            20% {
                opacity: 1;
            }

            100% {
                opacity: .2;
            }
        }

        #input-area {
            display: flex;
            margin-top: 20px;
            height: 48px;
            padding: 14px 16px;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #C8CFD9;
            box-sizing: border-box;
        }

        #userInput {
            flex: 1;
            font-size: 15px;
            border: 0;
            background: transparent;
        }

        #sendBtn {
            border: none;
            cursor: pointer;
            color: white;
            display: flex;
            width: 35px;
            height: 35px;
            padding: 8px 12px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            background: var(--accent);
        }

        .chat-text,
        .chat-bottom-text {
            color: var(--text);
            text-align: center;
        }

        .chat-text {
            font-size: 32px;
            font-weight: 600;
        }

        .chat-bottom-text {
            font-size: 12px;
            font-weight: 500;
            line-height: 17px;
            margin-top: 8px;
            margin-bottom: 0px;
        }

        input:focus-visible {
            outline: none;
        }

        .review-text {
            color: var(--muted);
            font-size: 14px;
            font-weight: 400;
            line-height: 19px;
            padding-top: 8px;
            border-top: 1px solid var(--border);
            width: 100%;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }

        .chat-history-text {
            color: var(--muted);
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        #historyList {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 8px;
            height: 62vh;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .helpful-section {
            display: none;
            gap: 8px;
            align-items: center;
        }

        .helpful-section.visible {
            display: flex;
        }

        .sr-only {
            position: absolute !important;
            height: 1px;
            width: 1px;
            overflow: hidden;
            clip: rect(1px, 1px, 1px, 1px);
            white-space: nowrap;
        }

        .chat-item-actions {
            position: relative;
        }

        .three-dots-btn {
            position: relative;
            top: 2px;
            background: transparent;
            border: 0;
            cursor: pointer;
            padding: 4px;
            color: #727790;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            width: 34vw;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px;
            border-radius: 8px 8px 0 0;
            border-top: 1px solid #ECF0F3;
            border-right: 1px solid #ECF0F3;
            border-left: 1px solid #ECF0F3;
            color: #2E2F38;
            font-size: 20px;
            font-weight: 600;
        }

        .modal-header h5 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .modal-body {
            padding: 24px;
            border-radius: 0;
            border: 1px solid #ECF0F3;
            background: #FCFCFC;
        }

        .modal-footer {
            display: flex;
            height: 96px;
            padding: 24px;
            justify-content: flex-end;
            align-items: center;
            gap: 8px;
        }

        .close-btn {
            border: 0;
            background: transparent;
            font-size: 22px;
            cursor: pointer;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #E6E9EE;
            font-size: 14px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            border: 0;
            font-size: 14px;
        }

        .btn-light {
            background: #fff;
            border: 1px solid #d7d7d7;
            color: #333;
        }

        .btn-warning {
            background: var(--accent);
            color: #fff;
        }

        .btn-danger {
            background: #E33E32;
            color: #fff;
        }

        .delete-icon {
            color: #F24130 !important;
        }

        .custom-btn {
            border-radius: 4px;
            width: fit-content;
            display: flex;
            height: 48px;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            font-weight: 600;
            line-height: 20px;
        }

        .custom-btn.orange-fill {
            background: #F7941C;
            color: #FFF;
            border: 1px solid #F7941C;
        }

        .custom-btn.grey-outline {
            border: 1px solid #858BA6;
            background: #FFF;
            color: #727790;
        }

        .custom-btn.delete-fill {
            background: #F24130;
            color: #FFF;
            border: 1px solid #F24130;
        }

        .delete-popup-heading {
            color: #2E2F38;
            font-size: 22.75px;
            font-weight: 600;
            line-height: 27.3px;
            margin: 10px 0px 8px 0px;
        }

        .delete-popup-content {
            color: #727790;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 20px;
        }

        .custom-toast-message {
            padding: 24px;
            width: 400px;
            border-radius: 4px;
            border: 1px solid #BEF4C9;
            background-color: #DDFBE2;
            color: #19622A;
        }

        .toast-body h4 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #19622A;
        }

        .toast-body p {
            font-size: 16px;
            font-weight: 400;
            line-height: 21px;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6" style="box-shadow: none;">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Chatbot
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Home</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">Analytics</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Chatbot</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="d-flex bg-white" style="height: 76vh !important;">
        <div id="sidebar" aria-label="Chat history sidebar">
            <button id="toggleSidebar" aria-expanded="true" title="Toggle sidebar">
                <iconify-icon icon="meteor-icons:sidebar" width="20" height="20"></iconify-icon>
                <span class="sr-only">Toggle sidebar</span>
            </button>

            <button id="newChatBtn" class="py-0" aria-label="New chat">
                <iconify-icon icon="hugeicons:pencil-edit-02" width="16" height="16"></iconify-icon>
                <span>New Chat</span>
            </button>

            <p class="chat-history-text">Chat History</p>
            <div id="historyList" role="list"></div>
        </div>

        <div id="main-panel">
            <div class="topbar-title">InsightEngine</div>

            <div class="d-flex h-100 flex-column align-items-center justify-content-center">
                <div class="w-100 d-flex flex-column chat-area">
                    <div id="chat-window" role="log" aria-live="polite" aria-relevant="additions"></div>
                </div>

                <div class="w-100">
                    <h4 id="welcomeText" class="chat-text">What do you want to analyze today?</h4>

                    <div id="input-area" role="region" aria-label="Message input">
                        <input id="userInput" type="text" placeholder="Ask me anything" aria-label="Message input" />
                        <button id="sendBtn" aria-label="Send message">
                            <iconify-icon icon="qlementine-icons:send-16" width="16" height="16"></iconify-icon>
                        </button>
                    </div>

                    <p class="chat-bottom-text">InsightEngine can make mistakes. Please verify critical information
                        independently.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="renameModal" class="modal-overlay" aria-hidden="true">
        <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="renameTitle">
            <div class="modal-header">
                <h5 id="renameTitle">Rename Chat</h5>
                <button id="renameModalClose" class="close-btn" aria-label="Close rename dialog">×</button>
            </div>

            <div class="modal-body">
                <label class="form-label" for="renameInput">Chat Name <span style="color:red">*</span></label>
                <input type="text" id="renameInput" class="form-control" />
            </div>

            <div class="modal-footer">
                <button id="renameCancelBtn" class="custom-btn grey-outline">Cancel</button>
                <button id="renameSaveBtn" class="custom-btn orange-fill">Rename</button>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal-overlay" aria-hidden="true">
        <div class="modal-card p-6" role="dialog" aria-modal="true" aria-labelledby="deleteTitle">
            <div class="modal-header justify-content-end p-0 border-0">
                <button id="deleteModalClose" class="close-btn p-0" aria-label="Close delete dialog">×</button>
            </div>

            <div class="modal-body text-center p-0 border-0 bg-white">
                <div class="delete-icon"><iconify-icon icon="quill:warning-alt" width="70"
                        height="70"></iconify-icon></div>
                <p class="delete-popup-heading">
                    Delete Chat?
                </p>
                <p class="delete-popup-content">
                    You’re about to delete this chat. This action can’t be undone. Are you sure you want to proceed?
                </p>
            </div>

            <div class="modal-footer p-0 h-100">
                <button id="deleteCancelBtn" class="custom-btn grey-outline flex-grow-1">Cancel</button>
                <button id="deleteConfirmBtn" class="custom-btn delete-fill flex-grow-1">Confirm</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="min-width: 50vw;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label fw-semibold">
                        Share additional comments to help us improve <span class="text-muted">(optional)</span>
                    </label>
                    <textarea id="feedbackText" class="form-control" rows="4" placeholder="Write your feedback..."></textarea>
                </div>

                <div class="modal-footer">
                    <button class="custom-btn grey-outline" data-bs-dismiss="modal">Cancel</button>
                    <button class="custom-btn orange-fill" id="submitFeedbackBtn">Submit feedback</button>
                </div>

            </div>
        </div>
    </div>

    <div class="toast-container position-fixed top-8 end-0 p-3">
        <div id="feedbackToast" class="toast custom-toast-message" role="alert">
            <div class="d-flex gap-3 justify-content-between">
                <div class="toast-body p-0">
                    <h4 id="toastTitle">Thank you for your feedback!</h4>
                    <p class="m-0" id="toastMessage">Your feedback has been submitted successfully. We appreciate your
                        input!</p>
                </div>
                <button class="btn-close" style="color: #727790;" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        (function() {
            'use strict';
            class ChatApp {
                constructor(options = {}) {
                    this.STORAGE_KEY = options.storageKey || 'insight_chats_v2';
                    this.ALIGNMENT_KEY = 'chat_alignment_changed';

                    this.chatWindow = document.getElementById('chat-window');
                    this.userInput = document.getElementById('userInput');
                    this.sendBtn = document.getElementById('sendBtn');
                    this.historyList = document.getElementById('historyList');
                    this.sidebar = document.getElementById('sidebar');
                    this.toggleSidebar = document.getElementById('toggleSidebar');
                    this.newChatBtn = document.getElementById('newChatBtn');

                    this.renameModal = document.getElementById('renameModal');
                    this.renameInput = document.getElementById('renameInput');
                    this.renameSaveBtn = document.getElementById('renameSaveBtn');
                    this.renameCancelBtn = document.getElementById('renameCancelBtn');
                    this.renameModalClose = document.getElementById('renameModalClose');

                    this.deleteModal = document.getElementById('deleteModal');
                    this.deleteConfirmBtn = document.getElementById('deleteConfirmBtn');
                    this.deleteCancelBtn = document.getElementById('deleteCancelBtn');
                    this.deleteModalClose = document.getElementById('deleteModalClose');

                    this.globalDropdown = null;
                    this.renameBtn = null;
                    this.deleteBtn = null;

                    this.chats = {};
                    this.currentChatId = null;
                    this.sendLocked = false;
                    this.typingSet = new Set();

                    this.renameTargetId = null;
                    this.deleteTargetId = null;

                    this.justifiedChanged = false;

                    this.init();
                }

                now() {
                    return Date.now();
                }

                setJustifiedChanged(flag) {
                    this.justifiedChanged = flag;
                    try {
                        localStorage.setItem(this.ALIGNMENT_KEY, JSON.stringify(flag));
                    } catch (e) {
                        console.warn('Failed to save alignment state', e);
                    }
                }

                save() {
                    try {
                        localStorage.setItem(this.STORAGE_KEY, JSON.stringify(this.chats));
                    } catch (e) {
                        console.warn('Save failed', e);
                    }
                }

                load() {
                    try {
                        const raw = localStorage.getItem(this.STORAGE_KEY);
                        if (!raw) return false;
                        const parsed = JSON.parse(raw);
                        if (parsed && typeof parsed === 'object') {
                            this.chats = parsed;
                            return true;
                        }
                    } catch (e) {
                        console.warn('Load failed', e);
                    }
                    return false;
                }

                escapeHtml(unsafe) {
                    return String(unsafe)
                        .replaceAll('&', '&amp;')
                        .replaceAll('<', '&lt;')
                        .replaceAll('>', '&gt;')
                        .replaceAll('"', '&quot;')
                        .replaceAll("'", '&#039;');
                }

                truncate(text, n = 36) {
                    if (!text) return 'New Chat';
                    text = String(text).trim();
                    return text.length > n ? text.slice(0, n).trim() + '…' : text;
                }

                sortedIds() {
                    return Object.keys(this.chats).sort((a, b) => {
                        const ta = Number(a.split('_')[1] || 0);
                        const tb = Number(b.split('_')[1] || 0);
                        return tb - ta;
                    });
                }

                renderHistory() {
                    this.historyList.innerHTML = '';
                    const ids = this.sortedIds();

                    ids.forEach(id => {
                        if (!this.chats[id] || this.chats[id].length === 0) return;

                        const preview = this.chats[id][0]?.text || 'New Chat';

                        const div = document.createElement('div');
                        div.className = 'chat-history-item';
                        div.dataset.id = id;
                        div.setAttribute('role', 'listitem');

                        div.innerHTML = `
                            <div class="history-left">${this.truncate(preview, 25)}</div>
                            <div class="chat-item-actions" aria-hidden="false">
                                <button class="three-dots-btn" data-menu="${id}" aria-haspopup="true" aria-controls="globalDropdown" aria-expanded="false" title="Open actions">
                                    <iconify-icon icon="mdi:dots-horizontal" width="20" height="20"></iconify-icon>
                                </button>
                            </div>
                        `;

                        div.addEventListener('click', (e) => {
                            if (e.target.closest('.chat-item-actions')) return;
                            this.loadChat(id);
                        });

                        this.historyList.appendChild(div);
                    });

                    this.highlightActive();
                }


                highlightActive() {
                    document.querySelectorAll('.chat-history-item').forEach(it => {
                        it.classList.toggle('active', it.dataset.id === this.currentChatId);
                    });
                }

                clearChatWindow() {
                    this.chatWindow.innerHTML = '';
                }

                appendMessage(sender, text, ts = null) {
                    const wrapper = document.createElement('div');
                    wrapper.className = `message ${sender}`;
                    const escaped = this.escapeHtml(text || '');

                    if (sender === 'agent') {
                        wrapper.innerHTML = `
                    <div class="bubble">${escaped}</div>
                    <div class="d-flex gap-3 align-items-center review-text mt-2">
                        <p class="m-0">Helpful?</p>
                        <iconify-icon class="feedback-btn cursor-pointer" data-type="up" icon="material-symbols:thumb-up-outline" width="20" height="20"></iconify-icon>
                        <iconify-icon class="feedback-btn cursor-pointer" data-type="down" icon="material-symbols:thumb-down-outline" width="20" height="20"></iconify-icon>
                    </div>
                `;
                    } else {
                        wrapper.innerHTML = `<div class="bubble">${escaped}</div>`;
                    }

                    if (ts) wrapper.dataset.ts = ts;

                    this.chatWindow.appendChild(wrapper);
                    this.scrollBottom();
                }

                appendTyping(id) {
                    this.removeTyping(id);
                    const div = document.createElement('div');
                    div.className = 'message agent';
                    div.id = id;
                    div.innerHTML =
                        `<div class="typing-bubble" aria-hidden="true"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>`;
                    this.chatWindow.appendChild(div);
                    this.scrollBottom();
                }

                removeTyping(id) {
                    const el = document.getElementById(id);
                    if (el) el.remove();
                    this.typingSet.delete(id);
                }

                scrollBottom() {
                    setTimeout(() => {
                        this.chatWindow.scrollTop = this.chatWindow.scrollHeight;
                    }, 40);
                }

                createNewChat() {
                    this.setJustifiedChanged(false);
                    const container = document.querySelector('.d-flex.h-100.flex-column.align-items-center');
                    if (container) {
                        container.classList.remove('justify-content-between');
                        if (!container.classList.contains('justify-content-center')) {
                            container.classList.add('justify-content-center');
                        }
                    }

                    if (this.currentChatId && Array.isArray(this.chats[this.currentChatId]) && this.chats[this
                            .currentChatId].length === 0) {
                        this.loadChat(this.currentChatId);
                        return;
                    }
                    const id = 'chat_' + this.now();
                    this.chats[id] = [];
                    this.save();
                    this.renderHistory();
                    this.loadChat(id);
                }

                deleteChatImmediate(id) {
                    if (!this.chats[id]) return;
                    delete this.chats[id];
                    this.save();

                    const ids = this.sortedIds();
                    if (ids.length) {
                        this.loadChat(ids[0]);
                    } else {
                        this.setJustifiedChanged(false);
                        const container = document.querySelector('.d-flex.h-100.flex-column.align-items-center');
                        if (container) {
                            container.classList.remove('justify-content-between');
                            if (!container.classList.contains('justify-content-center')) {
                                container.classList.add('justify-content-center');
                            }
                        }

                        this.createNewChat();
                    }
                    this.renderHistory();
                }


                loadChat(id) {
                    if (!this.chats[id]) return;
                    this.currentChatId = id;
                    this.clearChatWindow();

                    const conv = this.chats[id];
                    const welcomeText = document.getElementById("welcomeText");

                    if (conv.length === 0) {
                        if (welcomeText) welcomeText.style.display = "block";
                    } else {
                        if (welcomeText) welcomeText.style.display = "none";
                        conv.forEach(m => this.appendMessage(m.sender, m.text, m.ts));
                    }

                    this.highlightActive();
                    this.save();
                    this.userInput.focus();
                }

                sendMessage() {
                    const message = this.userInput.value.trim();
                    if (!message || this.sendLocked) return;

                    if (!this.justifiedChanged) {
                        const container = document.querySelector('.d-flex.h-100.flex-column.align-items-center');
                        if (container && container.classList.contains('justify-content-center')) {
                            container.classList.remove('justify-content-center');
                            container.classList.add('justify-content-between');
                            this.setJustifiedChanged(true);
                        }
                    }

                    const welcomeText = document.getElementById("welcomeText");
                    if (welcomeText) welcomeText.style.display = "none";

                    if (!this.currentChatId) this.createNewChat();

                    const userMsg = {
                        sender: 'user',
                        text: message,
                        ts: this.now()
                    };
                    this.chats[this.currentChatId].push(userMsg);
                    this.appendMessage('user', message, userMsg.ts);

                    this.userInput.value = '';
                    this.userInput.focus();

                    this.renderHistory();
                    this.save();
                    this.scrollBottom();

                    const typingId = 'typing-' + this.now();
                    this.appendTyping(typingId);
                    this.typingSet.add(typingId);

                    this.sendLocked = true;
                    this.sendBtn.disabled = true;

                    const delay = 700 + Math.floor(Math.random() * 700);

                    setTimeout(() => {
                        this.removeTyping(typingId);

                        const reply = `InsightEngine response based on your query: "${message}"`;
                        const agentMsg = {
                            sender: 'agent',
                            text: reply,
                            ts: this.now()
                        };

                        this.chats[this.currentChatId].push(agentMsg);
                        this.appendMessage('agent', reply, agentMsg.ts);

                        this.renderHistory();
                        this.save();
                        this.scrollBottom();

                        this.sendLocked = false;
                        this.sendBtn.disabled = false;

                    }, delay);

                    setTimeout(() => this.removeTyping(typingId), 6000);
                }

                closeAllMenus() {
                    if (this.globalDropdown) {
                        this.globalDropdown.classList.remove('visible');
                        document.querySelectorAll('.three-dots-btn[aria-expanded="true"]').forEach(btn => btn
                            .setAttribute('aria-expanded', 'false'));
                    }
                }

                openGlobalMenu(chatId, triggerBtn) {
                    if (!this.globalDropdown) return;
                    const dropdown = this.globalDropdown;
                    const rect = triggerBtn.getBoundingClientRect();

                    const top = rect.bottom + window.pageYOffset + 6;
                    const dropdownWidth = 160;
                    let left = rect.right + window.pageXOffset - dropdownWidth;

                    const minLeft = 8 + window.pageXOffset;
                    if (left < minLeft) left = rect.left + window.pageXOffset;

                    dropdown.style.top = `${top}px`;
                    dropdown.style.left = `${left}px`;
                    dropdown.dataset.chatId = chatId;
                    dropdown.classList.add('visible');

                    triggerBtn.setAttribute('aria-expanded', 'true');
                }

                hideGlobalMenu() {
                    if (!this.globalDropdown) return;
                    this.globalDropdown.classList.remove('visible');
                    delete this.globalDropdown.dataset.chatId;
                    document.querySelectorAll('.three-dots-btn[aria-expanded="true"]').forEach(btn => btn
                        .setAttribute('aria-expanded', 'false'));
                }

                openRenameModal(chatId) {
                    this.renameTargetId = chatId;
                    const currentTitle = this.chats[chatId]?.[0]?.text ?? 'New Chat';
                    this.renameInput.value = currentTitle;
                    this.showModal(this.renameModal);
                    setTimeout(() => this.renameInput.focus(), 40);
                    this.hideGlobalMenu();
                }

                saveRename() {
                    if (!this.renameTargetId) return;
                    const newName = this.renameInput.value.trim();
                    if (!newName) return;

                    if (this.chats[this.renameTargetId].length > 0) {
                        this.chats[this.renameTargetId][0].text = newName;
                    } else {
                        this.chats[this.renameTargetId].push({
                            sender: 'user',
                            text: newName,
                            ts: this.now()
                        });
                    }
                    this.save();
                    this.renderHistory();
                    if (typeof showToast === 'function') showToast("Success!", "Chat name updated successfully.");
                    this.hideModal(this.renameModal);
                    this.renameTargetId = null;
                }

                openDeleteModal(chatId) {
                    this.deleteTargetId = chatId;
                    this.showModal(this.deleteModal);
                    this.hideGlobalMenu();
                }

                confirmDelete() {
                    if (!this.deleteTargetId) return;
                    this.deleteChatImmediate(this.deleteTargetId);
                    if (typeof showToast === 'function') showToast("Success!", "Chat deleted successfully.");
                    this.hideModal(this.deleteModal);
                    this.deleteTargetId = null;
                }

                showModal(modalEl) {
                    modalEl.classList.add('show');
                    modalEl.setAttribute('aria-hidden', 'false');
                }

                hideModal(modalEl) {
                    modalEl.classList.remove('show');
                    modalEl.setAttribute('aria-hidden', 'true');
                }

                createGlobalDropdown() {
                    let dropdown = document.getElementById('globalDropdown');
                    if (!dropdown) {
                        dropdown = document.createElement('div');
                        dropdown.id = 'globalDropdown';
                        dropdown.className = 'dropdown-global';
                        dropdown.setAttribute('role', 'menu');
                        dropdown.setAttribute('aria-label', 'Chat actions');
                        dropdown.innerHTML = `
                    <button id="global-rename-btn" class="dropdown-action" role="menuitem">Rename</button>
                    <button id="global-delete-btn" class="dropdown-action delete-icon" role="menuitem">Delete</button>
                `;
                        document.body.appendChild(dropdown);
                    }

                    const styleId = 'global-dropdown-styles';
                    if (!document.getElementById(styleId)) {
                        const style = document.createElement('style');
                        style.id = styleId;
                        style.innerHTML = `
                    .dropdown-global {
                        position: absolute;
                        z-index: 999999;
                        display: none;
                        right: 0;
                        top: 24px;
                        background: #FFF;
                        display: none;
                        z-index: 999;
                        width: 237px;
                        padding: 8px;
                        border-radius: 8px;
                        border: 1.5px solid #ECF0F3;
                        box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.05);
                    }
                    .dropdown-global.visible { display: block; }
                    .dropdown-global .dropdown-action {
                    color: #2E2F38;
                    font-size: 14px;
                    font-weight: 400;
                    line-height: 19px;
                    width: 100%;
                    text-align: left;
                    background: transparent;
                    border: 0;
                    cursor: pointer;
                    padding: 12px 16px;
                    border-radius: 4px;
                        display: block;
                        width: 100%;
                        background: transparent;
                    }
                    .dropdown-global .dropdown-action:hover { background: #FFF8EB; }
                `;
                        document.head.appendChild(style);
                    }

                    this.globalDropdown = dropdown;
                    this.renameBtn = document.getElementById('global-rename-btn');
                    this.deleteBtn = document.getElementById('global-delete-btn');

                    this.renameBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const chatId = this.globalDropdown.dataset.chatId;
                        if (chatId) this.openRenameModal(chatId);
                    });

                    this.deleteBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const chatId = this.globalDropdown.dataset.chatId;
                        if (chatId) this.openDeleteModal(chatId);
                    });
                }

                bindEvents() {
                    document.addEventListener('click', (e) => {
                        const menuBtn = e.target.closest('.three-dots-btn');
                        if (menuBtn) {
                            e.stopPropagation();
                            const chatId = menuBtn.getAttribute('data-menu');
                            if (this.globalDropdown && this.globalDropdown.classList.contains('visible') &&
                                this.globalDropdown.dataset.chatId === chatId) {
                                this.hideGlobalMenu();
                                return;
                            }
                            this.openGlobalMenu(chatId, menuBtn);
                            return;
                        }

                        if (e.target.closest('#globalDropdown')) return;

                        this.closeAllMenus();
                    });

                    this.historyList.addEventListener('click', (e) => {
                        const renameBtn = e.target.closest('.rename-option');
                        const delBtn = e.target.closest('.delete-option');

                        if (renameBtn) {
                            e.stopPropagation();
                            const id = renameBtn.getAttribute('data-rename');
                            this.openRenameModal(id);
                            this.closeAllMenus();
                            return;
                        }

                        if (delBtn) {
                            e.stopPropagation();
                            const id = delBtn.getAttribute('data-delete');
                            this.openDeleteModal(id);
                            this.closeAllMenus();
                            return;
                        }
                    });

                    this.renameSaveBtn.addEventListener('click', () => this.saveRename());
                    this.renameCancelBtn.addEventListener('click', () => {
                        this.renameTargetId = null;
                        this.hideModal(this.renameModal);
                    });
                    this.renameModalClose.addEventListener('click', () => {
                        this.renameTargetId = null;
                        this.hideModal(this.renameModal);
                    });

                    this.renameInput.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            this.saveRename();
                        }
                        if (e.key === 'Escape') {
                            this.renameTargetId = null;
                            this.hideModal(this.renameModal);
                        }
                    });

                    this.deleteConfirmBtn.addEventListener('click', () => this.confirmDelete());
                    this.deleteCancelBtn.addEventListener('click', () => {
                        this.deleteTargetId = null;
                        this.hideModal(this.deleteModal);
                    });
                    this.deleteModalClose.addEventListener('click', () => {
                        this.deleteTargetId = null;
                        this.hideModal(this.deleteModal);
                    });

                    [this.renameModal, this.deleteModal].forEach(modal => {
                        modal.addEventListener('click', (e) => {
                            if (e.target === modal) {
                                if (modal === this.renameModal) this.renameTargetId = null;
                                if (modal === this.deleteModal) this.deleteTargetId = null;
                                this.hideModal(modal);
                            }
                        });
                    });

                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape') {
                            this.closeAllMenus();
                            this.hideModal(this.renameModal);
                            this.hideModal(this.deleteModal);
                            this.renameTargetId = null;
                            this.deleteTargetId = null;
                        }
                    });

                    this.userInput.addEventListener('keypress', (e) => {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            if (!this.sendBtn.disabled) this.sendMessage();
                        }
                    });
                    this.sendBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.sendMessage();
                    });

                    this.newChatBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.createNewChat();
                    });

                    this.toggleSidebar.addEventListener('click', (e) => {
                        e.preventDefault();
                        const collapsed = this.sidebar.classList.toggle('hidden');
                        this.toggleSidebar.setAttribute('aria-expanded', String(!collapsed));
                    });

                    this.chatWindow.addEventListener('click', (e) => {
                        const btn = e.target.closest('.feedback-btn');
                        if (!btn) return;

                        this.selectedFeedbackType = btn.dataset.type;
                        const feedbackModal = new bootstrap.Modal(document.getElementById('feedbackModal'));
                        feedbackModal.show();
                    });

                    document.getElementById('submitFeedbackBtn').addEventListener('click', () => {
                        const feedback = document.getElementById('feedbackText').value.trim();
                        document.getElementById('feedbackText').value = '';

                        const modal = bootstrap.Modal.getInstance(document.getElementById('feedbackModal'));
                        modal.hide();

                        const toast = new bootstrap.Toast(document.getElementById('feedbackToast'));
                        toast.show();

                        console.log("Feedback type:", this.selectedFeedbackType);
                        console.log("Feedback text:", feedback);
                    });

                    window.addEventListener('resize', () => this.closeAllMenus());
                    window.addEventListener('scroll', () => this.closeAllMenus(),
                        true);
                }

                init() {
                    const loaded = this.load();

                    try {
                        const savedFlag = JSON.parse(localStorage.getItem(this.ALIGNMENT_KEY));
                        this.justifiedChanged = savedFlag === true;
                    } catch {
                        this.justifiedChanged = false;
                    }

                    const container = document.querySelector('.d-flex.h-100.flex-column.align-items-center');
                    if (container) {
                        if (this.justifiedChanged) {
                            container.classList.remove('justify-content-center');
                            container.classList.add('justify-content-between');
                        } else {
                            container.classList.remove('justify-content-between');
                            container.classList.add('justify-content-center');
                        }
                    }

                    if (!loaded || Object.keys(this.chats).length === 0) {
                        this.createNewChat();
                    } else {
                        const ids = this.sortedIds();
                        if (ids.length) this.loadChat(ids[0]);
                    }

                    this.createGlobalDropdown();
                    this.renderHistory();
                    this.bindEvents();

                    window.addEventListener('beforeunload', () => this.save());
                }
            }

            window.chatApp = new ChatApp();
        })();



        function showToast(title, message) {
            document.getElementById("toastTitle").textContent = title;
            document.getElementById("toastMessage").textContent = message;

            const toastEl = document.getElementById('feedbackToast');
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    </script>
@endsection
