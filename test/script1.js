var xhttp = new XMLHttpRequest();

function loadPage() {
	xhttp.onreadystatechange = function(){
	if (this.readyState == 4 && this.status == 200) {
		setTimeout(function(){ getList();} , 1000);
		}		     
    }
	xhttp.open("POST", "index.php");
	xhttp.send();
}

function getList(){
	$.get('php/getUsers.php', function(response){
		var data = JSON.parse(response);
		var list = data.dataSet;
		var html = '';
		if(data.status == 1){
			var i;
			for(i = 0; i < list.length; i++){
				html+= "<button onclick='deleteList(this.id); loadPage();' id='"+list[i].id+"' class='close'>&#9940</button>";
				html+= "<span class='showList'>"+list[i].user+"</span><br><br>";
			}
			$('#userList').html(html);
		}
	});
}

function deleteList(get_id) {
	$.post('php/delete.php', {'users' : get_id} , function(response){
		var data = JSON.parse(response);
		alert(data.msg);
	})
}
