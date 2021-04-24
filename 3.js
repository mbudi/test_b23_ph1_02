var canvas  = document.createElement('canvas');
var image   = document.createElement('img');
var ctx     = canvas.getContext('2d');
canvas.style.display = 'none';

function base64img(arr){
    canvas.width    = 10 * arr.length;
    canvas.height   = 10 * arr.length;
    var x = 0;
    var y = 10;
    var lineheight = 10;
    for (var i = 0; i < arr.length; i++) {
    	ctx.fillText(arr[i], x, y + (i * lineheight) );
    }
    return canvas.toDataURL();
}

function createimg(len) {
    var arr = [];
    var str = "";
    var line= [];
    if (len % 2 == 0) {
        for (var i = 1; i <= len; i++) {
            str = "";
            for (var j = 1; j <= (len/2); j++) {
                if (i == 1 || i == len || j == Math.floor((len-1)/2)) {
                    str += "+";
                } else {
                    str += "=";
                }
            }
            str += str.split('').reverse().join('');
            arr.push(str.split('').join(' '));
        }
        image.src = base64img(arr);
        document.body.appendChild(image);
        console.log(image.src);
    }
}
createimg(8);
