document.addEventListener('DOMContentLoaded', function() {
    const whatsappIcon = document.getElementById('whatsappIcon');
    const chatPopup = document.getElementById('chatPopup');
    const closeChat = document.getElementById('closeChat');
    // Function to toggle chat popup
    function toggleChat() {
        chatPopup.classList.toggle('active');
    }
    whatsappIcon.addEventListener('click', toggleChat);
    closeChat.addEventListener('click', (e) => {
        e.stopPropagation();
        chatPopup.classList.remove('active');
    });
    // Close popup when clicking outside
    document.addEventListener('click', (e) => {
        if (!chatPopup.contains(e.target) && e.target !== whatsappIcon) {
            chatPopup.classList.remove('active');
        }
    });
    // Prevent popup from closing when clicking inside it
    chatPopup.addEventListener('click', (e) => {
        e.stopPropagation();
    });
  });