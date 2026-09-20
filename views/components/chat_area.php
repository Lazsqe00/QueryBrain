<?php
use Support\MarkdownRenderer;
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (!isset($messages)) {
    $messages = $_SESSION['chat_history'] ?? [];
}
?>
<div class="chat-main">
    
    <!-- =================== TOP BAR ===================== -->
    <div class="chat-topbar">
        <div class="d-flex align-items-center gap-3">
            <span class="font-monospace" style="font-size: 14px;">
                <i class="far fa-clock me-1 me-2"></i><?= date('g:i:s A') ?>
            </span>
            <a href="index.php?action=new_chat" class="btn-new-chat" title="New chat">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

<!-- =================== MESSAGES ===================== -->
    <div class="chat-container" id="chat-container">
        <div class="chat-inner d-flex flex-column gap-4" id="chat-history">
           <!--

            TH1: Nếu chưa có câu trả lời thì in ra 1 câu chào từ AI
            TH2: Nếu đã có tin nhắn -> Duyệt danh sách và in từng tin
                - AI tin nhắn sẽ nằm bên phải, user tin nhắn nằm bên trái
                - Xử lý danh sách tin nhắn => kiểm tra key, value xem AI, hay user
                - Các mô hình AI đều trả lời bằng Markdown => cần chuyển đổi văn bản định dạng Markdown thành mã HTML, do đó
                cần viết 1 hàm render
        -->
            <?php
                    if (empty($messages)) {
                            $currentTime = date('M j, Y g:i A');
                            echo 
                                '<div class="d-flex justify-content-start align-items-start gap-3">
                                    <div class="avatar-ai">
                                        <i class="fas fa-database" style="font-size: 18px; color: #111827;"></i>
                                    </div>
                                    <div class="flex-grow-1 min-w-0" style="max-width: 660px;">
                                        <div class="text-dark small mb-1" style="font-size: 16px;">
                                            Xin chào! Tôi là trợ lý AI Database của bạn. Hãy đặt câu hỏi bằng tiếng Việt tự nhiên, tôi sẽ tự động chuyển thành truy vấn SQL và giải đáp cho bạn.
                                        </div>
                                        <div class="text-muted small" style="font-size: 13px;">
                                            ' . $currentTime . '
                                        </div>
                                    </div>
                                </div>';
                    } else {
                        // duyet
                        foreach ($messages as $msg) {
                            $content = $msg['content'] ?? '';
                            $time = htmlspecialchars($msg['time']);
                            $role = $msg['role'] ?? '';

                            if ($role === 'user') {
                                echo '
                                <div class="d-flex justify-content-end align-items-start gap-2">
                                    <div class="bubble-user">
                                        ' . htmlspecialchars($content). '
                                    </div>
                                    <div class="avatar-user">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>';
                            }
                            else {
                              $renderer = new MarkdownRenderer();
                              $aiContent = $renderer->render($content);
                                echo '
                                <div class="d-flex justify-content-start align-items-start gap-2">
                                    <div class="avatar-ai">
                                       <i class="fas fa-database" style="font-size: 17px; color: #111827;"></i>
                                    </div>
                                    <div class="flex-grow-1 min-w-0" style="max-width: 660px;">
                                        <div class="text-dark small mb-1" style="font-size: 16px;">
                                            ' . $aiContent . '
                                        </div>
                                        <div class="text-muted small" style="font-size: 13px;">
                                            ' . $time . '
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                    }
            ?>
            <div id="chat-bottom"></div>
        </div>
    </div>
    <!-- =================== FLOATING INPUT BAR ===================== -->
    <div class="floating-input-bar-wrap">
        <div class="chat-inner">
            <form id="chat-form" method="POST" action="index.php" class="floating-input-form">
                <input id="q-input" type="text" name="question"
                    placeholder="Enter your question here..."
                    class="floating-input-field"
                    autocomplete="off" autofocus required>
                <div class="d-flex align-items-center gap-2 me-2">
                    <button id="send-btn" type="submit" class="btn-send-message">
                        <i class="fas fa-paper-plane" style="font-size: 16px; "></i>
                    </button>
                    <button type="button" id="prompt-btn" class="btn btn-sm text-indigo-600 fw-semibold text-decoration-none p-0 d-flex align-items-center gap-1">
                        <i class="fas fa-eye" style="font-size: 18px; margin-right: 2px;"></i> Prompt
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
