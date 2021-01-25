# Avaliação Dev

### Link
<https://github.com/eureciclo/avaliacao_dev>

### Observações
Caso tenha algum problema no windows ao utilizar o Laravel Sail, como "Unsupported operating system [MINGW64_NT-10.0-18363]. Laravel Sail supports macOS, Linux, and Windows (WSL2).", então utilize alguma distribuição (de preferência Linux) no WSL2 do Windows <https://docs.microsoft.com/en-us/windows/wsl/install-win10>. Para saber quais distribuições contém no WSL2 da sua máquina use o comando:
```
$ wsl -l -v
```
Para usar alguma distribuição, use o comando:
```
$ wsl -d distribuição-escolhida
```
Ou se tiver uma distribuição já padrão, só use `$ wsl`.
Obs: Utilizar WSL2 com o Docker pode apresentar alguns problemas, caso isso ocorra tente fechar do terminal WSL2 e abrir novamente.
### Inicialização

Para começar, instale as dependencias:
```
$ composer install
$ npm install
```

Adicione o .env:
```
$ composer run post-root-package-install
$ php artisan key:generate
```

Inicie o Laravel Mix:
```
// Em desenvolvimento:
$ npm run dev

// Em produção:
$ npm run prod
```

A partir daqui pode-se usar o WSL2, caso tenha problemas com o windows ao utilizar o Laravel Sail.

Em seguida use o comando do Laravel Sail para subir os arquivos no Docker:
```
$ ./vendor/bin/sail up -d
```

Também pode atribuir o caminho do Laravel Sail no Git Bash usando o seguinte comando:
```
$ alias sail='bash vendor/bin/sail'
$ sail up -d
```

Agora crie as tabelas do banco de dados:
```
$ sail artisan migrate
```

Para parar o processo use:
```
$ ./vendor/bin/sail down
ou
$ sail down
```
