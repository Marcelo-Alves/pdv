function fMasc(objeto,mascara) {
	obj=objeto
	masc=mascara
	setTimeout("fMascEx()",1)
}

function fMascEx() {
	obj.value=masc(obj.value)
}

function mTel(tel) {
	tel=tel.replace(/\D/g,"")
	tel=tel.replace(/^(\d)/,"($1")
	tel=tel.replace(/(.{3})(\d)/,"$1)$2")
	if(tel.length == 9) {
		tel=tel.replace(/(.{1})$/,"-$1")
	} else if (tel.length == 10) {
		tel=tel.replace(/(.{2})$/,"-$1")
	} else if (tel.length == 11) {
		tel=tel.replace(/(.{3})$/,"-$1")
	} else if (tel.length == 12) {
		tel=tel.replace(/(.{4})$/,"-$1")
	} else if (tel.length > 12) {
		tel=tel.replace(/(.{4})$/,"-$1")
	}
	return tel;
}

function mCEP(cep){
	cep=cep.replace(/\D/g,"")
	cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
	cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
	return cep
}


function mCPF(cpf){
	cpf=cpf.replace(/\D/g,"")
	cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
	cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
	cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
	return cpf
}

function validar() {
   let campo1 = document.getElementById('senha');
   let campo2 = document.getElementById('confirmasenha');
   let formulario= document.getElementById('frmfuncionario');

   if (campo1.value != campo2.value) {
		alert('O campo Confirma Senha tem que ser igual a campo Senha');		
		campo1.style.backgroundColor = "#FF0000";
		campo2.style.backgroundColor = "#FF0000";
		return false;
   }
   else{
	   formulario.submit();
   }
   
   
}