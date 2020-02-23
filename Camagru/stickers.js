
function addSticker(fileSrc, posW, posH){
	const canvas = document.getElementById('canvas');
	const context = canvas.getContext('2d');
	const img = new Image();
	img.src = fileSrc;
	img.onload = function() {
		context.drawImage(img, posW, posH, 80, 70);
	}
}
