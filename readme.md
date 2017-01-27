# SKND 0.0.1 "Hannah"

Este repositório pertence à equipe de Front-End do [projeto Skynerd Rebirth](https://www.facebook.com/groups/949377481749232/).

Neste repositório estão contidas as Views referentes ao processo de cadastramento de usuários Alpha/Beta.

As instruções de instalação estão simplificadas.

## Instalando o ambiente

Para iniciar é preciso instalar o Apache (ou Negix), PHP, MySQL e o [Composer](https://getcomposer.org), além do Git/GitHub. Instruções para instalar as ferramentas não estão inclusas aqui.

Opcionalmente, será preciso instalar o [NodeJS](https://) para utilizar o NPM, Sass e outras ferramentas de desenvolvimento avançadas.

## Baixando e utilizando o repositório

Para usuários Linux, MacOS ou simplesmente avançados, é possível usar o Git diretamente, que estará instalado na máquina.

Baixe o repositório com o comando

    $ git clone https://github.com/andreScutieri/sknd-hannah-betatest.git

Isso baixará todos os arquivos modificados para seu computador, numa pasta escolhida antes de dar o comando. No entanto, antes de poder utilizar o repositório, é preciso instalar o Laravel e suas dependências. Dentro da pasta baixada pelo git, é preciso dar o comando

    $ composer install

E esperar que todas as dependências sejam instaladas. No próximo passo, ensinarei a configurar a plataforma corretamente. Você pode pular para lá e voltar aqui quando terminar. Eu espero.

Com a plataforma configurada (ou não), você pode começar a fazer suas próprias modificações no código. Depois de criar arquivos, modificar arquivos existentes ou deletar alguma coisa, é preciso enviar essas modificações para que todos possam ver.

    $ git add <arquivo>

Onde `<arquivo>` é o nome do arquivo modificado, por exemplo `$ git add sidebar.blade.php`. Se você quer enviar vários arquivos num único pacote ou simplesmente colocar todo o material editado de uma vez, pode usar o `.` (ponto) no lugar do arquivo: `$ git add .`.

Depois de marcar todos os arquivos que você editou para envio, é preciso adicioná-los na lista de envio. Para isso, é preciso fazer um "commit". Durante o commit, você DEVE adicionar uma curta mensagem explicando sua contribuição ao projeto.

    $ git commit -m "Minha mensagem aqui"

Agora, suas modificações estão empacotadas e prontas para serem enviadas ao servidor remoto. Para isso, é preciso enviá-las ao GitHub.

    $ git push origin master

Sendo `master` o branch que estamos usando. Você pode criar um branch próprio apenas para sua edição e depois requisitar um `merge` (na verdade, este é o procedimento correto, que mostrarei em breve).

Caso seja a primeira vez que você vai contribuir, o Git ainda não sabe qual é o repositório Origin que estamos usando, então é preciso configurar com um comando. Depois de fazer isso uma vez, você não precisará repetir esse passo para os próximos commits. Importante avisar que o commit acima vai falhar se você não fizer o próximo comando antes:

    $ git remote add origin https://github.com/andreScutieri/sknd-hannah-betatest.git

Agora assim você pode dar `push` no seu commit.

Como disse antes, branches (galhos) são a maneira correta de trabalhar no Git. Isso possibilita que as modificações sejam testadas e validadas antes de ficarem disponíveis para todos. Isso possibilita que o Branch "master" (também chamado de Trunk ou Tronco) fique limpo e estável, enquanto os colaboradores trabalham em seus próprios branches isoladamente ou em pequenos grupos.

Para criar um novo branch local:

    $ git checkout -b nome_do_branch

Como exemplo, imagine que estou desenvolvendo o painel de login. Depois de clonar no repositório (baixar tudo) e instalar todo o ambiente, posso fazer `$ git checkout -b painel_login` e trabalhar dentro desse branch até ele estar pronto. Só aí posso pedir que para meu trabalho seja inserido no "master", ficando disponível a todos. Para que outros possam trabalhar com meu branch, eu posso disponibilizá-lo no repositório:

    $ git push origin nome_do_branch

Para manter seu código atualizado com as últimas mudanças que os outros coloboradores estão fazendo, é preciso fazer o `pull` de tempos em tempos. Num grupo bem organizado, que usa seus próprios branches para trabalhar, é possível fazer o `pull` todo dia, logo antes de começar a trabalhar no projeto:

    $ git pull

O Git checará o repositório para ver se há algo novo, e fará download dos arquivos. 

É possível substituir toda a complexidade do Git pelo programa do GitHub, que fará a maior parte do trabalho de forma visual e simplificada. O link está [aqui](https://) e é possível encontrar tutoriais para trabalhar tanto com o Git como com o GitHub no YouTube e no Google.

### Configurando a plataforma

Antes de poder usar o software, mesmo que seja só para ver as Views, é preciso fazer alguns comandos simples. Em primeiro lugar, você deve encontrar na raíz do projeto um arquivo chamado `.env.example`. Se você está usando Linux ou MacOS este arquivo estará oculto. Renomeie o arquivo para `.env`, tomando cuidado para que não seja digitado nada antes do ponto.

Agora, use o terminal ou janela de comando para gerar a chave secreta do Laravel. Essa chave é única em toda instalação e não será dividida nem mesmo com os colaboradores do projeto. Não precisa se preocupar, que o arquivo `.env` é secreto e não é enviado para o Git.

Dentro da pasta do projeto, execute o comando:

    $ php artisan key:generate

Ao completar o comando, seu arquivo `.env` terá uma sequência de caracteres na linha `APP_KEY`.

Na seção `DB_` é preciso preencher a configuração do MySQL para poder usar o banco de dados. Colaboradores que preferem usar outros bancos de dados só precisam seguir as instruções [desta página](https://). É muito simples de usar outros bancos com o Laravel, ainda que o projeto final use MySQL (MariaDB).

Preenchido o campo, é necessário agora "migrar" o banco de dados, que criará as tabelas que usaremos. Ainda no terminal, na pasta raíz, dê o comando:

    $ php artisan migrate

Este repositório só conta com uma única tabela. Não se preocupe se o sistema levantar Warnings, só se preocupe se houver algum erro fatal. Duas tabelas devem estar presentes no Banco de Dados: uma tabela `migrations`, criada pelo Laravel, e uma tabela `betas` que será usada por nós.

No arquivo `.env` verifique o valor da chave `APP_URL` para que os links das páginas sejam criados corretamente. Coloque o caminho completo do seu host de teste, por exemplo, `http://localhost/sknd`. Não coloque barra no final do endereço. Confira que a chave `APP_DEBUG` esteja como `true` para ver mensagens de erro mais completas!

### Editando as Views

Finalmente vamos poder começar a trabalhar! Mas antes vamos dar uma espiada no Backend para entender um pouquinho só sobre o Laravel e a SKND. Na pasta `routes` abra o arquivo `web.php`. Você deve ver o seguinte conteúdo:

    Route::get('/', 'BetaController@getBetaForm');
    Route::post('/', 'BetaController@postBetaForm');
    
    Route::get('/thankyou', 'BetaController@showThankYou');

Existem 3 rotas (routes) nesta versão super-simplificada do sistema. A primeira é a home (ou index), a própria página inicial. Quando você abrir o sistema no navegador, verá essa rota:

<img src="http://imgur.com/AETjIIv" alt="Home Page">

A segunda rota é a mesma página `/`, mas ao invés de ter seu método como GET, ela possui o método POST. Isso significa que essa rota é a usada para receber os dados do formulário de cadastro. Você não conseguirá acessar essa rota pelo método POST pelo navegador a não ser que clique no botão "Cadastrar" no formulário. A viagem até ela é tão rápida que você nem verá a página, pois o cadastro te levará para a última página disponível: `thankyou`. Nesta página, é possível ver apenas uma mensagem de agradecimento.

Se você foi honesto(a) e digitou dados corretos no formulário antes de clicar em Cadastrar, um usuário foi criado no banco de dados que nós migramos, na tabela `betas`. Nesta tabela, você verá um número de identificação (id), um nome de usuário (username), o e-mail (email), um código especial (token), a data de cadastro (created_at) e a data de atualização (updated_at). Você pode criar quantos usuários beta quiser, pois todo o código será descartado. Caso você "suje" demais o banco, pode refazer a migração, começando do zero, usando o comando na pasta raíz do projeto

    $ php artisan migrate:refresh

As duas páginas exibidas pelas rotas (o formulário e o agradecimento) estão dentro da pasta `resources/views/beta`. São dois arquivos: `registerbeta.blade.php` e `thankyou.blade.php`. Ao abrir qualquer um desses arquivos, você verá que a primeira linha diz:

    @extends('layouts.main')

Isso significa que as duas Views fazem parte de outro template, que mora na pasta `resources/views/layouts`. Neste arquivo `main.blade.php` é possível verificar o código base de uma página HTML, com o header, body e as tags meta.

No centro do arquivo `main` é possível ver a linha `@yield('content')`. Esta linha é substituída pelo conteúdo das Views `thankyou` e `registerbeta`. Isso deve ser levado em consideração ao criar as páginas, já que modificações na View `main` surtirá efeito em todas as páginas, enquanto o contrário não ocorre. Arquivos que devem estar disponíveis universalmente (como CSS, JS, fontes e etc) devem ser colocados no arquivo `main`. 

### Entendendo o arquivo registerbeta

O formulário está inserido dentro das tags `@section('content')` e `@endsection`. Estas tags existem para avisar o Laravel que este conteúdo será colocado no lugar do `@yield('content')` no layout principal. O código HTML é comum e simples, usando as classes do Twitter Bootstrap para dar uma ajeitada, e pode ser eliminado completamente. 

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/') }}">

O interessante desta linha é a sessão do "action". Esse código cria um link para a página principal (/) dinamicamente e não deve ser modificado.

    {{ csrf_field() }}

Este código especial cria um campo invisível de nome `_token` e é usado para prevenir ataques maliciosos. Se o código for removido, o Laravel não deixará o formulário ser enviado. Ele deve ficar dentro do formulário, preferencialmente como o primeiro campo.

    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">

Nesta linha, há um código especial em PHP para exibir uma classe extra. Caso haja um erro no nome do usuário, a class `has-error` será injetada nessa linha. Senão, não. Esse código pode ser adaptado para adicionar classes de erro no formulário seguindo outro padrão que não o do Twitter Bootstrap. Todos os outros campos possuem um código similar.

    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

O campo interessante é o value, que possui um código `{{ old('username') }}`. Caso o usuário faça um erro no cadastro e seja rejeitado, o valor do campo "voltará" preenchido. Ao remover este código, o campo volta em branco.

    @if ($errors->has('username'))
    	<span class="help-block">
            <strong>{{ $errors->first('username') }}</strong>
        </span>
    @endif

Este bloco exibe uma mensagem de erro se e apenas se houver um erro naquele campo. O código dentro do bloco `@if` pode ser alterado conforme as necessidades, e até ser mudado de lugar à vontade. O texto do código é gerado dinamicamente e inserido dentro das tags `<strong>`.

Um link para uma página de contrato ainda não existente está incluso, e gera um erro se for clicado. Experimente preencher incorretamente o formulário para verificar os erros gerados. A regra diz que o campo Username deve só conter letras, números e traços, ter menos de 255 caracteres e é obrigatório. O campo de e-mail precisa ser um e-mail válido, com menos de 255 caracteres e é obrigatório. Um erro especial será exibido se você tentar usar um username ou e-mail já cadastrado!

A View `thankyou` só possui uma mensagem de agradecimento.

### O arquivo app.css e app.js

Dois arquivos são gerados para uso do aplicativo, app.css e app.js. Ambos estão dentro da pasta `public`, em suas respectivas pastas. Estilos e script personalizados devem habitar a pasta `public` e serem divididos em suas próprias pastas. Se for necessário colocar fontes, crie uma pasta `fonts` e insira os arquivos dentro dela. Também é possível e necessário substituir o arquivo `favicon.ico` por um Favicon adequado.

O Laravel já está apto para usar SASS e LESS (entre outros pré-processadores), assim como usar o Gulp e WebPack. Não vou colocar em detalhes como usar essas tecnologias. Para fazer uso, instale o `npm` e puxe as dependências com o comando `npm install`. Uma página do manual [está inclusa](http://) aqui para configurar o sistema para usar o SASS, LESS ou o que quer que seja.

### Finalmentes

O objetivo nosso é construir a "cara" inicial do projeto SKND através deste sistema super-simples de cadastro de usuários Alpha/Beta. O sistema incluso aqui não possui nenhum código além do necessário para executar essa funcionalidade, portanto não serve como rede social, mas é uma importante ferramenta de aprendizado para a equipe. Através deste repositório, simulamos o workflow do futuro repositório completo da rede, a ser liberado em breve, e podemos já aprender a trabalhar com as Views, além de testar designs.

Principalmente, é preciso lembrar que esta é a versão ALPHA do projeto, e tudo pode (e provavelmente vai) ser mudado até a versão final. Logo, usemos este espaço para testar ideias ao invés de nos preocuparmos com otimização e perfeição. Ele oferece uma base bem restrita de controles (campos de formulário e botão, além de parágrafos de texto) para testarmos conceitos de design e código.

Bom trabalho a todos e qualquer dúvida sabem onde me encontrar! :D

-- Andre


