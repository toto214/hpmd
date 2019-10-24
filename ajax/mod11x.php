<!--
	<b>CID : </b><input class="cid_tf" id="mod_cid" />
	<input type="button" value="submit" onclick="checkMod11();" />
    <input type="button" value="GENCID" onclick="GMM();" />
    <div class="CHECK"></div>   -->
    
<script>

function GMM(){
	var v1 = 0;
	var v2 = 0;
	var v3 = 0;
	var v4 = 1;
	var v5 = 9;
	var v6 = Math.floor(Math.random() * (9 - 0 + 1)) + 0;
	var v7 = Math.floor(Math.random() * (9 - 0 + 1)) + 0;
	var v8 = Math.floor(Math.random() * (9 - 0 + 1)) + 0;
	var v9 = Math.floor(Math.random() * (9 - 0 + 1)) + 0;
	var v10 = Math.floor(Math.random() * (9 - 0 + 1)) + 0;
	var v11 = Math.floor(Math.random() * (9 - 0 + 1)) + 0;
	var v12 = Math.floor(Math.random() * (9 - 0 + 1)) + 0;
	var x = (v1*13)+(v2*12)+(v3*11)+(v4*10)+(v5*9)+(v6*8)+(v7*7)+(v8*6)+(v9*5)+(v10*4)+(v11*3)+(v12*2);
	x = x % 11;
	if(x<=1){
		x = 1-x;
	}else{
		x = 11 - x;
	}
	//alert(v1+""+v2+""+v3+""+v4+""+v5+""+v6+""+v7+""+v8+""+v9+""+v10+""+v11+""+v12+""+x);
	document.getElementById("cid").value = (v1+""+v2+""+v3+""+v4+""+v5+""+v6+""+v7+""+v8+""+v9+""+v10+""+v11+""+v12+""+x);
	
	
	
}
function checkMod11(){
 var cid = document.getElementById("cid_tf").value;
 if(cid.length==13){
 	var v1 = cid.substr(0, 1);
	var v2 = cid.substr(1, 1);
	var v3 = cid.substr(2, 1);
	var v4 = cid.substr(3, 1);
	var v5 = cid.substr(4, 1);
	var v6 = cid.substr(5, 1);
	var v7 = cid.substr(6, 1);
	var v8 = cid.substr(7, 1);
	var v9 = cid.substr(8, 1);
	var v10 = cid.substr(9, 1);
	var v11 = cid.substr(10, 1);
	var v12 = cid.substr(11, 1);
	var v13 = cid.substr(12, 1);
    var x = (v1*13)+(v2*12)+(v3*11)+(v4*10)+(v5*9)+(v6*8)+(v7*7)+(v8*6)+(v9*5)+(v10*4)+(v11*3)+(v12*2);
	x = x % 11;
	if(x<=1){
		x = 1-x;
	}else{
		x = 11 - x;
	}
	alert(v13+":"+x);
 }else{
 	alert("length <> 13");
 }
}
</script>
