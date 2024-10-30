/**
 * Play YouTube Video
 */
function playYouTube()
{
	var player   = document.getElementById("yt");
	var controls = document.getElementById("youtube-controls");
	
	if(player) {
		player.style.visibility = 'visible';
		controls.style.display  = 'none';
		player.playVideo();
	}
	return false;
}