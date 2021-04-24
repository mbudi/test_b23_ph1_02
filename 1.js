function makeChr(len) {
	var result	= [];
	var chr 	= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	var chrLen	= chr.length;
	for ( var i = 0; i < len; i++ ) {
		result.push(chr.charAt(Math.floor(Math.random() * chrLen)));
	}
	return result.join('');
}

function makeArr(row) {
	var result	= [];
	for (var i = 0; i < row; i++) {
		result.push(makeChr(28));
	}
	return result;
}

console.log(makeArr(3));
