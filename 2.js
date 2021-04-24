function sort(kata){
	var arr_kata = kata.split(" ");
	var arr_num = new Array();
	var kata_terurut = "";
	
	for (var i = 0; i < arr_kata.length; i++) {
		arr_num[i] = parseInt(arr_kata[i].match(/\d/g));
		if (isNaN(arr_num[i])) arr_num[i] = Infinity;
	}

	for (var i = 1; i < arr_kata.length; i++) {
		for (var j = 0; j < i; j++) {
			if (arr_num[i] < arr_num[j]) {
				var x = arr_num[i];
				var y = arr_kata[i];
				arr_num[i] = arr_num[j];
				arr_num[j] = x;
				arr_kata[i] = arr_kata[j];
				arr_kata[j] = y;
			}
		}
	}

	for (var i = 0; i < arr_kata.length; i++) {
		kata_terurut += arr_kata[i]+" ";
	}
	return kata_terurut;
}

console.log(sort("ta3hun menjela2ng se1lamat b4aru"));
