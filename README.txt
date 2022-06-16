----------------------------- Orientações da API -----------------------------
Toda a estrutura da base de dados está no script chamado "Notícias.sql"
Primeiramente precisa ser realizada a importação da base no script que citei 
acima.

A estrutura do banco consta com uma tabela de registro das notícias e outra 
dos tokens de acesso à api.
O token de acesso tem o status válido (1) ou inválido (0), só podendo ser 
usado para consumo da api quando estiver válido.

Todas as constantes de configuração estão em /app/config/config.php, basta 
ajustar os valores nela (como por exemplo, porta do banco, nome do banco, 
local da api) para se iniciar o uso da api.

Há a configuração do arquivo .htacces referente ao caminho da api, para 
redirecionamento por url amigável, deve-se ajustar este valor também.

Após estes passos, basta consumir os endpoints.
Métodos aceitos: 
	GET
		URL: /news/{$id_noticia} ou /news/
		HEADER: x-api-key: {$token_banco}
		Observações: A passagem do id da notícia não é obrigatória,
		ao passar sem o mesmo, irá listar todas as notícias do banco de
		dados. O token de acesso é obrigatório, como forma de restrição às
		informações de consulta/envio para a base de dados.
	POST
		URL: /news
		HEADER: x-api-key: {$token_banco}
		BODY: {
    			"title":"Título da notícia",
		    	"description":"Descrição da notícia",
    			"image":"Caminho da imagem da notícia."
			  }
