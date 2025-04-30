function showRoom(roomId) {
    document.querySelectorAll('.room-details').forEach(div => div.style.display = 'none');
    document.getElementById(roomId).style.display = 'block';
    
}

