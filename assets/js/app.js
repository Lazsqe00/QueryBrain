document.addEventListener('DOMContentLoaded', () => {
    const chatHistory = document.getElementById('chat-history');
    const chatForm = document.getElementById('chat-form');
    const qInput = document.getElementById('q-input');
    const sendBtn = document.getElementById('send-btn');

    /*
    Xử lý cuộn xuống khi 
        + Khi load lại trang thì nó sẽ cuộn lên => tự động cuộn xuống ở sự kiện DOMContentLoaded
        + Người dùng gửi tin nhắn nhưng đang cuộn lên
    */
    function scrollToBottom() {
        const bottom = document.getElementById('chat-bottom');
        bottom.scrollIntoView({ behavior: 'smooth' });
    }
    scrollToBottom(); 

    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault(); // chan trinh duyet load trang

        const question = qInput.value;

        const formData = new FormData(chatForm);
        formData.append('ajax', '1');


        qInput.value = '';
        qInput.disabled = true;
        sendBtn.disabled = true;
        sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin" style="font-size: 16px;"></i>';


        const tempUserHtml = `
            <div class="d-flex justify-content-end align-items-start gap-2">
                <div class="bubble-user">${question}</div>
                <div class="avatar-user"><i class="fas fa-user"></i></div>
            </div>
            <div id="ai-thinking" class="d-flex justify-content-start align-items-start gap-2">
                <div class="shimmer-sweep">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-brain preview-icon"><path d="M12 18V5"/><path d="M15 13a4.17 4.17 0 0 1-3-4 4.17 4.17 0 0 1-3 4"/><path d="M17.598 6.5A3 3 0 1 0 12 5a3 3 0 1 0-5.598 1.5"/><path d="M17.997 5.125a4 4 0 0 1 2.526 5.77"/><path d="M18 18a4 4 0 0 0 2-7.464"/><path d="M19.967 17.483A4 4 0 1 1 12 18a4 4 0 1 1-7.967-.517"/><path d="M6 18a4 4 0 0 1-2-7.464"/><path d="M6.003 5.125a4 4 0 0 0-2.526 5.77"/></svg>
                        <span style="font-size: 14px;">Thought Process </span>
                </div>
            </div>`;

        let bottomAnchor = document.getElementById('chat-bottom');
        bottomAnchor.insertAdjacentHTML('beforebegin', tempUserHtml);
        scrollToBottom();

        //ajax
        try {
            const res = await fetch('index.php', {
                method: 'POST',
                body: formData,
            });

            const html = await res.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const newHistory = doc.getElementById('chat-history');
            if (newHistory && chatHistory) {
                chatHistory.innerHTML = newHistory.innerHTML;
            }
        } 
        finally {
            qInput.disabled = false;
            sendBtn.disabled = false;
            sendBtn.innerHTML = '<i class="fas fa-paper-plane" style="font-size: 16px;"></i>';
            qInput.focus();
        }
    });
});


function switchSidebarTab(tab) {
    const btnSchema = document.getElementById('sidebar-tab-btn-schema');
    const btnHistory = document.getElementById('sidebar-tab-btn-history');
    const paneSchema = document.getElementById('sidebar-pane-schema');
    const paneHistory = document.getElementById('sidebar-pane-history');

    if (tab === 'schema') {
        if (btnSchema) {
            btnSchema.classList.add('active');
            btnSchema.classList.remove('inactive');
        }
        if (btnHistory) {
            btnHistory.classList.remove('active');
            btnHistory.classList.add('inactive');
        }
        if (paneSchema) paneSchema.classList.remove('d-none');
        if (paneHistory) paneHistory.classList.add('d-none');
    } else if (tab === 'history') {
        if (btnHistory) {
            btnHistory.classList.add('active');
            btnHistory.classList.remove('inactive');
        }
        if (btnSchema) {
            btnSchema.classList.remove('active');
            btnSchema.classList.add('inactive');
        }
        if (paneSchema) paneSchema.classList.add('d-none');
        if (paneHistory) paneHistory.classList.remove('d-none');
    }
}


function openAuthModal() {
    alert('Bổ sung thêm trang đăng nhập nhé');
}



