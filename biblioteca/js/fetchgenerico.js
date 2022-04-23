function fetchGenerico(link,dados){
		
	const retorno = fetch(link,	
				{method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					},
					body: dados})
				
	return retorno;	
}

function fetchGenericoTudo(link){
			
	const retorno = fetch(link,	
				{method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					}})				
	return retorno;	
}



