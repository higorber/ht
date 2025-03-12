# SISTEMA DE GERENCIAMENTO DE HOST FAMILY PARA CELÍACOS

Este projeto foi desenvolvido como parte do Trabalho de Conclusão de Curso (TCC) para a obtenção do título de Tecnólogo em Análise e Desenvolvimento de Sistemas pela Faculdade de Tecnologia de Jundiaí - "Deputado Ary Fossen", sob a orientação da Professora Me. Ângela Cristina de Oliveira Lühmann.

## Integrantes

- Higor Bernardes da Silva  
- Myrelle Sales Santos  
- Victor De Almeida e Silva  
- Whitney Gomes Santos De Sousa  

## Sobre o Projeto

O Sistema de Gerenciamento de Host Family para Celíacos foi desenvolvido com o objetivo de proporcionar uma plataforma segura e eficiente para pessoas celíacas (portadoras da doença celíaca), permitindo que elas encontrem hospedagens com opções alimentares adequadas às suas necessidades, sem riscos de contaminação cruzada. Além disso, o sistema oferece uma interface amigável para anfitriões que desejam disponibilizar suas propriedades e gerenciar reservas, tudo isso em conformidade com as exigências alimentares rigorosas dos celíacos.

Este sistema visa garantir que os hóspedes celíacos possam se hospedar de maneira segura, sem a preocupação com a ingestão acidental de glúten, ao mesmo tempo em que oferece aos anfitriões uma maneira simples e eficaz de gerenciar suas hospedagens e reservas.

## Funcionalidades

O sistema conta com funcionalidades como:

- Cadastro de anfitriões e hóspedes
- Gerenciamento de hospedagens
- Busca de hospedagens específicas para celíacos
- Gerenciamento de reservas e disponibilidade
- Filtros para garantir opções seguras, sem glúten

## Tecnologias Utilizadas

- **PHP** para o desenvolvimento da aplicação web
- **MySQL** para o gerenciamento do banco de dados
- **HTML/CSS/JavaScript** para a construção da interface do usuário

## Instruções de Instalação e Configuração

### 1. Instalar o XAMPP

Para rodar o sistema localmente, você precisará instalar o **XAMPP**, que inclui o servidor Apache (para rodar o sistema web) e o MySQL (para gerenciar o banco de dados).

- Baixe o XAMPP em: [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)
- Após o download, execute o instalador e siga os passos de instalação.
- Depois de instalado, abra o **Painel de Controle do XAMPP** e inicie os módulos **Apache** e **MySQL**.

### 2. Criar Banco de Dados no phpMyAdmin

Após a instalação do XAMPP, siga os passos abaixo para configurar o banco de dados:

1. Abra o navegador e acesse `http://localhost/phpmyadmin/`.
2. Crie um banco de dados chamado `hotel_bd`.
3. Importe o arquivo `hotel_bd.sql` (este arquivo deve estar disponível para você) para o banco de dados criado, clicando em "Importar" e selecionando o arquivo `.sql` no seu computador.

### 3. Configuração do Sistema

Após configurar o XAMPP e o banco de dados, siga os passos abaixo para acessar o sistema e fazer as configurações necessárias:

1. **Acesso ao Sistema:**
   - Abra o navegador e acesse o sistema através de `http://localhost/ht/`.
   
2. **Cadastro de Usuários:**
   - O sistema possui um sistema de cadastro para **Anfitriões** e **Hóspedes**. 
   - O **Anfitrião** pode cadastrar, gerenciar e visualizar as hospedagens e as reservas.
   - O **Hóspede** pode fazer reservas nas hospedagens cadastradas pelo Anfitrião.

3. **Gerenciamento de Hospedagens:**
   - O **Anfitrião** pode cadastrar novas **hospedagens** e gerenciar informações relacionadas, como preços, disponibilidade e outras configurações.
   
4. **Reserva pelo Hóspede:**
   - O **Hóspede** pode visualizar as hospedagens disponíveis e realizar uma **reserva**.
   - Após a reserva ser realizada, o **Anfitrião** será notificado para confirmar ou recusar a reserva.

5. **Confirmação de Reserva:**
   - Após o **Anfitrião** confirmar a reserva, o Hóspede será redirecionado para o **WhatsApp** para concluir o pagamento e outros detalhes relacionados à estadia.

6. **Consideração sobre Dieta para Celíacos:**
   - No cadastro de cada hospedagem, o **Anfitrião** pode informar se o local oferece opções para **celíacos** (sem glúten). Isso permite que Hóspedes com restrições alimentares possam fazer uma escolha mais informada sobre onde se hospedar.

## Como Usar

Para rodar o sistema localmente, siga as etapas abaixo:

1. Clone este repositório:
   ```bash
   git clone https://github.com/seu-usuario/nome-do-repositorio.git
   ```
2. Configure seu banco de dados MySQL de acordo com as instruções do projeto.
3. Abra o arquivo `index.php` no navegador e comece a utilizar o sistema!

## Agradecimentos

Este trabalho é dedicado aos professores, colegas de curso, e aos nossos familiares, que foram fundamentais durante a jornada acadêmica. Agradecemos também a todos que contribuíram direta ou indiretamente para o sucesso deste projeto.

## Conclusão

Este trabalho de TCC contribui para a criação de um ambiente mais seguro e inclusivo para pessoas celíacas, oferecendo uma solução tecnológica inovadora para o gerenciamento de hospedagens. O projeto está em constante evolução, com planos para melhorias e novos recursos que atenderão às necessidades de um público cada vez mais exigente em termos de segurança alimentar e experiência de hospedagem.

## Licença

Distribuído sob a licença MIT. Veja `LICENSE` para mais informações.

## Contato

Se tiver dúvidas ou sugestões, entre em contato com [seu_email@dominio.com](mailto:seu_email@dominio.com).
