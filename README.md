# Avaliação Dev

### Link
<https://github.com/eureciclo/avaliacao_dev>

### Inicialização

Para começar, instale as dependencias:
```
composer install
npm install
```

Adicione o .env:
```
composer run post-root-package-install
php artisan key:generate
```

Inicie o Laravel Mix:
```
// Em desenvolvimento:
npm run dev

// Em produção:
npm run prod
```

Em seguida, crie e inicie o conteiner:
```
docker-compose up -d --build
```

Crie as tabelas do banco de dados:
```
docker exec app php artisan migrate
```

Agora pode iniciar os testes:
```
docker exec app php artisan test
```

Caso dê algum problema, reinicie o nginx:
```
docker exec app service nginx reload
```

Para parar o conteiner, use o comando:
```
docker-compose down
```
