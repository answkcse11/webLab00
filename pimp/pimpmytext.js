function onClick() {
	$("mytext").style.fontSize = "24pt";
	//alert("Hello, world!");
}

function onChange() {
	if($("bling").checked) {
		$("mytext").style.fontWeight = "bold";
		$("mytext").style.color = "green";
		$("mytext").style.textDecoration = "underline";
	} else {
		$("mytext").style.fontWeight = "normal";
		$("mytext").style.color = "black";
		$("mytext").style.textDecoration = "none";
	}
}

function snoopify() {
	$("mytext").style.textTransform = "uppercase";
	var text = $("mytext").innerHTML;
	var array = test.split("\n");
	for(var i=0; i<array.length; i++) {
		array[i].
	}
}