<div id="notificationContainer" class="fixed top-4 right-4 z-50 space-y-2 pointer-events-none">
    {{-- Notifications will be dynamically inserted here --}}
</div>

{{-- Notification Template (hidden) --}}
<template id="notificationTemplate">
    <div class="notification-item px-4 py-3 rounded-lg shadow-lg flex items-center gap-3 max-w-md transform transition-all duration-300 translate-x-full opacity-0 pointer-events-auto">
        <svg class="w-5 h-5 flex-shrink-0 notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <!-- Icon will be injected -->
        </svg>
        <p class="font-medium text-sm notification-message text-white flex-1"></p>
        <button onclick="this.closest('.notification-item').remove()" class="hover:bg-white/20 rounded p-1 transition-colors flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</template>