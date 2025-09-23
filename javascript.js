const video = document.getElementById('enviroVideo');

// When video is ready, set start time to 35s
video.addEventListener('loadedmetadata', function() {
  video.currentTime = 35;
});

// Check time update to loop between 35s and 40s
video.addEventListener('timeupdate', function() {
  if (video.currentTime >= 40) {
    video.currentTime = 35;
    video.play();
  }
});

function openModal(id) {
  document.getElementById(id).style.display = 'block';
}

function closeModal(id) {
  document.getElementById(id).style.display = 'none';
}
