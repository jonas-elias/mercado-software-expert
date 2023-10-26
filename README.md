# <img src="https://www.softexpert.com/wp-content/themes/Zephyr-child/icon-softexpert-site.png" alt="SoftExpert Logo">  Software Expert - Mercado

Este é um repositório que permite o cadastro de produtos, tipos de produtos, valores percentuais de imposto, registro de vendas e cálculos de impostos sobre os produtos adquiridos aplicados as regras de servidor.

## Bibliotecas desenvolvidas para o projeto
O projeto desenvolvido utilizous-se de algumas bibliotecas desenvolvidas também por mim durante o desenvolvimento. Tomei a liberdade e criei uma espécie de SoftExpert Framework.

 Bibliotecas desenvolvidas e seus respectivos repositórios:
 - https://github.com/jonas-elias/expert-framework-database
 - https://github.com/jonas-elias/expert-framework-http
 - https://github.com/jonas-elias/expert-framework-validation
 - https://github.com/jonas-elias/expert-framework-helpers
 - https://github.com/jonas-elias/expert-framework-container

(sim, fiz do zero e estão todas publicadas no packagist 😎)

## Recursos Principais 📦

- **Cadastro de Produtos:** Registre informações detalhadas sobre os produtos disponíveis no mercado.

- **Cadastro de Tipos de Produtos:** Categorize os produtos em tipos para uma organização eficiente.

- **Impostos Personalizáveis:** Defina valores percentuais de imposto para diferentes produtos ou categorias.

- **Registro de Vendas:** Registre todas as vendas realizadas no mercado.

- **Cálculos de Impostos:** O sistema automatiza o cálculo de impostos sobre os produtos adquiridos.

## Pré-requisitos 🛠️

Antes de executar a aplicação, certifique-se de seguir os requisitos abaixo

- PHP-8.2
- Composer
- Extensão pdo_pgsql

## Configuração do Projeto ⚙️

Siga as etapas abaixo para configurar e executar o projeto:

1. Clone o repositório do GitHub e entre no diretório:

   ```shell
   git clone https://github.com/jonas-elias/mercado-software-expert.git && cd mercado-software-expert/

2. Instale as dependências:
   ```shell
   composer update

3. Inicie a aplicação:
   ```shell
   cd src/public/ && php -S 0.0.0.0:8000

## Qualidade de software 👌

#### Testes
```php
composer test
```

#### PHPStan
```php
composer analyse
```

#### Versionamento automático
```php
composer generate-changelog
```

## Dúvidas 🤔
Caso exista alguma dúvida sobre como instalar, utilizar ou gerenciar o projeto, entre em contato com o email: jonasdasilvaelias@gmail.com
Um grande abraço!
