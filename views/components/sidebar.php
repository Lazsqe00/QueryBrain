<aside class="sidebar">

    <div class="d-flex border-bottom bg-white px-2 pt-2 flex-shrink-0">
        <button type="button" id="sidebar-tab-btn-schema" onclick="switchSidebarTab('schema')"
            class="sidebar-tab-btn active d-flex align-items-center justify-content-center gap-2">
            <i class="fas fa-table" style="font-size: 16px;"></i> Schema
        </button>
        <button type="button" id="sidebar-tab-btn-history" onclick="switchSidebarTab('history')"
            class="sidebar-tab-btn inactive d-flex align-items-center justify-content-center gap-2">
            <i class="fas fa-history" style="font-size: 16px;"></i> Lịch sử 
        </button>
    </div>

    <!-- ====================SCHEMA VIEW==================== -->
    <div id="sidebar-pane-schema" class="d-flex flex-column flex-grow-1 overflow-hidden">
        <div class="p-3 pb-2 d-flex flex-column gap-2">
            <div id="sidebar-db-selector" class="selector-card">
                <span>database</span>
                <i class="fas fa-chevron-down text-secondary ms-2" style="font-size: 10px;"></i>
            </div>
            <div class="selector-card">
                <span>public</span>
                <i class="fas fa-chevron-down text-secondary ms-2" style="font-size: 10px;"></i>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between px-3 pt-2 pb-1 text-secondary">
            <span>Tokens</span>
            <span class="text-muted"></span>
        </div>

        <!-- ====================DS BANG SQL==================== -->
        <div class="flex-grow-1 overflow-auto px-3 py-1 d-flex flex-column gap-1">
            <div class="text-center text-muted small py-4 fst-italic">
                Chưa có bảng nào được tải.
            </div>
        </div>
        <div class="border-top px-5 py-3 d-flex flex-column gap-2" style="background-color: #f3f3f750;">
            <form method="POST" action="index.php">
                <input type="hidden" name="action" value="seed">
                <button type="submit" class="btn btn-sm text-decoration-none p-0 d-flex align-items-center gap-2" style="font-size: 14px;">
                    <i class="fas fa-sync-alt" style="color: #111827;"></i> Refresh Schema
                </button>
            </form>
        </div>
    </div>

    <!-- ==================== LICH SU CHAT ==================== -->
    <div id="sidebar-pane-history" class="d-flex flex-column flex-grow-1 overflow-hidden d-none">
        <div class="p-3 text-secondary text-center small">
            <i class="fas fa-history mb-2 d-block text-muted" style="font-size: 20px;"></i>
            Chưa có lịch sử cuộc trò chuyện nào.
        </div>
    </div>

    
</aside>
