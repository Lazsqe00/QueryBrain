<!-- ═══════ ICON RAIL (44px dark) ═══════ -->
<nav class="nav-rail">
    <!-- Logo -->
    <a href="index.php?action=new_chat" class="btn-logo mb-1">
            <i class="fa-brands fa-qq"></i>
    </a>

    <!-- Database Icon -->
    <button id="db-open-btn" class="nav-icon-btn">
        <i class="fas fa-database"></i>
    </button>

    <!-- History -->
    <button type="button" class="nav-icon-btn" onclick="switchSidebarTab('history')" >
        <i class="fas fa-history"></i>
    </button>

    <div class="flex-grow-1"></div>

    <button id="settings-open-btn" class="nav-icon-btn mb-1">
        <i class="fas fa-cog"></i>
    </button>

    <button type="button" class="nav-icon-btn" onclick="openAuthModal()">
        <i class="fas fa-user-circle"></i>
    </button>
</nav>
