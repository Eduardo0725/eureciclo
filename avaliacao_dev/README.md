# Avaliação Dev

### Link
<https://github.com/eureciclo/avaliacao_dev>

### Observações
Caso tenha algum problema no windows, como "Unsupported operating system [MINGW64_NT-10.0-18363]. Laravel Sail supports macOS, Linux, and Windows (WSL2).", então utilize alguma distribuição (de preferência Linux) no WSL2 do Windows <https://docs.microsoft.com/en-us/windows/wsl/install-win10>. Para saber quais distribuições contém no WSL2 da sua máquina use o comando:
```
$ wsl -l -v
```
Para usar alguma distribuição, use o comando:
```
$ wsl -d distribuição-escolhida
```
Ou se tiver uma distribuição já padrão, só use `$ wsl`.

### Inicialização

Para começar, instale as dependencias:
```
$ composer install
```

Em seguida use o comando do sail para subir os arquivos no Docker
```
$ ./vendor/bin/sail up
```
Ou, se tiver o Git Bash, pode atribui o sail usando o seguinte comando:
```
$ alias sail='bash vendor/bin/sail'
$ sail up
```

Para parar o processo, use o 'Ctrl + C' ou abra outro terminal e use:
```
$ ./vendor/bin/sail down
ou
$ sail down
```
