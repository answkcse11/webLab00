document.observe("dom:loaded", function(){
	$("findPW").observe("click", findPW);
	$("join").observe("click", join);
});

function findPW() {
	//how to:
	//popup을 통해서 학번을 입력받는다.
	//임의의 비밀번호를 제공한다.
	var stdid = prompt("학번을 입력해주세요.", "");
	if(/* stdid를 db에서 select해본다. */) {
		//찾았다면 해당 계정의 비밀번호를 임의의 6자리의 알파벳대문자와 숫자로 지정한뒤
		var temppw = randomStr();
		//해당번호를 hashing한 값으로 회원테이블의 PW attribute를 update한다.
		//update(~~~~~);
		//임의생성된 비밀번호를 alert를 통해서 알려준다.
		alert("임의생성된 비밀번호는 \'"+temppw+"\' 입니다.");
	} else {
		alert("입력하신 학번은 존재하지 않는 회원입니다.");
	}
}

function join() {
	/*
	입력할 정보는 총 4가지
	학번, PW, 이름, 레벨
	popup을 통해서 입력을 받도록 한다.
	입력받은 정보들은 ajax를 통해서 validation을 검사한뒤
	db에 저장하도록 insert한다.
	insert가 완료되면 popup창을 close하여 가입이 완료되었다는 alert를 띄운다.
	*/
}

function randomStr() {
	var str = "";
	var charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	for (var i=0; i<6; i++)
        str += charset.charAt(Math.floor(Math.random() * charset.length));
    return str;
}